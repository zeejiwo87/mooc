@extends('mentor.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/buttons.dataTables.min.css') }}"/>

    <style>
        .kelas-builder-page {
            --page-primary: #074366;
            --page-primary-dark: #052f49;
            --page-success: #10b981;
            --page-warning: #f59e0b;
            --page-danger: #ef4444;
            --page-text: #111827;
            --page-muted: #64748b;
            --page-border: #e5e7eb;
            --page-soft: #f8fafc;
            --page-white: #ffffff;
            width: 100%;
            padding: 0 24px 28px;
            color: var(--page-text);
        }

        .kelas-builder-shell {
            max-width: 1480px;
            margin: 0 auto;
        }

        .kelas-builder-page .d-flex.flex-column.gap-5 {
            gap: 20px !important;
        }

        .neo-card,
        .mentor-main-card,
        .assistant-card {
            overflow: hidden;
            background: var(--page-white);
            border: 1px solid #eef2f7;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(15, 23, 42, .06);
        }

        .hero-banner {
            min-height: 220px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .hero-banner::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(15, 23, 42, .18);
        }

        .hero-body,
        .content-body {
            padding: 22px;
            background: #ffffff;
        }

        .hero-top,
        .content-header,
        .assistant-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .kelas-title {
            margin: 0;
            color: var(--page-text);
            font-size: 24px;
            line-height: 1.3;
            font-weight: 800;
        }

        .kelas-owner,
        .muted-text {
            color: var(--page-muted);
            font-weight: 600;
        }

        .kelas-owner span {
            color: var(--page-text);
            font-weight: 800;
        }

        .stars {
            display: flex;
            align-items: center;
            gap: 3px;
            color: var(--page-warning);
        }

        .stars .bi-star {
            color: #cbd5e1;
        }

        .rating-number {
            margin-left: 8px;
            color: var(--page-text);
            font-weight: 800;
        }

        .short-desc {
            max-width: 920px;
            margin: 16px 0 0;
            color: var(--page-muted);
            line-height: 1.65;
            font-weight: 600;
        }

        .stat-row,
        .meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .stat-row {
            margin-top: 22px;
        }

        .stat-item {
            min-width: 185px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px;
            background: var(--page-soft);
            border: 1px solid var(--page-border);
            border-radius: 10px;
            box-shadow: none;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            min-width: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--page-primary);
            background: #ffffff;
            border: 1px solid var(--page-border);
            border-radius: 8px;
            box-shadow: none;
            font-size: 18px;
        }

        .stat-value {
            color: var(--page-text);
            font-size: 15px;
            line-height: 1.2;
            font-weight: 800;
        }

        .stat-label {
            margin-top: 3px;
            color: var(--page-muted);
            font-size: 12px;
            font-weight: 600;
        }

        .badge-neo {
            min-height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 10px;
            color: #334155 !important;
            background: var(--page-soft) !important;
            border: 1px solid var(--page-border);
            border-radius: 999px;
            box-shadow: none;
            font-size: 12px;
            line-height: 1;
            font-weight: 700;
        }

        .tabs-card {
            padding: 14px 16px 0;
            background: #ffffff;
            border-bottom: 1px solid #eef2f7;
        }

        .tabs-scroll {
            width: 100%;
            overflow-x: auto;
            padding-bottom: 12px;
        }

        .neo-tabs {
            display: flex;
            align-items: center;
            gap: 8px;
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
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 !important;
            padding: 9px 13px !important;
            color: var(--page-muted) !important;
            background: #ffffff !important;
            border: 1px solid var(--page-border) !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-size: 13px;
            line-height: 1;
            font-weight: 700;
            white-space: nowrap;
        }

        .neo-tabs .nav-link:hover {
            color: var(--page-primary) !important;
            background: #f8fafc !important;
            border-color: #cbd5e1 !important;
            transform: none;
        }

        .neo-tabs .nav-link.active {
            color: #ffffff !important;
            background: var(--page-primary) !important;
            border-color: var(--page-primary) !important;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
            color: var(--page-text) !important;
            font-size: 16px;
            font-weight: 800;
        }

        .section-title i {
            color: var(--page-primary);
        }

        .mentor-main-card,
        .assistant-card {
            padding: 18px;
            box-shadow: none;
        }

        .mentor-main-card {
            background: var(--page-soft);
            border-color: var(--page-border);
        }

        .mentor-main-icon {
            width: 48px;
            height: 48px;
            min-width: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--page-primary);
            background: #ffffff;
            border: 1px solid var(--page-border);
            border-radius: 10px;
            box-shadow: none;
            font-size: 22px;
        }

        .mentor-name {
            margin-bottom: 4px;
            color: var(--page-text);
            font-size: 17px;
            font-weight: 800;
        }

        .mentor-note {
            margin-bottom: 0;
            color: var(--page-muted);
            line-height: 1.65;
            font-weight: 600;
        }

        .assistant-card {
            margin-top: 18px;
            background: #ffffff;
        }

        .assistant-header {
            margin-bottom: 16px;
        }

        .assistant-title {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
            color: var(--page-text);
            font-size: 16px;
            font-weight: 800;
        }

        .assistant-title i {
            color: var(--page-primary);
        }

        .assistant-subtitle {
            margin: 6px 0 0;
            color: var(--page-muted);
            line-height: 1.6;
            font-weight: 600;
        }

        .assistant-limit {
            min-height: 34px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 11px;
            color: #047857;
            background: #ecfdf5;
            border: 1px solid #bbf7d0;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .neo-table-wrap {
            padding: 0;
            background: #ffffff;
            border: 0;
            border-radius: 0;
            box-shadow: none;
        }

        .kelas-builder-page .table-responsive {
            border: 0;
        }

        #mentor_table {
            width: 100% !important;
            margin-bottom: 0;
        }

        #mentor_table thead th {
            color: #64748b;
            background: #ffffff !important;
            border-bottom-color: #eef2f7 !important;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
        }

        #mentor_table tbody td {
            color: var(--page-text);
            background: #ffffff !important;
            border-bottom-color: #eef2f7 !important;
            font-size: 14px;
            vertical-align: middle;
        }

        #mentor_table tbody tr:hover {
            background: #f8fafc;
        }

        #mentor_table td:first-child {
            white-space: nowrap;
        }

        #mentor_table .action-icon-btn,
        #mentor_table .btn.btn-icon.action-icon-btn,
        #mentor_table td:first-child .btn.btn-icon,
        #mentor_table td:first-child .btn {
            width: 34px !important;
            height: 34px !important;
            min-width: 34px !important;
            padding: 0 !important;
            border: 0 !important;
            border-radius: 10px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            color: #ffffff !important;
            background: #3b82f6 !important;
            box-shadow: 0 6px 14px rgba(15, 23, 42, .14) !important;
            transition: transform .18s ease, filter .18s ease;
        }

        #mentor_table .action-icon-btn .bi,
        #mentor_table .btn.btn-icon.action-icon-btn .bi,
        #mentor_table td:first-child .btn.btn-icon .bi,
        #mentor_table td:first-child .btn i,
        #mentor_table td:first-child .btn svg {
            color: #ffffff !important;
            font-size: 16px !important;
            line-height: 1 !important;
        }

        #mentor_table .action-icon-btn[data-bs-target="#form_detail"],
        #mentor_table .btn[data-bs-target="#form_detail"] {
            background: #3b82f6 !important;
        }

        #mentor_table .action-icon-btn[data-bs-target="#form_edit"],
        #mentor_table .btn[data-bs-target="#form_edit"] {
            background: #f59e0b !important;
        }

        #mentor_table .action-icon-btn[onclick*="deleteConfirmation"],
        #mentor_table .btn[onclick*="deleteConfirmation"] {
            background: #ef4444 !important;
        }

        #mentor_table .action-icon-btn:hover,
        #mentor_table td:first-child .btn:hover {
            color: #ffffff !important;
            filter: brightness(.96);
            transform: translateY(-1px);
        }

        .kelas-builder-page .dataTables_wrapper {
            width: 100%;
            color: var(--page-text);
        }

        .kelas-builder-page .dataTables_wrapper .mentor-dt-topbar {
            width: 100%;
            display: flex !important;
            align-items: flex-start !important;
            justify-content: space-between !important;
            gap: 14px !important;
            flex-wrap: wrap !important;
            margin: 0 0 14px 0 !important;
        }

        .kelas-builder-page .dataTables_wrapper .mentor-dt-left,
        .kelas-builder-page .dataTables_wrapper .mentor-dt-right {
            display: flex !important;
            align-items: flex-start !important;
            gap: 10px !important;
            flex-wrap: wrap !important;
        }

        .kelas-builder-page .dataTables_wrapper .mentor-dt-left {
            flex-direction: column !important;
            justify-content: flex-start !important;
        }

        .kelas-builder-page .dataTables_wrapper .mentor-dt-right {
            justify-content: flex-end !important;
            margin-left: auto !important;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_length,
        .kelas-builder-page .dataTables_wrapper .dataTables_filter,
        .kelas-builder-page .dataTables_wrapper .dataTables_info,
        .kelas-builder-page .dataTables_wrapper .dataTables_paginate,
        .kelas-builder-page .dataTables_wrapper .dt-buttons {
            float: none !important;
            color: #64748b !important;
            font-size: 13px;
            font-weight: 600;
            margin: 0 !important;
            padding: 0 !important;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_length label,
        .kelas-builder-page .dataTables_wrapper .dataTables_filter label {
            display: inline-flex !important;
            align-items: center !important;
            gap: 8px !important;
            margin: 0 !important;
            color: #64748b !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            white-space: nowrap !important;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_filter {
            text-align: right !important;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_filter input,
        .kelas-builder-page .dataTables_wrapper .dataTables_length select {
            min-height: 38px;
            padding: 7px 10px !important;
            color: #111827;
            background: #ffffff !important;
            border: 1px solid var(--page-border) !important;
            border-radius: 8px !important;
            outline: none !important;
            box-shadow: none !important;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_filter input:focus,
        .kelas-builder-page .dataTables_wrapper .dataTables_length select:focus {
            border-color: var(--page-primary) !important;
            box-shadow: 0 0 0 .2rem rgba(59, 130, 246, .10) !important;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_filter input {
            width: 230px !important;
            margin-left: 6px !important;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_length select {
            width: auto !important;
            min-width: 78px !important;
            margin: 0 4px !important;
        }

        .kelas-builder-page .dataTables_wrapper .dt-buttons {
            display: inline-flex !important;
            align-items: center !important;
            gap: 6px !important;
            flex-wrap: wrap !important;
        }

        .kelas-builder-page .dataTables_wrapper .dt-buttons .btn,
        .kelas-builder-page .dataTables_wrapper .dt-button {
            min-height: 38px !important;
            margin-right: 6px !important;
            border-radius: 8px !important;
            font-weight: 700 !important;
            box-shadow: none !important;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_info {
            float: left !important;
            padding-top: 16px !important;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_paginate {
            float: right !important;
            padding-top: 10px !important;
        }

        .kelas-builder-page .dataTables_wrapper .pagination {
            gap: 4px;
            margin-bottom: 0;
            justify-content: flex-end;
        }

        .kelas-builder-page .dataTables_wrapper .page-link {
            min-width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            background: #ffffff;
            border: 1px solid var(--page-border);
            border-radius: 8px !important;
            font-weight: 700;
            box-shadow: none !important;
        }

        .kelas-builder-page .dataTables_wrapper .page-item.active .page-link {
            color: #ffffff;
            background: var(--page-primary);
            border-color: var(--page-primary);
        }

        .kelas-builder-page .dataTables_wrapper .page-item.disabled .page-link {
            color: #94a3b8;
            background: #f8fafc;
        }

        table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control::before,
        table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control::before {
            background: var(--page-primary) !important;
            border: 0 !important;
            box-shadow: none !important;
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
                padding: 18px;
            }

            .assistant-limit {
                white-space: normal;
            }

            .kelas-builder-page .dataTables_wrapper .mentor-dt-topbar,
            .kelas-builder-page .dataTables_wrapper .mentor-dt-left,
            .kelas-builder-page .dataTables_wrapper .mentor-dt-right {
                width: 100% !important;
                justify-content: flex-start !important;
                margin-left: 0 !important;
            }

            .kelas-builder-page .dataTables_wrapper .dataTables_filter,
            .kelas-builder-page .dataTables_wrapper .dataTables_filter label,
            .kelas-builder-page .dataTables_wrapper .dataTables_filter input {
                width: 100% !important;
                text-align: left !important;
            }

            .kelas-builder-page .dataTables_wrapper .dataTables_filter label {
                align-items: flex-start !important;
                flex-direction: column !important;
            }

            .kelas-builder-page .dataTables_wrapper .dataTables_filter input {
                margin-left: 0 !important;
            }

            .kelas-builder-page .dataTables_wrapper .dataTables_info,
            .kelas-builder-page .dataTables_wrapper .dataTables_paginate {
                float: none !important;
                width: 100% !important;
                text-align: left !important;
            }

            .kelas-builder-page .dataTables_wrapper .pagination {
                justify-content: flex-start;
                flex-wrap: wrap;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid kelas-builder-page kelas-mentor-neo-page">
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
                                    <a class="nav-link {{ request()->routeIs('mentor.kelas.kelas.histori') ? 'active' : '' }}"
                                       href="{{ route('mentor.kelas.kelas.histori', ['id' => $id]) }}">
                                        Beranda
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('mentor.kelas.mentor.*') ? 'active' : '' }}"
                                       href="{{ route('mentor.kelas.mentor.index', ['id' => $id]) }}">
                                        Mentor
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('mentor.kelas.persyaratan.*') ? 'active' : '' }}"
                                       href="{{ route('mentor.kelas.persyaratan.index', ['id' => $id]) }}">
                                        Persyaratan
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('mentor.kelas.tujuan_pembelajaran.*') ? 'active' : '' }}"
                                       href="{{ route('mentor.kelas.tujuan_pembelajaran.index', ['id' => $id]) }}">
                                        Tujuan Pembelajaran
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('mentor.kelas.target_peserta.*') ? 'active' : '' }}"
                                       href="{{ route('mentor.kelas.target_peserta.index', ['id' => $id]) }}">
                                        Target Peserta
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('mentor.kelas.kelas_tag.*') ? 'active' : '' }}"
                                       href="{{ route('mentor.kelas.kelas_tag.index', ['id' => $id]) }}">
                                        Tag
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('mentor.kelas.usulan_peserta.*') ? 'active' : '' }}"
                                       href="{{ route('mentor.kelas.usulan_peserta.index', ['id' => $id]) }}">
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
                                        Mentor utama kelas tetap hanya satu dan ditentukan oleh admin melalui data pemilik kelas.
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

        @include('mentor.kelas.kelas_mentor.view.detail')
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
        function removeMentorActionMutationButtons() {
            $('#mentor_table [data-bs-target="#form_edit"]').remove();
            $('#mentor_table [data-bs-target="#form_create"]').remove();
            $('#mentor_table [onclick*="deleteConfirmation"]').remove();
            $('#mentor_table [onclick*="edit"]').remove();
            $('#mentor_table [onclick*="destroy"]').remove();
            $('#mentor_table [data-action="edit"]').remove();
            $('#mentor_table [data-action="delete"]').remove();
        }

        function arrangeMentorDataTableToolbar() {
            const $wrapper = $('#mentor_table_wrapper');
            const $length = $('#mentor_table_length');
            const $filter = $('#mentor_table_filter');
            const $buttons = $wrapper.find('.dt-buttons').first();

            if (! $wrapper.length || ! $length.length) {
                return;
            }

            let $topbar = $wrapper.find('.mentor-dt-topbar').first();
            let $left = $wrapper.find('.mentor-dt-left').first();
            let $right = $wrapper.find('.mentor-dt-right').first();

            if (! $topbar.length) {
                $topbar = $('<div class="mentor-dt-topbar"></div>');
                $left = $('<div class="mentor-dt-left"></div>');
                $right = $('<div class="mentor-dt-right"></div>');

                $topbar.append($left).append($right);
                $wrapper.prepend($topbar);
            }

            $left.append($length);

            if ($buttons.length) {
                $left.append($buttons);
            }

            if ($filter.length) {
                $right.append($filter);
            }
        }

        function refreshMentorTableUi() {
            arrangeMentorDataTableToolbar();
            removeMentorActionMutationButtons();
        }

        $(document).on('init.dt draw.dt', '#mentor_table', function() {
            setTimeout(refreshMentorTableUi, 0);
        });

        $(document).ready(function() {
            setTimeout(refreshMentorTableUi, 500);
            setTimeout(refreshMentorTableUi, 1000);
        });
    </script>

    @include('mentor.kelas.kelas_mentor.script.list')
    @include('mentor.kelas.kelas_mentor.script.detail')
@endsection