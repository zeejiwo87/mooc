@extends('admin.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/buttons.dataTables.min.css') }}"/>

    <style>
        /* =========================================================
           HALAMAN KATEGORI KELAS
           Tampilan sederhana, bersih, dan responsive
        ========================================================= */

        .admin-page-simple {
            width: 100%;
        }

        .admin-page-simple .page-title h3 {
            margin-bottom: 4px;
            color: #111827;
        }

        .admin-page-simple .page-title p {
            color: #64748b;
        }

        /* Card */
        .admin-page-simple .card {
            overflow: hidden;
            border: 0;
            border-radius: 12px;
            background: #ffffff;
            box-shadow: 0 6px 18px rgba(15, 23, 42, .06);
        }

        .admin-page-simple .card-header {
            min-height: auto;
            padding: 16px 18px;
            background: #ffffff;
            border-bottom: 1px solid #eef2f7;
        }

        .admin-page-simple .card-title {
            margin: 0;
        }

        .admin-page-simple .card-body {
            padding: 18px;
        }

        /* Tombol umum */
        .admin-page-simple .btn {
            border-radius: 8px;
            font-weight: 700;
        }

        .admin-page-simple .btn-primary {
            color: #ffffff !important;
            background: #074366 !important;
            border-color: #074366 !important;
            box-shadow: 0 8px 18px rgba(7, 67, 102, .20) !important;
        }

        .admin-page-simple .btn-primary:hover,
        .admin-page-simple .btn-primary:focus {
            color: #ffffff !important;
            background: #052f49 !important;
            border-color: #052f49 !important;
        }

        /* Tabel */
        .admin-page-simple .table-responsive {
            width: 100%;
        }

        .admin-page-simple .table {
            width: 100% !important;
            margin-bottom: 0;
        }

        .admin-page-simple .table thead th {
            padding-top: 12px;
            padding-bottom: 12px;
            color: #64748b;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
            background: #ffffff;
            border-bottom-color: #eef2f7;
        }

        .admin-page-simple .table tbody td {
            padding-top: 12px;
            padding-bottom: 12px;
            color: #111827;
            font-size: 14px;
            vertical-align: middle;
        }

        .admin-page-simple .table tbody tr:last-child td {
            border-bottom: 0;
        }

        .admin-page-simple .table tbody tr:hover {
            background: #f8fafc;
        }

        .admin-page-simple .badge {
            padding: 6px 10px;
            border-radius: 999px;
            font-weight: 700;
        }

        /* =========================================================
           TOMBOL AKSI
           Detail = biru, Edit = kuning, Hapus = merah
        ========================================================= */

        #example td:first-child {
            white-space: nowrap;
        }

        #example .action-icon-btn,
        #example .btn.btn-icon.action-icon-btn,
        #example td:first-child .btn.btn-icon {
            width: 34px !important;
            height: 34px !important;
            min-width: 34px !important;
            padding: 0 !important;
            border: 0 !important;
            border-radius: 8px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            color: #ffffff !important;
            box-shadow: 0 5px 12px rgba(15, 23, 42, .12) !important;
            transition:
                transform .18s ease,
                filter .18s ease;
        }

        #example .action-icon-btn .bi,
        #example .btn.btn-icon.action-icon-btn .bi,
        #example td:first-child .btn.btn-icon .bi {
            color: #ffffff !important;
            font-size: 15px !important;
            line-height: 1 !important;
        }

        #example .action-icon-btn[data-bs-target="#form_detail"],
        #example .btn[data-bs-target="#form_detail"] {
            background: #3b82f6 !important;
        }

        #example .action-icon-btn[data-bs-target="#form_edit"],
        #example .btn[data-bs-target="#form_edit"] {
            background: #f59e0b !important;
        }

        #example .action-icon-btn[onclick*="deleteConfirmation"],
        #example .btn[onclick*="deleteConfirmation"] {
            background: #ef4444 !important;
        }

        #example .action-icon-btn:hover,
        #example td:first-child .btn.btn-icon:hover {
            color: #ffffff !important;
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        #example .action-icon-btn:active,
        #example td:first-child .btn.btn-icon:active {
            transform: translateY(0);
        }

        /* =========================================================
           DATATABLES
        ========================================================= */

        .admin-page-simple .dataTables_wrapper {
            width: 100%;
            color: #111827;
        }

        .admin-page-simple .dataTables_wrapper .dataTables_length,
        .admin-page-simple .dataTables_wrapper .dataTables_filter,
        .admin-page-simple .dataTables_wrapper .dataTables_info,
        .admin-page-simple .dataTables_wrapper .dataTables_paginate {
            color: #64748b !important;
            font-size: 13px;
            font-weight: 600;
        }

        .admin-page-simple .dataTables_wrapper .dataTables_length label,
        .admin-page-simple .dataTables_wrapper .dataTables_filter label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
        }

        .admin-page-simple .dataTables_wrapper .dataTables_filter input,
        .admin-page-simple .dataTables_wrapper .dataTables_length select {
            min-height: 38px;
            padding: 7px 10px !important;
            color: #111827;
            background: #ffffff !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 8px !important;
            outline: none !important;
            box-shadow: none !important;
        }

        .admin-page-simple .dataTables_wrapper .dataTables_filter input:focus,
        .admin-page-simple .dataTables_wrapper .dataTables_length select:focus {
            border-color: #074366 !important;
            box-shadow: 0 0 0 .2rem rgba(7, 67, 102, .10) !important;
        }

        /* Excel di kiri */
        .admin-page-simple .dataTables_wrapper > .dt-buttons,
        .admin-page-simple .dataTables_wrapper .dt-buttons {
            float: left !important;
            display: inline-flex !important;
            align-items: center;
            gap: 6px;
            margin-bottom: 12px;
        }

        /* Pencarian di kanan */
        .admin-page-simple .dataTables_wrapper .dataTables_filter {
            float: right !important;
            margin-bottom: 12px;
            text-align: right !important;
        }

        .admin-page-simple .dataTables_wrapper .dataTables_filter label {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: flex-end !important;
            gap: 8px !important;
            margin-bottom: 0 !important;
        }

        .admin-page-simple .dataTables_wrapper .dataTables_filter input {
            width: 230px !important;
            margin-left: 6px !important;
        }

        .admin-page-simple .dataTables_wrapper::after {
            content: "";
            display: block;
            clear: both;
        }

        .admin-page-simple .dataTables_wrapper .dt-buttons .btn,
        .admin-page-simple .dataTables_wrapper .dt-button {
            margin-right: 6px !important;
            border-radius: 8px !important;
            font-weight: 700 !important;
        }

        /* Pagination */
        .admin-page-simple .dataTables_wrapper .pagination {
            gap: 4px;
            margin-bottom: 0;
            justify-content: flex-end;
        }

        .admin-page-simple .dataTables_wrapper .page-link {
            min-width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 8px !important;
            font-weight: 700;
        }

        .admin-page-simple .dataTables_wrapper .page-item.active .page-link {
            color: #ffffff;
            background: #074366;
            border-color: #074366;
        }

        .admin-page-simple .dataTables_wrapper .page-item.disabled .page-link {
            color: #94a3b8;
            background: #f8fafc;
        }

        table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control::before,
        table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control::before {
            background: #074366 !important;
            border: 0 !important;
            box-shadow: none !important;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 767.98px) {
            .admin-page-simple .page-title {
                margin-bottom: 18px !important;
            }

            .admin-page-simple .card-header {
                align-items: flex-start !important;
                flex-direction: column;
                gap: 12px;
                padding: 15px;
            }

            .admin-page-simple .card-header .btn {
                width: 100%;
            }

            .admin-page-simple .card-body {
                padding: 15px;
            }

            .admin-page-simple .dataTables_wrapper > .dt-buttons,
            .admin-page-simple .dataTables_wrapper .dt-buttons,
            .admin-page-simple .dataTables_wrapper .dataTables_filter {
                float: none !important;
                width: 100% !important;
                display: flex !important;
                justify-content: flex-start !important;
                margin-bottom: 10px !important;
                text-align: left !important;
            }

            .admin-page-simple .dataTables_wrapper .dataTables_length label,
            .admin-page-simple .dataTables_wrapper .dataTables_filter label {
                width: 100% !important;
                align-items: flex-start !important;
                flex-direction: column !important;
            }

            .admin-page-simple .dataTables_wrapper .dataTables_filter input {
                width: 100% !important;
                margin-left: 0 !important;
            }

            .admin-page-simple .dataTables_wrapper .pagination {
                justify-content: flex-start;
                flex-wrap: wrap;
            }
        }
    </style>
