@extends('admin.layouts.index')

@section('css')
    <style>
        .progres-neo-page {
            --neo-bg: #eef2f7;
            --neo-surface: #eef2f7;
            --neo-text: #1f2937;
            --neo-muted: #64748b;
            --neo-border: rgba(148, 163, 184, .22);
            --neo-primary: #2563eb;
            --neo-success: #16a34a;
            --neo-warning: #d97706;
            --neo-danger: #dc2626;
            --neo-info: #0284c7;
            --neo-shadow-dark: rgba(163, 177, 198, .38);
            --neo-shadow-light: rgba(255, 255, 255, .86);
            padding: 0 30px 30px;
        }

        .progres-neo-page .content {
            max-width: 1480px;
            margin: 0 auto;
        }

        .progres-neo-card,
        .progres-neo-page .card {
            border: 0 !important;
            border-radius: 28px !important;
            background: var(--neo-surface) !important;
            box-shadow:
                10px 10px 22px var(--neo-shadow-dark),
                -10px -10px 22px var(--neo-shadow-light) !important;
            overflow: hidden;
        }

        .progres-neo-page .card-header {
            border-bottom: 1px solid var(--neo-border) !important;
            background: var(--neo-surface) !important;
            padding: 20px 24px !important;
        }

        .progres-neo-page .card-body {
            background: var(--neo-surface) !important;
        }

        .progres-neo-header {
            padding: 24px;
            border-radius: 28px;
            background: var(--neo-surface);
            box-shadow:
                10px 10px 22px var(--neo-shadow-dark),
                -10px -10px 22px var(--neo-shadow-light);
            margin-bottom: 24px;
        }

        .progres-neo-title {
            margin: 0;
            color: var(--neo-text);
            font-size: 1.55rem;
            line-height: 1.25;
            font-weight: 900;
        }

        .progres-neo-subtitle,
        .progres-neo-muted,
        .progres-neo-page .text-muted {
            color: var(--neo-muted) !important;
            font-weight: 650;
        }

        .progres-neo-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .btn-neo,
        .progres-neo-page .btn.btn-sm {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 14px !important;
            border: 1px solid rgba(148, 163, 184, .24) !important;
            border-radius: 14px !important;
            color: #334155 !important;
            background: var(--neo-surface) !important;
            font-size: .8rem;
            line-height: 1;
            font-weight: 850;
            text-decoration: none !important;
            box-shadow:
                5px 5px 12px rgba(163, 177, 198, .3),
                -5px -5px 12px rgba(255, 255, 255, .78) !important;
            transition: .18s ease;
        }

        .btn-neo:hover,
        .progres-neo-page .btn.btn-sm:hover {
            color: #0f172a !important;
            border-color: rgba(100, 116, 139, .34) !important;
            transform: translateY(-1px);
            box-shadow:
                6px 6px 14px rgba(163, 177, 198, .34),
                -6px -6px 14px rgba(255, 255, 255, .82) !important;
        }

        .progres-neo-page .btn-primary,
        .progres-neo-page .btn-success,
        .progres-neo-page .btn-warning,
        .progres-neo-page .btn-danger {
            color: #334155 !important;
            background: var(--neo-surface) !important;
        }

        .progres-neo-page .btn-primary i,
        .progres-neo-page .text-primary {
            color: var(--neo-primary) !important;
        }

        .progres-neo-page .btn-success i,
        .progres-neo-page .text-success {
            color: var(--neo-success) !important;
        }

        .progres-neo-page .btn-warning i,
        .progres-neo-page .text-warning {
            color: var(--neo-warning) !important;
        }

        .progres-neo-page .btn-danger i,
        .progres-neo-page .text-danger {
            color: var(--neo-danger) !important;
        }

        .badge-neo,
        .progres-neo-page .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            min-height: 30px;
            padding: 7px 12px !important;
            border: 1px solid rgba(148, 163, 184, .18);
            border-radius: 999px;
            color: #475569 !important;
            background: var(--neo-surface) !important;
            font-size: .76rem;
            line-height: 1;
            font-weight: 850;
            box-shadow:
                4px 4px 9px rgba(163, 177, 198, .24),
                -4px -4px 9px rgba(255, 255, 255, .76);
        }

        .progres-neo-page .badge-light-primary,
        .progres-neo-page .badge-light-info {
            color: var(--neo-primary) !important;
        }

        .progres-neo-page .badge-light-success {
            color: var(--neo-success) !important;
        }

        .progres-neo-page .badge-light-warning {
            color: var(--neo-warning) !important;
        }

        .progres-neo-page .badge-light-danger {
            color: var(--neo-danger) !important;
        }

        .progres-neo-page .badge-light-secondary,
        .progres-neo-page .badge-light-dark,
        .progres-neo-page .badge-light {
            color: #475569 !important;
        }

        .summary-neo-box {
            padding: 22px;
            border-radius: 24px;
            background: var(--neo-surface);
            box-shadow:
                inset 6px 6px 13px rgba(163, 177, 198, .24),
                inset -6px -6px 13px rgba(255, 255, 255, .78);
        }

        .summary-neo-percent {
            color: var(--neo-primary);
            font-size: 2.2rem;
            line-height: 1;
            font-weight: 950;
        }

        .info-neo-item {
            display: flex;
            align-items: center;
            gap: 13px;
            min-height: 66px;
            padding: 13px 14px;
            border-radius: 20px;
            background: var(--neo-surface);
            box-shadow:
                inset 4px 4px 9px rgba(163, 177, 198, .2),
                inset -4px -4px 9px rgba(255, 255, 255, .78);
        }

        .neo-icon,
        .progres-neo-page .symbol-label {
            width: 42px !important;
            height: 42px !important;
            min-width: 42px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            border-radius: 15px !important;
            background: var(--neo-surface) !important;
            box-shadow:
                4px 4px 10px rgba(163, 177, 198, .28),
                -4px -4px 10px rgba(255, 255, 255, .76) !important;
        }

        .progres,
        .progress-neo {
            width: 100%;
            height: 9px;
            overflow: hidden;
            border-radius: 999px;
            background: var(--neo-surface);
            box-shadow:
                inset 3px 3px 7px rgba(163, 177, 198, .34),
                inset -3px -3px 7px rgba(255, 255, 255, .78);
        }

        .progres-bar,
        .progress-neo-bar {
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(90deg, #60a5fa, #2563eb);
            box-shadow: none;
        }

        .progres-neo-page .progres-bar.bg-success,
        .progres-neo-page .bg-success.progres-bar {
            background: linear-gradient(90deg, #86efac, #16a34a) !important;
        }

        .progres-neo-page .table-responsive {
            border-radius: 0 0 28px 28px;
            background: var(--neo-surface);
        }

        .progres-neo-page .table {
            margin-bottom: 0 !important;
            color: var(--neo-text);
            border-collapse: separate;
            border-spacing: 0;
        }

        .progres-neo-page .table thead,
        .progres-neo-page .table thead.bg-light {
            background: var(--neo-surface) !important;
        }

        .progres-neo-page .table thead tr th {
            padding-top: 16px !important;
            padding-bottom: 16px !important;
            color: #64748b !important;
            background: var(--neo-surface) !important;
            border-bottom: 1px solid var(--neo-border) !important;
            font-size: .76rem;
            font-weight: 900 !important;
            text-transform: uppercase;
            letter-spacing: .035em;
        }

        .progres-neo-page .table tbody tr {
            transition: .18s ease;
        }

        .progres-neo-page .table tbody tr:hover {
            background: rgba(255, 255, 255, .28);
        }

        .progres-neo-page .table tbody td {
            padding-top: 17px !important;
            padding-bottom: 17px !important;
            border-bottom: 1px solid rgba(148, 163, 184, .16) !important;
            background: transparent !important;
        }

        .materi-neo-icon {
            width: 38px;
            height: 38px;
            min-width: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: var(--neo-surface);
            box-shadow:
                4px 4px 9px rgba(163, 177, 198, .24),
                -4px -4px 9px rgba(255, 255, 255, .76);
        }

        .detail-soal-neo-button {
            min-height: 34px !important;
            padding: 8px 11px !important;
            border-radius: 12px !important;
            color: #475569 !important;
            background: var(--neo-surface) !important;
            box-shadow:
                4px 4px 9px rgba(163, 177, 198, .22),
                -4px -4px 9px rgba(255, 255, 255, .72) !important;
            font-size: .72rem !important;
            font-weight: 850 !important;
        }

        .jawaban-neo-panel {
            padding: 14px;
            border: 0 !important;
            border-radius: 18px !important;
            background: var(--neo-surface) !important;
            box-shadow:
                inset 4px 4px 9px rgba(163, 177, 198, .2),
                inset -4px -4px 9px rgba(255, 255, 255, .78);
        }

        .jawaban-neo-item {
            padding: 11px 12px;
            border-radius: 15px;
            background: rgba(255, 255, 255, .34);
        }

        .jawaban-neo-item + .jawaban-neo-item {
            margin-top: 9px;
        }

        .progres-neo-empty {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 18px 20px;
            border: 0;
            border-radius: 22px;
            color: #475569;
            background: var(--neo-surface);
            box-shadow:
                inset 5px 5px 12px rgba(163, 177, 198, .22),
                inset -5px -5px 12px rgba(255, 255, 255, .78);
            font-weight: 700;
        }

        .progres-neo-page .swal2-popup {
            border: 1px solid rgba(148, 163, 184, .2) !important;
            border-radius: 24px !important;
            background: #eef2f7 !important;
            box-shadow:
                12px 12px 28px rgba(15, 23, 42, .16),
                -8px -8px 22px rgba(255, 255, 255, .7) !important;
        }

        .swal2-popup {
            border: 1px solid rgba(148, 163, 184, .2) !important;
            border-radius: 24px !important;
            background: #eef2f7 !important;
        }

        .swal2-confirm,
        .swal2-cancel {
            border-radius: 13px !important;
            font-weight: 850 !important;
        }

        @media (max-width: 991.98px) {
            .progres-neo-page {
                padding: 0 18px 24px;
            }

            .progres-neo-header {
                padding: 20px;
            }

            .progres-neo-actions {
                width: 100%;
            }

            .progres-neo-actions .btn,
            .progres-neo-actions a {
                flex: 1 1 180px;
            }
        }

        @media (max-width: 575.98px) {
            .progres-neo-actions .btn,
            .progres-neo-actions a {
                width: 100%;
                flex: 1 1 100%;
            }

            .progres-neo-title {
                font-size: 1.35rem;
            }

            .summary-neo-percent {
                font-size: 1.9rem;
            }
        }
    </style>
@endsection

@section('list')
    <li class="breadcrumb-item text-muted">Kelas</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">Progres Kelas</li>
@endsection

@section('content')
    <div class="container-fluid progres-neo-page">
        <div class="content flex-column-fluid">

            {{-- HEADER --}}
            <div class="progres-neo-header">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                    <div>
                        <h1 class="progres-neo-title">Progres Kelas</h1>
                        <p class="progres-neo-subtitle fs-7 mb-0 mt-2">
                            Monitoring progres belajar peserta per materi dan kuis dalam kelas.
                        </p>
                    </div>

                    <div class="progres-neo-actions">
                        <button type="button" class="btn btn-sm btn-primary" onclick="sync('{{ $id }}')">
                            <i class="bi bi-arrow-repeat"></i>
                            Tarik Materi
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="deleteConfirmation('{{ $id }}')">
                            <i class="bi bi-trash"></i>
                            Hapus Semua
                        </button>
                        <button type="button" class="btn btn-sm btn-warning" onclick="syncTuntas('{{ $id }}')">
                            <i class="bi bi-check2-circle"></i>
                            Set Tuntas Semua
                        </button>
                        <a href="{{ route('admin.kelas.progres_kelas.sertifikat', $id) }}" class="btn btn-sm btn-success">
                            <i class="bi bi-award"></i>
                            Cetak Sertifikat
                        </a>
                    </div>
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

            <div class="card progres-neo-card mb-6">
                <div class="card-body p-6">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-8">
                            <div class="d-flex align-items-center mb-3 gap-3 flex-wrap">
                                <span class="badge {{ $statusClass }}">{{ $statusLabel }}</span>
                                <span class="progres-neo-muted fs-8">ID Pendaftaran: #{{ $idPendaftaran }}</span>
                            </div>

                            <h2 class="fw-bold text-gray-900 fs-3 mb-2">
                                {{ $kelasJudul }}
                            </h2>

                            <div class="d-flex align-items-center progres-neo-muted mb-4">
                                <i class="bi bi-person-circle me-2"></i>
                                <span class="fw-semibold">{{ $penggunaNama }}</span>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="info-neo-item">
                                        <div class="symbol symbol-40px">
                                            <span class="symbol-label bg-light-primary">
                                                <i class="bi bi-calendar-plus text-primary fs-5"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <div class="progres-neo-muted fs-8 mb-1">Terdaftar</div>
                                            <div class="fw-semibold fs-7 text-gray-900">
                                                {{ $formatDateTime($terdaftarPada) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="info-neo-item">
                                        <div class="symbol symbol-40px">
                                            <span class="symbol-label bg-light-success">
                                                <i class="bi bi-flag text-success fs-5"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <div class="progres-neo-muted fs-8 mb-1">Selesai</div>
                                            <div class="fw-semibold fs-7 text-gray-900">
                                                {{ $formatDateTime($selesaiPada) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="info-neo-item">
                                        <div class="symbol symbol-40px">
                                            <span class="symbol-label bg-light-warning">
                                                <i class="bi bi-clock-history text-warning fs-5"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <div class="progres-neo-muted fs-8 mb-1">Terakhir Akses</div>
                                            <div class="fw-semibold fs-7 text-gray-900">
                                                {{ $formatDateTime($terakhirAkses) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Summary Progres --}}
                        <div class="col-lg-4">
                            <div class="summary-neo-box d-flex flex-column align-items-center">
                                <span class="progres-neo-muted fs-8 mb-2">Progres Belajar</span>
                                <div class="summary-neo-percent mb-3">
                                    {{ number_format($persentaseProgres, 1) }}%
                                </div>
                                <div class="progres w-100 mb-2">
                                    <div class="progres-bar" role="progresbar"
                                         style="width: {{ $persentaseProgres }}%;"
                                         aria-valuenow="{{ $persentaseProgres }}"
                                         aria-valuemin="0"
                                         aria-valuemax="100">
                                    </div>
                                </div>
                                <span class="progres-neo-muted fs-8">
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

                <div class="card progres-neo-card mb-5 card-flush">
                    <div class="card-header py-4">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 w-100">
                            <div>
                                <h4 class="fw-bold text-gray-900 mb-1">{{ $bagianJudul }}</h4>
                                <div class="progres-neo-muted fs-8">
                                    {{ $completed }} dari {{ $total }} materi selesai
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                <div class="progres-neo-muted fs-8">Progres</div>
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
                                            $progresKuis   = collect($row['progres_kuis'] ?? ($row->progres_kuis ?? []));
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
                                            $progresJawaban  = collect();

                                            if ($materiTipe === 'kuis' && $progresKuis->isNotEmpty()) {
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

                                                $tipeLabel = $jenisKuisLabel;

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
                                                    <span class="materi-neo-icon">
                                                        <i class="bi {{ $iconClass }} fs-4"></i>
                                                    </span>
                                                    <div class="flex-grow-1">
                                                        <div class="fw-semibold text-gray-900 mb-1">
                                                            {{ $materiJudul }}
                                                        </div>

                                                        @if ($materiTipe === 'kuis')
                                                            <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                                                                @if ($jenisKuisLabel)
                                                                    <span class="badge badge-light-info">
                                                                        {{ $jenisKuisLabel }}
                                                                    </span>
                                                                @endif

                                                                @if ($quizMetaText)
                                                                    <span class="progres-neo-muted fs-8">
                                                                        {{ $quizMetaText }}
                                                                    </span>
                                                                @endif
                                                            </div>

                                                            @if ($progresJawaban->isNotEmpty())
                                                                <button class="btn btn-xs detail-soal-neo-button border-0 px-2 py-1 fs-9"
                                                                        type="button"
                                                                        data-bs-toggle="collapse"
                                                                        data-bs-target="#{{ $collapseId }}">
                                                                    <i class="bi bi-list-check me-1"></i>
                                                                    Lihat detail soal
                                                                </button>

                                                                <div class="collapse mt-3" id="{{ $collapseId }}">
                                                                    <div class="jawaban-neo-panel">
                                                                        @foreach ($progresJawaban as $pj)
                                                                            @php
                                                                                $pertanyaan = $pj['soal_pertanyaan'] ?? ($pj->soal_pertanyaan ?? '-');
                                                                                $benar      = $pj['benar'] ?? ($pj->benar ?? null);

                                                                                [$jawabanStatusLabel, $jawabanStatusClass, $jawabanStatusIcon] = match (true) {
                                                                                    $benar === 1 => ['Benar', 'success', 'bi-check-circle-fill'],
                                                                                    $benar === 0 => ['Salah', 'danger', 'bi-x-circle-fill'],
                                                                                    default      => ['Belum dijawab', 'dark', 'bi-circle'],
                                                                                };
                                                                            @endphp

                                                                            <div class="jawaban-neo-item d-flex align-items-start gap-2">
                                                                                <i class="bi {{ $jawabanStatusIcon }} text-{{ $jawabanStatusClass }} fs-6 mt-1"></i>
                                                                                <div class="flex-grow-1">
                                                                                    <div class="text-gray-800 fs-8 mb-2">
                                                                                        {{ $pertanyaan }}
                                                                                    </div>
                                                                                    <span class="badge badge-light-{{ $jawabanStatusClass }} fs-9">
                                                                                        {{ $jawabanStatusLabel }}
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
                                                        <i class="bi bi-check-circle me-1"></i>
                                                        Selesai
                                                    </span>
                                                @else
                                                    <span class="badge badge-light-secondary fs-8">
                                                        <i class="bi bi-hourglass-split me-1"></i>
                                                        Belum
                                                    </span>
                                                @endif
                                            </td>

                                            <td class="pe-6 align-top">
                                                @if ($selesaiPada)
                                                    <span class="progres-neo-muted fs-8">
                                                        {{ \Carbon\Carbon::parse($selesaiPada)->format('d M Y H:i') }}
                                                    </span>
                                                @else
                                                    <span class="progres-neo-muted fs-8">-</span>
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
                <div class="progres-neo-empty">
                    <i class="bi bi-info-circle fs-3 text-primary"></i>
                    <div class="fs-7">Belum ada data progres materi untuk pendaftaran ini.</div>
                </div>
            @endforelse

        </div>
    </div>
@endsection

@section('javascript')
    <script>
        function deleteConfirmation(id) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: "Apakah Anda yakin ingin menghapus semua materi progres untuk pendaftaran ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#334155',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    DataManager.openLoading();
                    const destroy = "{{ route('admin.kelas.progres_kelas.delete', ':id') }}";
                    DataManager.deleteData(destroy.replace(':id', id)).then(response => {
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

        function sync(id) {
            Swal.fire({
                title: 'Konfirmasi Sync',
                text: "Tarik ulang materi dari kelas untuk pendaftaran ini?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#334155',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, lanjut',
                cancelButtonText: 'Batal',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    DataManager.openLoading();
                    const create = "{{ route('admin.kelas.progres_kelas.sync', ':id') }}";
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
                confirmButtonColor: '#334155',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, lanjut',
                cancelButtonText: 'Batal',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    DataManager.openLoading();
                    const create = "{{ route('admin.kelas.progres_kelas.sync_tuntas', ':id') }}";
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
