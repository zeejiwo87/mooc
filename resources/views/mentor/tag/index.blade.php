@extends('mentor.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/buttons.dataTables.min.css') }}"/>

    <style>
        /* =========================================================
           TAG MENTOR - SIMPLE SEPERTI ADMIN
           Visual only: route, include, id, dan script utama tetap
        ========================================================= */

        .admin-page-simple {
            width: 100%;
        }

        .admin-page-simple .page-title h3 {
            margin-bottom: 4px;
            color: #111827;
        }

        .admin-page-simple .page-title p {
            color: #64748b !important;
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
            border-collapse: separate !important;
            border-spacing: 0 !important;
        }

        .admin-page-simple .table thead th {
            padding-top: 12px;
            padding-bottom: 12px;
            color: #64748b !important;
            font-size: 12px;
            font-weight: 800 !important;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
            background: #ffffff !important;
            border-bottom: 1px solid #eef2f7 !important;
        }

        .admin-page-simple .table tbody td {
            padding-top: 12px;
            padding-bottom: 12px;
            color: #111827 !important;
            font-size: 14px;
            vertical-align: middle;
            background: #ffffff !important;
            border-bottom: 1px solid #eef2f7 !important;
        }

        .admin-page-simple .table tbody tr:last-child td {
            border-bottom: 0 !important;
        }

        .admin-page-simple .table tbody tr:hover td {
            background: #f8fafc !important;
        }

        .admin-page-simple .badge {
            padding: 6px 10px;
            border-radius: 999px;
            font-weight: 700;
        }

        /* =========================================================
           TOMBOL AKSI TAG MENTOR
           Walaupun hanya 1 tombol, tetap dibuat berwarna dari awal.
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
        #example .mentor-tag-action-detail {
            width: 34px !important;
            height: 34px !important;
            min-width: 34px !important;
            min-height: 34px !important;
            padding: 0 !important;
            margin: 0 3px !important;
            border: 0 !important;
            border-radius: 10px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            color: #ffffff !important;
            background: #3b82f6 !important;
            box-shadow: 0 6px 14px rgba(15, 23, 42, .14) !important;
            font-size: 0 !important;
            line-height: 1 !important;
            text-decoration: none !important;
            vertical-align: middle !important;
            transition: transform .18s ease, filter .18s ease;
        }

        #example td:first-child a i,
        #example td:first-child button i,
        #example td:first-child .btn i,
        #example td:first-child a .bi,
        #example td:first-child button .bi,
        #example td:first-child .btn .bi,
        #example .action-icon-btn .bi,
        #example .btn.btn-icon.action-icon-btn .bi,
        #example .mentor-tag-action-detail i,
        #example .mentor-tag-action-detail .bi {
            color: #ffffff !important;
            font-size: 16px !important;
            line-height: 1 !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        #example td:first-child a:hover,
        #example td:first-child button:hover,
        #example td:first-child .btn:hover,
        #example .action-icon-btn:hover,
        #example .mentor-tag-action-detail:hover {
            color: #ffffff !important;
            background: #2563eb !important;
            filter: brightness(.96);
            transform: translateY(-1px);
        }

        #example td:first-child a:active,
        #example td:first-child button:active,
        #example td:first-child .btn:active,
        #example .action-icon-btn:active,
        #example .mentor-tag-action-detail:active {
            transform: translateY(0);
        }

        /* DataTables */
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
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 .2rem rgba(59, 130, 246, .10) !important;
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
            margin-right: 6px !important;
            padding: 8px 13px !important;
            color: #ffffff !important;
            background: #10b981 !important;
            border: 1px solid #10b981 !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-size: 13px !important;
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
            background: #3b82f6;
            border-color: #3b82f6;
        }

        .admin-page-simple .dataTables_wrapper .page-item.disabled .page-link {
            color: #94a3b8;
            background: #f8fafc;
        }

        table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control::before,
        table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control::before {
            background: #3b82f6 !important;
            border: 0 !important;
            box-shadow: none !important;
        }

        .modal-content {
            overflow: hidden;
            background: #ffffff !important;
            border: 0 !important;
            border-radius: 12px !important;
            box-shadow: 0 18px 45px rgba(15, 23, 42, .16) !important;
        }

        .modal-header {
            padding: 16px 20px;
            background: #ffffff !important;
            border-bottom: 1px solid #eef2f7 !important;
        }

        .modal-title {
            color: #111827 !important;
            font-size: 18px;
            font-weight: 800;
        }

        .modal-body {
            padding: 22px;
            background: #ffffff !important;
        }

        .modal-footer {
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

        .modal .btn-light {
            color: #ffffff !important;
            background: #ef4444 !important;
            border-color: #ef4444 !important;
        }

        .modal .btn-primary {
            color: #ffffff !important;
            background: #3b82f6 !important;
            border-color: #3b82f6 !important;
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
            <p class="text-muted mb-0">Lihat tag yang digunakan untuk mengelompokkan dan menandai kelas</p>
        </div>

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder mb-1">Daftar Tag</span>
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

    @include('mentor.tag.view.detail')
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

    @include('mentor.tag.script.list')
    @include('mentor.tag.script.detail')

    <script>
        function warnaAksiTagMentor() {
            $('#example tbody td:first-child').find('a, button, .btn').each(function () {
                const $btn = $(this);
                $btn.addClass('mentor-tag-action-detail');
                $btn.find('i, .bi').css({
                    color: '#ffffff',
                    fontSize: '16px',
                    lineHeight: '1',
                    margin: '0',
                    padding: '0'
                });
            });
        }

        $(document).ready(function () {
            warnaAksiTagMentor();

            $('#example').on('draw.dt init.dt responsive-display.dt', function () {
                setTimeout(warnaAksiTagMentor, 0);
            });

            setTimeout(warnaAksiTagMentor, 150);
            setTimeout(warnaAksiTagMentor, 500);
            setTimeout(warnaAksiTagMentor, 1000);
        });
    </script>
@endsection
