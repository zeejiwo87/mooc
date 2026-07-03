@extends('admin.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/buttons.dataTables.min.css') }}" />

    <style>
        .pendaftaran-neo-page {
            --neo-bg: #eef2f7;
            --neo-surface: #eef2f7;
            --neo-text: #1f2937;
            --neo-muted: #64748b;
            --neo-border: rgba(148, 163, 184, .22);
            --neo-primary: #2563eb;
            --neo-success: #16a34a;
            --neo-warning: #b45309;
            --neo-danger: #b91c1c;
            --neo-shadow-dark: rgba(163, 177, 198, .34);
            --neo-shadow-light: rgba(255, 255, 255, .86);
            padding: 0 28px 30px;
            color: var(--neo-text);
        }

        .pendaftaran-neo-page .content {
            max-width: 1480px;
            margin: 0 auto;
        }

        .pendaftaran-neo-page .card {
            border: 0 !important;
            border-radius: 28px;
            background: var(--neo-surface);
            box-shadow:
                10px 10px 22px var(--neo-shadow-dark),
                -10px -10px 22px var(--neo-shadow-light) !important;
            overflow: hidden;
        }

        .pendaftaran-neo-page .card-header {
            min-height: unset;
            padding: 24px 26px;
            border-bottom: 1px solid rgba(148, 163, 184, .18);
            background: var(--neo-surface);
        }

        .pendaftaran-neo-page .card-title {
            margin: 0;
        }

        .pendaftaran-neo-page .card-label {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--neo-text);
            font-size: 1.18rem;
            font-weight: 900 !important;
            letter-spacing: -.01em;
        }

        .pendaftaran-neo-page .card-label::before {
            content: "\F1C8";
            font-family: bootstrap-icons !important;
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            color: var(--neo-primary);
            background: var(--neo-surface);
            box-shadow:
                5px 5px 11px rgba(163, 177, 198, .28),
                -5px -5px 11px rgba(255, 255, 255, .78);
            font-size: 1.05rem;
        }

        .pendaftaran-neo-page .card-body {
            padding: 24px 26px 28px !important;
            background: var(--neo-surface);
        }

        .pendaftaran-neo-page .table-responsive.mb-8 {
            margin-bottom: 0 !important;
            padding: 18px !important;
            border: 0 !important;
            border-radius: 24px !important;
            background: var(--neo-surface);
            box-shadow:
                inset 5px 5px 11px rgba(163, 177, 198, .18),
                inset -5px -5px 11px rgba(255, 255, 255, .82);
        }

        .pendaftaran-neo-page label,
        .pendaftaran-neo-page .form-label {
            color: #334155;
            font-weight: 850 !important;
        }

        .pendaftaran-neo-page .form-control,
        .pendaftaran-neo-page .form-select {
            min-height: 42px;
            border: 1px solid rgba(148, 163, 184, .24) !important;
            border-radius: 15px !important;
            color: #1e293b;
            background-color: var(--neo-surface) !important;
            box-shadow:
                inset 4px 4px 9px rgba(163, 177, 198, .18),
                inset -4px -4px 9px rgba(255, 255, 255, .8) !important;
            font-weight: 700;
        }

        .pendaftaran-neo-page .form-control:focus,
        .pendaftaran-neo-page .form-select:focus {
            border-color: rgba(37, 99, 235, .34) !important;
            box-shadow:
                inset 4px 4px 9px rgba(163, 177, 198, .2),
                inset -4px -4px 9px rgba(255, 255, 255, .84),
                0 0 0 .18rem rgba(37, 99, 235, .08) !important;
        }

        .pendaftaran-neo-page .select2-container--bootstrap5 .select2-selection,
        .pendaftaran-neo-page .select2-container .select2-selection--single {
            min-height: 42px;
            border: 1px solid rgba(148, 163, 184, .24) !important;
            border-radius: 15px !important;
            background: var(--neo-surface) !important;
            box-shadow:
                inset 4px 4px 9px rgba(163, 177, 198, .18),
                inset -4px -4px 9px rgba(255, 255, 255, .8) !important;
        }

        .pendaftaran-neo-page .select2-container--bootstrap5 .select2-selection__rendered,
        .pendaftaran-neo-page .select2-container .select2-selection__rendered {
            color: #1e293b !important;
            font-weight: 750;
            line-height: 40px !important;
            padding-left: 14px !important;
        }

        .pendaftaran-neo-page .btn,
        .pendaftaran-neo-page .dt-button,
        .pendaftaran-neo-page a.btn {
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 9px 14px !important;
            border: 1px solid rgba(148, 163, 184, .22) !important;
            border-radius: 14px !important;
            color: #334155 !important;
            background: var(--neo-surface) !important;
            font-size: .8rem;
            line-height: 1;
            font-weight: 850;
            text-decoration: none !important;
            box-shadow:
                5px 5px 11px rgba(163, 177, 198, .26),
                -5px -5px 11px rgba(255, 255, 255, .78) !important;
            transition: .18s ease;
        }

        .pendaftaran-neo-page .btn:hover,
        .pendaftaran-neo-page .dt-button:hover,
        .pendaftaran-neo-page a.btn:hover {
            transform: translateY(-1px);
            color: #0f172a !important;
            border-color: rgba(100, 116, 139, .3) !important;
            box-shadow:
                6px 6px 14px rgba(163, 177, 198, .3),
                -6px -6px 14px rgba(255, 255, 255, .84) !important;
        }

        .pendaftaran-neo-page .btn-primary,
        .pendaftaran-neo-page .btn-info,
        .pendaftaran-neo-page .btn-success {
            color: var(--neo-primary) !important;
        }

        .pendaftaran-neo-page .btn-warning {
            color: var(--neo-warning) !important;
        }

        .pendaftaran-neo-page .btn-danger {
            color: var(--neo-danger) !important;
        }

        .pendaftaran-neo-page .btn-light,
        .pendaftaran-neo-page .btn-secondary {
            color: #475569 !important;
        }

        .pendaftaran-neo-page #example_wrapper {
            color: var(--neo-text);
        }

        .pendaftaran-neo-page #example_wrapper .dataTables_length,
        .pendaftaran-neo-page #example_wrapper .dataTables_filter,
        .pendaftaran-neo-page #example_wrapper .dataTables_info {
            color: var(--neo-muted) !important;
            font-weight: 750;
        }

        .pendaftaran-neo-page #example_wrapper .dataTables_filter input,
        .pendaftaran-neo-page #example_wrapper .dataTables_length select {
            margin-left: 8px;
            min-height: 38px;
            border: 1px solid rgba(148, 163, 184, .22) !important;
            border-radius: 13px !important;
            color: #1e293b;
            background: var(--neo-surface) !important;
            box-shadow:
                inset 4px 4px 8px rgba(163, 177, 198, .17),
                inset -4px -4px 8px rgba(255, 255, 255, .78) !important;
            font-weight: 700;
        }

        .pendaftaran-neo-page .table-responsive > .table-responsive {
            padding: 10px;
            border-radius: 20px;
            background: var(--neo-surface);
            box-shadow:
                5px 5px 13px rgba(163, 177, 198, .2),
                -5px -5px 13px rgba(255, 255, 255, .7);
        }

        .pendaftaran-neo-page table.dataTable,
        .pendaftaran-neo-page .table {
            width: 100% !important;
            margin: 0 !important;
            border-collapse: separate !important;
            border-spacing: 0 9px !important;
        }

        .pendaftaran-neo-page table.dataTable thead tr,
        .pendaftaran-neo-page .table thead tr {
            border: 0 !important;
        }

        .pendaftaran-neo-page table.dataTable thead th,
        .pendaftaran-neo-page .table thead th {
            padding: 12px 14px !important;
            border: 0 !important;
            color: #64748b !important;
            background: transparent !important;
            font-size: .76rem !important;
            font-weight: 900 !important;
            letter-spacing: .035em;
            text-transform: uppercase;
        }

        .pendaftaran-neo-page table.dataTable tbody tr,
        .pendaftaran-neo-page .table tbody tr {
            background: var(--neo-surface) !important;
            box-shadow:
                4px 4px 11px rgba(163, 177, 198, .18),
                -4px -4px 11px rgba(255, 255, 255, .72);
        }

        .pendaftaran-neo-page table.dataTable tbody td,
        .pendaftaran-neo-page .table tbody td {
            padding: 13px 14px !important;
            border-top: 1px solid rgba(148, 163, 184, .12) !important;
            border-bottom: 1px solid rgba(255, 255, 255, .55) !important;
            color: #334155 !important;
            background: transparent !important;
            font-weight: 750;
            vertical-align: middle;
        }

        .pendaftaran-neo-page table.dataTable tbody td:first-child,
        .pendaftaran-neo-page .table tbody td:first-child {
            border-radius: 16px 0 0 16px;
            border-left: 1px solid rgba(148, 163, 184, .12) !important;
        }

        .pendaftaran-neo-page table.dataTable tbody td:last-child,
        .pendaftaran-neo-page .table tbody td:last-child {
            border-radius: 0 16px 16px 0;
            border-right: 1px solid rgba(255, 255, 255, .55) !important;
        }

        .pendaftaran-neo-page .badge,
        .pendaftaran-neo-page .badge-light,
        .pendaftaran-neo-page .badge-primary,
        .pendaftaran-neo-page .badge-success,
        .pendaftaran-neo-page .badge-warning,
        .pendaftaran-neo-page .badge-danger {
            min-height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 7px 11px;
            border-radius: 999px;
            background: var(--neo-surface) !important;
            color: #475569 !important;
            box-shadow:
                4px 4px 9px rgba(163, 177, 198, .2),
                -4px -4px 9px rgba(255, 255, 255, .74);
            font-weight: 850;
        }

        .pendaftaran-neo-page .badge-success,
        .pendaftaran-neo-page .text-success {
            color: #166534 !important;
        }

        .pendaftaran-neo-page .badge-warning,
        .pendaftaran-neo-page .text-warning {
            color: #92400e !important;
        }

        .pendaftaran-neo-page .badge-danger,
        .pendaftaran-neo-page .text-danger {
            color: #b91c1c !important;
        }

        .pendaftaran-neo-page .dataTables_paginate .pagination {
            gap: 7px;
            margin-top: 14px !important;
        }

        .pendaftaran-neo-page .dataTables_paginate .page-item .page-link {
            min-width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(148, 163, 184, .18) !important;
            border-radius: 13px !important;
            color: #475569 !important;
            background: var(--neo-surface) !important;
            box-shadow:
                4px 4px 9px rgba(163, 177, 198, .2),
                -4px -4px 9px rgba(255, 255, 255, .74);
            font-weight: 850;
        }

        .pendaftaran-neo-page .dataTables_paginate .page-item.active .page-link {
            color: var(--neo-primary) !important;
            box-shadow:
                inset 4px 4px 8px rgba(163, 177, 198, .2),
                inset -4px -4px 8px rgba(255, 255, 255, .78) !important;
        }

        .pendaftaran-neo-page .dataTables_paginate .page-item.disabled .page-link {
            opacity: .55;
        }

        #form_create .modal-dialog,
        #form_edit .modal-dialog,
        #form_detail .modal-dialog {
            margin-top: 40px;
        }

        #form_create .modal-content,
        #form_edit .modal-content,
        #form_detail .modal-content {
            border: 1px solid rgba(148, 163, 184, .18) !important;
            border-radius: 26px !important;
            background: #eef2f7 !important;
            box-shadow:
                12px 12px 28px rgba(15, 23, 42, .16),
                -8px -8px 22px rgba(255, 255, 255, .68) !important;
            overflow: hidden;
        }

        #form_create .modal-header,
        #form_edit .modal-header,
        #form_detail .modal-header {
            padding: 22px 24px;
            border-bottom: 1px solid rgba(148, 163, 184, .18) !important;
            background: #eef2f7 !important;
        }

        #form_create .modal-title,
        #form_edit .modal-title,
        #form_detail .modal-title {
            color: #1f2937;
            font-weight: 900;
        }

        #form_create .modal-body,
        #form_edit .modal-body,
        #form_detail .modal-body {
            padding: 24px;
            background: #eef2f7 !important;
        }

        #form_create .modal-footer,
        #form_edit .modal-footer,
        #form_detail .modal-footer {
            padding: 18px 24px 22px;
            border-top: 1px solid rgba(148, 163, 184, .16) !important;
            background: #eef2f7 !important;
        }

        #form_create h6,
        #form_edit h6,
        #form_detail h6 {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 18px !important;
            padding: 10px 14px !important;
            border: 0 !important;
            border-radius: 14px;
            color: #334155 !important;
            background: #eef2f7;
            box-shadow:
                inset 4px 4px 8px rgba(163, 177, 198, .16),
                inset -4px -4px 8px rgba(255, 255, 255, .74);
            font-weight: 900 !important;
        }

        #form_create h6::before,
        #form_edit h6::before,
        #form_detail h6::before {
            content: "\F431";
            font-family: bootstrap-icons !important;
            color: #2563eb;
        }

        #form_create .form-control,
        #form_create .form-select,
        #form_edit .form-control,
        #form_edit .form-select,
        #form_detail .form-control,
        #form_detail .form-select {
            min-height: 42px;
            border: 1px solid rgba(148, 163, 184, .22) !important;
            border-radius: 15px !important;
            color: #1e293b;
            background: #eef2f7 !important;
            box-shadow:
                inset 4px 4px 9px rgba(163, 177, 198, .18),
                inset -4px -4px 9px rgba(255, 255, 255, .76) !important;
            font-weight: 750;
        }

        #form_create .select2-container--bootstrap5 .select2-selection,
        #form_create .select2-container .select2-selection--single,
        #form_edit .select2-container--bootstrap5 .select2-selection,
        #form_edit .select2-container .select2-selection--single {
            min-height: 42px;
            border: 1px solid rgba(148, 163, 184, .22) !important;
            border-radius: 15px !important;
            background: #eef2f7 !important;
            box-shadow:
                inset 4px 4px 9px rgba(163, 177, 198, .18),
                inset -4px -4px 9px rgba(255, 255, 255, .76) !important;
        }

        #form_create label,
        #form_edit label,
        #form_detail label {
            color: #334155 !important;
            font-weight: 850 !important;
        }

        #form_detail p {
            min-height: 42px;
            display: flex;
            align-items: center;
            margin: 0;
            padding: 10px 13px;
            border-radius: 14px;
            color: #1e293b !important;
            background: #eef2f7;
            box-shadow:
                inset 4px 4px 9px rgba(163, 177, 198, .16),
                inset -4px -4px 9px rgba(255, 255, 255, .76);
            font-weight: 750 !important;
        }

        #form_create .btn,
        #form_edit .btn,
        #form_detail .btn {
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 9px 15px !important;
            border: 1px solid rgba(148, 163, 184, .22) !important;
            border-radius: 14px !important;
            color: #334155 !important;
            background: #eef2f7 !important;
            box-shadow:
                5px 5px 11px rgba(163, 177, 198, .24),
                -5px -5px 11px rgba(255, 255, 255, .72) !important;
            font-weight: 850;
        }

        #form_create .btn-primary,
        #form_edit .btn-primary {
            color: #2563eb !important;
        }

        #form_create .btn-light,
        #form_edit .btn-light,
        #form_detail .btn-light {
            color: #475569 !important;
        }

        #form_create .btn-close,
        #form_edit .btn-close,
        #form_detail .btn-close {
            width: 34px;
            height: 34px;
            border-radius: 12px;
            background-color: #eef2f7;
            box-shadow:
                4px 4px 9px rgba(163, 177, 198, .22),
                -4px -4px 9px rgba(255, 255, 255, .72);
            opacity: .85;
        }

        .modal-backdrop.show {
            opacity: .36;
        }

        .swal2-popup {
            border-radius: 24px !important;
            background: #eef2f7 !important;
            box-shadow:
                12px 12px 28px rgba(15, 23, 42, .16),
                -8px -8px 22px rgba(255, 255, 255, .64) !important;
        }

        .swal2-title {
            color: #1f2937 !important;
            font-weight: 900 !important;
        }

        .swal2-html-container,
        .swal2-content {
            color: #64748b !important;
            font-weight: 650 !important;
        }

        .swal2-confirm,
        .swal2-cancel {
            border-radius: 14px !important;
            font-weight: 850 !important;
            box-shadow: none !important;
        }

        @media (max-width: 767.98px) {
            .pendaftaran-neo-page {
                padding: 0 16px 24px;
            }

            .pendaftaran-neo-page .card-header {
                flex-direction: column;
                align-items: stretch;
                gap: 16px;
            }

            .pendaftaran-neo-page .card-toolbar,
            .pendaftaran-neo-page .card-toolbar .d-flex,
            .pendaftaran-neo-page .card-toolbar .btn {
                width: 100%;
            }

            .pendaftaran-neo-page .card-body {
                padding: 18px !important;
            }

            .pendaftaran-neo-page .table-responsive.mb-8 {
                padding: 14px !important;
            }

            #form_create .modal-dialog,
            #form_edit .modal-dialog,
            #form_detail .modal-dialog {
                margin: 18px;
            }

            #form_create .modal-body,
            #form_edit .modal-body,
            #form_detail .modal-body {
                padding: 18px;
            }
        }

        /* FIX: jarak icon plus/minus responsive DataTables agar tidak mepet tombol aksi */
        .pendaftaran-neo-page table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control,
        .pendaftaran-neo-page table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control,
        .pendaftaran-neo-page table.dataTable.dtr-inline.collapsed > tbody > tr > td:first-child,
        .pendaftaran-neo-page table.dataTable.dtr-inline.collapsed > tbody > tr > th:first-child {
            position: relative;
        }

        .pendaftaran-neo-page table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control,
        .pendaftaran-neo-page table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control {
            padding-left: 48px !important;
        }

        .pendaftaran-neo-page table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control::before,
        .pendaftaran-neo-page table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control::before {
            top: 50% !important;
            left: 16px !important;
            transform: translateY(-50%) !important;
            margin-top: 0 !important;
            width: 24px !important;
            height: 24px !important;
            line-height: 22px !important;
            border-radius: 999px !important;
            border: 1px solid rgba(148, 163, 184, .32) !important;
            background: #eef2f7 !important;
            color: #2563eb !important;
            box-shadow:
                3px 3px 7px rgba(163, 177, 198, .28),
                -3px -3px 7px rgba(255, 255, 255, .82) !important;
        }

        .pendaftaran-neo-page table.dataTable.dtr-inline.collapsed > tbody > tr.parent > td.dtr-control::before,
        .pendaftaran-neo-page table.dataTable.dtr-inline.collapsed > tbody > tr.parent > th.dtr-control::before {
            background: #eef2f7 !important;
            color: #dc2626 !important;
        }

        .pendaftaran-neo-page table.dataTable tbody td:last-child,
        .pendaftaran-neo-page table.dataTable tbody th:last-child {
            min-width: 150px;
        }

        .pendaftaran-neo-page .action-row,
        .pendaftaran-neo-page .table-actions,
        .pendaftaran-neo-page td .d-flex,
        .pendaftaran-neo-page td .btn-group {
            gap: 10px !important;
            align-items: center !important;
            flex-wrap: nowrap !important;
        }

        .pendaftaran-neo-page td .btn,
        .pendaftaran-neo-page td .btn-sm,
        .pendaftaran-neo-page td a.btn,
        .pendaftaran-neo-page td button.btn {
            margin-left: 4px !important;
            margin-right: 4px !important;
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
    <div class="container-fluid pendaftaran-neo-page">
        <div class="content flex-column-fluid">
            <div class="card mb-xl-8 mb-5 border-2 shadow">
                <div class="card-header">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder mb-1">Data Pendaftaran Kelas</span>
                    </h3>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <a type="button" class="btn btn-sm btn-primary fs-sm-8 fs-lg-6" data-bs-toggle="modal"
                                data-bs-target="#form_create" title="Tambah Pendaftaran">Tambah Pendaftaran</a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-5">
                    <div
                        class="table-responsive mb-8 p-4 mx-0 border-hover-dark border-primary border-1 fs-sm-8 fs-lg-6 rounded-2">
                        <div class="row mb-4 fs-sm-8 fs-lg-6">
                            <div class="col-md-4 mb-2">
                                <label class="d-flex align-items-center fw-bolder mb-1">
                                    <span>Filter Kelas</span>
                                </label>
                                <select data-control="select2" id="filter_id_kelas"
                                    class="form-select form-select-sm fs-sm-8 fs-lg-6" data-allow-clear="true"
                                    data-placeholder="Pilih Kelas">
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="d-flex align-items-center fw-bolder mb-1">
                                    <span>Filter Status</span>
                                </label>
                                <select id="filter_status" data-control="select2"
                                    class="form-select form-select-sm fs-sm-8 fs-lg-6" data-allow-clear="true"
                                    data-placeholder="Pilih Status">
                                    <option value="">Semua Status</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="selesai">Selesai</option>
                                </select>
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
        </div>
    </div>

    @include('admin.pendaftaran.view.detail')
    @include('admin.pendaftaran.view.create')
    @include('admin.pendaftaran.view.edit')
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
    @include('admin.pendaftaran.script.list')
    @include('admin.pendaftaran.script.create')
    @include('admin.pendaftaran.script.edit')
    @include('admin.pendaftaran.script.detail')
@endsection
