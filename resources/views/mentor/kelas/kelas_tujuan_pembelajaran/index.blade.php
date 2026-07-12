@extends('mentor.layouts.index')


@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/buttons.dataTables.min.css') }}">

    <style>
        /* =========================================================
           TUJUAN PEMBELAJARAN - SIMPLE, FLAT, RESPONSIVE
           Hanya tampilan. Route, ID, Blade, dan JavaScript tetap.
        ========================================================= */
        .kelas-builder-page {
            --page-primary: #074366;
            --page-primary-dark: #052f49;
            --page-text: #111827;
            --page-muted: #64748b;
            --page-border: #e5e7eb;
            --page-soft: #f8fafc;
            --page-white: #ffffff;
            --page-success: #10b981;
            --page-warning: #f59e0b;
            --page-danger: #ef4444;
            padding: 0 24px 28px;
            color: var(--page-text);
        }

        .kelas-builder-shell {
            max-width: 1480px;
            margin: 0 auto;
        }

        .neo-card {
            overflow: hidden;
            background: var(--page-white);
            border: 1px solid #eef2f7;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(15, 23, 42, .06);
        }

        /* Hero */
        .hero-banner {
            min-height: 220px;
            position: relative;
            background-position: center;
            background-size: cover;
        }

        .hero-banner::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(15, 23, 42, .20);
        }

        .hero-body,
        .content-body {
            padding: 22px;
            background: var(--page-white);
        }

        .hero-top,
        .content-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .kelas-title {
            margin: 0;
            color: var(--page-text);
            font-size: 24px;
            line-height: 1.3;
            font-weight: 800;
        }

        .kelas-owner,
        .muted-text {
            color: var(--page-muted);
            font-weight: 600;
        }

        .kelas-owner span {
            color: var(--page-text);
            font-weight: 800;
        }

        .stars {
            display: flex;
            align-items: center;
            gap: 3px;
            color: var(--page-warning);
        }

        .stars .bi-star {
            color: #cbd5e1;
        }

        .rating-number {
            margin-left: 8px;
            color: var(--page-text);
            font-weight: 800;
        }

        .short-desc {
            max-width: 920px;
            margin: 16px 0 0;
            color: var(--page-muted);
            line-height: 1.65;
            font-weight: 600;
        }

        /* Informasi ringkas */
        .stat-row,
        .meta-row,
        .action-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .stat-row {
            margin-top: 22px;
        }

        .stat-item {
            min-width: 185px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px;
            background: var(--page-soft);
            border: 1px solid var(--page-border);
            border-radius: 10px;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            min-width: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--page-primary);
            background: var(--page-white);
            border: 1px solid var(--page-border);
            border-radius: 8px;
            font-size: 18px;
        }

        .stat-value {
            color: var(--page-text);
            font-size: 15px;
            line-height: 1.2;
            font-weight: 800;
        }

        .stat-label {
            margin-top: 3px;
            color: var(--page-muted);
            font-size: 12px;
            font-weight: 600;
        }

        .badge-neo,
        .kelas-builder-page .badge {
            min-height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 10px;
            color: #334155 !important;
            background: var(--page-soft) !important;
            border: 1px solid var(--page-border) !important;
            border-radius: 999px;
            box-shadow: none !important;
            font-size: 12px;
            line-height: 1;
            font-weight: 700;
        }

        /* Navigasi tab */
        .tabs-card {
            padding: 14px 16px 0;
            background: var(--page-white);
            border-bottom: 1px solid #eef2f7;
        }

        .tabs-scroll {
            width: 100%;
            overflow-x: auto;
            padding-bottom: 12px;
        }

        .neo-tabs {
            min-width: max-content;
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
            padding: 0;
            list-style: none;
            border: 0 !important;
        }

        .neo-tabs .nav-item {
            margin: 0 !important;
        }

        .neo-tabs .nav-link {
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 !important;
            padding: 9px 13px !important;
            color: var(--page-muted) !important;
            background: var(--page-white) !important;
            border: 1px solid var(--page-border) !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-size: 13px;
            line-height: 1;
            font-weight: 700;
            white-space: nowrap;
        }

        .neo-tabs .nav-link:hover {
            color: var(--page-primary) !important;
            background: var(--page-soft) !important;
            border-color: #cbd5e1 !important;
        }

        .neo-tabs .nav-link.active {
            color: #ffffff !important;
            background: var(--page-primary) !important;
            border-color: var(--page-primary) !important;
        }

        /* Judul isi */
        .section-title {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
            color: var(--page-text);
            font-size: 16px;
            font-weight: 800;
        }

        .section-title i {
            color: var(--page-primary);
        }

        .kelas-builder-page h2,
        .kelas-builder-page h3,
        .kelas-builder-page .text-gray-900,
        .kelas-builder-page .text-gray-800 {
            color: var(--page-text) !important;
        }

        .kelas-builder-page .text-muted,
        .kelas-builder-page .text-gray-700,
        .kelas-builder-page .text-gray-500,
        .kelas-builder-page .text-gray-400 {
            color: var(--page-muted) !important;
        }

        /* Tombol */
        .kelas-builder-page .btn,
        .kelas-builder-page .dt-button,
        .kelas-builder-page .dataTables_wrapper .btn {
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 8px 14px !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-size: 13px;
            line-height: 1;
            font-weight: 700 !important;
            transition: background .18s ease, border-color .18s ease;
        }

        .kelas-builder-page .btn-primary,
        .kelas-builder-page .btn.btn-primary {
            color: #ffffff !important;
            background: var(--page-primary) !important;
            border: 1px solid var(--page-primary) !important;
        }

        .kelas-builder-page .btn-primary:hover,
        .kelas-builder-page .btn-primary:focus {
            color: #ffffff !important;
            background: var(--page-primary-dark) !important;
            border-color: var(--page-primary-dark) !important;
        }

        .kelas-builder-page .btn-light,
        .kelas-builder-page .btn-secondary {
            color: #475569 !important;
            background: var(--page-white) !important;
            border: 1px solid var(--page-border) !important;
        }

        .kelas-builder-page .btn-light:hover,
        .kelas-builder-page .btn-secondary:hover {
            color: var(--page-text) !important;
            background: var(--page-soft) !important;
            border-color: #cbd5e1 !important;
        }

        /* Tabel */
        .kelas-builder-page .table-responsive {
            width: 100%;
            padding: 0 !important;
            overflow-x: auto;
            background: var(--page-white) !important;
            border: 1px solid var(--page-border) !important;
            border-radius: 10px !important;
            box-shadow: none !important;
        }

        .kelas-builder-page table.dataTable,
        .kelas-builder-page .table {
            width: 100% !important;
            margin: 0 !important;
            border-collapse: collapse !important;
            border-spacing: 0 !important;
        }

        .kelas-builder-page .table thead th,
        .kelas-builder-page table.dataTable thead th {
            padding: 12px 14px !important;
            color: var(--page-muted) !important;
            background: var(--page-soft) !important;
            border-top: 0 !important;
            border-bottom: 1px solid var(--page-border) !important;
            font-size: 12px !important;
            font-weight: 800 !important;
            letter-spacing: .04em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .kelas-builder-page .table tbody tr {
            background: var(--page-white) !important;
        }

        .kelas-builder-page .table tbody tr:hover td {
            background: var(--page-soft) !important;
        }

        .kelas-builder-page .table tbody td {
            padding: 12px 14px !important;
            color: var(--page-text) !important;
            background: var(--page-white);
            border-top: 0 !important;
            border-bottom: 1px solid #eef2f7 !important;
            vertical-align: middle !important;
        }

        .kelas-builder-page .table tbody tr:last-child td {
            border-bottom: 0 !important;
        }

        /* DataTables */
        .kelas-builder-page .dataTables_wrapper {
            padding: 16px;
            color: var(--page-text);
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_length,
        .kelas-builder-page .dataTables_wrapper .dataTables_filter,
        .kelas-builder-page .dataTables_wrapper .dataTables_info,
        .kelas-builder-page .dataTables_wrapper .dataTables_paginate {
            color: var(--page-muted) !important;
            font-size: 13px;
            font-weight: 600;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_length label,
        .kelas-builder-page .dataTables_wrapper .dataTables_filter label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_length select,
        .kelas-builder-page .dataTables_wrapper .dataTables_filter input,
        .kelas-builder-page .form-control,
        .kelas-builder-page .form-select {
            min-height: 38px;
            padding: 7px 10px !important;
            color: var(--page-text) !important;
            background: var(--page-white) !important;
            border: 1px solid var(--page-border) !important;
            border-radius: 8px !important;
            outline: none !important;
            box-shadow: none !important;
            font-size: 13px;
            font-weight: 600;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_length select:focus,
        .kelas-builder-page .dataTables_wrapper .dataTables_filter input:focus,
        .kelas-builder-page .form-control:focus,
        .kelas-builder-page .form-select:focus {
            border-color: var(--page-primary) !important;
            box-shadow: 0 0 0 .2rem rgba(7, 67, 102, .10) !important;
        }

        .kelas-builder-page .dataTables_wrapper .pagination {
            gap: 4px;
            margin-bottom: 0;
            justify-content: flex-end;
        }

        .kelas-builder-page .dataTables_wrapper .page-link,
        .kelas-builder-page .paginate_button {
            min-width: 34px;
            height: 34px;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            color: var(--page-muted) !important;
            background: var(--page-white) !important;
            border: 1px solid var(--page-border) !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-weight: 700;
        }

        .kelas-builder-page .dataTables_wrapper .page-item.active .page-link,
        .kelas-builder-page .dataTables_wrapper .paginate_button.current {
            color: #ffffff !important;
            background: var(--page-primary) !important;
            border-color: var(--page-primary) !important;
        }

        table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control::before,
        table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control::before {
            background: var(--page-primary) !important;
            border: 0 !important;
            box-shadow: none !important;
        }

        /* Modal create, edit, detail */
        #form_create .modal-content,
        #form_edit .modal-content,
        #form_detail .modal-content {
            overflow: hidden;
            color: var(--page-text);
            background: var(--page-white) !important;
            border: 0 !important;
            border-radius: 12px !important;
            box-shadow: 0 18px 45px rgba(15, 23, 42, .16) !important;
        }

        #form_create .modal-header,
        #form_edit .modal-header,
        #form_detail .modal-header {
            padding: 16px 20px;
            background: var(--page-white) !important;
            border-bottom: 1px solid #eef2f7 !important;
        }

        #form_create .modal-body,
        #form_edit .modal-body,
        #form_detail .modal-body {
            padding: 22px;
            background: var(--page-white) !important;
        }

        #form_create .modal-footer,
        #form_edit .modal-footer,
        #form_detail .modal-footer {
            gap: 8px;
            padding: 14px 20px 18px;
            background: var(--page-white) !important;
            border-top: 1px solid #eef2f7 !important;
        }

        #form_create .modal-title,
        #form_edit .modal-title,
        #form_detail .modal-title {
            color: var(--page-text) !important;
            font-size: 18px;
            font-weight: 800 !important;
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

        #form_create .form-control,
        #form_create .form-select,
        #form_edit .form-control,
        #form_edit .form-select,
        #form_detail .form-control,
        #form_detail .form-select,
        #form_create textarea,
        #form_edit textarea,
        #form_detail textarea {
            min-height: 42px;
            color: var(--page-text) !important;
            background: var(--page-white) !important;
            border: 1px solid var(--page-border) !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-size: 14px;
            font-weight: 600;
        }

        #form_create .form-control:focus,
        #form_create .form-select:focus,
        #form_edit .form-control:focus,
        #form_edit .form-select:focus,
        #form_detail .form-control:focus,
        #form_detail .form-select:focus {
            border-color: var(--page-primary) !important;
            box-shadow: 0 0 0 .2rem rgba(7, 67, 102, .10) !important;
        }

        #form_create .modal-footer .btn-light,
        #form_edit .modal-footer .btn-light,
        #form_detail .modal-footer .btn-light {
            color: #ffffff !important;
            background: var(--page-danger) !important;
            border: 1px solid var(--page-danger) !important;
        }

        #form_create .modal-footer .btn-primary,
        #form_edit .modal-footer .btn-primary,
        #form_detail .modal-footer .btn-primary {
            color: #ffffff !important;
            background: var(--page-primary) !important;
            border: 1px solid var(--page-primary) !important;
        }

        .modal-backdrop.show {
            opacity: .34 !important;
            background: #0f172a !important;
        }

        /* SweetAlert dibuat eksplisit agar tombol selalu terlihat */
        .swal2-container .swal2-popup {
            color: #111827 !important;
            background: #ffffff !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 12px !important;
            box-shadow: 0 18px 45px rgba(15, 23, 42, .16) !important;
        }

        .swal2-container .swal2-title {
            color: #111827 !important;
            font-weight: 800 !important;
        }

        .swal2-container .swal2-html-container {
            color: #475569 !important;
            font-weight: 600 !important;
        }

        .swal2-container .swal2-confirm,
        .swal2-container .swal2-cancel {
            min-height: 40px;
            padding: 9px 18px !important;
            color: #ffffff !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-weight: 700 !important;
        }

        .swal2-container .swal2-confirm {
            background: #074366 !important;
            border: 1px solid #074366 !important;
        }

        .swal2-container .swal2-cancel {
            background: #ef4444 !important;
            border: 1px solid #ef4444 !important;
        }

        @media (max-width: 767.98px) {
            .kelas-builder-page {
                padding: 0 16px 24px;
            }

            .hero-top,
            .content-header {
                flex-direction: column;
                align-items: stretch;
            }

            .hero-body,
            .content-body {
                padding: 16px;
            }

            .content-header .btn,
            .kelas-builder-page .btn {
                width: 100%;
            }

            .stat-item {
                min-width: 100%;
            }

            .kelas-builder-page .dataTables_wrapper .dataTables_length label,
            .kelas-builder-page .dataTables_wrapper .dataTables_filter label {
                align-items: flex-start;
                flex-direction: column;
            }

            .kelas-builder-page .dataTables_wrapper .dataTables_filter input {
                width: 100% !important;
                margin-left: 0 !important;
            }

            .kelas-builder-page .dataTables_wrapper .pagination {
                justify-content: flex-start;
                flex-wrap: wrap;
            }

            #form_create .modal-footer,
            #form_edit .modal-footer,
            #form_detail .modal-footer {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            #form_create .modal-footer .btn,
            #form_edit .modal-footer .btn,
            #form_detail .modal-footer .btn {
                width: 100%;
            }
        }

        /* =========================================================
           FINAL ADMIN-LIKE TABLE TOOLBAR
           Excel di kiri, pencarian di kanan.
        ========================================================= */
        .kelas-builder-page .dataTables_wrapper::after {
            content: "";
            display: block;
            clear: both;
        }

        .kelas-builder-page .dataTables_wrapper > .dt-buttons,
        .kelas-builder-page .dataTables_wrapper .dt-buttons {
            float: left !important;
            display: inline-flex !important;
            align-items: center !important;
            flex-wrap: wrap !important;
            gap: 8px !important;
            margin-bottom: 14px !important;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_filter {
            float: right !important;
            margin-bottom: 14px !important;
            text-align: right !important;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_filter label {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: flex-end !important;
            flex-direction: row !important;
            gap: 8px !important;
            margin-bottom: 0 !important;
            white-space: nowrap;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_filter input {
            width: 230px !important;
            margin-left: 6px !important;
        }

        .kelas-builder-page .dataTables_wrapper .buttons-excel,
        .kelas-builder-page .dataTables_wrapper .buttons-excelHtml5,
        .kelas-builder-page .dataTables_wrapper .dt-button.buttons-excel {
            color: #ffffff !important;
            background: #10b981 !important;
            border: 1px solid #10b981 !important;
            box-shadow: none !important;
        }

        .kelas-builder-page .dataTables_wrapper .buttons-excel:hover,
        .kelas-builder-page .dataTables_wrapper .buttons-excelHtml5:hover,
        .kelas-builder-page .dataTables_wrapper .dt-button.buttons-excel:hover {
            color: #ffffff !important;
            background: #059669 !important;
            border-color: #059669 !important;
        }

        /* =========================================================
           FINAL ACTION BUTTONS
           Detail biru, edit kuning, hapus merah.
        ========================================================= */
        .kelas-builder-page #tujuan_table th:first-child,
        .kelas-builder-page #tujuan_table td:first-child {
            width: 150px !important;
            min-width: 150px !important;
            padding-left: 12px !important;
            padding-right: 12px !important;
            text-align: center !important;
            white-space: nowrap !important;
        }

        .kelas-builder-page #tujuan_table td:first-child .btn,
        .kelas-builder-page #tujuan_table td:first-child button,
        .kelas-builder-page #tujuan_table td:first-child a {
            width: 36px !important;
            height: 36px !important;
            min-width: 36px !important;
            min-height: 36px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 3px !important;
            padding: 0 !important;
            color: #ffffff !important;
            background: #3b82f6 !important;
            border: 1px solid #3b82f6 !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-size: 14px !important;
            line-height: 1 !important;
            vertical-align: middle !important;
            text-decoration: none !important;
            transform: none !important;
        }

        .kelas-builder-page #tujuan_table td:first-child .btn i,
        .kelas-builder-page #tujuan_table td:first-child button i,
        .kelas-builder-page #tujuan_table td:first-child a i,
        .kelas-builder-page #tujuan_table td:first-child .bi,
        .kelas-builder-page #tujuan_table td:first-child [class*="fa"],
        .kelas-builder-page #tujuan_table td:first-child [class*="ki-"],
        .kelas-builder-page #tujuan_table td:first-child svg {
            color: #ffffff !important;
            fill: #ffffff !important;
            font-size: 15px !important;
            line-height: 1 !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .kelas-builder-page #tujuan_table td:first-child .aksi-detail {
            color: #ffffff !important;
            background: #3b82f6 !important;
            border-color: #3b82f6 !important;
        }

        .kelas-builder-page #tujuan_table td:first-child .aksi-edit {
            color: #ffffff !important;
            background: #f59e0b !important;
            border-color: #f59e0b !important;
        }

        .kelas-builder-page #tujuan_table td:first-child .aksi-delete {
            color: #ffffff !important;
            background: #ef4444 !important;
            border-color: #ef4444 !important;
        }

        .kelas-builder-page #tujuan_table td:first-child .aksi-detail:hover {
            background: #2563eb !important;
            border-color: #2563eb !important;
            transform: translateY(-1px) !important;
        }

        .kelas-builder-page #tujuan_table td:first-child .aksi-edit:hover {
            background: #d97706 !important;
            border-color: #d97706 !important;
            transform: translateY(-1px) !important;
        }

        .kelas-builder-page #tujuan_table td:first-child .aksi-delete:hover {
            background: #dc2626 !important;
            border-color: #dc2626 !important;
            transform: translateY(-1px) !important;
        }

        @media (max-width: 767.98px) {
            .kelas-builder-page .dataTables_wrapper > .dt-buttons,
            .kelas-builder-page .dataTables_wrapper .dt-buttons,
            .kelas-builder-page .dataTables_wrapper .dataTables_filter {
                float: none !important;
                width: 100% !important;
                display: flex !important;
                justify-content: flex-start !important;
                margin-bottom: 10px !important;
                text-align: left !important;
            }

            .kelas-builder-page .dataTables_wrapper .dataTables_filter label {
                width: 100% !important;
                display: flex !important;
                align-items: flex-start !important;
                justify-content: flex-start !important;
                flex-direction: column !important;
            }

            .kelas-builder-page .dataTables_wrapper .dataTables_filter input {
                width: 100% !important;
                margin-left: 0 !important;
            }

            .kelas-builder-page #tujuan_table th:first-child,
            .kelas-builder-page #tujuan_table td:first-child {
                width: 140px !important;
                min-width: 140px !important;
            }

            .kelas-builder-page #tujuan_table td:first-child .btn,
            .kelas-builder-page #tujuan_table td:first-child button,
            .kelas-builder-page #tujuan_table td:first-child a {
                width: 34px !important;
                height: 34px !important;
                min-width: 34px !important;
                min-height: 34px !important;
                margin: 0 2px !important;
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
    <div class="container-fluid kelas-builder-page kelas-admin-neo-page">
        @php
            $bannerUrl = $kelas->banner
                ? route('view-file', ['banner', $kelas->banner])
                : asset('assets/media/logos/banner-default.jpg');

            $avgRating = $kelas->rating ?? 0;
            $fullStars = floor($avgRating);
            $hasHalfStar = $avgRating - $fullStars >= 0.5;
            $ratingLabel = $avgRating >= 4.5 ? 'Sangat Baik' : ($avgRating >= 3.5 ? 'Baik' : ($avgRating > 0 ? 'Cukup' : 'Belum ada rating'));
        @endphp

        <div class="kelas-builder-shell">
            <div class="d-flex flex-column gap-5">
                <div class="neo-card">
                    <div class="hero-banner" style="background-image: url('{{ $bannerUrl }}');"></div>

                    <div class="hero-body">
                        <div class="hero-top">
                            <div>
                                <h2 class="kelas-title">{{ $kelas->judul ?? 'Judul tidak tersedia' }}</h2>
                                <div class="kelas-owner mt-2">
                                    Oleh: <span>{{ $kelas->pemilik ?? 'Pemilik tidak tersedia' }}</span>
                                </div>
                            </div>

                            <div>
                                <div class="stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $fullStars)
                                            <i class="bi bi-star-fill fs-5"></i>
                                        @elseif ($hasHalfStar && $i === $fullStars + 1)
                                            <i class="bi bi-star-half fs-5"></i>
                                        @else
                                            <i class="bi bi-star fs-5"></i>
                                        @endif
                                    @endfor
                                    <span class="rating-number">{{ number_format($avgRating, 1) }}</span>
                                </div>

                                <div class="meta-row justify-content-end mt-2">
                                    <span class="badge-neo">{{ $ratingLabel }}</span>
                                    <span class="muted-text fs-8">{{ $kelas->total_review ?? 0 }} ulasan</span>
                                </div>
                            </div>
                        </div>

                        @if (!empty($kelas->deskripsi_singkat))
                            <p class="short-desc">{{ $kelas->deskripsi_singkat }}</p>
                        @endif

                        <div class="stat-row">
                            <div class="stat-item">
                                <span class="stat-icon"><i class="bi bi-journal-text"></i></span>
                                <div>
                                    <div class="stat-value">{{ $kelas->jumlah_materi ?? 0 }}</div>
                                    <div class="stat-label">Jumlah Materi</div>
                                </div>
                            </div>

                            <div class="stat-item">
                                <span class="stat-icon"><i class="bi bi-clock-history"></i></span>
                                <div>
                                    <div class="stat-value">{{ $kelas->total_durasi_menit ?? 0 }} menit</div>
                                    <div class="stat-label">Durasi Total</div>
                                </div>
                            </div>

                            <div class="stat-item">
                                <span class="stat-icon"><i class="bi bi-people"></i></span>
                                <div>
                                    <div class="stat-value">{{ $kelas->total_pendaftaran ?? 0 }}</div>
                                    <div class="stat-label">Total Pendaftar</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="neo-card">
                    <div class="tabs-card">
                        <div class="tabs-scroll">
                            <ul class="neo-tabs">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('mentor.kelas.kelas.histori') ? 'active' : '' }}"
                                       href="{{ route('mentor.kelas.kelas.histori', ['id' => $id]) }}">
                                        Beranda
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('mentor.kelas.mentor.*') ? 'active' : '' }}"
                                       href="{{ route('mentor.kelas.mentor.index', ['id' => $id]) }}">
                                        Mentor
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('mentor.kelas.persyaratan.*') ? 'active' : '' }}"
                                       href="{{ route('mentor.kelas.persyaratan.index', ['id' => $id]) }}">
                                        Persyaratan
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('mentor.kelas.tujuan_pembelajaran.*') ? 'active' : '' }}"
                                       href="{{ route('mentor.kelas.tujuan_pembelajaran.index', ['id' => $id]) }}">
                                        Tujuan Pembelajaran
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('mentor.kelas.target_peserta.*') ? 'active' : '' }}"
                                       href="{{ route('mentor.kelas.target_peserta.index', ['id' => $id]) }}">
                                        Target Peserta
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('mentor.kelas.kelas_tag.*') ? 'active' : '' }}"
                                       href="{{ route('mentor.kelas.kelas_tag.index', ['id' => $id]) }}">
                                        Tag
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('mentor.kelas.usulan_peserta.*') ? 'active' : '' }}"
                                       href="{{ route('mentor.kelas.usulan_peserta.index', ['id' => $id]) }}">
                                        Ulasan Peserta
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="content-body">
                <div class="content-header mb-5">
                    <h3 class="section-title mb-0">
                        <i class="bi bi-bullseye"></i>
                        Tujuan Pembelajaran
                    </h3>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#form_create">
                        Tambah Tujuan
                    </button>
                </div>

                <div
                    class="table-responsive mb-8  p-4 mx-0 border-hover-dark border-primary border-1 fs-sm-8 fs-lg-6 rounded-2">
                    <table id="tujuan_table"
                        class="table table-sm align-middle table-row-bordered table-row-solid gs-0 gy-2">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0 fs-sm-8 fs-lg-6">
                                <th class="min-w-125px ps-5 text-nowrap">Aksi</th>
                                <th class="min-w-80px">Urutan</th>
                                <th class="min-w-300px">Tujuan Pembelajaran</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 fw-bolder fs-sm-8 fs-lg-6">
                        </tbody>
                    </table>
                </div>                    </div>
                </div>
            </div>
        </div>

    @include('mentor.kelas.kelas_tujuan_pembelajaran.view.create')
    @include('mentor.kelas.kelas_tujuan_pembelajaran.view.edit')
    @include('mentor.kelas.kelas_tujuan_pembelajaran.view.detail')
    </div>
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
    @include('mentor.kelas.kelas_tujuan_pembelajaran.script.list')
    @include('mentor.kelas.kelas_tujuan_pembelajaran.script.create')
    @include('mentor.kelas.kelas_tujuan_pembelajaran.script.edit')
    @include('mentor.kelas.kelas_tujuan_pembelajaran.script.detail')
    @include('mentor.kelas.kelas_tujuan_pembelajaran.script.delete')

    <script>
        function mentorSetImportantStyle(element, property, value) {
            if (!element || !element.style) {
                return;
            }

            element.style.setProperty(property, value, 'important');
        }

        function warnaTombolAksiTujuanMentor() {
            $('#tujuan_table tbody tr').each(function () {
                const $buttons = $(this).find(
                    'td:first-child .btn, td:first-child button, td:first-child a'
                );

                $buttons.each(function (index) {
                    const button = this;
                    const $btn = $(button);

                    const identity = [
                        String($btn.html() || ''),
                        String($btn.text() || ''),
                        String($btn.attr('title') || ''),
                        String($btn.attr('aria-label') || ''),
                        String($btn.attr('data-bs-target') || $btn.attr('data-target') || ''),
                        String($btn.attr('onclick') || ''),
                        String($btn.attr('href') || ''),
                        String($btn.attr('class') || ''),
                        String($btn.find('i').attr('class') || '')
                    ].join(' ').toLowerCase();

                    let actionClass = 'aksi-detail';
                    let color = '#3b82f6';

                    const isDelete =
                        identity.includes('delete') ||
                        identity.includes('hapus') ||
                        identity.includes('destroy') ||
                        identity.includes('remove') ||
                        identity.includes('trash') ||
                        identity.includes('danger');

                    const isEdit =
                        identity.includes('form_edit') ||
                        identity.includes('edit') ||
                        identity.includes('ubah') ||
                        identity.includes('pencil') ||
                        identity.includes('pen') ||
                        identity.includes('warning');

                    const isDetail =
                        identity.includes('form_detail') ||
                        identity.includes('detail') ||
                        identity.includes('lihat') ||
                        identity.includes('show') ||
                        identity.includes('eye');

                    if (isDelete) {
                        actionClass = 'aksi-delete';
                        color = '#ef4444';
                    } else if (isEdit) {
                        actionClass = 'aksi-edit';
                        color = '#f59e0b';
                    } else if (isDetail) {
                        actionClass = 'aksi-detail';
                        color = '#3b82f6';
                    } else if ($buttons.length >= 3) {
                        if (index === 1) {
                            actionClass = 'aksi-edit';
                            color = '#f59e0b';
                        } else if (index === 2) {
                            actionClass = 'aksi-delete';
                            color = '#ef4444';
                        }
                    }

                    $btn
                        .removeClass(
                            'btn-primary btn-info btn-warning btn-danger btn-success ' +
                            'btn-secondary btn-light btn-dark aksi-detail aksi-edit aksi-delete'
                        )
                        .addClass(actionClass);

                    mentorSetImportantStyle(button, 'width', '36px');
                    mentorSetImportantStyle(button, 'height', '36px');
                    mentorSetImportantStyle(button, 'min-width', '36px');
                    mentorSetImportantStyle(button, 'min-height', '36px');
                    mentorSetImportantStyle(button, 'padding', '0');
                    mentorSetImportantStyle(button, 'margin', '0 3px');
                    mentorSetImportantStyle(button, 'display', 'inline-flex');
                    mentorSetImportantStyle(button, 'align-items', 'center');
                    mentorSetImportantStyle(button, 'justify-content', 'center');
                    mentorSetImportantStyle(button, 'color', '#ffffff');
                    mentorSetImportantStyle(button, 'background', color);
                    mentorSetImportantStyle(button, 'background-color', color);
                    mentorSetImportantStyle(button, 'border-color', color);
                    mentorSetImportantStyle(button, 'border-radius', '8px');
                    mentorSetImportantStyle(button, 'box-shadow', 'none');

                    $btn.find('i, .bi, [class*="fa"], [class*="ki-"], svg').each(function () {
                        mentorSetImportantStyle(this, 'color', '#ffffff');
                        mentorSetImportantStyle(this, 'fill', '#ffffff');
                        mentorSetImportantStyle(this, 'font-size', '15px');
                        mentorSetImportantStyle(this, 'margin', '0');
                        mentorSetImportantStyle(this, 'padding', '0');
                        mentorSetImportantStyle(this, 'line-height', '1');
                    });
                });
            });
        }

        function rapikanToolbarTujuanMentor() {
            const $wrapper = $('#tujuan_table_wrapper');

            if (!$wrapper.length) {
                return;
            }

            const $buttons = $wrapper.find('.dt-buttons');
            const $filter = $wrapper.find('.dataTables_filter');

            $buttons.css({
                float: 'left'
            });

            $filter.css({
                float: 'right',
                textAlign: 'right'
            });
        }

        $(document).ready(function () {
            warnaTombolAksiTujuanMentor();
            rapikanToolbarTujuanMentor();

            $('#tujuan_table').on(
                'draw.dt init.dt xhr.dt responsive-display.dt',
                function () {
                    warnaTombolAksiTujuanMentor();
                    rapikanToolbarTujuanMentor();
                }
            );

            const tableBody = document.querySelector('#tujuan_table tbody');

            if (tableBody) {
                const observer = new MutationObserver(function () {
                    warnaTombolAksiTujuanMentor();
                    rapikanToolbarTujuanMentor();
                });

                observer.observe(tableBody, {
                    childList: true,
                    subtree: true
                });
            }

            setTimeout(function () {
                warnaTombolAksiTujuanMentor();
                rapikanToolbarTujuanMentor();
            }, 150);

            setTimeout(function () {
                warnaTombolAksiTujuanMentor();
                rapikanToolbarTujuanMentor();
            }, 500);

            setTimeout(function () {
                warnaTombolAksiTujuanMentor();
                rapikanToolbarTujuanMentor();
            }, 1000);
        });
    </script>

@endsection
