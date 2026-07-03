@extends('admin.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/buttons.dataTables.min.css') }}"/>

    <style>
        :root {
            --neo-bg: #eef2f7;
            --neo-surface: #eef2f7;
            --neo-surface-soft: #f3f6fa;
            --neo-text: #1f2937;
            --neo-muted: #6b7280;
            --neo-border: rgba(148, 163, 184, 0.18);

            --neo-shadow-dark: rgba(163, 177, 198, 0.42);
            --neo-shadow-light: rgba(255, 255, 255, 0.95);

            --neo-primary: #3b82f6;
            --neo-primary-dark: #2563eb;
            --neo-success: #10b981;
        }

        .neo-page {
            width: 100%;
            padding: 0 30px 30px;
        }

        .neo-page-shell {
            width: 100%;
            max-width: 1480px;
            margin: 0 auto;
        }

        .neo-page-inner {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .neo-page-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 24px;
            border-radius: 24px;
            background: var(--neo-surface);
            box-shadow:
                10px 10px 22px var(--neo-shadow-dark),
                -10px -10px 22px var(--neo-shadow-light);
        }

        .neo-page-title-wrap {
            min-width: 0;
        }

        .neo-page-title {
            margin: 0;
            color: var(--neo-text);
            font-size: 1.65rem;
            line-height: 1.2;
            font-weight: 800;
            letter-spacing: -0.025em;
        }

        .neo-page-subtitle {
            margin: 7px 0 0;
            color: var(--neo-muted);
            font-size: 0.94rem;
            line-height: 1.45;
            font-weight: 500;
        }

        .neo-page-icon {
            width: 58px;
            height: 58px;
            min-width: 58px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--neo-surface);
            color: var(--neo-primary);
            box-shadow:
                inset 5px 5px 10px rgba(163, 177, 198, 0.28),
                inset -5px -5px 10px rgba(255, 255, 255, 0.92);
            font-size: 1.45rem;
        }

        .neo-card {
            border: 0 !important;
            border-radius: 24px;
            background: var(--neo-surface) !important;
            box-shadow:
                10px 10px 22px var(--neo-shadow-dark),
                -10px -10px 22px var(--neo-shadow-light) !important;
            overflow: hidden;
        }

        .neo-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 22px 24px 18px;
            border-bottom: 1px solid var(--neo-border);
            background: transparent !important;
            min-height: auto !important;
        }

        .neo-card-title-wrap {
            min-width: 0;
        }

        .neo-card-title {
            margin: 0;
            color: var(--neo-text);
            font-size: 1.08rem;
            line-height: 1.25;
            font-weight: 800;
        }

        .neo-card-subtitle {
            margin: 6px 0 0;
            color: var(--neo-muted);
            font-size: 0.86rem;
            line-height: 1.4;
            font-weight: 500;
        }

        .neo-card-toolbar {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            flex-shrink: 0;
        }

        .neo-btn-primary {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            border: 0;
            border-radius: 16px;
            color: #ffffff !important;
            background: var(--neo-primary) !important;
            font-size: 0.88rem;
            line-height: 1;
            font-weight: 800;
            box-shadow:
                7px 7px 16px rgba(163, 177, 198, 0.44),
                -7px -7px 16px rgba(255, 255, 255, 0.9);
            transition:
                transform .18s ease,
                box-shadow .18s ease,
                background .18s ease;
        }

        .neo-btn-primary:hover {
            transform: translateY(-1px);
            color: #ffffff !important;
            background: var(--neo-primary-dark) !important;
            box-shadow:
                9px 9px 18px rgba(163, 177, 198, 0.48),
                -9px -9px 18px rgba(255, 255, 255, 0.92);
        }

        .neo-btn-primary:active {
            transform: translateY(0);
            box-shadow:
                inset 4px 4px 8px rgba(37, 99, 235, 0.28),
                inset -4px -4px 8px rgba(255, 255, 255, 0.22);
        }

        .neo-card-body {
            padding: 22px 24px 24px !important;
        }

        .neo-table-panel {
            width: 100%;
            border-radius: 20px;
            padding: 12px;
            background: var(--neo-surface);
            box-shadow:
                inset 6px 6px 12px rgba(163, 177, 198, 0.24),
                inset -6px -6px 12px rgba(255, 255, 255, 0.92);
        }

        .neo-table-scroll {
            width: 100%;
            overflow-x: auto;
            border-radius: 16px;
        }

        #example {
            width: 100% !important;
            margin: 0 !important;
            border-collapse: separate !important;
            border-spacing: 0 8px !important;
        }

        #example thead tr {
            background: transparent !important;
        }

        #example thead th {
            padding: 8px 14px 10px !important;
            border: 0 !important;
            background: transparent !important;
            color: var(--neo-muted) !important;
            font-size: 0.76rem !important;
            line-height: 1.35;
            font-weight: 800 !important;
            letter-spacing: .055em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        #example tbody tr {
            background: transparent !important;
        }

        #example tbody td {
            padding: 14px !important;
            border: 0 !important;
            background: var(--neo-surface-soft) !important;
            color: var(--neo-text) !important;
            font-size: 0.9rem;
            line-height: 1.35;
            vertical-align: middle;
        }

        #example tbody tr td:first-child {
            border-top-left-radius: 14px;
            border-bottom-left-radius: 14px;
        }

        #example tbody tr td:last-child {
            border-top-right-radius: 14px;
            border-bottom-right-radius: 14px;
        }

        #example tbody tr:hover td {
            background: #f8fafc !important;
        }

        #example .btn {
            border-radius: 12px !important;
            font-weight: 700;
        }

        #example .badge {
            border-radius: 999px;
            padding: 7px 11px;
            font-weight: 800;
        }

        .dataTables_wrapper {
            color: var(--neo-text);
        }

        .dataTables_wrapper .row {
            align-items: center;
            row-gap: 14px;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            color: var(--neo-muted) !important;
            font-size: 0.86rem;
            font-weight: 600;
        }

        .dataTables_wrapper .dataTables_length {
            padding: 2px 0 14px;
        }

        .dataTables_wrapper .dataTables_filter {
            padding: 2px 0 14px;
            text-align: right;
        }

        .dataTables_wrapper .dataTables_length label,
        .dataTables_wrapper .dataTables_filter label {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin: 0;
            color: var(--neo-muted);
            font-size: 0.86rem;
            font-weight: 700;
        }

        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            min-height: 40px;
            border: 0 !important;
            border-radius: 14px !important;
            background: var(--neo-surface) !important;
            color: var(--neo-text) !important;
            box-shadow:
                inset 4px 4px 8px rgba(163, 177, 198, 0.26),
                inset -4px -4px 8px rgba(255, 255, 255, 0.92) !important;
            outline: none !important;
        }

        .dataTables_wrapper .dataTables_filter input {
            width: 230px !important;
            padding: 9px 14px !important;
        }

        .dataTables_wrapper .dataTables_length select {
            padding: 8px 32px 8px 12px !important;
        }

        .dataTables_wrapper .dataTables_info {
            padding-top: 18px !important;
        }

        .dataTables_wrapper .dataTables_paginate {
            padding-top: 14px !important;
        }

        .dataTables_wrapper .pagination {
            gap: 8px;
            margin: 0 !important;
            justify-content: flex-end;
        }

        .dataTables_wrapper .page-item .page-link {
            min-width: 38px;
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0 !important;
            border-radius: 13px !important;
            background: var(--neo-surface) !important;
            color: var(--neo-muted) !important;
            font-size: 0.86rem;
            font-weight: 800;
            box-shadow:
                5px 5px 10px rgba(163, 177, 198, 0.34),
                -5px -5px 10px rgba(255, 255, 255, 0.92);
        }

        .dataTables_wrapper .page-item.active .page-link {
            color: #ffffff !important;
            background: var(--neo-primary) !important;
        }

        .dataTables_wrapper .page-item.disabled .page-link {
            opacity: .55;
            box-shadow: none;
        }

        table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control::before,
        table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control::before {
            border: 0 !important;
            border-radius: 10px !important;
            background: var(--neo-primary) !important;
            box-shadow: none !important;
            line-height: 16px !important;
        }

        @media (max-width: 1199.98px) {
            .neo-page {
                padding: 0 26px 28px;
            }
        }

        @media (max-width: 991.98px) {
            .neo-page {
                padding: 0 22px 26px;
            }

            .neo-page-inner {
                gap: 20px;
            }

            .neo-page-heading {
                padding: 22px;
            }

            .neo-card-header {
                padding: 20px 20px 16px;
            }

            .neo-card-body {
                padding: 20px !important;
            }
        }

        @media (max-width: 767.98px) {
            .neo-page {
                padding: 0 18px 24px;
            }

            .neo-page-heading {
                align-items: flex-start;
                padding: 20px;
                border-radius: 22px;
            }

            .neo-page-title {
                font-size: 1.42rem;
            }

            .neo-page-subtitle {
                font-size: 0.88rem;
            }

            .neo-page-icon {
                width: 50px;
                height: 50px;
                min-width: 50px;
                border-radius: 17px;
                font-size: 1.25rem;
            }

            .neo-card {
                border-radius: 22px;
            }

            .neo-card-header {
                align-items: flex-start;
                flex-direction: column;
                padding: 18px 18px 14px;
            }

            .neo-card-toolbar {
                width: 100%;
            }

            .neo-btn-primary {
                width: 100%;
            }

            .neo-card-body {
                padding: 18px !important;
            }

            .dataTables_wrapper .dataTables_filter {
                text-align: left;
            }

            .dataTables_wrapper .dataTables_length label,
            .dataTables_wrapper .dataTables_filter label {
                width: 100%;
                align-items: flex-start;
                flex-direction: column;
                gap: 8px;
            }

            .dataTables_wrapper .dataTables_filter input {
                width: 100% !important;
            }

            .dataTables_wrapper .pagination {
                justify-content: flex-start;
                flex-wrap: wrap;
            }
        }

        @media (max-width: 575.98px) {
            .neo-page {
                padding: 0 14px 20px;
            }

            .neo-page-inner {
                gap: 16px;
            }

            .neo-page-heading {
                padding: 18px;
                border-radius: 20px;
            }

            .neo-page-icon {
                display: none;
            }

            .neo-card {
                border-radius: 20px;
            }

            .neo-card-header {
                padding: 17px 16px 13px;
            }

            .neo-card-body {
                padding: 16px !important;
            }

            .neo-table-panel {
                padding: 8px;
                border-radius: 16px;
            }

            #example {
                border-spacing: 0 7px !important;
            }

            #example thead th {
                padding: 7px 10px 8px !important;
                font-size: 0.72rem !important;
            }

            #example tbody td {
                padding: 12px 10px !important;
                font-size: 0.86rem;
            }
        }
    </style>