@endsection

@section('list')
    <li class="breadcrumb-item text-muted">Kelas</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">Kategori</li>
@endsection

@section('content')
    <div class="container-fluid admin-page-simple">

        <div class="page-title mb-4">
            <h3 class="fw-bold">Data Kategori Kelas</h3>
            <p class="text-muted mb-0">Kelola kategori utama untuk mengelompokkan kelas</p>
        </div>

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder mb-1">Daftar Kategori</span>
                </h3>

                <a type="button"
                   class="btn btn-primary btn-sm"
                   data-bs-toggle="modal"
                   data-bs-target="#form_create"
                   title="Tambah Kategori">
                    <i class="bi bi-plus-lg me-1"></i>
                    Tambah Kategori
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="example"
                           class="table table-sm align-middle table-row-bordered table-row-solid gs-0 gy-2">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0 fs-sm-8 fs-lg-6">
                                <th class="min-w-125px ps-5 text-nowrap">Aksi</th>
                                <th class="min-w-150px">Nama</th>
                                <th class="min-w-80px">Urutan</th>
                                <th class="min-w-80px">Aktif</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 fw-bolder fs-sm-8 fs-lg-6">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    @include('admin.kategori.view.detail')
    @include('admin.kategori.view.create')
    @include('admin.kategori.view.edit')
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

    @include('admin.kategori.script.list')
    @include('admin.kategori.script.create')
    @include('admin.kategori.script.edit')
    @include('admin.kategori.script.detail')
@endsection
