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
            background: #3b82f6;
            border-color: #3b82f6;
            color: #ffffff !important;
            box-shadow: 0 8px 18px rgba(59, 130, 246, .20) !important;
        }

        .admin-page-simple .btn-primary:hover {
            background: #2563eb;
            border-color: #2563eb;
            color: #ffffff !important;
        }

        .admin-page-simple .table {
            margin-bottom: 0;
        }

        .admin-page-simple .table thead th {
            color: #64748b;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .04em;
            border-bottom-color: #eef2f7;
            white-space: nowrap;
            background: #ffffff;
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
            border-radius: 999px;
            padding: 6px 10px;
            font-weight: 700;
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

        .admin-page-simple .dataTables_wrapper .dataTables_filter {
            text-align: right;
        }

        .admin-page-simple .dataTables_wrapper .dataTables_filter input,
        .admin-page-simple .dataTables_wrapper .dataTables_length select {
            border: 1px solid #e5e7eb !important;
            border-radius: 8px !important;
            min-height: 38px;
            padding: 7px 10px !important;
            color: #111827;
            background: #ffffff !important;
            outline: none !important;
            box-shadow: none !important;
        }

        .admin-page-simple .dataTables_wrapper .dataTables_filter input:focus,
        .admin-page-simple .dataTables_wrapper .dataTables_length select:focus {
            border-color: #009ef7 !important;
            box-shadow: 0 0 0 .2rem rgba(0, 158, 247, .10) !important;
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
            border-radius: 8px !important;
            color: #64748b;
            border: 1px solid #e5e7eb;
            font-weight: 700;
        }

        .admin-page-simple .dataTables_wrapper .page-item.active .page-link {
            background: #009ef7;
            border-color: #009ef7;
            color: #ffffff;
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

        /* ===== ACTION BUTTON COLORS ===== */
        #example td:first-child {
            white-space: nowrap;
        }

        #example .action-icon-btn,
        #example .btn.btn-icon.action-icon-btn {
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
            transition: .18s ease;
        }

        #example .action-icon-btn .bi,
        #example .btn.btn-icon.action-icon-btn .bi {
            color: #ffffff !important;
            font-size: 16px !important;
            line-height: 1 !important;
        }

        #example .action-icon-btn[data-bs-target="#form_detail"] {
            background: #3b82f6 !important;
        }

        #example .action-icon-btn[data-bs-target="#form_edit"] {
            background: #f59e0b !important;
        }

        #example .action-icon-btn[onclick*="deleteConfirmation"],
        #example .action-icon-btn[onclick*="delete"],
        #example .action-icon-btn[onclick*="hapus"] {
            background: #ef4444 !important;
        }

        #example .action-icon-btn:hover {
            transform: translateY(-1px);
            filter: brightness(.96);
            color: #ffffff !important;
        }

        #example .action-icon-btn:active {
            transform: translateY(0);
        }

        .neo-btn-primary,
        .btn.btn-primary {
            background: #3b82f6 !important;
            border-color: #3b82f6 !important;
            color: #ffffff !important;
            box-shadow: 0 8px 18px rgba(59, 130, 246, .20) !important;
        }

        .neo-btn-primary:hover,
        .btn.btn-primary:hover {
            background: #2563eb !important;
            border-color: #2563eb !important;
            color: #ffffff !important;
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

            .admin-page-simple .dataTables_wrapper .dataTables_filter {
                text-align: left;
            }

            .admin-page-simple .dataTables_wrapper .dataTables_length label,
            .admin-page-simple .dataTables_wrapper .dataTables_filter label {
                align-items: flex-start;
                flex-direction: column;
            }

            .admin-page-simple .dataTables_wrapper .dataTables_filter input {
                width: 100% !important;
            }

            .admin-page-simple .dataTables_wrapper .pagination {
                justify-content: flex-start;
                flex-wrap: wrap;
            }
        }

        /* ===== POSISI EXCEL KIRI, CARI KANAN ===== */
.admin-page-simple .dataTables_wrapper {
    width: 100%;
}

/* Bar atas DataTables */
.admin-page-simple .dataTables_wrapper > .dt-buttons,
.admin-page-simple .dataTables_wrapper .dt-buttons {
    float: left !important;
    display: inline-flex !important;
    align-items: center;
    gap: 6px;
    margin-bottom: 12px;
}

/* Search / Cari pindah ke kanan */
.admin-page-simple .dataTables_wrapper .dataTables_filter {
    float: right !important;
    text-align: right !important;
    margin-bottom: 12px;
}

/* Label Cari dan input tetap rapi */
.admin-page-simple .dataTables_wrapper .dataTables_filter label {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: flex-end !important;
    gap: 8px !important;
    margin-bottom: 0 !important;
}

/* Lebar kolom pencarian */
.admin-page-simple .dataTables_wrapper .dataTables_filter input {
    width: 230px !important;
    margin-left: 6px !important;
}

/* Supaya tabel turun ke bawah setelah bar tombol/search */
.admin-page-simple .dataTables_wrapper::after {
    content: "";
    display: block;
    clear: both;
}

/* Tombol Excel biar tetap rapi */
.admin-page-simple .dataTables_wrapper .dt-buttons .btn,
.admin-page-simple .dataTables_wrapper .dt-button {
    border-radius: 8px !important;
    font-weight: 700 !important;
    margin-right: 6px !important;
}

/* Responsive: di HP tombol dan cari turun susun */
@media (max-width: 767.98px) {
    .admin-page-simple .dataTables_wrapper > .dt-buttons,
    .admin-page-simple .dataTables_wrapper .dt-buttons,
    .admin-page-simple .dataTables_wrapper .dataTables_filter {
        float: none !important;
        width: 100% !important;
        text-align: left !important;
        display: flex !important;
        justify-content: flex-start !important;
        margin-bottom: 10px !important;
    }

    .admin-page-simple .dataTables_wrapper .dataTables_filter label {
        width: 100% !important;
        align-items: flex-start !important;
        flex-direction: column !important;
    }

    .admin-page-simple .dataTables_wrapper .dataTables_filter input {
        width: 100% !important;
        margin-left: 0 !important;
    }
}
    </style>
@endsection

@section('list')
    <li class="breadcrumb-item text-muted">Pengguna</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">Data Pengguna</li>
@endsection

@section('content')
    <div class="container-fluid admin-page-simple">

        <div class="page-title mb-4">
            <h3 class="fw-bold">Data Pengguna</h3>
            <p class="text-muted mb-0">Kelola data pengguna yang terdaftar di platform</p>
        </div>

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder mb-1">Daftar Pengguna</span>
                </h3>

                <a type="button"
                   class="btn btn-primary btn-sm"
                   data-bs-toggle="modal"
                   data-bs-target="#form_create"
                   title="Tambah Pengguna">
                    <i class="bi bi-plus-lg me-1"></i>
                    Tambah Pengguna
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
                                <th class="min-w-150px">Email</th>
                                <th class="min-w-120px">Telepon</th>
                                <th class="min-w-100px">Terverifikasi</th>
                                <th class="min-w-120px">Total Kelas Selesai</th>
                                <th class="min-w-120px">Total Poin</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 fw-bolder fs-sm-8 fs-lg-6">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    @include('admin.pengguna.view.detail')
    @include('admin.pengguna.view.create')
    @include('admin.pengguna.view.edit')
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

    @include('admin.pengguna.script.list')
    @include('admin.pengguna.script.create')
    @include('admin.pengguna.script.edit')
    @include('admin.pengguna.script.detail')
@endsection