@endsection

@section('list')
    <li class="breadcrumb-item text-muted">Mentor</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">Data Mentor</li>
@endsection

@section('content')
    <div class="container-fluid neo-page">
        <div class="neo-page-shell">
            <div class="neo-page-inner">

                <div class="neo-page-heading">
                    <div class="neo-page-title-wrap">
                        <h3 class="neo-page-title">Data Mentor</h3>
                        <p class="neo-page-subtitle">Kelola data mentor yang tersedia di platform</p>
                    </div>

                    <div class="neo-page-icon">
                        <i class="bi bi-person-workspace"></i>
                    </div>
                </div>

                <div class="neo-card">
                    <div class="neo-card-header">
                        <div class="neo-card-title-wrap">
                            <h3 class="neo-card-title">Daftar Mentor</h3>
                            <p class="neo-card-subtitle">Lihat, tambah, ubah, dan kelola informasi mentor</p>
                        </div>

                        <div class="neo-card-toolbar">
                            <a type="button"
                               class="neo-btn-primary"
                               data-bs-toggle="modal"
                               data-bs-target="#form_create"
                               title="Tambah Mentor">
                                <i class="bi bi-plus-lg"></i>
                                Tambah Mentor
                            </a>
                        </div>
                    </div>

                    <div class="neo-card-body">
                        <div class="neo-table-panel">
                            <div class="neo-table-scroll">
                                <table id="example"
                                       class="table table-sm align-middle table-row-bordered table-row-solid gs-0 gy-2">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0 fs-sm-8 fs-lg-6">
                                            <th class="min-w-125px ps-5 text-nowrap">Aksi</th>
                                            <th class="min-w-150px">Nama</th>
                                            <th class="min-w-150px">Email</th>
                                            <th class="min-w-150px">Spesialisasi</th>
                                            <th class="min-w-80px">Total Peserta</th>
                                            <th class="min-w-80px">Rating</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-800 fw-bolder fs-sm-8 fs-lg-6">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('admin.mentor.view.detail')
    @include('admin.mentor.view.create')
    @include('admin.mentor.view.edit')
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

    @include('admin.mentor.script.list')
    @include('admin.mentor.script.create')
    @include('admin.mentor.script.edit')
    @include('admin.mentor.script.detail')
@endsection