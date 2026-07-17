@extends('admin.layouts.index')

@section('css')
    <style>
        /* =========================================================
           PROGRES KELAS - SIMPLE, FLAT, KONSISTEN
           Visual only: route, variable Blade, dan JavaScript tidak diubah
        ========================================================= */

        .progres-neo-page {
            --page-primary: #074366;
            --page-primary-dark: #052f49;
            --page-blue: #3b82f6;
            --page-success: #10b981;
            --page-success-dark: #059669;
            --page-warning: #f59e0b;
            --page-warning-dark: #d97706;
            --page-danger: #ef4444;
            --page-danger-dark: #dc2626;
            --page-purple: #8b5cf6;
            --page-text: #111827;
            --page-muted: #64748b;
            --page-border: #e5e7eb;
            --page-soft: #f8fafc;
            --page-white: #ffffff;
            padding: 0 24px 28px;
            color: var(--page-text);
        }

        .progres-neo-page .content {
            max-width: 1480px;
            margin: 0 auto;
        }

        /* Header */
        .progres-neo-header {
            margin-bottom: 18px;
            padding: 18px;
            background: var(--page-white);
            border: 1px solid #eef2f7;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(15, 23, 42, .06);
        }

        .progres-neo-title {
            margin: 0;
            color: var(--page-text);
            font-size: 24px;
            line-height: 1.3;
            font-weight: 800;
        }

        .progres-neo-subtitle,
        .progres-neo-muted,
        .progres-neo-page .text-muted {
            color: var(--page-muted) !important;
            font-weight: 600;
        }

        .progres-neo-actions {
            width: 440px;
            max-width: 100%;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .progres-neo-actions .btn,
        .progres-neo-actions a.btn {
            width: 100%;
            min-width: 0;
            white-space: nowrap;
        }

        /* Tombol utama halaman */
        .progres-neo-page .btn,
        .progres-neo-actions .btn {
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 8px 13px !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-size: 13px;
            line-height: 1;
            font-weight: 700;
            text-decoration: none !important;
            transform: none !important;
        }

        .progres-neo-page .btn i {
            color: currentColor !important;
        }

        .progres-neo-page .btn-primary {
            color: #ffffff !important;
            background: var(--page-blue) !important;
            border: 1px solid var(--page-blue) !important;
        }

        .progres-neo-page .btn-primary:hover {
            color: #ffffff !important;
            background: #2563eb !important;
            border-color: #2563eb !important;
        }

        .progres-neo-page .btn-success {
            color: #ffffff !important;
            background: var(--page-success) !important;
            border: 1px solid var(--page-success) !important;
        }

        .progres-neo-page .btn-success:hover {
            color: #ffffff !important;
            background: var(--page-success-dark) !important;
            border-color: var(--page-success-dark) !important;
        }

        .progres-neo-page .btn-warning {
            color: #ffffff !important;
            background: var(--page-warning) !important;
            border: 1px solid var(--page-warning) !important;
        }

        .progres-neo-page .btn-warning:hover {
            color: #ffffff !important;
            background: var(--page-warning-dark) !important;
            border-color: var(--page-warning-dark) !important;
        }

        .progres-neo-page .btn-danger {
            color: #ffffff !important;
            background: var(--page-danger) !important;
            border: 1px solid var(--page-danger) !important;
        }

        .progres-neo-page .btn-danger:hover {
            color: #ffffff !important;
            background: var(--page-danger-dark) !important;
            border-color: var(--page-danger-dark) !important;
        }

        .progres-neo-page .btn:hover {
            transform: translateY(-1px) !important;
            filter: brightness(.98);
        }

        .progres-neo-page .btn:active {
            transform: translateY(0) !important;
        }

        /* Card */
        .progres-neo-card,
        .progres-neo-page .card {
            overflow: hidden;
            background: var(--page-white) !important;
            border: 1px solid #eef2f7 !important;
            border-radius: 12px !important;
            box-shadow: 0 6px 18px rgba(15, 23, 42, .06) !important;
        }

        .progres-neo-page .card-header {
            min-height: auto;
            padding: 16px 18px !important;
            background: var(--page-white) !important;
            border-bottom: 1px solid #eef2f7 !important;
        }

        .progres-neo-page .card-body {
            background: var(--page-white) !important;
        }

        .progres-neo-page .card h2,
        .progres-neo-page .card h4,
        .progres-neo-page .text-gray-900 {
            color: var(--page-text) !important;
        }

        /* Badge */
        .badge-neo,
        .progres-neo-page .badge {
            min-height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            padding: 6px 10px !important;
            color: #334155 !important;
            background: var(--page-soft) !important;
            border: 1px solid var(--page-border) !important;
            border-radius: 999px;
            box-shadow: none !important;
            font-size: 12px;
            line-height: 1;
            font-weight: 700;
        }

        .progres-neo-page .badge-light-primary,
        .progres-neo-page .badge-light-info {
            color: #1d4ed8 !important;
            background: #eff6ff !important;
            border-color: #bfdbfe !important;
        }

        .progres-neo-page .badge-light-success {
            color: #047857 !important;
            background: #ecfdf5 !important;
            border-color: #bbf7d0 !important;
        }

        .progres-neo-page .badge-light-warning {
            color: #92400e !important;
            background: #fffbeb !important;
            border-color: #fde68a !important;
        }

        .progres-neo-page .badge-light-danger {
            color: #b91c1c !important;
            background: #fef2f2 !important;
            border-color: #fecaca !important;
        }

        .progres-neo-page .badge-light-secondary,
        .progres-neo-page .badge-light-dark,
        .progres-neo-page .badge-light {
            color: #475569 !important;
            background: var(--page-soft) !important;
            border-color: var(--page-border) !important;
        }

        /* Ringkasan detail */
        .summary-neo-box {
            padding: 18px;
            background: var(--page-soft);
            border: 1px solid var(--page-border);
            border-radius: 12px;
            box-shadow: none;
        }

        .summary-neo-percent {
            color: var(--page-primary);
            font-size: 34px;
            line-height: 1;
            font-weight: 800;
        }

        .info-neo-item {
            min-height: 66px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 14px;
            background: var(--page-soft);
            border: 1px solid var(--page-border);
            border-radius: 10px;
            box-shadow: none;
        }

        .neo-icon,
        .progres-neo-page .symbol-label {
            width: 40px !important;
            height: 40px !important;
            min-width: 40px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            background: #ffffff !important;
            border: 1px solid var(--page-border);
            border-radius: 8px !important;
            box-shadow: none !important;
        }

        .progres-neo-page .text-primary {
            color: var(--page-blue) !important;
        }

        .progres-neo-page .text-success {
            color: var(--page-success) !important;
        }

        .progres-neo-page .text-warning {
            color: var(--page-warning) !important;
        }

        .progres-neo-page .text-danger {
            color: var(--page-danger) !important;
        }

        /* Progress bar */
        .progres,
        .progress-neo {
            width: 100%;
            height: 9px;
            overflow: hidden;
            background: #e5e7eb;
            border-radius: 999px;
            box-shadow: none;
        }

        .progres-bar,
        .progress-neo-bar {
            height: 100%;
            background: var(--page-blue);
            border-radius: 999px;
            box-shadow: none;
        }

        .progres-neo-page .progres-bar.bg-success,
        .progres-neo-page .bg-success.progres-bar {
            background: var(--page-success) !important;
        }

        /* Tabel */
        .progres-neo-page .table-responsive {
            background: #ffffff;
            border-radius: 0;
        }

        .progres-neo-page .table {
            width: 100%;
            margin-bottom: 0 !important;
            color: var(--page-text);
            border-collapse: separate;
            border-spacing: 0;
        }

        .progres-neo-page .table thead,
        .progres-neo-page .table thead.bg-light {
            background: var(--page-soft) !important;
        }

        .progres-neo-page .table thead tr th {
            padding: 13px 14px !important;
            color: #475569 !important;
            background: var(--page-soft) !important;
            border-bottom: 1px solid var(--page-border) !important;
            font-size: 12px !important;
            font-weight: 800 !important;
            text-transform: uppercase;
            letter-spacing: .03em;
            white-space: nowrap;
        }

        .progres-neo-page .table tbody td {
            padding: 13px 14px !important;
            color: #334155 !important;
            background: #ffffff !important;
            border-bottom: 1px solid #eef2f7 !important;
            vertical-align: middle;
            font-size: 13px;
            font-weight: 600;
        }

        .progres-neo-page .table tbody tr:hover td {
            background: #f8fafc !important;
        }

        .progres-neo-page .table tbody tr:last-child td {
            border-bottom: 0 !important;
        }

        .materi-neo-icon {
            width: 38px;
            height: 38px;
            min-width: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--page-soft);
            border: 1px solid var(--page-border);
            border-radius: 8px;
            box-shadow: none;
        }

        /* Detail soal */
        .detail-soal-neo-button {
            min-height: 34px !important;
            padding: 8px 11px !important;
            color: #ffffff !important;
            background: var(--page-purple) !important;
            border: 1px solid var(--page-purple) !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-size: 12px !important;
            font-weight: 700 !important;
        }

        .detail-soal-neo-button:hover {
            color: #ffffff !important;
            background: #7c3aed !important;
            border-color: #7c3aed !important;
        }

        .jawaban-neo-panel {
            padding: 14px;
            background: var(--page-soft) !important;
            border: 1px solid var(--page-border) !important;
            border-radius: 10px !important;
            box-shadow: none !important;
        }

        .jawaban-neo-item {
            padding: 11px 12px;
            background: #ffffff;
            border: 1px solid #eef2f7;
            border-radius: 8px;
        }

        .jawaban-neo-item + .jawaban-neo-item {
            margin-top: 8px;
        }

        .progres-neo-empty {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 18px 20px;
            color: #475569;
            background: #ffffff;
            border: 1px solid #eef2f7;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(15, 23, 42, .06);
            font-weight: 700;
        }

        /* SweetAlert */
        .progres-neo-page .swal2-popup,
        .swal2-popup {
            color: var(--page-text) !important;
            background: #ffffff !important;
            border: 1px solid var(--page-border) !important;
            border-radius: 12px !important;
            box-shadow: 0 18px 45px rgba(15, 23, 42, .16) !important;
        }

        .swal2-title {
            color: var(--page-text) !important;
            font-weight: 800 !important;
        }

        .swal2-html-container,
        .swal2-content {
            color: var(--page-muted) !important;
            font-weight: 600 !important;
        }

        .swal2-confirm,
        .swal2-cancel {
            min-height: 40px;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-weight: 700 !important;
        }

        @media (max-width: 991.98px) {
            .progres-neo-page {
                padding: 0 16px 24px;
            }

            .progres-neo-header {
                padding: 16px;
            }

            .progres-neo-actions {
                width: 100%;
                max-width: 440px;
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 575.98px) {
            .progres-neo-title {
                font-size: 20px;
            }

            .summary-neo-percent {
                font-size: 30px;
            }

            .progres-neo-actions {
                width: 100%;
                max-width: 100%;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 8px;
            }

            .progres-neo-actions .btn,
            .progres-neo-actions a.btn {
                width: 100%;
                padding-left: 8px !important;
                padding-right: 8px !important;
                font-size: 12px;
                white-space: normal;
            }

            .progres-neo-page .card-body {
                padding: 16px !important;
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
                                                    <span class="materi-neo-icon">
                                                        <i class="bi {{ $iconClass }} fs-4"></i>
                                                    </span>
                                                    <div class="flex-grow-1">
                                                        <div class="fw-semibold text-gray-900 mb-1">
                                                            {{ $materiJudul }}
                                                        </div>

                                                        @if ($progresKuis->isNotEmpty())
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

                                                                                $benarRaw = $pj['benar'] ?? ($pj->benar ?? null);
                                                                                $benar = is_null($benarRaw) ? null : (bool) $benarRaw;

                                                                                [$jawabanStatusLabel, $jawabanStatusClass, $jawabanStatusIcon] = match (true) {
                                                                                    $benar === true  => ['Benar', 'success', 'bi-check-circle-fill'],
                                                                                    $benar === false => ['Salah', 'danger', 'bi-x-circle-fill'],
                                                                                    default          => ['Belum dijawab', 'dark', 'bi-circle'],
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
