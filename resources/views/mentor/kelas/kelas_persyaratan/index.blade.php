@extends('mentor.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/buttons.dataTables.min.css') }}">

    <style>
        /* =========================================================
           PERSYARATAN KELAS MENTOR
           Tampilan simple seperti admin
           Visual only - fungsi, route, id, include tetap mentor
        ========================================================= */

        .kelas-builder-page {
            --page-primary: #074366;
            --page-primary-dark: #052f49;
            --page-info: #3b82f6;
            --page-success: #10b981;
            --page-warning: #f59e0b;
            --page-danger: #ef4444;
            --page-text: #111827;
            --page-muted: #64748b;
            --page-border: #e5e7eb;
            --page-soft: #f8fafc;
            --page-white: #ffffff;
            width: 100%;
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

        .hero-banner {
            min-height: 230px;
            background-size: cover;
            background-position: center;
            position: relative;
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
        }

        .hero-top,
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
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
        .muted-text,
        .kelas-builder-page .text-muted,
        .kelas-builder-page .text-gray-700,
        .kelas-builder-page .text-gray-500,
        .kelas-builder-page .text-gray-400 {
            color: var(--page-muted) !important;
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
            box-shadow: none;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            min-width: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--page-primary);
            background: #ffffff;
            border: 1px solid var(--page-border);
            border-radius: 8px;
            box-shadow: none;
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
        .kelas-builder-page .badge,
        .kelas-builder-page .badge-light-success,
        .kelas-builder-page .badge-light-primary,
        .kelas-builder-page .badge-light-warning,
        .kelas-builder-page .badge-light-danger,
        .kelas-builder-page .badge-light-info {
            min-height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 10px;
            color: #334155 !important;
            background: var(--page-soft) !important;
            border: 1px solid var(--page-border);
            border-radius: 999px;
            box-shadow: none;
            font-size: 12px;
            line-height: 1;
            font-weight: 700;
        }

        .tabs-card {
            padding: 14px 16px 0;
            background: var(--page-white);
            border-bottom: 1px solid #eef2f7;
        }

        .tabs-scroll {
            width: 100%;
            overflow-x: auto;
            padding-bottom: 12px;
            scrollbar-width: thin;
        }

        .tabs-scroll::-webkit-scrollbar {
            height: 6px;
        }

        .tabs-scroll::-webkit-scrollbar-thumb {
            border-radius: 999px;
            background: #cbd5e1;
        }

        .neo-tabs {
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: max-content;
            margin: 0;
            padding: 0;
            list-style: none;
            border: 0 !important;
        }

        .neo-tabs .nav-item {
            margin: 0 !important;
            padding: 0 !important;
        }

        .neo-tabs .nav-link,
        .kelas-builder-page .nav-line-tabs .nav-link {
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 !important;
            padding: 9px 13px !important;
            color: var(--page-muted) !important;
            background: #ffffff !important;
            border: 1px solid var(--page-border) !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-size: 13px;
            line-height: 1;
            font-weight: 700;
            white-space: nowrap;
            transition: background .18s ease, border-color .18s ease, color .18s ease;
        }

        .neo-tabs .nav-link:hover {
            color: var(--page-primary) !important;
            background: var(--page-soft) !important;
            border-color: #cbd5e1 !important;
            transform: none;
        }

        .neo-tabs .nav-link.active {
            color: #ffffff !important;
            background: var(--page-primary) !important;
            border-color: var(--page-primary) !important;
        }

        .section-title,
        .content-body h3,
        .kelas-builder-page .text-gray-900,
        .kelas-builder-page .text-gray-800,
        .kelas-builder-page h2,
        .kelas-builder-page h3 {
            color: var(--page-text) !important;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
            font-size: 16px;
            font-weight: 800;
        }

        .section-title i {
            color: var(--page-primary);
        }

        .content-header .btn.btn-primary,
        .kelas-builder-page .btn.btn-primary {
            color: #ffffff !important;
            background: var(--page-primary) !important;
            border-color: var(--page-primary) !important;
        }

        .content-header .btn.btn-primary:hover,
        .kelas-builder-page .btn.btn-primary:hover {
            color: #ffffff !important;
            background: var(--page-primary-dark) !important;
            border-color: var(--page-primary-dark) !important;
        }

        .kelas-builder-page .btn,
        .kelas-builder-page .dt-button,
        .kelas-builder-page .dataTables_wrapper .btn {
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 8px 13px !important;
            border: 1px solid var(--page-border) !important;
            border-radius: 8px !important;
            color: #334155 !important;
            background: #ffffff !important;
            box-shadow: none !important;
            font-size: 13px;
            font-weight: 700 !important;
            line-height: 1 !important;
            text-decoration: none !important;
            transition: background .18s ease, border-color .18s ease, color .18s ease;
        }

        .kelas-builder-page .btn:hover,
        .kelas-builder-page .dt-button:hover {
            color: #0f172a !important;
            background: var(--page-soft) !important;
            border-color: #cbd5e1 !important;
            box-shadow: none !important;
            transform: none;
        }

        .kelas-builder-page .table-responsive,
        .kelas-builder-page .persyaratan-table-wrap {
            overflow-x: auto;
            background: #ffffff !important;
            border: 1px solid #eef2f7 !important;
            border-radius: 12px !important;
            padding: 18px !important;
            box-shadow: none !important;
        }

        #persyaratan_table {
            width: 100% !important;
            margin-bottom: 0 !important;
        }

        #persyaratan_table thead th {
            color: var(--page-muted) !important;
            background: #ffffff !important;
            border-bottom: 1px solid #eef2f7 !important;
            font-size: 12px !important;
            font-weight: 800 !important;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
        }

        #persyaratan_table tbody td {
            color: var(--page-text) !important;
            font-size: 14px;
            vertical-align: middle !important;
            border-color: #eef2f7 !important;
        }

        #persyaratan_table tbody tr:hover {
            background: var(--page-soft) !important;
        }

        #persyaratan_table tbody tr:last-child td {
            border-bottom: 0;
        }

        #persyaratan_table td:first-child,
        #persyaratan_table th:first-child {
            white-space: nowrap;
            width: 120px;
        }

        #persyaratan_table td:first-child .btn,
        #persyaratan_table td:first-child a,
        #persyaratan_table td:first-child button {
            width: 34px !important;
            height: 34px !important;
            min-width: 34px !important;
            min-height: 34px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 0 !important;
            border: 0 !important;
            border-radius: 8px !important;
            color: #ffffff !important;
            box-shadow: 0 6px 14px rgba(15, 23, 42, .12) !important;
        }

        #persyaratan_table td:first-child .btn i,
        #persyaratan_table td:first-child a i,
        #persyaratan_table td:first-child button i,
        #persyaratan_table td:first-child svg {
            color: #ffffff !important;
            fill: #ffffff !important;
        }

        #persyaratan_table td:first-child [data-bs-target="#form_detail"],
        #persyaratan_table td:first-child [data-target="#form_detail"] {
            background: var(--page-info) !important;
        }

        #persyaratan_table td:first-child [data-bs-target="#form_edit"],
        #persyaratan_table td:first-child [data-target="#form_edit"] {
            background: var(--page-warning) !important;
        }

        #persyaratan_table td:first-child [onclick*="delete"],
        #persyaratan_table td:first-child [onclick*="Delete"],
        #persyaratan_table td:first-child [onclick*="hapus"],
        #persyaratan_table td:first-child [onclick*="destroy"] {
            background: var(--page-danger) !important;
        }

        .kelas-builder-page .dataTables_wrapper {
            width: 100%;
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
            display: inline-flex !important;
            align-items: center !important;
            gap: 8px !important;
            margin-bottom: 12px !important;
            color: var(--page-muted) !important;
            font-weight: 600 !important;
        }

        .kelas-builder-page .dataTables_wrapper .dt-buttons {
            float: left !important;
            display: inline-flex !important;
            align-items: center;
            gap: 6px;
            margin-bottom: 12px;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_filter {
            float: right !important;
            text-align: right !important;
            margin-bottom: 12px;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_filter input,
        .kelas-builder-page .dataTables_wrapper .dataTables_length select,
        .kelas-builder-page .form-control,
        .kelas-builder-page .form-select {
            min-height: 38px;
            color: var(--page-text) !important;
            background: #ffffff !important;
            border: 1px solid var(--page-border) !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            outline: none !important;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_filter input:focus,
        .kelas-builder-page .dataTables_wrapper .dataTables_length select:focus,
        .kelas-builder-page .form-control:focus,
        .kelas-builder-page .form-select:focus {
            border-color: var(--page-primary) !important;
            box-shadow: 0 0 0 .2rem rgba(7, 67, 102, .10) !important;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_filter input {
            width: 230px !important;
            margin-left: 6px !important;
            padding: 7px 10px !important;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_length select {
            margin: 0 4px;
            padding: 7px 28px 7px 10px !important;
        }

        .kelas-builder-page .dataTables_wrapper .dt-buttons .btn,
        .kelas-builder-page .dataTables_wrapper .dt-button {
            border-radius: 8px !important;
            margin-right: 6px !important;
            font-weight: 700 !important;
        }

        .kelas-builder-page .dataTables_wrapper .dt-buttons .buttons-excel,
        .kelas-builder-page .dataTables_wrapper .dt-buttons .buttons-excelHtml5,
        .kelas-builder-page .dataTables_wrapper .dt-button.buttons-excel,
        .kelas-builder-page .dataTables_wrapper .dt-button.buttons-excelHtml5 {
            color: #ffffff !important;
            background: var(--page-success) !important;
            border-color: var(--page-success) !important;
        }

        .kelas-builder-page .dataTables_wrapper .pagination {
            gap: 4px;
            margin-bottom: 0;
            justify-content: flex-end;
        }

        .kelas-builder-page .dataTables_wrapper .page-link {
            min-width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--page-muted) !important;
            background: #ffffff !important;
            border: 1px solid var(--page-border) !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-weight: 700;
        }

        .kelas-builder-page .dataTables_wrapper .page-item.active .page-link {
            color: #ffffff !important;
            background: var(--page-primary) !important;
            border-color: var(--page-primary) !important;
        }

        .kelas-builder-page .dataTables_wrapper .page-item.disabled .page-link {
            color: #94a3b8 !important;
            background: var(--page-soft) !important;
        }

        .kelas-builder-page .dataTables_wrapper::after {
            content: "";
            display: block;
            clear: both;
        }

        table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control::before,
        table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control::before {
            background: var(--page-primary) !important;
            border: 0 !important;
            box-shadow: none !important;
        }

        /* Modal mengikuti style simple admin */
        #form_create .modal-content,
        #form_edit .modal-content,
        #form_detail .modal-content {
            overflow: hidden;
            background: #ffffff !important;
            border: 0 !important;
            border-radius: 12px !important;
            box-shadow: 0 18px 45px rgba(15, 23, 42, .16) !important;
        }

        #form_create .modal-header,
        #form_edit .modal-header,
        #form_detail .modal-header,
        #form_create .modal-footer,
        #form_edit .modal-footer,
        #form_detail .modal-footer {
            background: #ffffff !important;
            border-color: #eef2f7 !important;
        }

        #form_create .modal-body,
        #form_edit .modal-body,
        #form_detail .modal-body {
            background: #ffffff !important;
        }

        #form_create .modal-title,
        #form_edit .modal-title,
        #form_detail .modal-title {
            color: var(--page-text) !important;
            font-weight: 800 !important;
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
            background: #ffffff !important;
            border: 1px solid var(--page-border) !important;
            border-radius: 8px !important;
            box-shadow: none !important;
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

        #form_create .btn-close,
        #form_edit .btn-close,
        #form_detail .btn-close {
            background-color: transparent !important;
            border: 0 !important;
            box-shadow: none !important;
            opacity: .75;
        }

        #form_create .btn-close:hover,
        #form_edit .btn-close:hover,
        #form_detail .btn-close:hover {
            opacity: 1;
        }

        #form_create .modal-footer .btn-light,
        #form_edit .modal-footer .btn-light,
        #form_detail .modal-footer .btn-light {
            color: #ffffff !important;
            background: var(--page-danger) !important;
            border-color: var(--page-danger) !important;
        }

        #form_create .modal-footer .btn-primary,
        #form_edit .modal-footer .btn-primary,
        #form_detail .modal-footer .btn-primary {
            color: #ffffff !important;
            background: var(--page-primary) !important;
            border-color: var(--page-primary) !important;
        }

        .modal-backdrop.show {
            opacity: .34 !important;
            background: #0f172a !important;
        }

        .swal2-container .swal2-popup {
            color: var(--page-text) !important;
            background: #ffffff !important;
            border: 1px solid var(--page-border) !important;
            border-radius: 12px !important;
            box-shadow: 0 18px 45px rgba(15, 23, 42, .16) !important;
        }

        .swal2-container .swal2-title {
            color: var(--page-text) !important;
            font-weight: 800 !important;
        }

        .swal2-container .swal2-html-container {
            color: #475569 !important;
            font-weight: 600 !important;
        }

        .swal2-container .swal2-confirm,
        .swal2-container .swal2-cancel {
            min-height: 40px;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-weight: 700 !important;
        }

        .swal2-container .swal2-confirm {
            color: #ffffff !important;
            background: var(--page-primary) !important;
            border: 1px solid var(--page-primary) !important;
        }

        .swal2-container .swal2-cancel {
            color: #ffffff !important;
            background: var(--page-danger) !important;
            border: 1px solid var(--page-danger) !important;
        }



        /* =========================================================
           FIX SWEETALERT BUTTONS
           Tombol konfirmasi tambah/hapus harus selalu terlihat
        ========================================================= */
        .swal2-container {
            z-index: 20000 !important;
        }

        .swal2-container .swal2-actions {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 10px !important;
            visibility: visible !important;
            opacity: 1 !important;
            margin-top: 18px !important;
        }

        .swal2-container .swal2-styled,
        .swal2-container button.swal2-confirm,
        .swal2-container button.swal2-cancel,
        .swal2-container .swal2-actions .swal2-confirm,
        .swal2-container .swal2-actions .swal2-cancel {
            min-width: 96px !important;
            min-height: 40px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 9px 16px !important;
            border-radius: 8px !important;
            border: 1px solid transparent !important;
            box-shadow: none !important;
            font-size: 13px !important;
            line-height: 1 !important;
            font-weight: 800 !important;
            opacity: 1 !important;
            visibility: visible !important;
            cursor: pointer !important;
        }

        .swal2-container button.swal2-confirm,
        .swal2-container .swal2-actions .swal2-confirm {
            color: #ffffff !important;
            background-color: #074366 !important;
            border-color: #074366 !important;
        }

        .swal2-container button.swal2-confirm:hover,
        .swal2-container .swal2-actions .swal2-confirm:hover {
            color: #ffffff !important;
            background-color: #052f49 !important;
            border-color: #052f49 !important;
            filter: none !important;
        }

        .swal2-container button.swal2-cancel,
        .swal2-container .swal2-actions .swal2-cancel {
            color: #ffffff !important;
            background-color: #ef4444 !important;
            border-color: #ef4444 !important;
        }

        .swal2-container button.swal2-cancel:hover,
        .swal2-container .swal2-actions .swal2-cancel:hover {
            color: #ffffff !important;
            background-color: #dc2626 !important;
            border-color: #dc2626 !important;
            filter: none !important;
        }

        .swal2-container .swal2-confirm:focus,
        .swal2-container .swal2-cancel:focus {
            box-shadow: 0 0 0 .2rem rgba(7, 67, 102, .15) !important;
        }

        @media (max-width: 991.98px) {
            .kelas-builder-page {
                padding: 0 18px 24px;
            }

            .hero-top,
            .content-header {
                flex-direction: column;
                align-items: stretch;
            }

            .hero-body,
            .content-body {
                padding: 18px;
            }

            .kelas-builder-page .dataTables_wrapper .dt-buttons,
            .kelas-builder-page .dataTables_wrapper .dataTables_filter {
                float: none !important;
                width: 100% !important;
                text-align: left !important;
                display: flex !important;
                justify-content: flex-start !important;
                margin-bottom: 10px !important;
            }

            .kelas-builder-page .dataTables_wrapper .dataTables_filter label {
                width: 100% !important;
                align-items: flex-start !important;
                flex-direction: column !important;
            }

            .kelas-builder-page .dataTables_wrapper .dataTables_filter input {
                width: 100% !important;
                margin-left: 0 !important;
            }

            .kelas-builder-page .dataTables_wrapper .pagination {
                justify-content: flex-start;
                flex-wrap: wrap;
            }
        }

        @media (max-width: 767.98px) {
            .kelas-builder-page {
                padding: 0 14px 22px;
            }

            .kelas-title {
                font-size: 20px;
            }

            .stat-item {
                min-width: 100%;
            }

            .content-header .btn,
            .kelas-builder-page .btn {
                width: 100%;
            }

            .kelas-builder-page .table-responsive,
            .kelas-builder-page .persyaratan-table-wrap {
                padding: 14px !important;
            }
        }
    

        /* =========================================================
           FINAL SWEETALERT FIX - HANYA 2 TOMBOL, TANPA NO
           Deny button SweetAlert dimatikan total.
        ========================================================= */
        body .swal2-container,
        html body .swal2-container {
            z-index: 2147483647 !important;
        }

        body .swal2-popup {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: flex-start !important;
            width: 420px !important;
            max-width: calc(100vw - 32px) !important;
            padding: 28px 28px 24px !important;
            background: #ffffff !important;
            border: 1px solid #eef2f7 !important;
            border-radius: 12px !important;
            box-shadow: 0 18px 45px rgba(15, 23, 42, .16) !important;
            color: #111827 !important;
        }

        body .swal2-icon {
            margin: 0 auto 16px !important;
        }

        body .swal2-title {
            width: 100% !important;
            margin: 0 0 8px !important;
            padding: 0 !important;
            color: #111827 !important;
            text-align: center !important;
            font-size: 22px !important;
            line-height: 1.25 !important;
            font-weight: 800 !important;
        }

        body .swal2-html-container {
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            color: #475569 !important;
            text-align: center !important;
            font-size: 14px !important;
            line-height: 1.5 !important;
            font-weight: 600 !important;
        }

        body .swal2-actions {
            width: 100% !important;
            display: flex !important;
            flex-direction: row !important;
            flex-wrap: nowrap !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 12px !important;
            margin: 22px 0 0 !important;
            padding: 0 !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        body .swal2-actions .swal2-confirm,
        body .swal2-actions .swal2-cancel,
        body button.swal2-confirm,
        body button.swal2-cancel {
            position: relative !important;
            min-width: 116px !important;
            width: auto !important;
            height: 42px !important;
            min-height: 42px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 !important;
            padding: 0 18px !important;
            border: 0 !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            color: #ffffff !important;
            font-size: 14px !important;
            line-height: 1.15 !important;
            font-weight: 800 !important;
            opacity: 1 !important;
            visibility: visible !important;
            pointer-events: auto !important;
            transform: none !important;
            text-indent: 0 !important;
            overflow: visible !important;
        }

        body .swal2-actions .swal2-confirm,
        body button.swal2-confirm {
            background: #074366 !important;
            border-color: #074366 !important;
        }

        body .swal2-actions .swal2-confirm:hover,
        body button.swal2-confirm:hover {
            background: #052f49 !important;
            border-color: #052f49 !important;
        }

        body .swal2-actions .swal2-cancel,
        body button.swal2-cancel {
            background: #ef4444 !important;
            border-color: #ef4444 !important;
        }

        body .swal2-actions .swal2-cancel:hover,
        body button.swal2-cancel:hover {
            background: #dc2626 !important;
            border-color: #dc2626 !important;
        }

        body .swal2-actions .swal2-deny,
        body button.swal2-deny,
        body .swal2-deny,
        body .quick-swal-deny-hidden {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
            width: 0 !important;
            min-width: 0 !important;
            height: 0 !important;
            min-height: 0 !important;
            padding: 0 !important;
            margin: 0 !important;
            border: 0 !important;
            overflow: hidden !important;
            pointer-events: none !important;
        }

        @media (max-width: 575.98px) {
            body .swal2-popup {
                width: calc(100vw - 24px) !important;
                padding: 24px 18px 20px !important;
            }

            body .swal2-actions {
                gap: 10px !important;
            }

            body .swal2-actions .swal2-confirm,
            body .swal2-actions .swal2-cancel,
            body button.swal2-confirm,
            body button.swal2-cancel {
                min-width: 104px !important;
                padding: 0 14px !important;
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
                        <i class="bi bi-clipboard-check"></i>
                        Persyaratan Kelas
                    </h3>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#form_create">
                        Tambah Persyaratan
                    </button>
                </div>

                <div
                    class="table-responsive mb-8  p-4 mx-0 border-hover-dark border-primary border-1  fs-sm-8 fs-lg-6 rounded-2">
                    <table id="persyaratan_table"
                        class="table table-sm align-middle table-row-bordered table-row-solid gs-0 gy-2">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0 fs-sm-8 fs-lg-6">
                                <th class="min-w-125px ps-5 text-nowrap">Aksi</th>
                                <th class="min-w-80px">Urutan</th>
                                <th class="min-w-300px">Persyaratan</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 fw-bolder fs-sm-8 fs-lg-6">
                        </tbody>
                    </table>
                </div>                    </div>
                </div>
            </div>
        </div>

    @include('mentor.kelas.kelas_persyaratan.view.create')
    @include('mentor.kelas.kelas_persyaratan.view.edit')
    @include('mentor.kelas.kelas_persyaratan.view.detail')
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



    <script>
        /* =========================================================
           SWEETALERT GLOBAL FIX
           Matikan tombol deny/NO dari semua Swal.fire di halaman ini.
           Hasil: maksimal 2 tombol: confirm + cancel.
        ========================================================= */
        (function installPersyaratanSwalTwoButtonFix() {
            function forceSweetAlertTwoButtons() {
                const actions = document.querySelector('.swal2-actions');

                document.querySelectorAll('.swal2-deny, button.swal2-deny').forEach((button) => {
                    button.classList.add('quick-swal-deny-hidden');
                    button.style.setProperty('display', 'none', 'important');
                    button.style.setProperty('visibility', 'hidden', 'important');
                    button.style.setProperty('opacity', '0', 'important');
                    button.style.setProperty('width', '0', 'important');
                    button.style.setProperty('min-width', '0', 'important');
                    button.style.setProperty('height', '0', 'important');
                    button.style.setProperty('min-height', '0', 'important');
                    button.style.setProperty('padding', '0', 'important');
                    button.style.setProperty('margin', '0', 'important');
                    button.style.setProperty('overflow', 'hidden', 'important');
                    button.setAttribute('aria-hidden', 'true');
                    button.setAttribute('tabindex', '-1');
                });

                if (actions) {
                    actions.style.setProperty('display', 'flex', 'important');
                    actions.style.setProperty('flex-direction', 'row', 'important');
                    actions.style.setProperty('flex-wrap', 'nowrap', 'important');
                    actions.style.setProperty('justify-content', 'center', 'important');
                    actions.style.setProperty('align-items', 'center', 'important');
                    actions.style.setProperty('gap', '12px', 'important');
                    actions.style.setProperty('width', '100%', 'important');
                    actions.style.setProperty('margin-top', '22px', 'important');
                    actions.style.setProperty('opacity', '1', 'important');
                    actions.style.setProperty('visibility', 'visible', 'important');
                }

                const confirmButton = document.querySelector('.swal2-confirm');
                const cancelButton = document.querySelector('.swal2-cancel');

                const styleButton = (button, background) => {
                    if (!button) return;
                    button.style.setProperty('display', 'inline-flex', 'important');
                    button.style.setProperty('align-items', 'center', 'important');
                    button.style.setProperty('justify-content', 'center', 'important');
                    button.style.setProperty('min-width', '116px', 'important');
                    button.style.setProperty('width', 'auto', 'important');
                    button.style.setProperty('height', '42px', 'important');
                    button.style.setProperty('min-height', '42px', 'important');
                    button.style.setProperty('padding', '0 18px', 'important');
                    button.style.setProperty('margin', '0', 'important');
                    button.style.setProperty('border', '0', 'important');
                    button.style.setProperty('border-radius', '8px', 'important');
                    button.style.setProperty('background', background, 'important');
                    button.style.setProperty('background-color', background, 'important');
                    button.style.setProperty('color', '#ffffff', 'important');
                    button.style.setProperty('font-weight', '800', 'important');
                    button.style.setProperty('font-size', '14px', 'important');
                    button.style.setProperty('line-height', '1.15', 'important');
                    button.style.setProperty('opacity', '1', 'important');
                    button.style.setProperty('visibility', 'visible', 'important');
                    button.style.setProperty('pointer-events', 'auto', 'important');
                    button.style.setProperty('box-shadow', 'none', 'important');
                    button.style.setProperty('transform', 'none', 'important');
                };

                styleButton(confirmButton, '#074366');
                styleButton(cancelButton, '#ef4444');

                if (cancelButton && cancelButton.textContent.trim().toLowerCase() === 'no') {
                    cancelButton.textContent = 'Batal';
                }

                if (actions) {
                    actions.querySelectorAll('button').forEach((button) => {
                        const label = button.textContent.trim().toLowerCase();
                        if (!button.classList.contains('swal2-confirm') && !button.classList.contains('swal2-cancel')) {
                            button.classList.add('quick-swal-deny-hidden');
                            button.style.setProperty('display', 'none', 'important');
                        }

                        if (label === 'no' && !button.classList.contains('swal2-cancel')) {
                            button.classList.add('quick-swal-deny-hidden');
                            button.style.setProperty('display', 'none', 'important');
                        }
                    });
                }
            }

            function normalizeSwalOptions(options) {
                const fixed = {
                    ...options,
                    showDenyButton: false,
                    denyButtonText: '',
                    buttonsStyling: false,
                    reverseButtons: false,
                    customClass: {
                        ...(options.customClass || {}),
                        actions: 'quick-swal-actions',
                        confirmButton: 'quick-swal-confirm',
                        cancelButton: 'quick-swal-cancel',
                        denyButton: 'quick-swal-deny-hidden',
                    },
                };

                if (fixed.showCancelButton === true) {
                    const cancelText = String(fixed.cancelButtonText || '').trim().toLowerCase();
                    if (!cancelText || cancelText === 'no') {
                        fixed.cancelButtonText = 'Batal';
                    }
                }

                const originalDidOpen = fixed.didOpen;
                fixed.didOpen = (popup) => {
                    forceSweetAlertTwoButtons();
                    setTimeout(forceSweetAlertTwoButtons, 0);
                    setTimeout(forceSweetAlertTwoButtons, 80);
                    setTimeout(forceSweetAlertTwoButtons, 200);

                    if (typeof originalDidOpen === 'function') {
                        originalDidOpen(popup);
                    }
                };

                return fixed;
            }

            function install() {
                if (!window.Swal || typeof window.Swal.fire !== 'function' || window.Swal.__persyaratanTwoButtonFixed) {
                    return Boolean(window.Swal && window.Swal.__persyaratanTwoButtonFixed);
                }

                const originalFire = window.Swal.fire.bind(window.Swal);

                window.Swal.fire = function (...args) {
                    if (args.length === 1 && typeof args[0] === 'object' && args[0] !== null) {
                        return originalFire(normalizeSwalOptions(args[0]));
                    }

                    if (typeof args[0] === 'string') {
                        return originalFire(normalizeSwalOptions({
                            title: args[0],
                            text: args[1] || '',
                            icon: args[2] || undefined,
                        }));
                    }

                    return originalFire(...args);
                };

                window.Swal.__persyaratanTwoButtonFixed = true;
                return true;
            }

            if (!install()) {
                const timer = setInterval(() => {
                    if (install()) {
                        clearInterval(timer);
                    }
                }, 50);

                setTimeout(() => clearInterval(timer), 3000);
            }

            document.addEventListener('click', () => setTimeout(forceSweetAlertTwoButtons, 0), true);
            document.addEventListener('keydown', () => setTimeout(forceSweetAlertTwoButtons, 0), true);
        })();
    </script>

    <script>
        function warnaAksiPersyaratanMentor() {
            $('#persyaratan_table tbody td:first-child').find('a, button, .btn').each(function () {
                const btn = this;
                const $btn = $(this);
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

                let bg = '#3b82f6';

                if (identity.includes('delete') || identity.includes('hapus') || identity.includes('trash') || identity.includes('destroy')) {
                    bg = '#ef4444';
                } else if (identity.includes('edit') || identity.includes('ubah') || identity.includes('pencil') || identity.includes('pen')) {
                    bg = '#f59e0b';
                } else if (identity.includes('detail') || identity.includes('lihat') || identity.includes('view') || identity.includes('eye')) {
                    bg = '#3b82f6';
                }

                btn.style.setProperty('background-color', bg, 'important');
                btn.style.setProperty('border-color', bg, 'important');
                btn.style.setProperty('color', '#ffffff', 'important');
                btn.style.setProperty('width', '34px', 'important');
                btn.style.setProperty('height', '34px', 'important');
                btn.style.setProperty('min-width', '34px', 'important');
                btn.style.setProperty('min-height', '34px', 'important');
                btn.style.setProperty('padding', '0', 'important');
                btn.style.setProperty('border-radius', '8px', 'important');
                btn.style.setProperty('display', 'inline-flex', 'important');
                btn.style.setProperty('align-items', 'center', 'important');
                btn.style.setProperty('justify-content', 'center', 'important');

                $btn.find('i, .bi, svg').each(function () {
                    this.style.setProperty('color', '#ffffff', 'important');
                    this.style.setProperty('fill', '#ffffff', 'important');
                });
            });
        }

        $(document).ready(function () {
            warnaAksiPersyaratanMentor();
            $('#persyaratan_table').on('draw.dt init.dt responsive-display.dt', warnaAksiPersyaratanMentor);

            setTimeout(warnaAksiPersyaratanMentor, 200);
            setTimeout(warnaAksiPersyaratanMentor, 600);
            setTimeout(warnaAksiPersyaratanMentor, 1000);

            const tbody = document.querySelector('#persyaratan_table tbody');
            if (tbody) {
                new MutationObserver(warnaAksiPersyaratanMentor).observe(tbody, {
                    childList: true,
                    subtree: true
                });
            }
        });
    </script>

    @include('mentor.kelas.kelas_persyaratan.script.list')
    @include('mentor.kelas.kelas_persyaratan.script.create')
    @include('mentor.kelas.kelas_persyaratan.script.edit')
    @include('mentor.kelas.kelas_persyaratan.script.detail')
    @include('mentor.kelas.kelas_persyaratan.script.delete')
@endsection
