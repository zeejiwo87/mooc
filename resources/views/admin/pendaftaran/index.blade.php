@extends('admin.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/buttons.dataTables.min.css') }}" />

    <style>
        /* =========================================================
           HALAMAN DATA PENDAFTARAN KELAS
           Simple, bersih, konsisten seperti Data Kelas
           Visual only: tidak mengubah route, id, include, atau logic backend
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
            box-shadow: none !important;
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

        /* Select dan Select2 */
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
        .admin-page-simple .filter-panel .select2-container--focus .select2-selection,
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

        .admin-page-simple .badge,
        .admin-page-simple .badge-light,
        .admin-page-simple .badge-primary,
        .admin-page-simple .badge-success,
        .admin-page-simple .badge-warning,
        .admin-page-simple .badge-danger,
        .admin-page-simple .badge-light-success,
        .admin-page-simple .badge-light-warning,
        .admin-page-simple .badge-light-danger,
        .admin-page-simple .badge-light-primary,
        .admin-page-simple .badge-light-info {
            min-height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 10px;
            border-radius: 999px;
            border: 1px solid #e5e7eb !important;
            background: #f8fafc !important;
            color: #475569 !important;
            font-weight: 700;
        }

        .admin-page-simple .badge-success,
        .admin-page-simple .badge-light-success,
        .admin-page-simple .text-success {
            color: #047857 !important;
            background: #ecfdf5 !important;
            border-color: #bbf7d0 !important;
        }

        .admin-page-simple .badge-warning,
        .admin-page-simple .badge-light-warning,
        .admin-page-simple .text-warning {
            color: #92400e !important;
            background: #fffbeb !important;
            border-color: #fde68a !important;
        }

        .admin-page-simple .badge-danger,
        .admin-page-simple .badge-light-danger,
        .admin-page-simple .text-danger {
            color: #b91c1c !important;
            background: #fef2f2 !important;
            border-color: #fecaca !important;
        }

        /* Tombol aksi */
        #example th:first-child,
        #example td:first-child {
            width: 132px !important;
            min-width: 132px !important;
            white-space: nowrap;
            text-align: center;
        }

        #example .action-icon-btn,
        #example .btn.btn-icon.action-icon-btn,
        #example td:first-child .btn.btn-icon,
        #example td:first-child a,
        #example td:first-child button {
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
            vertical-align: middle !important;
        }

        #example .action-icon-btn .bi,
        #example .btn.btn-icon.action-icon-btn .bi,
        #example td:first-child .btn.btn-icon .bi,
        #example td:first-child a i,
        #example td:first-child button i,
        #example td:first-child .bi {
            color: #ffffff !important;
            font-size: 15px !important;
            line-height: 1 !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* Detail = Biru */
        #example .action-icon-btn[data-bs-target="#form_detail"],
        #example .btn[data-bs-target="#form_detail"],
        #example td:first-child a[data-bs-target="#form_detail"],
        #example td:first-child button[data-bs-target="#form_detail"],
        #example td:first-child a[title*="Detail"],
        #example td:first-child button[title*="Detail"],
        #example td:first-child a[title*="Lihat"],
        #example td:first-child button[title*="Lihat"] {
            background: #3b82f6 !important;
        }

        /* Edit = Kuning */
        #example .action-icon-btn[data-bs-target="#form_edit"],
        #example .btn[data-bs-target="#form_edit"],
        #example td:first-child a[data-bs-target="#form_edit"],
        #example td:first-child button[data-bs-target="#form_edit"],
        #example td:first-child a[title*="Edit"],
        #example td:first-child button[title*="Edit"] {
            background: #f59e0b !important;
        }

        /* Hapus = Merah */
        #example .action-icon-btn[onclick*="deleteConfirmation"],
        #example .btn[onclick*="deleteConfirmation"],
        #example td:first-child a[onclick*="delete"],
        #example td:first-child button[onclick*="delete"],
        #example td:first-child a[title*="Hapus"],
        #example td:first-child button[title*="Hapus"] {
            background: #ef4444 !important;
        }

        #example .action-icon-btn:hover,
        #example td:first-child .btn.btn-icon:hover,
        #example td:first-child a:hover,
        #example td:first-child button:hover {
            color: #ffffff !important;
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        #example .action-icon-btn:active,
        #example td:first-child .btn.btn-icon:active,
        #example td:first-child a:active,
        #example td:first-child button:active {
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

        .admin-page-simple .dataTables_wrapper .dt-buttons .btn,
        .admin-page-simple .dataTables_wrapper .dt-button {
            margin-right: 6px !important;
            border-radius: 8px !important;
            color: #ffffff !important;
            background: #10b981 !important;
            border: 1px solid #10b981 !important;
            font-weight: 700 !important;
            box-shadow: none !important;
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

        /* Modal */
        #form_create .modal-dialog,
        #form_edit .modal-dialog,
        #form_detail .modal-dialog {
            margin-top: 28px;
            margin-bottom: 28px;
        }

        #form_create .modal-content,
        #form_edit .modal-content,
        #form_detail .modal-content {
            overflow: hidden;
            border: 0 !important;
            border-radius: 12px !important;
            background: #ffffff !important;
            box-shadow: 0 18px 45px rgba(15, 23, 42, .16) !important;
        }

        #form_create .modal-header,
        #form_edit .modal-header,
        #form_detail .modal-header {
            padding: 16px 20px;
            background: #ffffff !important;
            border-bottom: 1px solid #eef2f7 !important;
        }

        #form_create .modal-title,
        #form_edit .modal-title,
        #form_detail .modal-title {
            color: #111827;
            font-size: 18px;
            font-weight: 800;
        }

        #form_create .modal-body,
        #form_edit .modal-body,
        #form_detail .modal-body {
            padding: 22px;
            background: #ffffff !important;
        }

        #form_create .modal-footer,
        #form_edit .modal-footer,
        #form_detail .modal-footer {
            gap: 8px;
            padding: 14px 20px 18px;
            background: #ffffff !important;
            border-top: 1px solid #eef2f7 !important;
        }

        #form_create h6,
        #form_edit h6,
        #form_detail h6 {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px !important;
            padding-bottom: 10px !important;
            color: #074366 !important;
            border-bottom: 1px solid #e5e7eb !important;
            font-size: 14px;
            font-weight: 800 !important;
        }

        #form_create label,
        #form_edit label,
        #form_detail label {
            color: #111827 !important;
            font-weight: 800 !important;
        }

        #form_create .form-control,
        #form_create .form-select,
        #form_edit .form-control,
        #form_edit .form-select,
        #form_detail .form-control,
        #form_detail .form-select,
        #form_create .select2-container--bootstrap5 .select2-selection,
        #form_create .select2-container .select2-selection--single,
        #form_edit .select2-container--bootstrap5 .select2-selection,
        #form_edit .select2-container .select2-selection--single {
            min-height: 42px;
            color: #111827 !important;
            background: #ffffff !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-weight: 600;
        }

        #form_create .form-control:focus,
        #form_create .form-select:focus,
        #form_edit .form-control:focus,
        #form_edit .form-select:focus {
            border-color: #074366 !important;
            box-shadow: 0 0 0 .2rem rgba(7, 67, 102, .10) !important;
        }

        #form_detail p {
            min-height: 40px;
            display: flex;
            align-items: center;
            margin: 0;
            padding: 9px 11px;
            color: #334155 !important;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-weight: 600 !important;
        }

        #form_create .btn,
        #form_edit .btn,
        #form_detail .btn {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 8px 15px !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-size: 13px;
            line-height: 1;
            font-weight: 700;
        }

        #form_create .btn-primary,
        #form_edit .btn-primary {
            color: #ffffff !important;
            background: #074366 !important;
            border: 1px solid #074366 !important;
        }

        #form_create .btn-light,
        #form_edit .btn-light,
        #form_detail .btn-light {
            color: #ffffff !important;
            background: #ef4444 !important;
            border: 1px solid #ef4444 !important;
        }

        #form_create .btn-close,
        #form_edit .btn-close,
        #form_detail .btn-close {
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

        .select2-container--open {
            z-index: 1065 !important;
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

        .modal-backdrop.show {
            opacity: .34 !important;
            background: #0f172a !important;
        }

        .swal2-popup {
            color: #111827 !important;
            background: #ffffff !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 12px !important;
            box-shadow: 0 18px 45px rgba(15, 23, 42, .16) !important;
        }

        .swal2-title {
            color: #111827 !important;
            font-weight: 800 !important;
        }

        .swal2-html-container,
        .swal2-content {
            color: #475569 !important;
            font-weight: 600 !important;
        }

        .swal2-confirm,
        .swal2-cancel {
            min-height: 40px;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-weight: 700 !important;
        }

        /* Responsive */
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

            #form_create .modal-footer,
            #form_edit .modal-footer,
            #form_detail .modal-footer {
                flex-direction: column-reverse;
                align-items: stretch;
            }
        }

        /* =========================================================
           FIX FINAL ACTION BUTTONS PENDAFTARAN
           Progres hijau, Detail biru, Edit kuning, Hapus merah
           Diletakkan paling bawah agar tidak kalah oleh style lain.
        ========================================================= */
        #example th:first-child,
        #example td:first-child {
            width: 150px !important;
            min-width: 150px !important;
            white-space: nowrap !important;
            text-align: center !important;
        }

        #example td:first-child .action-icon-btn,
        #example td:first-child .btn,
        #example td:first-child a,
        #example td:first-child button,
        #example .action-icon-btn {
            width: 34px !important;
            height: 34px !important;
            min-width: 34px !important;
            min-height: 34px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 3px 0 0 !important;
            padding: 0 !important;
            color: #ffffff !important;
            background-color: #3b82f6 !important;
            border: 0 !important;
            border-radius: 8px !important;
            box-shadow: 0 5px 12px rgba(15, 23, 42, .12) !important;
            line-height: 1 !important;
            vertical-align: middle !important;
        }

        #example td:first-child .action-icon-btn:last-child,
        #example td:first-child .btn:last-child,
        #example td:first-child a:last-child,
        #example td:first-child button:last-child {
            margin-right: 0 !important;
        }

        #example td:first-child .action-icon-btn i,
        #example td:first-child .action-icon-btn .bi,
        #example td:first-child .btn i,
        #example td:first-child .btn .bi,
        #example td:first-child a i,
        #example td:first-child a .bi,
        #example td:first-child button i,
        #example td:first-child button .bi,
        #example .action-icon-btn i,
        #example .action-icon-btn .bi {
            color: #ffffff !important;
            font-size: 15px !important;
            line-height: 1 !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* Progres = hijau */
        #example td:first-child a[title*="Progres"],
        #example td:first-child .action-icon-btn[title*="Progres"],
        #example td:first-child a[href*="progres"],
        #example td:first-child a[href*="progres_kelas"],
        #example td:first-child a:has(.bi-layout-text-sidebar-reverse) {
            background-color: #10b981 !important;
            border-color: #10b981 !important;
        }

        /* Detail = biru */
        #example td:first-child button[data-bs-target="#form_detail"],
        #example td:first-child .action-icon-btn[data-bs-target="#form_detail"],
        #example td:first-child .btn[data-bs-target="#form_detail"],
        #example td:first-child button[title*="Detail"],
        #example td:first-child .btn[title*="Detail"] {
            background-color: #3b82f6 !important;
            border-color: #3b82f6 !important;
        }

        /* Edit = kuning */
        #example td:first-child button[data-bs-target="#form_edit"],
        #example td:first-child .action-icon-btn[data-bs-target="#form_edit"],
        #example td:first-child .btn[data-bs-target="#form_edit"],
        #example td:first-child button[title*="Edit"],
        #example td:first-child .btn[title*="Edit"] {
            background-color: #f59e0b !important;
            border-color: #f59e0b !important;
        }

        /* Hapus = merah, untuk jaga-jaga jika nanti ada delete */
        #example td:first-child button[onclick*="delete"],
        #example td:first-child .action-icon-btn[onclick*="delete"],
        #example td:first-child .btn[onclick*="delete"],
        #example td:first-child button[title*="Hapus"],
        #example td:first-child .btn[title*="Hapus"] {
            background-color: #ef4444 !important;
            border-color: #ef4444 !important;
        }

        #example td:first-child .action-icon-btn:hover,
        #example td:first-child .btn:hover,
        #example td:first-child a:hover,
        #example td:first-child button:hover {
            color: #ffffff !important;
            filter: brightness(.94) !important;
            transform: translateY(-1px) !important;
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
            <p class="text-muted mb-0">Kelola peserta yang terdaftar pada kelas, status, progres, dan waktu akses terakhir</p>
        </div>

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder mb-1">Daftar Pendaftaran</span>
                </h3>

                <a type="button"
                   class="btn btn-primary btn-sm fs-sm-8 fs-lg-6"
                   data-bs-toggle="modal"
                   data-bs-target="#form_create"
                   title="Tambah Pendaftaran">
                    <i class="bi bi-plus-lg me-1"></i>
                    Tambah Pendaftaran
                </a>
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

    <script>
        function warnaTombolAksiPendaftaran() {
            $('#example .action-icon-btn, #example tbody td:first-child .btn, #example tbody td:first-child button, #example tbody td:first-child a').each(function () {
                const $btn = $(this);
                const html = String($btn.html() || '').toLowerCase();
                const title = String($btn.attr('title') || '').toLowerCase();
                const target = String($btn.attr('data-bs-target') || '').toLowerCase();
                const onclick = String($btn.attr('onclick') || '').toLowerCase();
                const href = String($btn.attr('href') || '').toLowerCase();

                let warna = '#3b82f6';

                if (
                    title.includes('progres') ||
                    title.includes('materi') ||
                    href.includes('progres') ||
                    href.includes('progres_kelas') ||
                    html.includes('layout-text-sidebar')
                ) {
                    warna = '#10b981';
                } else if (
                    target.includes('form_edit') ||
                    title.includes('edit') ||
                    html.includes('pencil') ||
                    html.includes('bi-pencil')
                ) {
                    warna = '#f59e0b';
                } else if (
                    onclick.includes('delete') ||
                    onclick.includes('hapus') ||
                    title.includes('hapus') ||
                    html.includes('trash') ||
                    html.includes('bi-trash')
                ) {
                    warna = '#ef4444';
                } else if (
                    target.includes('form_detail') ||
                    title.includes('detail') ||
                    title.includes('lihat') ||
                    html.includes('file-text') ||
                    html.includes('bi-file-text')
                ) {
                    warna = '#3b82f6';
                }

                $btn.addClass('aksi-warna-final').attr('style', function (_, oldStyle) {
                    return oldStyle || '';
                }).css({
                    width: '34px',
                    height: '34px',
                    minWidth: '34px',
                    minHeight: '34px',
                    padding: '0',
                    margin: '0 3px 0 0',
                    display: 'inline-flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    color: '#ffffff',
                    backgroundColor: warna,
                    borderColor: warna,
                    borderWidth: '0',
                    borderStyle: 'solid',
                    borderRadius: '8px',
                    boxShadow: '0 5px 12px rgba(15, 23, 42, .12)',
                    lineHeight: '1',
                    verticalAlign: 'middle'
                });

                $btn.find('i, .bi, span').css({
                    color: '#ffffff',
                    fontSize: '15px',
                    lineHeight: '1',
                    margin: '0',
                    padding: '0'
                });
            });
        }

        $(document).ready(function () {
            warnaTombolAksiPendaftaran();

            $('#example').on('draw.dt init.dt xhr.dt responsive-display.dt column-visibility.dt', function () {
                warnaTombolAksiPendaftaran();
                setTimeout(warnaTombolAksiPendaftaran, 50);
            });

            const tableTarget = document.getElementById('example');
            if (tableTarget) {
                const observer = new MutationObserver(function () {
                    warnaTombolAksiPendaftaran();
                });
                observer.observe(tableTarget, { childList: true, subtree: true });
            }

            setTimeout(warnaTombolAksiPendaftaran, 100);
            setTimeout(warnaTombolAksiPendaftaran, 300);
            setTimeout(warnaTombolAksiPendaftaran, 700);
            setTimeout(warnaTombolAksiPendaftaran, 1200);
        });
    </script>
@endsection
