@extends('admin.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/buttons.dataTables.min.css') }}" />

    <style>
        /* =========================================================
           HALAMAN DATA KELAS
           Tampilan sederhana, bersih, dan konsisten
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

        /* Tombol */
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

        /* Filter */
        .admin-page-simple .filter-panel {
            margin-bottom: 18px;
            padding: 16px;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
        }

        .admin-page-simple .filter-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
        }

        .admin-page-simple .filter-field {
            min-width: 0;
        }

        .admin-page-simple .filter-label {
            display: block;
            margin-bottom: 7px;
            color: #111827;
            font-size: 13px;
            font-weight: 800;
        }

        .admin-page-simple .filter-action {
            display: flex;
            justify-content: flex-end;
            margin-top: 14px;
        }

        .admin-page-simple .btn-reset-filter {
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 8px 14px;
            color: #475569 !important;
            background: #ffffff !important;
            border: 1px solid #dbe3ec !important;
            border-radius: 8px;
            box-shadow: none !important;
        }

        .admin-page-simple .btn-reset-filter:hover {
            color: #111827 !important;
            background: #f1f5f9 !important;
            border-color: #cbd5e1 !important;
        }

        /* Select dan Select2 */
        .admin-page-simple .filter-panel .form-select,
        .admin-page-simple .filter-panel .select2-container--bootstrap5 .select2-selection {
            min-height: 40px;
            color: #111827 !important;
            background: #ffffff !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 8px !important;
            box-shadow: none !important;
        }

        .admin-page-simple .filter-panel .form-select {
            padding: 8px 11px !important;
            font-size: 13px;
        }

        .admin-page-simple .filter-panel .select2-container {
            width: 100% !important;
        }

        .admin-page-simple .filter-panel .select2-container--bootstrap5 .select2-selection {
            display: flex;
            align-items: center;
            padding: 6px 10px;
        }

        .admin-page-simple .filter-panel .select2-container--bootstrap5.select2-container--focus .select2-selection,
        .admin-page-simple .filter-panel .form-select:focus {
            border-color: #074366 !important;
            box-shadow: 0 0 0 .2rem rgba(7, 67, 102, .10) !important;
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

        /* Tombol aksi */
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
            transition: transform .18s ease, filter .18s ease;
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

        /* Isi Kelas */
#example .action-icon-btn[title="Isi Kelas"],
#example .btn[title="Isi Kelas"],
#example a[title="Isi Kelas"],
#example a[href*="histori"] {
    background: #10b981 !important;
    color: #ffffff !important;
}

/* Template Sertifikat */
#example .action-icon-btn[title="Template Sertifikat"],
#example .btn[title="Template Sertifikat"],
#example a[title="Template Sertifikat"],
#example a[href*="sertifikat"] {
    background: #8b5cf6 !important;
    color: #ffffff !important;
}

/* Jaga semua tombol/link aksi tetap berbentuk tombol icon */
#example td:first-child a,
#example td:first-child button {
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
}

#example td:first-child a i,
#example td:first-child button i {
    color: #ffffff !important;
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

        /* DataTables */
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

        /* Excel kiri dan pencarian kanan */
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

        /* Responsive */
        @media (max-width: 1199.98px) {
            .admin-page-simple .filter-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

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

            .admin-page-simple .filter-grid {
                grid-template-columns: 1fr;
            }

            .admin-page-simple .filter-action {
                justify-content: stretch;
            }

            .admin-page-simple .btn-reset-filter {
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
    <li class="breadcrumb-item text-dark">Data Kelas</li>
@endsection

@section('content')
    <div class="container-fluid admin-page-simple">

        <div class="page-title mb-4">
            <h3 class="fw-bold">Data Kelas</h3>
            <p class="text-muted mb-0">Kelola kelas, kategori, pemilik, tingkat, bahasa, sertifikat, dan status publikasi</p>
        </div>

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder mb-1">Daftar Kelas</span>
                </h3>

                <a type="button"
                   class="btn btn-primary btn-sm"
                   data-bs-toggle="modal"
                   data-bs-target="#form_create"
                   title="Tambah Kelas">
                    <i class="bi bi-plus-lg me-1"></i>
                    Tambah Kelas
                </a>
            </div>

            <div class="card-body">

                <div class="filter-panel">
                    <div class="filter-grid">
                        <div class="filter-field">
                            <label class="filter-label" for="filter_id_kategori">Filter Kategori</label>
                            <select data-control="select2"
                                    id="filter_id_kategori"
                                    class="form-select form-select-sm"
                                    data-allow-clear="true"
                                    data-placeholder="Pilih Kategori">
                            </select>
                        </div>

                        <div class="filter-field">
                            <label class="filter-label" for="filter_tingkat">Filter Tingkat</label>
                            <select id="filter_tingkat"
                                    data-control="select2"
                                    class="form-select form-select-sm"
                                    data-allow-clear="true"
                                    data-placeholder="Pilih Tingkat">
                                <option value="">Semua Tingkat</option>
                                <option value="pemula">Pemula</option>
                                <option value="menengah">Menengah</option>
                                <option value="lanjutan">Lanjutan</option>
                            </select>
                        </div>

                        <div class="filter-field">
                            <label class="filter-label" for="filter_bahasa">Filter Bahasa</label>
                            <select id="filter_bahasa"
                                    data-control="select2"
                                    class="form-select form-select-sm"
                                    data-allow-clear="true"
                                    data-placeholder="Pilih Bahasa">
                                <option value="">Semua Bahasa</option>
                                <option value="ID">Indonesia</option>
                                <option value="EN">Inggris</option>
                                <option value="AR">Arab</option>
                            </select>
                        </div>

                        <div class="filter-field">
                            <label class="filter-label" for="filter_status">Filter Status</label>
                            <select id="filter_status"
                                    data-control="select2"
                                    class="form-select form-select-sm"
                                    data-allow-clear="true"
                                    data-placeholder="Pilih Status">
                                <option value="">Semua Status</option>
                                <option value="draft">Draft</option>
                                <option value="terbit">Terbit</option>
                                <option value="arsip">Arsip</option>
                            </select>
                        </div>
                    </div>

                    <div class="filter-action">
                        <button type="button"
                                class="btn btn-reset-filter btn-sm"
                                id="btn_reset_filter_kelas">
                            <i class="bi bi-arrow-counterclockwise"></i>
                            Reset Filter
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="example"
                           class="table table-sm align-middle table-row-bordered table-row-solid gs-0 gy-2">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0 fs-sm-8 fs-lg-6">
                                <th class="min-w-125px ps-5 text-nowrap">Aksi</th>
                                <th class="min-w-180px">Judul</th>
                                <th class="min-w-150px">Kategori</th>
                                <th class="min-w-150px">Sub Kategori</th>
                                <th class="min-w-150px">Pemilik</th>
                                <th class="min-w-80px">Tingkat</th>
                                <th class="min-w-80px">Bahasa</th>
                                <th class="min-w-90px">Sertifikat</th>
                                <th class="min-w-80px">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 fw-bolder fs-sm-8 fs-lg-6">
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

    @include('admin.kelas.kelas.view.detail')
    @include('admin.kelas.kelas.view.create')
    @include('admin.kelas.kelas.view.edit')
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

    @include('admin.kelas.kelas.script.list')
    @include('admin.kelas.kelas.script.create')
    @include('admin.kelas.kelas.script.edit')
    @include('admin.kelas.kelas.script.detail')
@endsection
