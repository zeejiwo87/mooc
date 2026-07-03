<?php

namespace App\Services\Materi;

use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

final class SoalImportService
{
    /**
     * Import soal dari template teks.
     *
     * Aturan bobot otomatis:
     * - Jika template tidak menulis "Nilai: ...", bobot soal dibagi otomatis supaya total mendekati 100.
     *   Contoh: 10 soal => 10 poin per soal, 50 soal => 2 poin per soal, 3 soal => 34/33/33.
     * - Jika sebagian soal menulis "Nilai: ...", nilai manual dipertahankan dan sisa bobot dibagi
     *   ke soal yang tidak menulis nilai.
     */
    public function importFromText(int $idKuis, string $text): array
    {
        $questions = $this->applyAutomaticWeights($this->parse($text));

        if (empty($questions)) {
            throw new InvalidArgumentException('Template soal kosong atau formatnya belum benar.');
        }

        $createdSoal = 0;
        $createdJawaban = 0;

        DB::transaction(function () use ($idKuis, $questions, &$createdSoal, &$createdJawaban) {
            foreach ($questions as $question) {
                $idSoal = DB::table('soal')->insertGetId([
                    'id_kuis' => $idKuis,
                    'teks_soal' => $question['teks_soal'],
                    'nilai' => (int) $question['nilai'],
                    'penjelasan' => $question['penjelasan'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $createdSoal++;

                foreach ($question['jawaban'] as $answer) {
                    DB::table('soal_jawaban')->insert([
                        'id_soal' => $idSoal,
                        'teks_jawaban' => $answer['teks_jawaban'],
                        'benar' => $answer['benar'] ? 1 : 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $createdJawaban++;
                }
            }
        });

        return [
            'total_soal' => $createdSoal,
            'total_jawaban' => $createdJawaban,
            'total_bobot' => array_sum(array_map(fn ($question) => (int) $question['nilai'], $questions)),
        ];
    }

    private function parse(string $text): array
    {
        $text = trim(str_replace(["\r\n", "\r"], "\n", $text));

        if ($text === '') {
            return [];
        }

        $lines = array_values(array_filter(array_map('trim', explode("\n", $text)), fn ($line) => $line !== ''));

        $questions = [];
        $current = null;

        foreach ($lines as $line) {
            if (preg_match('/^\d+[\.\)]\s*(.+)$/u', $line, $matches)) {
                if ($current !== null) {
                    $questions[] = $this->validateQuestion($current, count($questions) + 1);
                }

                $current = [
                    'teks_soal' => trim($matches[1]),
                    'nilai' => null,
                    'nilai_manual' => false,
                    'penjelasan' => null,
                    'jawaban' => [],
                ];

                continue;
            }

            if ($current === null) {
                continue;
            }

            if (preg_match('/^Nilai\s*:\s*(\d+)$/iu', $line, $matches)) {
                $current['nilai'] = max(1, (int) $matches[1]);
                $current['nilai_manual'] = true;
                continue;
            }

            if (preg_match('/^Penjelasan\s*:\s*(.+)$/iu', $line, $matches)) {
                $current['penjelasan'] = trim($matches[1]);
                continue;
            }

            if (preg_match('/^[A-Z][\.\)]\s*(.+)$/u', $line, $matches)) {
                $answerText = trim($matches[1]);
                $isCorrect = str_contains($answerText, '*');

                $answerText = trim(str_replace('*', '', $answerText));

                $current['jawaban'][] = [
                    'teks_jawaban' => $answerText,
                    'benar' => $isCorrect,
                ];

                continue;
            }

            if (! empty($current['teks_soal'])) {
                $current['teks_soal'] .= ' '.$line;
            }
        }

        if ($current !== null) {
            $questions[] = $this->validateQuestion($current, count($questions) + 1);
        }

        return $questions;
    }

    private function validateQuestion(array $question, int $number): array
    {
        if (trim((string) $question['teks_soal']) === '') {
            throw new InvalidArgumentException("Soal nomor {$number} belum memiliki teks soal.");
        }

        if (count($question['jawaban']) < 2) {
            throw new InvalidArgumentException("Soal nomor {$number} minimal harus memiliki 2 pilihan jawaban.");
        }

        $correctCount = collect($question['jawaban'])->where('benar', true)->count();

        if ($correctCount < 1) {
            throw new InvalidArgumentException("Soal nomor {$number} belum memiliki jawaban benar. Tambahkan tanda * pada salah satu jawaban.");
        }

        if ($correctCount > 1) {
            throw new InvalidArgumentException("Soal nomor {$number} memiliki lebih dari 1 jawaban benar. Untuk saat ini gunakan 1 jawaban benar saja.");
        }

        foreach ($question['jawaban'] as $index => $answer) {
            if (trim((string) $answer['teks_jawaban']) === '') {
                $pilihan = chr(65 + $index);
                throw new InvalidArgumentException("Jawaban {$pilihan} pada soal nomor {$number} masih kosong.");
            }
        }

        return $question;
    }

    private function applyAutomaticWeights(array $questions): array
    {
        $totalQuestions = count($questions);

        if ($totalQuestions === 0) {
            return [];
        }

        $autoIndexes = [];
        $manualTotal = 0;

        foreach ($questions as $index => $question) {
            $hasManualValue = (bool) ($question['nilai_manual'] ?? false);
            $nilai = (int) ($question['nilai'] ?? 0);

            if ($hasManualValue && $nilai > 0) {
                $manualTotal += $nilai;
                continue;
            }

            $autoIndexes[] = $index;
        }

        if (empty($autoIndexes)) {
            foreach ($questions as &$question) {
                $question['nilai'] = max(1, (int) ($question['nilai'] ?? 1));
                unset($question['nilai_manual']);
            }
            unset($question);

            return $questions;
        }

        $remainingTarget = 100 - $manualTotal;
        $weights = $this->distributeWeights($remainingTarget, count($autoIndexes));

        foreach ($autoIndexes as $i => $questionIndex) {
            $questions[$questionIndex]['nilai'] = $weights[$i] ?? 1;
        }

        foreach ($questions as &$question) {
            $question['nilai'] = max(1, (int) ($question['nilai'] ?? 1));
            unset($question['nilai_manual']);
        }
        unset($question);

        return $questions;
    }

    private function distributeWeights(int $targetTotal, int $count): array
    {
        if ($count <= 0) {
            return [];
        }

        // Jika jumlah soal lebih banyak daripada total target, integer min 1 membuat total tidak bisa tepat 100.
        // Dalam kondisi itu tetap berikan nilai minimal 1 agar validasi dan perhitungan kuis tetap aman.
        if ($targetTotal < $count) {
            return array_fill(0, $count, 1);
        }

        $base = max(1, intdiv($targetTotal, $count));
        $remainder = max(0, $targetTotal - ($base * $count));
        $weights = array_fill(0, $count, $base);

        for ($i = 0; $i < $remainder; $i++) {
            $weights[$i]++;
        }

        return $weights;
    }
}
