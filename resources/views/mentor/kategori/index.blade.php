@extends('mentor.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/buttons.dataTables.min.css') }}"/>

    <style>
        /* =========================================================
           KATEGORI MENTOR - TAMPILAN SIMPLE SEPERTI ADMIN
           Visual only: tidak mengubah route, ID, include, atau logic
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
            border: 0;
            border-radius: 12px;
            background: #ffffff;
            box-shadow: 0 6px 18px rgba(15, 23, 42, .06);
            overflow: hidden;
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
            font-weight: 800 !important;
        }

        .admin-page-simple .card-body {
            padding: 18px;
            background: #ffffff;
        }

        .admin-page-simple .btn {
            border-radius: 8px;
            font-weight: 700;
            box-shadow: none !important;
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
            background: #ffffff;
        }

        .admin-page-simple .table tbody tr:last-child td {
            border-bottom: 0;
        }

        .admin-page-simple .table tbody tr:hover td {
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

        .admin-page-simple .badge-light-danger,
        .admin-page-simple .badge-danger,
        .admin-page-simple .bg-danger {
            color: #b91c1c !important;
            background: #fef2f2 !important;
            border: 1px solid #fecaca !important;
        }

        .admin-page-simple .badge-light-warning,
        .admin-page-simple .badge-warning,
        .admin-page-simple .bg-warning {
            color: #92400e !important;
            background: #fffbeb !important;
            border: 1px solid #fde68a !important;
        }

        .admin-page-simple .badge-light-primary,
        .admin-page-simple .badge-primary,
        .admin-page-simple .bg-primary {
            color: #1d4ed8 !important;
            background: #eff6ff !important;
            border: 1px solid #bfdbfe !important;
        }

        /* =========================================================
           TOMBOL AKSI - LANGSUNG BERWARNA
           Detail biru, edit kuning, hapus merah.
           Di mentor kategori biasanya hanya ada detail, tetap biru.
        ========================================================= */

        #example th:first-child,
        #example td:first-child {
            width: 96px !important;
            min-width: 96px !important;
            text-align: center !important;
            white-space: nowrap !important;
        }

        #example td:first-child a,
        #example td:first-child button,
        #example td:first-child .btn,
        #example .action-icon-btn,
        #example .btn.btn-icon.action-icon-btn,
        #example td:first-child .btn.btn-icon {
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
            transition: transform .18s ease, filter .18s ease;
            line-height: 1 !important;
        }

        #example td:first-child a i,
        #example td:first-child button i,
        #example td:first-child .btn i,
        #example .action-icon-btn .bi,
        #example .btn.btn-icon.action-icon-btn .bi,
        #example td:first-child .btn.btn-icon .bi {
            color: #ffffff !important;
            font-size: 15px !important;
            line-height: 1 !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        #example td:first-child .btn-action-detail,
        #example td:first-child [data-bs-target="#form_detail"],
        #example td:first-child [data-target="#form_detail"],
        #example td:first-child [title*="Detail"],
        #example td:first-child [title*="Lihat"] {
            background: #3b82f6 !important;
            border-color: #3b82f6 !important;
        }

        #example td:first-child .btn-action-edit,
        #example td:first-child [data-bs-target="#form_edit"],
        #example td:first-child [data-target="#form_edit"],
        #example td:first-child [title*="Edit"] {
            background: #f59e0b !important;
            border-color: #f59e0b !important;
        }

        #example td:first-child .btn-action-delete,
        #example td:first-child [onclick*="delete"],
        #example td:first-child [onclick*="Delete"],
        #example td:first-child [onclick*="hapus"],
        #example td:first-child [title*="Hapus"],
        #example td:first-child [title*="Delete"] {
            background: #ef4444 !important;
            border-color: #ef4444 !important;
        }

        #example td:first-child a:hover,
        #example td:first-child button:hover,
        #example td:first-child .btn:hover,
        #example .action-icon-btn:hover,
        #example td:first-child .btn.btn-icon:hover {
            color: #ffffff !important;
            filter: brightness(.96);
            transform: translateY(-1px);
        }

        #example td:first-child a:active,
        #example td:first-child button:active,
        #example td:first-child .btn:active,
        #example .action-icon-btn:active,
        #example td:first-child .btn.btn-icon:active {
            transform: translateY(0);
        }

        /* DataTables. */
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
            border-color: #009ef7 !important;
            box-shadow: 0 0 0 .2rem rgba(0, 158, 247, .10) !important;
        }

        /* Excel kiri dan pencarian kanan. */
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
            margin-right: 6px !important;
            padding: 8px 13px !important;
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

        /* Modal detail tetap simple. */
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

        .modal .btn-close:hover {
            opacity: 1;
            transform: none !important;
        }

        .modal label,
        .modal .form-label,
        .modal h6 {
            color: #111827 !important;
            font-size: 13px;
            font-weight: 800 !important;
        }

        .modal p,
        .modal dd {
            color: #475569 !important;
            font-weight: 600 !important;
        }

        .modal .btn.btn-light,
        .modal .modal-footer .btn-light {
            min-height: 40px;
            padding: 8px 15px;
            color: #ffffff !important;
            background: #ef4444 !important;
            border: 1px solid #ef4444 !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-weight: 700;
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
                width: 82px !important;
                min-width: 82px !important;
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
            <p class="text-muted mb-0">Lihat kategori utama yang digunakan untuk mengelompokkan kelas</p>
        </div>

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder mb-1">Daftar Kategori</span>
                </h3>
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

    @include('mentor.kategori.view.detail')
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

    @include('mentor.kategori.script.list')
    @include('mentor.kategori.script.detail')

    <script>
        function warnaTombolAksiKategoriMentor() {
            $('#example tbody tr').each(function () {
                const $buttons = $(this).find('td:first-child .btn, td:first-child button, td:first-child a');

                $buttons.each(function (index) {
                    const btn = this;
                    const $btn = $(btn);
                    const identity = [
                        $btn.attr('title'),
                        $btn.attr('aria-label'),
                        $btn.attr('data-bs-original-title'),
                        $btn.attr('data-bs-target'),
                        $btn.attr('data-target'),
                        $btn.attr('onclick'),
                        $btn.attr('href'),
                        $btn.attr('class'),
                        $btn.text(),
                        $btn.find('i').attr('class'),
                        $btn.find('svg').attr('class')
                    ].filter(Boolean).join(' ').toLowerCase();

                    $btn
                        .removeClass('btn-primary btn-info btn-warning btn-danger btn-success btn-light-primary btn-light-warning btn-light-danger')
                        .removeClass('btn-action-detail btn-action-edit btn-action-delete');

                    if (
                        identity.includes('delete') ||
                        identity.includes('hapus') ||
                        identity.includes('trash') ||
                        identity.includes('destroy')
                    ) {
                        $btn.addClass('btn-action-delete');
                        btn.style.setProperty('background-color', '#ef4444', 'important');
                        btn.style.setProperty('border-color', '#ef4444', 'important');
                    } else if (
                        identity.includes('edit') ||
                        identity.includes('ubah') ||
                        identity.includes('pencil') ||
                        identity.includes('pen')
                    ) {
                        $btn.addClass('btn-action-edit');
                        btn.style.setProperty('background-color', '#f59e0b', 'important');
                        btn.style.setProperty('border-color', '#f59e0b', 'important');
                    } else {
                        $btn.addClass('btn-action-detail');
                        btn.style.setProperty('background-color', '#3b82f6', 'important');
                        btn.style.setProperty('border-color', '#3b82f6', 'important');
                    }

                    btn.style.setProperty('color', '#ffffff', 'important');
                    $btn.find('i, .bi').each(function () {
                        this.style.setProperty('color', '#ffffff', 'important');
                    });
                });
            });
        }

        $(document).ready(function () {
            warnaTombolAksiKategoriMentor();

            $('#example').on('draw.dt init.dt responsive-display.dt', function () {
                warnaTombolAksiKategoriMentor();
            });

            setTimeout(warnaTombolAksiKategoriMentor, 200);
            setTimeout(warnaTombolAksiKategoriMentor, 600);
            setTimeout(warnaTombolAksiKategoriMentor, 1000);
        });
    </script>
@endsection
