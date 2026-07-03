<?php

namespace App\Services\Kelas;

use App\Models\Kelas;
use App\Models\KelasMentor;
use Illuminate\Support\Collection;
use LogicException;

final class KelasMentorService
{
    private const ROLE_ASISTEN_MENTOR = 'Asisten Mentor';
    private const MAX_ASISTEN_MENTOR = 2;

    /**
     * Mengambil daftar asisten mentor pada satu kelas.
     *
     * Konsep:
     * - Mentor utama tetap dari kelas.id_pemilik.
     * - Asisten mentor diambil dari tabel kelas_mentor.
     * - Maksimal 2 asisten mentor per kelas.
     */
    public function getListData(string $id, ?array $filters = []): Collection
    {
        return KelasMentor::query()
            ->join('mentor', 'mentor.id_mentor', '=', 'kelas_mentor.id_mentor')
            ->where('kelas_mentor.id_kelas', $id)
            ->select([
                'kelas_mentor.id_kelas_mentor',
                'kelas_mentor.id_kelas',
                'kelas_mentor.id_mentor',
                'kelas_mentor.peran',
                'kelas_mentor.created_at',
                'kelas_mentor.updated_at',
                'mentor.nama as mentor_nama',
                'mentor.email as mentor_email',
                'mentor.foto_profil as mentor_foto_profil',
                'mentor.spesialisasi as mentor_spesialisasi',
            ])
            ->orderBy('kelas_mentor.id_kelas_mentor')
            ->get();
    }

    public function create(array $data): KelasMentor
    {
        $payload = $this->normalizePayload($data);

        $kelas = $this->getKelasOrFail($payload['id_kelas']);

        $this->ensureMentorBukanMentorUtama($kelas, $payload['id_mentor']);
        $this->ensureMentorBelumMenjadiAsisten($payload['id_kelas'], $payload['id_mentor']);
        $this->ensureJumlahAsistenBelumMaksimal($payload['id_kelas']);

        return KelasMentor::create($payload);
    }

    public function getDetailData(string $id, ?array $filters = []): ?KelasMentor
    {
        return KelasMentor::query()
            ->join('mentor', 'mentor.id_mentor', '=', 'kelas_mentor.id_mentor')
            ->join('kelas', 'kelas.id_kelas', '=', 'kelas_mentor.id_kelas')
            ->where('kelas_mentor.id_kelas_mentor', $id)
            ->select([
                'kelas_mentor.id_kelas_mentor',
                'kelas_mentor.id_kelas',
                'kelas_mentor.id_mentor',
                'kelas_mentor.peran',
                'kelas_mentor.created_at',
                'kelas_mentor.updated_at',
                'mentor.nama as mentor_nama',
                'mentor.email as mentor_email',
                'mentor.foto_profil as mentor_foto_profil',
                'mentor.spesialisasi as mentor_spesialisasi',
                'kelas.judul as kelas_judul',
                'kelas.id_pemilik as id_mentor_utama',
            ])
            ->first();
    }

    public function findById(string $id): ?KelasMentor
    {
        return KelasMentor::query()
            ->where('id_kelas_mentor', $id)
            ->first();
    }

    public function update(KelasMentor $kelasMentor, array $data): KelasMentor
    {
        $payload = $this->normalizePayload($data);

        $kelas = $this->getKelasOrFail($payload['id_kelas']);

        $this->ensureMentorBukanMentorUtama($kelas, $payload['id_mentor']);
        $this->ensureMentorBelumMenjadiAsisten(
            $payload['id_kelas'],
            $payload['id_mentor'],
            (int) $kelasMentor->id_kelas_mentor
        );

        $kelasMentor->update($payload);

        return $kelasMentor->fresh();
    }

    public function delete(KelasMentor $kelasMentor): void
    {
        $kelasMentor->delete();
    }

    private function normalizePayload(array $data): array
    {
        return [
            'id_kelas' => (int) ($data['id_kelas'] ?? 0),
            'id_mentor' => (int) ($data['id_mentor'] ?? 0),

            // Peran dibuat tetap agar tabel kelas_mentor tidak dipakai untuk mentor utama.
            'peran' => self::ROLE_ASISTEN_MENTOR,
        ];
    }

    private function getKelasOrFail(int $idKelas): Kelas
    {
        $kelas = Kelas::query()
            ->select([
                'id_kelas',
                'id_pemilik',
                'judul',
            ])
            ->where('id_kelas', $idKelas)
            ->first();

        if (! $kelas) {
            throw new LogicException('Kelas tidak ditemukan.');
        }

        return $kelas;
    }

    private function ensureMentorBukanMentorUtama(Kelas $kelas, int $idMentor): void
    {
        if ((int) $kelas->id_pemilik === $idMentor) {
            throw new LogicException(
                'Mentor utama tidak boleh ditambahkan sebagai asisten mentor.'
            );
        }
    }

    private function ensureMentorBelumMenjadiAsisten(
        int $idKelas,
        int $idMentor,
        ?int $ignoreIdKelasMentor = null
    ): void {
        $query = KelasMentor::query()
            ->where('id_kelas', $idKelas)
            ->where('id_mentor', $idMentor);

        if ($ignoreIdKelasMentor !== null) {
            $query->where('id_kelas_mentor', '!=', $ignoreIdKelasMentor);
        }

        if ($query->exists()) {
            throw new LogicException('Mentor ini sudah menjadi asisten mentor pada kelas tersebut.');
        }
    }

    private function ensureJumlahAsistenBelumMaksimal(int $idKelas): void
    {
        $jumlahAsisten = KelasMentor::query()
            ->where('id_kelas', $idKelas)
            ->count();

        if ($jumlahAsisten >= self::MAX_ASISTEN_MENTOR) {
            throw new LogicException('Maksimal hanya boleh 2 asisten mentor dalam satu kelas.');
        }
    }
}