@extends('admin.layouts.index')

@section('css')
    <style>
        .kelas-builder-page {
            --bg: #eef2f7;
            --surface: #eef2f7;
            --surface-soft: #f4f7fb;
            --text: #1f2937;
            --muted: #6b7280;
            --border: rgba(148, 163, 184, .2);
            --primary: #3b82f6;
            --warning: #f59e0b;
            --success: #10b981;
            --danger: #ef4444;
            --shadow-dark: rgba(163, 177, 198, .36);
            --shadow-light: rgba(255, 255, 255, .88);
            padding: 0 30px 30px;
            color: var(--text);
        }

        .kelas-builder-shell {
            max-width: 1480px;
            margin: 0 auto;
        }

        .neo-card {
            border: 0;
            border-radius: 28px;
            background: var(--surface);
            box-shadow: 10px 10px 22px var(--shadow-dark), -10px -10px 22px var(--shadow-light);
            overflow: hidden;
        }

        .hero-banner {
            min-height: 240px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .hero-banner::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(15, 23, 42, .28);
        }

        .hero-body,
        .content-body {
            padding: 26px 28px 28px;
        }

        .hero-top,
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 18px;
        }

        .kelas-title {
            margin: 0;
            color: var(--text);
            font-size: 1.75rem;
            line-height: 1.25;
            font-weight: 850;
        }

        .kelas-owner,
        .muted-text {
            color: var(--muted);
            font-weight: 650;
        }

        .kelas-owner span {
            color: var(--text);
            font-weight: 850;
        }

        .stars {
            display: flex;
            align-items: center;
            gap: 3px;
            color: var(--warning);
        }

        .stars .bi-star {
            color: #94a3b8;
        }

        .rating-number {
            margin-left: 8px;
            color: var(--text);
            font-weight: 850;
        }

        .short-desc {
            max-width: 920px;
            margin: 18px 0 0;
            color: var(--muted);
            line-height: 1.65;
            font-weight: 600;
        }

        .stat-row,
        .meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .stat-row {
            margin-top: 24px;
        }

        .stat-item {
            min-width: 185px;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 15px 16px;
            border-radius: 20px;
            background: var(--surface);
            box-shadow: inset 5px 5px 10px rgba(163, 177, 198, .22), inset -5px -5px 10px rgba(255, 255, 255, .82);
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            color: var(--primary);
            background: var(--surface);
            box-shadow: 5px 5px 10px rgba(163, 177, 198, .26), -5px -5px 10px rgba(255, 255, 255, .76);
            font-size: 1.15rem;
        }

        .stat-value {
            color: var(--text);
            font-size: 1rem;
            line-height: 1.2;
            font-weight: 850;
        }

        .stat-label {
            margin-top: 3px;
            color: var(--muted);
            font-size: .78rem;
            font-weight: 700;
        }

        .badge-neo {
            min-height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 7px 12px;
            border-radius: 999px;
            border: 1px solid rgba(148, 163, 184, .16);
            background: var(--surface) !important;
            color: #475569 !important;
            font-size: .78rem;
            line-height: 1;
            font-weight: 850;
            box-shadow: 5px 5px 10px rgba(163, 177, 198, .22), -5px -5px 10px rgba(255, 255, 255, .72);
        }

        .tabs-card {
            padding: 18px 20px 0;
            border-bottom: 1px solid var(--border);
        }

        .tabs-scroll {
            width: 100%;
            overflow-x: auto;
            padding-bottom: 14px;
            scrollbar-width: thin;
        }

        .tabs-scroll::-webkit-scrollbar {
            height: 6px;
        }

        .tabs-scroll::-webkit-scrollbar-thumb {
            border-radius: 999px;
            background: rgba(148, 163, 184, .42);
        }

        .neo-tabs {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: max-content;
            margin: 0;
            padding: 0;
            list-style: none;
            border: 0 !important;
        }

        .neo-tabs .nav-item {
            margin: 0 !important;
            padding: 0 !important;
        }

        .neo-tabs .nav-link,
        .kelas-builder-page .nav-line-tabs .nav-link {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 !important;
            padding: 10px 15px !important;
            border: 0 !important;
            border-radius: 16px !important;
            color: var(--muted) !important;
            background: var(--surface) !important;
            font-size: .86rem;
            line-height: 1;
            font-weight: 850;
            white-space: nowrap;
            box-shadow: 5px 5px 10px rgba(163, 177, 198, .24), -5px -5px 10px rgba(255, 255, 255, .76) !important;
            transition: .18s ease;
        }

        .neo-tabs .nav-link:hover {
            color: #1e293b !important;
            transform: translateY(-1px);
            box-shadow: 6px 6px 13px rgba(163, 177, 198, .28), -6px -6px 13px rgba(255, 255, 255, .78) !important;
        }

        .neo-tabs .nav-link.active {
            color: #fff !important;
            background: var(--primary) !important;
            box-shadow: inset 3px 3px 8px rgba(30, 64, 175, .22), inset -3px -3px 8px rgba(147, 197, 253, .28) !important;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 0;
            color: var(--text) !important;
            font-size: 1.05rem;
            font-weight: 900;
        }

        .section-title i {
            color: var(--primary);
        }

        .mentor-main-card,
        .assistant-card {
            border-radius: 24px;
            padding: 24px;
            background: var(--surface);
            box-shadow: inset 5px 5px 12px rgba(163, 177, 198, .2), inset -5px -5px 12px rgba(255, 255, 255, .76);
        }

        .mentor-main-icon {
            width: 58px;
            height: 58px;
            min-width: 58px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            color: var(--success);
            background: var(--surface);
            box-shadow: 6px 6px 14px rgba(163, 177, 198, .26), -6px -6px 14px rgba(255, 255, 255, .76);
            font-size: 1.6rem;
        }

        .mentor-name {
            color: var(--text);
            font-size: 1.15rem;
            font-weight: 900;
            margin-bottom: 4px;
        }

        .mentor-note {
            color: var(--muted);
            line-height: 1.65;
            font-weight: 600;
            margin-bottom: 0;
        }

        .info-box {
            margin-top: 18px;
            border-radius: 20px;
            padding: 18px 20px;
            background: rgba(59, 130, 246, .08);
            border: 1px solid rgba(59, 130, 246, .16);
            color: #334155;
            font-weight: 650;
            line-height: 1.65;
        }

        .info-box code {
            color: #1d4ed8;
            background: rgba(255, 255, 255, .68);
            border-radius: 8px;
            padding: 2px 6px;
            font-weight: 800;
        }

        .btn-neo-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 42px;
            padding: 10px 16px;
            border: 0;
            border-radius: 16px;
            color: #fff !important;
            background: var(--primary) !important;
            font-size: .86rem;
            font-weight: 850;
            box-shadow: 5px 5px 12px rgba(59, 130, 246, .25), -5px -5px 12px rgba(255, 255, 255, .74);
            transition: .18s ease;
        }

        .btn-neo-primary:hover {
            color: #fff !important;
            transform: translateY(-1px);
            box-shadow: 7px 7px 15px rgba(59, 130, 246, .30), -7px -7px 15px rgba(255, 255, 255, .78);
        }

        .assistant-card {
            margin-top: 22px;
        }

        .assistant-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 18px;
        }

        .assistant-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
            color: var(--text);
            font-size: 1rem;
            font-weight: 900;
        }

        .assistant-title i {
            color: var(--primary);
        }

        .assistant-subtitle {
            margin: 6px 0 0;
            color: var(--muted);
            line-height: 1.6;
            font-weight: 600;
        }

        .assistant-limit {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 12px;
            border-radius: 999px;
            color: #1d4ed8;
            background: rgba(59, 130, 246, .08);
            border: 1px solid rgba(59, 130, 246, .16);
            font-size: .8rem;
            font-weight: 850;
            white-space: nowrap;
        }

        .neo-table-wrap {
            padding: 16px;
            border-radius: 22px;
            background: var(--surface);
            box-shadow: inset 5px 5px 12px rgba(163, 177, 198, .16), inset -5px -5px 12px rgba(255, 255, 255, .72);
        }

        .kelas-builder-page table.dataTable {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 10px !important;
        }

        .kelas-builder-page table.dataTable thead th {
            border: 0 !important;
            color: #475569;
            background: transparent !important;
            font-size: .78rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .02em;
        }

        .kelas-builder-page table.dataTable tbody tr {
            border-radius: 18px;
            background: var(--surface);
            box-shadow: 5px 5px 12px rgba(163, 177, 198, .22), -5px -5px 12px rgba(255, 255, 255, .76);
        }

        .kelas-builder-page table.dataTable tbody td {
            border-top: 0 !important;
            border-bottom: 0 !important;
            padding: 14px 16px !important;
            color: var(--text);
            font-weight: 700;
            vertical-align: middle;
            background: transparent !important;
        }

        .kelas-builder-page table.dataTable tbody td:first-child {
            border-top-left-radius: 18px;
            border-bottom-left-radius: 18px;
            width: 135px;
        }

        .kelas-builder-page table.dataTable tbody td:last-child {
            border-top-right-radius: 18px;
            border-bottom-right-radius: 18px;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_filter input,
        .kelas-builder-page .dataTables_wrapper .dataTables_length select {
            border: 0;
            border-radius: 14px;
            background: var(--surface);
            color: var(--text);
            box-shadow: inset 4px 4px 9px rgba(163, 177, 198, .22), inset -4px -4px 9px rgba(255, 255, 255, .78);
            padding: 8px 12px;
            outline: none;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_filter,
        .kelas-builder-page .dataTables_wrapper .dataTables_length,
        .kelas-builder-page .dataTables_wrapper .dataTables_info,
        .kelas-builder-page .dataTables_wrapper .dataTables_paginate {
            color: var(--muted) !important;
            font-weight: 700;
        }

        @media (max-width: 991.98px) {
            .kelas-builder-page {
                padding: 0 18px 24px;
            }

            .hero-top,
            .content-header,
            .assistant-header {
                flex-direction: column;
            }

            .hero-body,
            .content-body {
                padding: 22px;
            }

            .assistant-limit {
                white-space: normal;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid kelas-builder-page kelas-admin-neo-page">
        @php
            $bannerUrl = $kelas->banner
                ? route('view-file', ['banner', $kelas->banner])
                : asset('assets/media/logos/banner-default.jpg');

            $avgRating = $kelas->rating ?? 0;
            $fullStars = floor($avgRating);
            $hasHalfStar = $avgRating - $fullStars >= 0.5;
            $ratingLabel = $avgRating >= 4.5
                ? 'Sangat Baik'
                : ($avgRating >= 3.5
                    ? 'Baik'
                    : ($avgRating > 0
                        ? 'Cukup'
                        : 'Belum ada rating'));
        @endphp

        <div class="kelas-builder-shell">
            <div class="d-flex flex-column gap-5">
                <div class="neo-card">
                    <div class="hero-banner" style="background-image: url('{{ $bannerUrl }}');"></div>

                    <div class="hero-body">
                        <div class="hero-top">
                            <div>
                                <h2 class="kelas-title">{{ $kelas->judul ?? 'Judul tidak tersedia' }}</h2>
                                <div class="kelas-owner mt-2">
                                    Oleh: <span>{{ $kelas->pemilik ?? 'Pemilik tidak tersedia' }}</span>
                                </div>
                            </div>

                            <div>
                                <div class="stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $fullStars)
                                            <i class="bi bi-star-fill fs-5"></i>
                                        @elseif ($hasHalfStar && $i === $fullStars + 1)
                                            <i class="bi bi-star-half fs-5"></i>
                                        @else
                                            <i class="bi bi-star fs-5"></i>
                                        @endif
                                    @endfor
                                    <span class="rating-number">{{ number_format($avgRating, 1) }}</span>
                                </div>

                                <div class="meta-row justify-content-end mt-2">
                                    <span class="badge-neo">{{ $ratingLabel }}</span>
                                    <span class="muted-text fs-8">{{ $kelas->total_review ?? 0 }} ulasan</span>
                                </div>
                            </div>
                        </div>

                        @if (! empty($kelas->deskripsi_singkat))
                            <p class="short-desc">{{ $kelas->deskripsi_singkat }}</p>
                        @endif

                        <div class="stat-row">
                            <div class="stat-item">
                                <span class="stat-icon"><i class="bi bi-journal-text"></i></span>
                                <div>
                                    <div class="stat-value">{{ $kelas->jumlah_materi ?? 0 }}</div>
                                    <div class="stat-label">Jumlah Materi</div>
                                </div>
                            </div>

                            <div class="stat-item">
                                <span class="stat-icon"><i class="bi bi-clock-history"></i></span>
                                <div>
                                    <div class="stat-value">{{ $kelas->total_durasi_menit ?? 0 }} menit</div>
                                    <div class="stat-label">Durasi Total</div>
                                </div>
                            </div>

                            <div class="stat-item">
                                <span class="stat-icon"><i class="bi bi-people"></i></span>
                                <div>
                                    <div class="stat-value">{{ $kelas->total_pendaftaran ?? 0 }}</div>
                                    <div class="stat-label">Total Pendaftar</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="neo-card">
                    <div class="tabs-card">
                        <div class="tabs-scroll">
                            <ul class="neo-tabs">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.kelas.kelas.histori') ? 'active' : '' }}"
                                       href="{{ route('admin.kelas.kelas.histori', ['id' => $id]) }}">
                                        Beranda
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.kelas.mentor.*') ? 'active' : '' }}"
                                       href="{{ route('admin.kelas.mentor.index', ['id' => $id]) }}">
                                        Mentor
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.kelas.persyaratan.*') ? 'active' : '' }}"
                                       href="{{ route('admin.kelas.persyaratan.index', ['id' => $id]) }}">
                                        Persyaratan
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.kelas.tujuan_pembelajaran.*') ? 'active' : '' }}"
                                       href="{{ route('admin.kelas.tujuan_pembelajaran.index', ['id' => $id]) }}">
                                        Tujuan Pembelajaran
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.kelas.target_peserta.*') ? 'active' : '' }}"
                                       href="{{ route('admin.kelas.target_peserta.index', ['id' => $id]) }}">
                                        Target Peserta
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.kelas.kelas_tag.*') ? 'active' : '' }}"
                                       href="{{ route('admin.kelas.kelas_tag.index', ['id' => $id]) }}">
                                        Tag
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.kelas.usulan_peserta.*') ? 'active' : '' }}"
                                       href="{{ route('admin.kelas.usulan_peserta.index', ['id' => $id]) }}">
                                        Ulasan Peserta
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="content-body">
                        <div class="content-header mb-5">
                            <h3 class="section-title mb-0">
                                <i class="bi bi-person-check"></i>
                                Mentor Kelas
                            </h3>

                            <button type="button"
                                    id="btn_open_create"
                                    class="btn btn-neo-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#form_create">
                                <i class="bi bi-plus-circle"></i>
                                Tambah Asisten Mentor
                            </button>
                        </div>

                        <div class="mentor-main-card">
                            <div class="d-flex align-items-start gap-4">
                                <span class="mentor-main-icon">
                                    <i class="bi bi-person-badge"></i>
                                </span>

                                <div>
                                    <div class="mentor-name">
                                        {{ $kelas->pemilik ?? 'Mentor utama belum tersedia' }}
                                    </div>

                                    <p class="mentor-note">
                                        Mentor utama kelas tetap hanya satu. Jika ingin mengganti mentor utama,
                                        lakukan melalui form edit kelas pada field mentor/pemilik kelas.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="assistant-card">
                            <div class="assistant-header">
                                <div>
                                    <h4 class="assistant-title">
                                        <i class="bi bi-people"></i>
                                        Asisten Mentor
                                    </h4>
                                    <p class="assistant-subtitle">
                                        Setiap kelas dapat memiliki maksimal 2 asisten mentor.
                                    </p>
                                </div>

                                <span class="assistant-limit">
                                    <i class="bi bi-info-circle"></i>
                                    Maksimal 2 asisten mentor
                                </span>
                            </div>

                            <div class="neo-table-wrap mt-5">
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="mentor_table">
                                        <thead>
                                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                <th>Aksi</th>
                                                <th>Nama Asisten Mentor</th>
                                                <th>Peran</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-700 fw-semibold"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.kelas.kelas_mentor.view.create')
        @include('admin.kelas.kelas_mentor.view.edit')
        @include('admin.kelas.kelas_mentor.view.detail')
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/lodash.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.colReorder.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/print.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.js') }}"></script>

    <script>
        function fetchDataDropdown(url, id, placeholder, name, callback) {
            DataManager.executeOperations(url, "admin_" + url, 60).then(response => {
                $(id).empty().append('<option></option>');

                if (response.success) {
                    response.data.forEach(item => {
                        $(id).append(`<option value="${item['id_' + placeholder]}">${item[name]}</option>`);
                    });

                    $(id).select2({
                        width: '100%',
                        allowClear: true,
                        placeholder: $(id).data('placeholder') || 'Pilih data',
                        dropdownParent: $(id).closest('.modal')
                    });

                    if (callback) {
                        callback();
                    }

                    return;
                }

                if (!response.errors) {
                    Swal.fire('Warning', response.message || 'Data dropdown gagal dimuat.', 'warning');
                }
            }).catch(error => {
                ErrorHandler.handleError(error);
            });
        }

        $(document).on('click', '#btn_open_create', function() {
            const modalElement = document.getElementById('form_create');

            if (!modalElement) {
                return;
            }

            if (window.bootstrap && bootstrap.Modal) {
                bootstrap.Modal.getOrCreateInstance(modalElement).show();
                return;
            }

            if ($.fn.modal) {
                $('#form_create').modal('show');
            }
        });
    </script>

    @include('admin.kelas.kelas_mentor.script.list')
    @include('admin.kelas.kelas_mentor.script.create')
    @include('admin.kelas.kelas_mentor.script.edit')
    @include('admin.kelas.kelas_mentor.script.detail')
    @include('admin.kelas.kelas_mentor.script.delete')
@endsection