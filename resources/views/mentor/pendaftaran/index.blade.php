@extends('mentor.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/buttons.dataTables.min.css') }}"/>

    <style>
        /* =========================================================
           PENDAFTARAN MENTOR - SIMPLE SEPERTI ADMIN
           Visual only: tidak mengubah route, ID, include, atau JS inti
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

        .admin-page-simple .filter-panel {
            margin-bottom: 18px;
            padding: 16px;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
        }

        .admin-page-simple .filter-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
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

        .admin-page-simple .filter-panel .form-select,
        .admin-page-simple .filter-panel .select2-container--bootstrap5 .select2-selection,
        .admin-page-simple .filter-panel .select2-container .select2-selection--single {
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

        .admin-page-simple .filter-panel .select2-container--bootstrap5 .select2-selection,
        .admin-page-simple .filter-panel .select2-container .select2-selection--single {
            display: flex;
            align-items: center;
            padding: 6px 10px;
        }

        .admin-page-simple .filter-panel .select2-container--bootstrap5.select2-container--focus .select2-selection,
        .admin-page-simple .filter-panel .select2-container--bootstrap5.select2-container--open .select2-selection,
        .admin-page-simple .filter-panel .form-select:focus {
            border-color: #074366 !important;
            box-shadow: 0 0 0 .2rem rgba(7, 67, 102, .10) !important;
        }

        .select2-container--open {
            z-index: 1065 !important;
        }

        .select2-dropdown {
            overflow: hidden !important;
            background: #ffffff !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 8px !important;
            box-shadow: 0 12px 30px rgba(15, 23, 42, .12) !important;
        }

        .select2-results__option {
            padding: 9px 11px !important;
            color: #334155 !important;
            font-size: 13px;
            font-weight: 600;
        }

        .select2-results__option--highlighted,
        .select2-results__option--selected {
            color: #ffffff !important;
            background: #074366 !important;
        }

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

        .admin-page-simple .badge-light-success,
        .admin-page-simple .badge-success,
        .admin-page-simple .bg-success {
            color: #047857 !important;
            background: #ecfdf5 !important;
            border: 1px solid #bbf7d0 !important;
        }

        .admin-page-simple .badge-light-primary,
        .admin-page-simple .badge-primary,
        .admin-page-simple .bg-primary {
            color: #1d4ed8 !important;
            background: #eff6ff !important;
            border: 1px solid #bfdbfe !important;
        }

        .admin-page-simple .badge-light-warning,
        .admin-page-simple .badge-warning,
        .admin-page-simple .bg-warning {
            color: #92400e !important;
            background: #fffbeb !important;
            border: 1px solid #fde68a !important;
        }

        .admin-page-simple .badge-light-danger,
        .admin-page-simple .badge-danger,
        .admin-page-simple .bg-danger {
            color: #b91c1c !important;
            background: #fef2f2 !important;
            border: 1px solid #fecaca !important;
        }

        /* =========================================================
           TOMBOL AKSI BERWARNA
           Progres = hijau, Detail = biru, Edit = kuning, Hapus = merah
        ========================================================= */

        #example th:first-child,
        #example td:first-child {
            width: 130px !important;
            min-width: 130px !important;
            white-space: nowrap !important;
            text-align: center !important;
        }

        #example td:first-child a,
        #example td:first-child button,
        #example td:first-child .btn,
        #example .mentor-action-btn {
            width: 34px !important;
            height: 34px !important;
            min-width: 34px !important;
            min-height: 34px !important;
            margin: 0 3px !important;
            padding: 0 !important;
            border: 0 !important;
            border-radius: 8px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            color: #ffffff !important;
            background: #3b82f6 !important;
            box-shadow: 0 5px 12px rgba(15, 23, 42, .12) !important;
            line-height: 1 !important;
            text-decoration: none !important;
            transition: transform .18s ease, filter .18s ease;
        }

        #example td:first-child a i,
        #example td:first-child button i,
        #example td:first-child .btn i,
        #example td:first-child .bi,
        #example .mentor-action-btn i,
        #example .mentor-action-btn .bi {
            color: #ffffff !important;
            font-size: 15px !important;
            line-height: 1 !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        #example td:first-child .action-progress {
            background: #10b981 !important;
            border-color: #10b981 !important;
        }

        #example td:first-child .action-detail,
        #example td:first-child .btn[data-bs-target="#form_detail"],
        #example td:first-child a[data-bs-target="#form_detail"],
        #example td:first-child button[data-bs-target="#form_detail"] {
            background: #3b82f6 !important;
            border-color: #3b82f6 !important;
        }

        #example td:first-child .action-edit,
        #example td:first-child .btn[data-bs-target="#form_edit"],
        #example td:first-child a[data-bs-target="#form_edit"],
        #example td:first-child button[data-bs-target="#form_edit"] {
            background: #f59e0b !important;
            border-color: #f59e0b !important;
        }

        #example td:first-child .action-delete,
        #example td:first-child .btn[onclick*="delete"],
        #example td:first-child a[onclick*="delete"],
        #example td:first-child button[onclick*="delete"],
        #example td:first-child .btn[onclick*="hapus"],
        #example td:first-child a[onclick*="hapus"],
        #example td:first-child button[onclick*="hapus"] {
            background: #ef4444 !important;
            border-color: #ef4444 !important;
        }

        #example td:first-child a:hover,
        #example td:first-child button:hover,
        #example td:first-child .btn:hover,
        #example .mentor-action-btn:hover {
            color: #ffffff !important;
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        #example td:first-child a:active,
        #example td:first-child button:active,
        #example td:first-child .btn:active,
        #example .mentor-action-btn:active {
            transform: translateY(0);
        }

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
            min-height: 38px !important;
            padding: 8px 14px !important;
            margin-right: 6px !important;
            color: #ffffff !important;
            background: #10b981 !important;
            border: 1px solid #10b981 !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-weight: 700 !important;
        }

        .admin-page-simple .dataTables_wrapper .dt-buttons .btn:hover,
        .admin-page-simple .dataTables_wrapper .dt-button:hover {
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

        table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control,
        table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control {
            position: relative;
            padding-left: 48px !important;
        }

        table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control::before,
        table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control::before {
            top: 50% !important;
            left: 16px !important;
            transform: translateY(-50%) !important;
            margin-top: 0 !important;
            width: 24px !important;
            height: 24px !important;
            line-height: 22px !important;
            border: 0 !important;
            border-radius: 999px !important;
            background: #074366 !important;
            color: #ffffff !important;
            box-shadow: none !important;
        }

        table.dataTable.dtr-inline.collapsed > tbody > tr.parent > td.dtr-control::before,
        table.dataTable.dtr-inline.collapsed > tbody > tr.parent > th.dtr-control::before {
            background: #ef4444 !important;
            color: #ffffff !important;
        }

        .dropdown-menu {
            z-index: 10000 !important;
            padding: 8px;
            background: #ffffff !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 10px !important;
            box-shadow: 0 16px 36px rgba(15, 23, 42, .14) !important;
        }

        .dropdown-item {
            min-height: 36px;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 10px !important;
            color: #334155 !important;
            background: transparent !important;
            border-radius: 8px !important;
            font-size: 13px;
            font-weight: 700;
        }

        .dropdown-item:hover {
            color: #0f172a !important;
            background: #f1f5f9 !important;
        }

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
            min-height: auto;
            padding: 16px 20px;
            background: #ffffff !important;
            border-bottom: 1px solid #eef2f7 !important;
        }

        .modal .modal-title {
            margin: 0;
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

        .modal .btn-close:hover {
            opacity: 1;
            transform: none !important;
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

        .modal .btn.btn-light,
        .modal .btn.btn-primary,
        .modal .modal-footer .btn {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 8px 15px;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-size: 13px;
            line-height: 1;
            font-weight: 700;
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

        .modal .btn:hover {
            filter: brightness(.96);
            transform: none !important;
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

            .admin-page-simple .card-body {
                padding: 15px;
            }

            .admin-page-simple .filter-grid {
                grid-template-columns: 1fr;
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

            .modal .modal-body {
                padding: 16px;
            }

            .modal .modal-footer {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .modal .modal-footer .btn {
                width: 100%;
            }
        }
    </style>
@endsection

@section('list')
    <li class="breadcrumb-item text-muted">Kelas</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">Pendaftaran</li>
@endsection

@section('content')
    <div class="container-fluid admin-page-simple">

        <div class="page-title mb-4">
            <h3 class="fw-bold">Data Pendaftaran Kelas</h3>
            <p class="text-muted mb-0">Pantau peserta yang terdaftar pada kelas beserta progres dan status belajarnya</p>
        </div>

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder mb-1">Daftar Pendaftaran</span>
                </h3>
            </div>

            <div class="card-body">
                <div class="filter-panel">
                    <div class="filter-grid">
                        <div class="filter-field">
                            <label class="filter-label" for="filter_id_kelas">Filter Kelas</label>
                            <select data-control="select2"
                                    id="filter_id_kelas"
                                    class="form-select form-select-sm fs-sm-8 fs-lg-6"
                                    data-allow-clear="true"
                                    data-placeholder="Pilih Kelas">
                            </select>
                        </div>

                        <div class="filter-field">
                            <label class="filter-label" for="filter_status">Filter Status</label>
                            <select id="filter_status"
                                    data-control="select2"
                                    class="form-select form-select-sm fs-sm-8 fs-lg-6"
                                    data-allow-clear="true"
                                    data-placeholder="Pilih Status">
                                <option value="">Semua Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="example"
                           class="table table-sm align-middle table-row-bordered table-row-solid gs-0 gy-2">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0 fs-sm-8 fs-lg-6">
                                <th class="min-w-125px ps-5 text-nowrap">Aksi</th>
                                <th class="min-w-150px">Pengguna</th>
                                <th class="min-w-180px">Kelas</th>
                                <th class="min-w-150px">Terdaftar Pada</th>
                                <th class="min-w-100px">Progres (%)</th>
                                <th class="min-w-100px">Status</th>
                                <th class="min-w-150px">Selesai Pada</th>
                                <th class="min-w-150px">Terakhir Akses</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 fw-bolder fs-sm-8 fs-lg-6">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    @include('mentor.pendaftaran.view.detail')
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
        function fetchDataDropdown(url, id, placeholderKey, nameKey, callback) {
            DataManager.executeOperations(url, "admin_" + url, 60).then(response => {
                $(id).empty().append('<option></option>');
                if (response.success) {
                    response.data.forEach(item => {
                        $(id).append(
                            `<option value="${item['id_' + placeholderKey]}">${item[nameKey]}</option>`);
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

    @include('mentor.pendaftaran.script.list')
    @include('mentor.pendaftaran.script.detail')

    <script>
        function warnaTombolAksiPendaftaranMentor() {
            $('#example tbody tr').each(function () {
                const $buttons = $(this).find('td:first-child .btn, td:first-child button, td:first-child a');

                $buttons.each(function (index) {
                    const btn = this;
                    const $btn = $(this);

                    const iconClass = $btn.find('i, .bi').attr('class') || '';
                    const identity = [
                        $btn.attr('title') || '',
                        $btn.attr('aria-label') || '',
                        $btn.attr('data-bs-original-title') || '',
                        $btn.attr('data-bs-target') || '',
                        $btn.attr('data-target') || '',
                        $btn.attr('onclick') || '',
                        $btn.attr('href') || '',
                        $btn.attr('class') || '',
                        $btn.text() || '',
                        $btn.html() || '',
                        iconClass
                    ].join(' ').toLowerCase();

                    $btn
                        .removeClass('btn-primary btn-info btn-warning btn-danger btn-success btn-light-primary btn-light-warning btn-light-danger')
                        .removeClass('action-progress action-detail action-edit action-delete')
                        .addClass('mentor-action-btn');

                    let background = '#3b82f6';
                    let border = '#3b82f6';
                    let actionClass = 'action-detail';

                    if (
                        identity.includes('progres') ||
                        identity.includes('progress') ||
                        identity.includes('grafik') ||
                        identity.includes('chart') ||
                        identity.includes('bar-chart') ||
                        identity.includes('clipboard-data') ||
                        identity.includes('speedometer') ||
                        identity.includes('activity')
                    ) {
                        background = '#10b981';
                        border = '#10b981';
                        actionClass = 'action-progress';
                    } else if (
                        identity.includes('edit') ||
                        identity.includes('ubah') ||
                        identity.includes('pencil') ||
                        identity.includes('bi-pencil')
                    ) {
                        background = '#f59e0b';
                        border = '#f59e0b';
                        actionClass = 'action-edit';
                    } else if (
                        identity.includes('delete') ||
                        identity.includes('hapus') ||
                        identity.includes('destroy') ||
                        identity.includes('trash') ||
                        identity.includes('bi-trash')
                    ) {
                        background = '#ef4444';
                        border = '#ef4444';
                        actionClass = 'action-delete';
                    }

                    $btn.addClass(actionClass);

                    btn.style.setProperty('background', background, 'important');
                    btn.style.setProperty('background-color', background, 'important');
                    btn.style.setProperty('border-color', border, 'important');
                    btn.style.setProperty('color', '#ffffff', 'important');

                    $btn.find('i, .bi').each(function () {
                        this.style.setProperty('color', '#ffffff', 'important');
                    });
                });
            });
        }

        $(document).ready(function () {
            warnaTombolAksiPendaftaranMentor();

            $('#example').on('draw.dt init.dt responsive-display.dt', function () {
                warnaTombolAksiPendaftaranMentor();
            });

            setTimeout(warnaTombolAksiPendaftaranMentor, 200);
            setTimeout(warnaTombolAksiPendaftaranMentor, 600);
            setTimeout(warnaTombolAksiPendaftaranMentor, 1000);

            const targetBody = document.querySelector('#example tbody');
            if (targetBody) {
                const observer = new MutationObserver(function () {
                    warnaTombolAksiPendaftaranMentor();
                });

                observer.observe(targetBody, {
                    childList: true,
                    subtree: true
                });
            }
        });
    </script>
@endsection
