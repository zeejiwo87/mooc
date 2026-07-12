@extends('mentor.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/buttons.dataTables.min.css') }}" />

    <style>
        /* =========================================================
           KELAS MENTOR - SIMPLE SEPERTI ADMIN
           Visual only: route, ID, include, dan script utama tetap.
        ========================================================= */
        .admin-page-simple {
            width: 100%;
            color: #111827;
        }

        .admin-page-simple .page-title h3 {
            margin-bottom: 4px;
            color: #111827;
            font-weight: 800;
        }

        .admin-page-simple .page-title p {
            color: #64748b !important;
            font-size: 13px;
            font-weight: 600;
        }

        .admin-page-simple .card {
            overflow: hidden;
            border: 0 !important;
            border-radius: 12px;
            background: #ffffff;
            box-shadow: 0 6px 18px rgba(15, 23, 42, .06) !important;
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

        .admin-page-simple .card-label {
            color: #111827;
            font-size: 16px;
            font-weight: 800;
        }

        .admin-page-simple .card-body {
            padding: 18px;
            background: #ffffff;
        }

        /* Tombol umum */
        .admin-page-simple .btn,
        .admin-page-simple a.btn,
        .admin-page-simple button.btn {
            border-radius: 8px !important;
            font-weight: 700;
            box-shadow: none !important;
        }

        .admin-page-simple .btn-primary,
        .admin-page-simple .btn.btn-primary {
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
            font-size: 13px;
            font-weight: 700;
        }

        .admin-page-simple .btn-reset-filter:hover {
            color: #111827 !important;
            background: #f1f5f9 !important;
            border-color: #cbd5e1 !important;
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

        .admin-page-simple .filter-panel .form-select,
        .admin-page-simple .filter-panel .select2-container--bootstrap5 .select2-selection,
        .admin-page-simple .filter-panel .select2-container .select2-selection--single {
            min-height: 40px;
            color: #111827 !important;
            background: #ffffff !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-size: 13px;
            font-weight: 600;
        }

        .admin-page-simple .filter-panel .form-select {
            padding: 8px 11px !important;
        }

        .admin-page-simple .filter-panel .select2-container {
            width: 100% !important;
        }

        .admin-page-simple .filter-panel .select2-container--bootstrap5 .select2-selection {
            display: flex;
            align-items: center;
            padding: 6px 10px;
        }

        .admin-page-simple .filter-panel .select2-container--bootstrap5 .select2-selection__rendered,
        .admin-page-simple .filter-panel .select2-container .select2-selection__rendered {
            color: #111827 !important;
            font-size: 13px;
            font-weight: 600;
            line-height: 26px !important;
            padding-left: 0 !important;
        }

        .admin-page-simple .filter-panel .select2-container--bootstrap5.select2-container--focus .select2-selection,
        .admin-page-simple .filter-panel .form-select:focus {
            border-color: #074366 !important;
            box-shadow: 0 0 0 .2rem rgba(7, 67, 102, .10) !important;
        }

        .select2-dropdown {
            background: #ffffff !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 8px !important;
            box-shadow: 0 12px 30px rgba(15, 23, 42, .12) !important;
            overflow: hidden;
        }

        .select2-results__option {
            padding: 9px 11px !important;
            color: #334155 !important;
            font-size: 13px;
            font-weight: 600;
        }

        .select2-results__option--highlighted {
            color: #ffffff !important;
            background: #074366 !important;
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
            color: #64748b !important;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
            background: #ffffff;
            border-bottom-color: #eef2f7 !important;
        }

        .admin-page-simple .table tbody td {
            padding-top: 12px;
            padding-bottom: 12px;
            color: #111827 !important;
            font-size: 14px;
            vertical-align: middle;
            background: #ffffff;
        }

        .admin-page-simple .table tbody tr:last-child td {
            border-bottom: 0;
        }

        .admin-page-simple .table tbody tr:hover td {
            background: #f8fafc !important;
        }

        .admin-page-simple .badge {
            padding: 6px 10px;
            border-radius: 999px;
            font-weight: 700;
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

        .admin-page-simple .dataTables_wrapper .buttons-excel,
        .admin-page-simple .dataTables_wrapper .buttons-excelHtml5 {
            color: #ffffff !important;
            background: #10b981 !important;
            border: 1px solid #10b981 !important;
            box-shadow: none !important;
        }

        .admin-page-simple .dataTables_wrapper .buttons-excel:hover,
        .admin-page-simple .dataTables_wrapper .buttons-excelHtml5:hover {
            color: #ffffff !important;
            background: #059669 !important;
            border-color: #059669 !important;
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

        /* Tombol aksi */
        #example th:first-child,
        #example td:first-child {
            width: 190px !important;
            min-width: 190px !important;
            white-space: nowrap !important;
            text-align: center !important;
        }

        #example td:first-child a,
        #example td:first-child button,
        #example td:first-child .btn,
        #example .mentor-kelas-action-btn {
            width: 34px !important;
            height: 34px !important;
            min-width: 34px !important;
            min-height: 34px !important;
            padding: 0 !important;
            margin: 0 3px !important;
            border: 0 !important;
            border-radius: 8px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            color: #ffffff !important;
            background: #3b82f6 !important;
            box-shadow: 0 5px 12px rgba(15, 23, 42, .12) !important;
            line-height: 1 !important;
            vertical-align: middle !important;
            text-decoration: none !important;
            transform: none !important;
            opacity: 1 !important;
            overflow: hidden !important;
        }

        #example td:first-child a i,
        #example td:first-child button i,
        #example td:first-child .btn i,
        #example td:first-child .bi,
        #example .mentor-kelas-action-btn i,
        #example .mentor-kelas-action-btn .bi {
            color: #ffffff !important;
            font-size: 15px !important;
            line-height: 1 !important;
            margin: 0 !important;
        }

        #example td:first-child a:hover,
        #example td:first-child button:hover,
        #example td:first-child .btn:hover,
        #example .mentor-kelas-action-btn:hover {
            color: #ffffff !important;
            filter: brightness(.95) !important;
            transform: translateY(-1px) !important;
        }

        #example .aksi-detail {
            background: #3b82f6 !important;
        }

        #example .aksi-edit {
            background: #f59e0b !important;
        }

        #example .aksi-hapus {
            background: #ef4444 !important;
        }

        #example .aksi-isi-kelas,
        #example .aksi-materi,
        #example .aksi-histori {
            background: #10b981 !important;
        }

        #example .aksi-sertifikat,
        #example .aksi-template {
            background: #8b5cf6 !important;
        }

        /* Modal bawaan pada include tetap dibuat simple */
        .modal-backdrop.show {
            opacity: .34 !important;
            background: #0f172a !important;
        }

        .modal .modal-content {
            overflow: hidden;
            color: #111827;
            background: #ffffff !important;
            border: 0 !important;
            border-radius: 12px !important;
            box-shadow: 0 18px 45px rgba(15, 23, 42, .16) !important;
        }

        .modal .modal-header {
            padding: 16px 20px;
            background: #ffffff !important;
            border-bottom: 1px solid #eef2f7 !important;
        }

        .modal .modal-title {
            color: #111827 !important;
            font-size: 18px;
            font-weight: 800;
        }

        .modal .modal-body {
            padding: 22px;
            background: #ffffff !important;
        }

        .modal .modal-footer {
            gap: 8px;
            padding: 14px 20px 18px;
            background: #ffffff !important;
            border-top: 1px solid #eef2f7 !important;
        }

        .modal .btn-close {
            width: 32px;
            height: 32px;
            margin: 0 !important;
            padding: 0 !important;
            background-color: transparent !important;
            border: 0 !important;
            border-radius: 0 !important;
            box-shadow: none !important;
            opacity: .78;
        }

        .modal .form-label,
        .modal label,
        .modal dt {
            margin-bottom: 8px;
            color: #111827 !important;
            font-size: 13px;
            font-weight: 800 !important;
        }

        .modal dd,
        .modal p {
            color: #475569 !important;
            font-weight: 600;
        }

        .modal .form-control,
        .modal .form-select,
        .modal textarea,
        .modal .select2-selection {
            min-height: 42px;
            color: #111827 !important;
            background: #ffffff !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-size: 14px;
            font-weight: 600;
        }

        .modal .form-control:focus,
        .modal .form-select:focus,
        .modal textarea:focus {
            border-color: #074366 !important;
            box-shadow: 0 0 0 .2rem rgba(7, 67, 102, .10) !important;
        }

        .modal .btn.btn-light,
        .modal .modal-footer .btn-light {
            color: #ffffff !important;
            background: #ef4444 !important;
            border: 1px solid #ef4444 !important;
        }

        .modal .btn.btn-primary,
        .modal .modal-footer .btn-primary {
            color: #ffffff !important;
            background: #074366 !important;
            border: 1px solid #074366 !important;
        }

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

            .admin-page-simple .card-header .btn,
            .admin-page-simple .card-header a {
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

            #example th:first-child,
            #example td:first-child {
                width: 170px !important;
                min-width: 170px !important;
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
            <p class="text-muted mb-0">Kelola kelas, kategori, tingkat, bahasa, sertifikat, dan status publikasi</p>
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

    @include('mentor.kelas.kelas.view.detail')
    @include('mentor.kelas.kelas.view.create')
    @include('mentor.kelas.kelas.view.edit')
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

    @include('mentor.kelas.kelas.script.list')
    @include('mentor.kelas.kelas.script.create')
    @include('mentor.kelas.kelas.script.edit')
    @include('mentor.kelas.kelas.script.detail')

    <script>
        function warnaTombolAksiKelasMentor() {
            $('#example tbody tr').each(function () {
                const $buttons = $(this).find('td:first-child a, td:first-child button, td:first-child .btn');

                $buttons.each(function (index) {
                    const btn = this;
                    const $btn = $(btn);
                    const html = String($btn.html() || '').toLowerCase();
                    const text = String($btn.text() || '').toLowerCase();
                    const title = String($btn.attr('title') || '').toLowerCase();
                    const aria = String($btn.attr('aria-label') || '').toLowerCase();
                    const target = String($btn.attr('data-bs-target') || $btn.attr('data-target') || '').toLowerCase();
                    const onclick = String($btn.attr('onclick') || '').toLowerCase();
                    const href = String($btn.attr('href') || '').toLowerCase();
                    const klass = String($btn.attr('class') || '').toLowerCase();
                    const icon = String($btn.find('i').attr('class') || '').toLowerCase();
                    const identity = `${html} ${text} ${title} ${aria} ${target} ${onclick} ${href} ${klass} ${icon}`;

                    let actionClass = 'aksi-detail';
                    let bgColor = '#3b82f6';

                    $btn
                        .removeClass('btn-primary btn-info btn-warning btn-danger btn-success btn-secondary btn-light btn-dark')
                        .removeClass('aksi-detail aksi-edit aksi-hapus aksi-isi-kelas aksi-materi aksi-histori aksi-sertifikat aksi-template')
                        .addClass('mentor-kelas-action-btn');

                    if (
                        identity.includes('sertifikat') ||
                        identity.includes('certificate') ||
                        identity.includes('template') ||
                        identity.includes('award')
                    ) {
                        actionClass = 'aksi-sertifikat';
                        bgColor = '#8b5cf6';
                    } else if (
                        identity.includes('isi kelas') ||
                        identity.includes('histori') ||
                        identity.includes('materi') ||
                        identity.includes('manage') ||
                        identity.includes('content') ||
                        identity.includes('journal') ||
                        identity.includes('book')
                    ) {
                        actionClass = 'aksi-isi-kelas';
                        bgColor = '#10b981';
                    } else if (
                        identity.includes('form_edit') ||
                        identity.includes('edit') ||
                        identity.includes('ubah') ||
                        identity.includes('pencil') ||
                        identity.includes('pen')
                    ) {
                        actionClass = 'aksi-edit';
                        bgColor = '#f59e0b';
                    } else if (
                        identity.includes('delete') ||
                        identity.includes('hapus') ||
                        identity.includes('destroy') ||
                        identity.includes('remove') ||
                        identity.includes('trash')
                    ) {
                        actionClass = 'aksi-hapus';
                        bgColor = '#ef4444';
                    } else if (
                        identity.includes('form_detail') ||
                        identity.includes('detail') ||
                        identity.includes('lihat') ||
                        identity.includes('show') ||
                        identity.includes('eye')
                    ) {
                        actionClass = 'aksi-detail';
                        bgColor = '#3b82f6';
                    } else if ($buttons.length > 1) {
                        if (index === 1) {
                            actionClass = 'aksi-edit';
                            bgColor = '#f59e0b';
                        } else if (index === 2) {
                            actionClass = 'aksi-isi-kelas';
                            bgColor = '#10b981';
                        } else if (index === 3) {
                            actionClass = 'aksi-sertifikat';
                            bgColor = '#8b5cf6';
                        }
                    }

                    $btn.addClass(actionClass);

                    btn.style.setProperty('background-color', bgColor, 'important');
                    btn.style.setProperty('border-color', bgColor, 'important');
                    btn.style.setProperty('color', '#ffffff', 'important');
                    btn.style.setProperty('width', '34px', 'important');
                    btn.style.setProperty('height', '34px', 'important');
                    btn.style.setProperty('min-width', '34px', 'important');
                    btn.style.setProperty('padding', '0', 'important');
                    btn.style.setProperty('display', 'inline-flex', 'important');
                    btn.style.setProperty('align-items', 'center', 'important');
                    btn.style.setProperty('justify-content', 'center', 'important');
                    btn.style.setProperty('border-radius', '8px', 'important');

                    $btn.find('i, .bi, svg').each(function () {
                        this.style.setProperty('color', '#ffffff', 'important');
                        this.style.setProperty('fill', '#ffffff', 'important');
                        this.style.setProperty('font-size', '15px', 'important');
                    });
                });
            });
        }

        $(document).ready(function () {
            warnaTombolAksiKelasMentor();

            $('#example').on('draw.dt init.dt responsive-display.dt', function () {
                warnaTombolAksiKelasMentor();
            });

            const tableBody = document.querySelector('#example tbody');
            if (tableBody) {
                const observer = new MutationObserver(function () {
                    warnaTombolAksiKelasMentor();
                });
                observer.observe(tableBody, { childList: true, subtree: true });
            }

            setTimeout(warnaTombolAksiKelasMentor, 200);
            setTimeout(warnaTombolAksiKelasMentor, 600);
            setTimeout(warnaTombolAksiKelasMentor, 1000);
        });
    </script>
@endsection
