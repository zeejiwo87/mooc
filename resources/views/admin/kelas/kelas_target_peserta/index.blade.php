@extends('admin.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/buttons.dataTables.min.css') }}">

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
        .meta-row,
        .action-row {
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

        .badge-neo,
        .kelas-builder-page .badge,
        .kelas-builder-page .badge-light-success,
        .kelas-builder-page .badge-light-primary,
        .kelas-builder-page .badge-light-warning,
        .kelas-builder-page .badge-light-danger,
        .kelas-builder-page .badge-light-info {
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

        .section-title,
        .content-body h3,
        .kelas-builder-page .text-gray-900,
        .kelas-builder-page .text-gray-800,
        .kelas-builder-page h2,
        .kelas-builder-page h3 {
            color: var(--text) !important;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 0;
            font-size: 1.05rem;
            font-weight: 900;
        }

        .section-title i {
            color: var(--primary);
        }

        .kelas-builder-page .text-muted,
        .kelas-builder-page .text-gray-700,
        .kelas-builder-page .text-gray-500,
        .kelas-builder-page .text-gray-400 {
            color: var(--muted) !important;
        }

        .kelas-builder-page .btn,
        .kelas-builder-page .btn.btn-primary,
        .kelas-builder-page .btn.btn-light,
        .kelas-builder-page .btn.btn-secondary,
        .kelas-builder-page .dt-button,
        .kelas-builder-page .dataTables_wrapper .btn {
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 9px 14px !important;
            border: 1px solid rgba(148, 163, 184, .2) !important;
            border-radius: 14px !important;
            color: #334155 !important;
            background: var(--surface) !important;
            font-weight: 850 !important;
            line-height: 1 !important;
            box-shadow: 5px 5px 12px rgba(163, 177, 198, .26), -5px -5px 12px rgba(255, 255, 255, .76) !important;
            transition: .18s ease;
        }

        .kelas-builder-page .btn:hover,
        .kelas-builder-page .dt-button:hover {
            transform: translateY(-1px);
            color: #0f172a !important;
            border-color: rgba(100, 116, 139, .28) !important;
            box-shadow: 6px 6px 14px rgba(163, 177, 198, .3), -6px -6px 14px rgba(255, 255, 255, .8) !important;
        }

        .kelas-builder-page .table-responsive {
            border: 0 !important;
            border-radius: 24px !important;
            background: var(--surface) !important;
            padding: 18px !important;
            box-shadow: inset 5px 5px 12px rgba(163, 177, 198, .2), inset -5px -5px 12px rgba(255, 255, 255, .76) !important;
        }

        .kelas-builder-page table.dataTable,
        .kelas-builder-page .table {
            border-collapse: separate !important;
            border-spacing: 0 10px !important;
            margin-top: 10px !important;
        }

        .kelas-builder-page .table thead tr,
        .kelas-builder-page table.dataTable thead tr {
            background: transparent !important;
        }

        .kelas-builder-page .table thead th,
        .kelas-builder-page table.dataTable thead th {
            border: 0 !important;
            color: #64748b !important;
            font-size: .76rem !important;
            font-weight: 900 !important;
            letter-spacing: .035em;
        }

        .kelas-builder-page .table tbody tr {
            border-radius: 18px;
            background: var(--surface-soft) !important;
            box-shadow: 4px 4px 10px rgba(163, 177, 198, .16), -4px -4px 10px rgba(255, 255, 255, .62);
        }

        .kelas-builder-page .table tbody td {
            border-top: 0 !important;
            border-bottom: 0 !important;
            color: #334155 !important;
            vertical-align: middle !important;
            padding-top: 14px !important;
            padding-bottom: 14px !important;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_length select,
        .kelas-builder-page .dataTables_wrapper .dataTables_filter input,
        .kelas-builder-page .form-control,
        .kelas-builder-page .form-select {
            min-height: 40px;
            border: 1px solid rgba(148, 163, 184, .18) !important;
            border-radius: 14px !important;
            color: #334155 !important;
            background: var(--surface) !important;
            box-shadow: inset 4px 4px 9px rgba(163, 177, 198, .2), inset -4px -4px 9px rgba(255, 255, 255, .74) !important;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_info,
        .kelas-builder-page .dataTables_wrapper .dataTables_length,
        .kelas-builder-page .dataTables_wrapper .dataTables_filter,
        .kelas-builder-page .dataTables_wrapper .dataTables_paginate {
            color: var(--muted) !important;
            font-weight: 700;
        }

        .kelas-builder-page .paginate_button,
        .kelas-builder-page .page-link {
            border: 0 !important;
            border-radius: 12px !important;
            color: #334155 !important;
            background: var(--surface) !important;
            box-shadow: 3px 3px 7px rgba(163, 177, 198, .18), -3px -3px 7px rgba(255, 255, 255, .62) !important;
        }

        #form_create .modal-content,
        #form_edit .modal-content,
        #form_detail .modal-content {
            border: 0 !important;
            border-radius: 26px !important;
            background: #eef2f7 !important;
            box-shadow: 12px 12px 28px rgba(15, 23, 42, .14) !important;
            overflow: hidden;
        }

        #form_create .modal-header,
        #form_edit .modal-header,
        #form_detail .modal-header,
        #form_create .modal-footer,
        #form_edit .modal-footer,
        #form_detail .modal-footer,
        #form_create .modal-body,
        #form_edit .modal-body,
        #form_detail .modal-body {
            border-color: rgba(148, 163, 184, .18) !important;
            background: #eef2f7 !important;
        }

        #form_create .modal-title,
        #form_edit .modal-title,
        #form_detail .modal-title {
            color: #1f2937 !important;
            font-weight: 900 !important;
        }

        #form_create .form-control,
        #form_create .form-select,
        #form_edit .form-control,
        #form_edit .form-select,
        #form_detail .form-control,
        #form_detail .form-select,
        #form_create textarea,
        #form_edit textarea,
        #form_detail textarea {
            min-height: 42px;
            border: 1px solid rgba(148, 163, 184, .2) !important;
            border-radius: 15px !important;
            color: #334155 !important;
            background: #eef2f7 !important;
            box-shadow: inset 4px 4px 9px rgba(163, 177, 198, .2), inset -4px -4px 9px rgba(255, 255, 255, .74) !important;
        }

        #form_create .form-control:focus,
        #form_create .form-select:focus,
        #form_edit .form-control:focus,
        #form_edit .form-select:focus,
        #form_detail .form-control:focus,
        #form_detail .form-select:focus {
            border-color: rgba(37, 99, 235, .42) !important;
            box-shadow: inset 4px 4px 9px rgba(163, 177, 198, .2), inset -4px -4px 9px rgba(255, 255, 255, .74), 0 0 0 3px rgba(37, 99, 235, .08) !important;
        }

        #form_create .btn,
        #form_edit .btn,
        #form_detail .btn {
            min-height: 38px;
            border: 1px solid rgba(148, 163, 184, .22) !important;
            border-radius: 14px !important;
            color: #334155 !important;
            background: #eef2f7 !important;
            font-weight: 850 !important;
            box-shadow: 5px 5px 12px rgba(163, 177, 198, .24) !important;
        }

        #form_create .btn-close,
        #form_edit .btn-close,
        #form_detail .btn-close {
            border-radius: 13px;
            background-color: #eef2f7;
            opacity: 1;
            box-shadow: 4px 4px 9px rgba(163, 177, 198, .22);
        }

        .modal-backdrop.show {
            opacity: .35 !important;
        }

        .swal2-popup {
            border-radius: 24px !important;
            background: #eef2f7 !important;
            color: #1f2937 !important;
            box-shadow: 12px 12px 28px rgba(15, 23, 42, .14) !important;
        }

        .swal2-confirm,
        .swal2-cancel {
            border-radius: 14px !important;
            box-shadow: 5px 5px 12px rgba(163, 177, 198, .24) !important;
        }

        @media (max-width: 767.98px) {
            .kelas-builder-page {
                padding: 0 18px 24px;
            }

            .hero-top,
            .content-header {
                flex-direction: column;
                align-items: stretch;
            }

            .content-body .d-flex.justify-content-between.align-items-center.mb-5 {
                align-items: stretch !important;
                gap: 12px;
                flex-direction: column;
            }

            .kelas-builder-page .btn {
                width: 100%;
            }

            .stat-item {
                min-width: 100%;
            }
        }
    </style>
