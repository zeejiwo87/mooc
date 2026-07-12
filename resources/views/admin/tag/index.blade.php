@extends('admin.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/buttons.dataTables.min.css') }}"/>

    <style>
        .admin-page-simple {
            width: 100%;
        }

        .admin-page-simple .page-title h3 {
            margin-bottom: 4px;
        }

        .admin-page-simple .card {
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
            border-radius: 12px 12px 0 0;
        }

        .admin-page-simple .card-title {
            margin: 0;
        }

        .admin-page-simple .card-body {
            padding: 18px;
        }

        .admin-page-simple .btn {
            border-radius: 8px;
            font-weight: 700;
        }

        .admin-page-simple .btn-primary {
            color: #ffffff !important;
            background: #3b82f6 !important;
            border-color: #3b82f6 !important;
            box-shadow: 0 8px 18px rgba(59, 130, 246, .20) !important;
        }

        .admin-page-simple .btn-primary:hover,
        .admin-page-simple .btn-primary:focus {
            color: #ffffff !important;
            background: #2563eb !important;
            border-color: #2563eb !important;
        }

        .admin-page-simple .table {
            width: 100% !important;
            margin-bottom: 0;
        }

        .admin-page-simple .table thead th {
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

        /* Tombol aksi mengikuti tampilan admin/mentor. */
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
            border-radius: 10px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            color: #ffffff !important;
            box-shadow: 0 6px 14px rgba(15, 23, 42, .14) !important;
            transition: transform .18s ease, filter .18s ease;
        }

        #example .action-icon-btn .bi,
        #example .btn.btn-icon.action-icon-btn .bi,
        #example td:first-child .btn.btn-icon .bi {
            color: #ffffff !important;
            font-size: 16px !important;
            line-height: 1 !important;
        }

        /* Detail / lihat. */
        #example .action-icon-btn[data-bs-target="#form_detail"],
        #example .btn[data-bs-target="#form_detail"] {
            background: #3b82f6 !important;
        }

        /* Edit. */
        #example .action-icon-btn[data-bs-target="#form_edit"],
        #example .btn[data-bs-target="#form_edit"] {
            background: #f59e0b !important;
        }

        /* Hapus. */
        #example .action-icon-btn[onclick*="deleteConfirmation"],
        #example .btn[onclick*="deleteConfirmation"] {
            background: #ef4444 !important;
        }

        #example .action-icon-btn:hover,
        #example td:first-child .btn.btn-icon:hover {
            color: #ffffff !important;
            filter: brightness(.96);
            transform: translateY(-1px);
        }

        #example .action-icon-btn:active,
        #example td:first-child .btn.btn-icon:active {
            transform: translateY(0);
        }

        /* DataTables. */
        .admin-page-simple .dataTables_wrapper {
            width: 100%;
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
            border-color: #009ef7 !important;
            box-shadow: 0 0 0 .2rem rgba(0, 158, 247, .10) !important;
        }

        /* Excel di kiri dan pencarian di kanan. */
        .admin-page-simple .dataTables_wrapper > .dt-buttons,
        .admin-page-simple .dataTables_wrapper .dt-buttons {
            float: left !important;
            display: inline-flex !important;
            align-items: center;
            gap: 6px;
            margin-bottom: 12px;
        }

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
            border: 1px solid #e5e7eb;
            border-radius: 8px !important;
            font-weight: 700;
        }

        .admin-page-simple .dataTables_wrapper .page-item.active .page-link {
            color: #ffffff;
            background: #009ef7;
            border-color: #009ef7;
        }

        .admin-page-simple .dataTables_wrapper .page-item.disabled .page-link {
            color: #94a3b8;
            background: #f8fafc;
        }

        table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control::before,
        table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control::before {
            background: #009ef7 !important;
            border: 0 !important;
            box-shadow: none !important;
        }

        @media (max-width: 767.98px) {
            .admin-page-simple .card-header {
                align-items: flex-start !important;
                flex-direction: column;
                gap: 12px;
                padding: 15px;
            }

            .admin-page-simple .card-body {
                padding: 15px;
            }

            .admin-page-simple .card-header .btn {
                width: 100%;
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
    <li class="breadcrumb-item text-dark">Tag</li>
@endsection

@section('content')
    <div class="container-fluid admin-page-simple">

        <div class="page-title mb-4">
            <h3 class="fw-bold">Data Tag Kelas</h3>
            <p class="text-muted mb-0">Kelola tag untuk mengelompokkan dan menandai kelas</p>
        </div>

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder mb-1">Daftar Tag</span>
                </h3>

                <a type="button"
                   class="btn btn-primary btn-sm"
                   data-bs-toggle="modal"
                   data-bs-target="#form_create"
                   title="Tambah Tag">
                    <i class="bi bi-plus-lg me-1"></i>
                    Tambah Tag
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
                                <th class="min-w-150px">Slug</th>
                                <th class="min-w-80px">Total Kelas</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 fw-bolder fs-sm-8 fs-lg-6">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    @include('admin.tag.view.detail')
    @include('admin.tag.view.create')
    @include('admin.tag.view.edit')
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

    @include('admin.tag.script.list')
    @include('admin.tag.script.create')
    @include('admin.tag.script.edit')
    @include('admin.tag.script.detail')
@endsection
