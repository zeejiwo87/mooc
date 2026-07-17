@extends('mentor.layouts.index')

@section('list')
    <li class="breadcrumb-item text-muted">Kelas</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">Progres Kelas</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="content flex-column-fluid">

            {{-- HEADER --}}
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 gap-3">
                <div>
                    <h1 class="fw-bold text-gray-900 mb-1">Progres Kelas</h1>
                    <p class="text-muted fs-7 mb-0">
                        Monitoring progres belajar peserta per materi dan kuis dalam kelas.
                    </p>
                </div>

                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-primary" onclick="sync('{{ $id }}')">
                        <i class="bi bi-arrow-repeat me-1"></i> Tarik Materi
                    </button>
                    <button type="button" class="btn btn-sm btn-warning" onclick="syncTuntas('{{ $id }}')">
                        <i class="bi bi-arrow-repeat me-1"></i> Set Tuntas Semua
                    </button>
                    <a href="{{route('mentor.kelas.progres_kelas.sertifikat', $id) }}" class="btn btn-sm btn-success" >
                        <i class="bi bi-layout-text-sidebar-reverse"></i> Cetak Sertifikat
                    </a>
                </div>
            </div>

            {{-- CARD DETAIL PENDAFTARAN --}}
            @php
                use Carbon\Carbon;

                $idPendaftaran     = $pendaftaran->id_pendaftaran ?? null;
                $penggunaNama      = $pendaftaran->pengguna_nama ?? '-';
                $kelasJudul        = $pendaftaran->kelas_judul ?? '-';
                $persentaseProgres = (float) ($pendaftaran->persentase_progres ?? 0);
                $status            = $pendaftaran->status ?? 'aktif';
                $terdaftarPada     = $pendaftaran->terdaftar_pada ?? null;
                $selesaiPada       = $pendaftaran->selesai_pada ?? null;
                $terakhirAkses     = $pendaftaran->terakhir_akses ?? null;

                [$statusLabel, $statusClass] = match ($status) {
                    'aktif'   => ['Aktif', 'badge-light-primary'],
                    'selesai' => ['Selesai', 'badge-light-success'],
                    'expired' => ['Expired', 'badge-light-danger'],
                    default   => [ucfirst($status), 'badge-light-secondary'],
                };

                $formatDateTime = function ($value) {
                    if (! $value) return '-';
                    try {
                        return Carbon::parse($value)->format('d M Y H:i');
                    } catch (\Throwable $e) {
                        return $value;
                    }
                };
            @endphp

            <div class="card mb-6 border-0 shadow-sm">
                <div class="card-body p-6">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-8">
                            <div class="d-flex align-items-center mb-3 gap-3">
                                <span class="badge {{ $statusClass }}">{{ $statusLabel }}</span>
                                <span class="text-muted fs-8">ID Pendaftaran: #{{ $idPendaftaran }}</span>
                            </div>

                            <h2 class="fw-bold text-gray-900 fs-3 mb-2">
                                {{ $kelasJudul }}
                            </h2>

                            <div class="d-flex align-items-center text-muted mb-4">
                                <i class="bi bi-person-circle me-2"></i>
                                <span class="fw-semibold">{{ $penggunaNama }}</span>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px me-3">
                                            <span class="symbol-label bg-light-primary">
                                                <i class="bi bi-calendar-plus text-primary fs-5"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <div class="text-muted fs-8 mb-1">Terdaftar</div>
                                            <div class="fw-semibold fs-7">
                                                {{ $formatDateTime($terdaftarPada) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px me-3">
                                            <span class="symbol-label bg-light-success">
                                                <i class="bi bi-flag text-success fs-5"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <div class="text-muted fs-8 mb-1">Selesai</div>
                                            <div class="fw-semibold fs-7">
                                                {{ $formatDateTime($selesaiPada) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px me-3">
                                            <span class="symbol-label bg-light-warning">
                                                <i class="bi bi-clock-history text-warning fs-5"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <div class="text-muted fs-8 mb-1">Terakhir Akses</div>
                                            <div class="fw-semibold fs-7">
                                                {{ $formatDateTime($terakhirAkses) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Summary Progres --}}
                        <div class="col-lg-4">
                            <div class="p-4 rounded-3 bg-light d-flex flex-column align-items-center">
                                <span class="text-muted fs-8 mb-2">Progres Belajar</span>
                                <div class="display-6 fw-bold text-primary mb-2">
                                    {{ number_format($persentaseProgres, 1) }}%
                                </div>
                                <div class="progres w-100 h-8px mb-1">
                                    <div class="progres-bar" role="progresbar"
                                         style="width: {{ $persentaseProgres }}%;"
                                         aria-valuenow="{{ $persentaseProgres }}"
                                         aria-valuemin="0"
                                         aria-valuemax="100">
                                    </div>
                                </div>
                                <span class="text-muted fs-8">
                                    Status: <span class="fw-semibold">{{ $statusLabel }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- DAFTAR MATERI PER BAGIAN --}}
            @php
                $items = collect($progres ?? []);
                $grouped = $items
                    ->groupBy('bagian_judul')
                    ->sortBy(function ($group) {
                        $first = $group->first();
                        return $first['urutan_bagian_kelas'] ?? ($first->urutan_bagian_kelas ?? 0);
                    });
            @endphp

            @forelse ($grouped as $bagianJudul => $rows)
                @php
                    $rowsSorted  = $rows->sortBy(fn ($row) => $row['urutan_materi'] ?? ($row->urutan_materi ?? 0));
                    $total       = $rowsSorted->count();
                    $completed   = $rowsSorted->where('selesai', true)->count();
                    $percentage  = $total > 0 ? round(($completed / $total) * 100) : 0;
                @endphp

                <div class="card mb-5 border-0 shadow-sm card-flush">
                    <div class="card-header py-4">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                            <div>
                                <h4 class="fw-bold text-gray-900 mb-1">{{ $bagianJudul }}</h4>
                                <div class="text-muted fs-8">
                                    {{ $completed }} dari {{ $total }} materi selesai
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <div class="text-muted fs-8">Progres</div>
                                <div class="progres w-150px h-6px">
                                    <div class="progres-bar bg-success" role="progresbar"
                                         style="width: {{ $percentage }}%;"
                                         aria-valuenow="{{ $percentage }}"
                                         aria-valuemin="0"
                                         aria-valuemax="100">
                                    </div>
                                </div>
                                <div class="fw-bold text-success fs-6">
                                    {{ $percentage }}%
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-row-dashed">
                                <thead class="bg-light">
                                    <tr class="fw-semibold text-muted fs-8">
                                        <th class="ps-6" style="width: 50px;">#</th>
                                        <th>Materi / Kuis</th>
                                        <th style="width: 130px;">Tipe</th>
                                        <th style="width: 130px;">Status</th>
                                        <th class="pe-6" style="width: 160px;">Selesai Pada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rowsSorted as $index => $row)
                                        @php
                                            $isDone        = (bool) ($row['selesai'] ?? ($row->selesai ?? false));
                                            $materiTipe    = $row['materi_tipe'] ?? ($row->materi_tipe ?? '-');
                                            $materiJudul   = $row['materi_judul'] ?? ($row->materi_judul ?? '-');
                                            $selesaiPada   = $row['selesai_pada'] ?? ($row->selesai_pada ?? null);
                                            $progresKuis  = collect($row['progres_kuis'] ?? ($row->progres_kuis ?? []));
                                            $idProgresKls  = $row['id_progres_kelas'] ?? ($row->id_progres_kelas ?? $index);

                                            $iconClass = match ($materiTipe) {
                                                'video'           => 'bi-play-circle-fill text-primary',
                                                'text', 'artikel' => 'bi-file-text-fill text-info',
                                                'kuis'            => 'bi-question-circle-fill text-warning',
                                                default           => 'bi-file-earmark-fill text-secondary',
                                            };

                                            $tipeLabel       = ucfirst($materiTipe);
                                            $quizMetaText    = null;
                                            $jenisKuisLabel  = null;
                                            $progresJawaban = collect();

                                            if ($progresKuis->isNotEmpty()) {
                                                $attempt      = $progresKuis->first();
                                                $kuisTipe     = $attempt['kuis_tipe'] ?? ($attempt->kuis_tipe ?? null);
                                                $nilai        = $attempt['nilai'] ?? ($attempt->nilai ?? null);
                                                $totalSoal    = (int) ($attempt['total_soal'] ?? ($attempt->total_soal ?? 0));
                                                $soalTerjawab = (int) ($attempt['soal_terjawab'] ?? ($attempt->soal_terjawab ?? 0));

                                                $jenisKuisLabel = match ($kuisTipe) {
                                                    'kuis_materi' => 'Kuis Materi',
                                                    'ujian', 'ujian_akhir' => 'Ujian',
                                                    default => 'Kuis',
                                                };

                                                    if ($materiTipe === 'kuis') {
                                                        $tipeLabel = $jenisKuisLabel;
                                                    }
                                                $quizMetaText = trim(
                                                    ($nilai !== null ? 'Nilai: ' . number_format((float) $nilai, 1) : '') .
                                                    ($totalSoal ? ' • ' . $soalTerjawab . '/' . $totalSoal . ' soal' : '')
                                                );

                                                $progresJawaban = collect($attempt['progres_jawaban'] ?? ($attempt->progres_jawaban ?? []));
                                            }

                                            $collapseId = 'soal-progres-' . $idProgresKls;
                                        @endphp

                                        <tr>
                                            <td class="ps-6 align-top">
                                                <span class="fw-semibold text-gray-500">
                                                    {{ $index + 1 }}
                                                </span>
                                            </td>

                                            <td class="align-top">
                                                <div class="d-flex align-items-start gap-3">
                                                    <i class="bi {{ $iconClass }} fs-3 mt-1"></i>
                                                    <div class="flex-grow-1">
                                                        <div class="fw-semibold text-gray-900 mb-1">
                                                            {{ $materiJudul }}
                                                        </div>

                                                        @if ($progresKuis->isNotEmpty())
                                                            <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                                                                @if ($jenisKuisLabel)
                                                                    <span class="badge badge-light-info">
                                                                        {{ $jenisKuisLabel }}
                                                                    </span>
                                                                @endif

                                                                @if ($quizMetaText)
                                                                    <span class="text-muted fs-8">
                                                                        {{ $quizMetaText }}
                                                                    </span>
                                                                @endif
                                                            </div>

                                                            @if ($progresJawaban->isNotEmpty())
                                                                <button class="btn btn-xs btn-light border-0 px-2 py-1 fs-9"
                                                                        type="button"
                                                                        data-bs-toggle="collapse"
                                                                        data-bs-target="#{{ $collapseId }}">
                                                                    <i class="bi bi-list-check me-1"></i>
                                                                    Lihat detail soal
                                                                </button>

                                                                <div class="collapse mt-2" id="{{ $collapseId }}">
                                                                    <div class="border rounded p-3 bg-light-subtle">
                                                                        @foreach ($progresJawaban as $pj)
                                                                            @php
                                                                                $pertanyaan = $pj['soal_pertanyaan'] ?? ($pj->soal_pertanyaan ?? '-');

                                                                                $benarRaw = $pj['benar'] ?? ($pj->benar ?? null);
                                                                                $benar = is_null($benarRaw) ? null : (bool) $benarRaw;

                                                                                [$statusLabel, $statusClass, $statusIcon] = match (true) {
                                                                                    $benar === true  => ['Benar', 'success', 'bi-check-circle-fill'],
                                                                                    $benar === false => ['Salah', 'danger', 'bi-x-circle-fill'],
                                                                                    default          => ['Belum dijawab', 'dark', 'bi-circle'],
                                                                                };
                                                                            @endphp

                                                                            <div class="d-flex align-items-start gap-2 mb-2">
                                                                                <i class="bi {{ $statusIcon }} text-{{ $statusClass }} fs-6 mt-1"></i>
                                                                                <div class="flex-grow-1">
                                                                                    <div class="text-gray-800 fs-8 mb-1">
                                                                                        {{ $pertanyaan }}
                                                                                    </div>
                                                                                    <span class="badge badge-light-{{ $statusClass }} fs-9">
                                                                                        {{ $statusLabel }}
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="align-top">
                                                <span class="badge badge-light fs-8">
                                                    {{ $tipeLabel }}
                                                </span>
                                            </td>

                                            <td class="align-top">
                                                @if ($isDone)
                                                    <span class="badge badge-light-success fs-8">
                                                        <i class="bi bi-check-circle me-1"></i> Selesai
                                                    </span>
                                                @else
                                                    <span class="badge badge-light-secondary fs-8">
                                                        <i class="bi bi-hourglass-split me-1"></i> Belum
                                                    </span>
                                                @endif
                                            </td>

                                            <td class="pe-6 align-top">
                                                @if ($selesaiPada)
                                                    <span class="text-muted fs-8">
                                                        {{ \Carbon\Carbon::parse($selesaiPada)->format('d M Y H:i') }}
                                                    </span>
                                                @else
                                                    <span class="text-muted fs-8">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info d-flex align-items-center">
                    <i class="bi bi-info-circle fs-3 me-3"></i>
                    <div class="fs-7">Belum ada data progres materi untuk pendaftaran ini.</div>
                </div>
            @endforelse

        </div>
    </div>
@endsection

@section('javascript')
    <script>
        function sync(id) {
            Swal.fire({
                title: 'Konfirmasi Sync',
                text: "Tarik ulang materi dari kelas untuk pendaftaran ini?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Ya, lanjut',
                cancelButtonText: 'Batal',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    DataManager.openLoading();
                    const create = "{{ route('mentor.kelas.progres_kelas.sync', ':id') }}";
                    DataManager.postData(create.replace(':id', id)).then(response => {
                        if (response.success) {
                            Swal.fire('Berhasil!', response.message, 'success');
                            setTimeout(() => location.reload(), 1000);
                        } else {
                            Swal.fire('Warning', response.message, 'warning');
                        }
                    }).catch(error => {
                        ErrorHandler.handleError(error);
                    });
                }
            });
        }
        
        function syncTuntas(id) {
            Swal.fire({
                title: 'Konfirmasi Set Tuntas',
                text: "Tandai semua materi sebagai tuntas untuk pendaftaran ini?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Ya, lanjut',
                cancelButtonText: 'Batal',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    DataManager.openLoading();
                    const create = "{{ route('mentor.kelas.progres_kelas.sync_tuntas', ':id') }}";
                    DataManager.postData(create.replace(':id', id)).then(response => {
                        if (response.success) {
                            Swal.fire('Berhasil!', response.message, 'success');
                            setTimeout(() => location.reload(), 1000);
                        } else {
                            Swal.fire('Warning', response.message, 'warning');
                        }
                    }).catch(error => {
                        ErrorHandler.handleError(error);
                    });
                }
            });
        }   
    </script>
@endsection