@endsection

@section('list')
    <li class="breadcrumb-item text-muted">Kelas</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">Data Kelas</li>
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
            $ratingLabel = $avgRating >= 4.5 ? 'Sangat Baik' : ($avgRating >= 3.5 ? 'Baik' : ($avgRating > 0 ? 'Cukup' : 'Belum ada rating'));
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

                        @if (!empty($kelas->deskripsi_singkat))
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
                        <i class="bi bi-people"></i>
                        Target Peserta
                    </h3>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#form_create">
                        Tambah Target
                    </button>
                </div>

                <div
                    class="table-responsive mb-8  p-4 mx-0 border-hover-dark border-primary border-1 fs-sm-8 fs-lg-6 rounded-2">
                    <table id="target_table"
                        class="table table-sm align-middle table-row-bordered table-row-solid gs-0 gy-2">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0 fs-sm-8 fs-lg-6">
                                <th class="min-w-125px ps-5 text-nowrap">Aksi</th>
                                <th class="min-w-80px">Urutan</th>
                                <th class="min-w-300px">Target Peserta</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 fw-bolder fs-sm-8 fs-lg-6">
                        </tbody>
                    </table>
                </div>                    </div>
                </div>
            </div>
        </div>

    @include('admin.kelas.kelas_target_peserta.view.create')
    @include('admin.kelas.kelas_target_peserta.view.edit')
    @include('admin.kelas.kelas_target_peserta.view.detail')
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
                    $(id).select2();
                    if (callback) {
                        callback();
                    }
                } else if (!response.errors) {
                    Swal.fire('Warning', response.message, 'warning');
                }
            }).catch(error => {
                ErrorHandler.handleError(error);
            });
        }
    </script>
    @include('admin.kelas.kelas_target_peserta.script.list')
    @include('admin.kelas.kelas_target_peserta.script.create')
    @include('admin.kelas.kelas_target_peserta.script.edit')
    @include('admin.kelas.kelas_target_peserta.script.detail')
    @include('admin.kelas.kelas_target_peserta.script.delete')
@endsection
