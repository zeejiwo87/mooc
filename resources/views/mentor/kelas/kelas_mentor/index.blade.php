@extends('mentor.layouts.index')

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

        .kelas-builder-page .dataTables_wrapper {
            color: var(--text);
        }

        .kelas-builder-page .dataTables_wrapper .mentor-dt-topbar {
            width: 100%;
            display: flex !important;
            align-items: flex-start !important;
            justify-content: space-between !important;
            gap: 14px !important;
            flex-wrap: wrap !important;
            margin: 0 0 16px 0 !important;
        }

        .kelas-builder-page .dataTables_wrapper .mentor-dt-left {
            display: flex !important;
            flex-direction: column !important;
            align-items: flex-start !important;
            justify-content: flex-start !important;
            gap: 10px !important;
            flex-wrap: nowrap !important;
        }

        .kelas-builder-page .dataTables_wrapper .mentor-dt-right {
            display: flex !important;
            align-items: flex-start !important;
            justify-content: flex-end !important;
            gap: 12px !important;
            flex-wrap: wrap !important;
            margin-left: auto !important;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_length,
        .kelas-builder-page .dataTables_wrapper .dataTables_filter,
        .kelas-builder-page .dataTables_wrapper .dt-buttons {
            float: none !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_length label,
        .kelas-builder-page .dataTables_wrapper .dataTables_filter label {
            display: inline-flex !important;
            align-items: center !important;
            gap: 8px !important;
            margin: 0 !important;
            color: var(--muted) !important;
            font-size: .86rem !important;
            font-weight: 700 !important;
            white-space: nowrap !important;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_length select,
        .kelas-builder-page .dataTables_wrapper .dataTables_filter input {
            min-height: 38px !important;
            border: 0 !important;
            border-radius: 14px !important;
            background: var(--surface) !important;
            color: var(--text) !important;
            box-shadow: inset 4px 4px 9px rgba(163, 177, 198, .22), inset -4px -4px 9px rgba(255, 255, 255, .78) !important;
            outline: none !important;
            display: inline-block !important;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_length select {
            width: auto !important;
            min-width: 78px !important;
            margin: 0 4px !important;
            padding: 8px 32px 8px 12px !important;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_filter input {
            width: 230px !important;
            margin-left: 4px !important;
            padding: 8px 12px !important;
        }

        .kelas-builder-page .dataTables_wrapper .dt-buttons {
            display: flex !important;
            align-items: center !important;
            justify-content: flex-start !important;
            gap: 8px !important;
            flex-wrap: wrap !important;
            width: 100% !important;
        }

        .kelas-builder-page .dataTables_wrapper .dt-buttons .btn,
        .kelas-builder-page .dataTables_wrapper .dt-buttons button {
            margin: 0 !important;
            min-height: 38px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_info,
        .kelas-builder-page .dataTables_wrapper .dataTables_paginate {
            color: var(--muted) !important;
            font-size: .86rem !important;
            font-weight: 700 !important;
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
            gap: 8px !important;
            margin: 0 !important;
            justify-content: flex-end !important;
        }

        .kelas-builder-page .dataTables_wrapper .page-item .page-link {
            min-width: 38px;
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0 !important;
            border-radius: 13px !important;
            background: var(--surface) !important;
            color: var(--muted) !important;
            font-size: .86rem;
            font-weight: 800;
            box-shadow: 5px 5px 10px rgba(163, 177, 198, .34), -5px -5px 10px rgba(255, 255, 255, .92);
        }

        .kelas-builder-page .dataTables_wrapper .page-item.active .page-link {
            color: #fff !important;
            background: var(--primary) !important;
        }

        .kelas-builder-page .dataTables_wrapper .page-item.disabled .page-link {
            opacity: .55;
            box-shadow: none !important;
        }

        .kelas-builder-page .dataTables_wrapper::after {
            content: "";
            display: table;
            clear: both;
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

            .kelas-builder-page .dataTables_wrapper .mentor-dt-topbar,
            .kelas-builder-page .dataTables_wrapper .mentor-dt-left,
            .kelas-builder-page .dataTables_wrapper .mentor-dt-right {
                width: 100% !important;
                justify-content: flex-start !important;
                margin-left: 0 !important;
            }

            .kelas-builder-page .dataTables_wrapper .dataTables_filter label,
            .kelas-builder-page .dataTables_wrapper .dataTables_filter input {
                width: 100% !important;
            }

            .kelas-builder-page .dataTables_wrapper .dataTables_filter input {
                min-width: 180px !important;
            }

            .kelas-builder-page .dataTables_wrapper .dataTables_info,
            .kelas-builder-page .dataTables_wrapper .dataTables_paginate {
                float: none !important;
                width: 100% !important;
                text-align: left !important;
            }

            .kelas-builder-page .dataTables_wrapper .pagination {
                justify-content: flex-start !important;
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