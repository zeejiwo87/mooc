@extends('admin.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/buttons.dataTables.min.css') }}"/>

    <style>
        /* =========================================================
           KELAS MENTOR - SIMPLE FLAT
           Visual only: route, id, data-attribute, include, dan JS tidak diubah
        ========================================================= */

        .kelas-builder-page {
            --page-primary: #074366;
            --page-primary-dark: #052f49;
            --page-blue: #2563eb;
            --page-success: #10b981;
            --page-warning: #f59e0b;
            --page-danger: #ef4444;
            --page-text: #111827;
            --page-muted: #64748b;
            --page-border: #e5e7eb;
            --page-soft: #f8fafc;
            --page-white: #ffffff;
            padding: 0 24px 28px;
            color: var(--page-text);
        }

        .kelas-builder-shell {
            max-width: 1480px;
            margin: 0 auto;
        }

        /* Card utama */
        .kelas-builder-page .neo-card,
        .kelas-builder-page .mentor-main-card,
        .kelas-builder-page .assistant-card,
        .kelas-builder-page .neo-table-wrap {
            background: var(--page-white);
            border: 1px solid #eef2f7;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(15, 23, 42, .06);
        }

        .kelas-builder-page .neo-card {
            overflow: hidden;
        }

        .kelas-builder-page .hero-banner {
            min-height: 230px;
            position: relative;
            background-size: cover;
            background-position: center;
        }

        .kelas-builder-page .hero-banner::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(15, 23, 42, .20);
        }

        .kelas-builder-page .hero-body,
        .kelas-builder-page .content-body {
            padding: 22px;
            background: #ffffff;
        }

        .kelas-builder-page .hero-top,
        .kelas-builder-page .content-header,
        .kelas-builder-page .assistant-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
        }

        .kelas-builder-page .kelas-title {
            margin: 0;
            color: var(--page-text);
            font-size: 24px;
            line-height: 1.3;
            font-weight: 800;
        }

        .kelas-builder-page .kelas-owner,
        .kelas-builder-page .muted-text,
        .kelas-builder-page .mentor-note,
        .kelas-builder-page .assistant-subtitle {
            color: var(--page-muted) !important;
            font-weight: 600;
        }

        .kelas-builder-page .kelas-owner span,
        .kelas-builder-page .mentor-name {
            color: var(--page-text);
            font-weight: 800;
        }

        .kelas-builder-page .stars {
            display: flex;
            align-items: center;
            gap: 3px;
            color: var(--page-warning);
        }

        .kelas-builder-page .stars .bi-star {
            color: #cbd5e1;
        }

        .kelas-builder-page .rating-number {
            margin-left: 8px;
            color: var(--page-text);
            font-weight: 800;
        }

        .kelas-builder-page .short-desc {
            max-width: 920px;
            margin: 16px 0 0;
            color: var(--page-muted);
            line-height: 1.65;
            font-weight: 600;
        }

        .kelas-builder-page .meta-row,
        .kelas-builder-page .stat-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .kelas-builder-page .stat-row {
            margin-top: 22px;
        }

        .kelas-builder-page .stat-item {
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

        .kelas-builder-page .stat-icon {
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

        .kelas-builder-page .stat-value {
            color: var(--page-text);
            font-size: 15px;
            line-height: 1.2;
            font-weight: 800;
        }

        .kelas-builder-page .stat-label {
            margin-top: 3px;
            color: var(--page-muted);
            font-size: 12px;
            font-weight: 600;
        }

        .kelas-builder-page .badge-neo,
        .kelas-builder-page .badge,
        .modal .badge {
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

        .kelas-builder-page .badge-light-success,
        .modal .badge-light-success {
            color: #047857 !important;
            background: #ecfdf5 !important;
            border-color: #bbf7d0 !important;
        }

        .kelas-builder-page .badge-light-warning,
        .modal .badge-light-warning {
            color: #92400e !important;
            background: #fffbeb !important;
            border-color: #fde68a !important;
        }

        .kelas-builder-page .badge-light-danger,
        .modal .badge-light-danger {
            color: #b91c1c !important;
            background: #fef2f2 !important;
            border-color: #fecaca !important;
        }

        .kelas-builder-page .badge-light-primary,
        .kelas-builder-page .badge-light-info,
        .modal .badge-light-primary,
        .modal .badge-light-info {
            color: #1d4ed8 !important;
            background: #eff6ff !important;
            border-color: #bfdbfe !important;
        }

        /* Tabs */
        .kelas-builder-page .tabs-card {
            padding: 14px 16px 0;
            background: #ffffff;
            border-bottom: 1px solid #eef2f7;
        }

        .kelas-builder-page .tabs-scroll {
            width: 100%;
            overflow-x: auto;
            padding-bottom: 12px;
        }

        .kelas-builder-page .neo-tabs {
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: max-content;
            margin: 0;
            padding: 0;
            list-style: none;
            border: 0 !important;
        }

        .kelas-builder-page .neo-tabs .nav-item {
            margin: 0 !important;
            padding: 0 !important;
        }

        .kelas-builder-page .neo-tabs .nav-link,
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

        .kelas-builder-page .neo-tabs .nav-link:hover {
            color: var(--page-primary) !important;
            background: var(--page-soft) !important;
            border-color: #cbd5e1 !important;
            transform: none !important;
        }

        .kelas-builder-page .neo-tabs .nav-link.active {
            color: #ffffff !important;
            background: var(--page-primary) !important;
            border-color: var(--page-primary) !important;
        }

        /* Header konten */
        .kelas-builder-page .section-title,
        .kelas-builder-page .assistant-title {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
            color: var(--page-text) !important;
            font-size: 16px;
            font-weight: 800;
        }

        .kelas-builder-page .section-title i,
        .kelas-builder-page .assistant-title i {
            color: var(--page-primary) !important;
        }

        .kelas-builder-page .mentor-main-card {
            margin-bottom: 18px;
            padding: 18px;
            background: var(--page-soft);
            border-color: var(--page-border);
            box-shadow: none;
        }

        .kelas-builder-page .mentor-main-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--page-primary);
            background: #ffffff;
            border: 1px solid var(--page-border);
            border-radius: 8px;
            box-shadow: none;
            font-size: 20px;
        }

        .kelas-builder-page .mentor-name {
            font-size: 16px;
        }

        .kelas-builder-page .mentor-note,
        .kelas-builder-page .assistant-subtitle {
            margin: 6px 0 0;
            line-height: 1.6;
        }

        .kelas-builder-page .assistant-card {
            padding: 18px;
            box-shadow: none;
            border-color: var(--page-border);
        }

        .kelas-builder-page .assistant-header {
            margin-bottom: 18px;
        }

        .kelas-builder-page .assistant-limit {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 10px;
            color: #475569;
            background: var(--page-soft);
            border: 1px solid var(--page-border);
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        /* Tombol umum */
        .kelas-builder-page .btn,
        .modal .btn {
            border-radius: 8px !important;
            box-shadow: none !important;
            font-weight: 700 !important;
            transform: none !important;
        }

        .kelas-builder-page .btn-neo-primary,
        .kelas-builder-page .btn.btn-neo-primary,
        .kelas-builder-page .btn.btn-primary,
        .kelas-builder-page .dt-buttons .btn,
        .kelas-builder-page .dt-button {
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 8px 13px !important;
            color: #ffffff !important;
            background: var(--page-primary) !important;
            border: 1px solid var(--page-primary) !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-size: 13px;
            line-height: 1;
            text-decoration: none !important;
        }

        .kelas-builder-page .btn-neo-primary:hover,
        .kelas-builder-page .btn.btn-primary:hover,
        .kelas-builder-page .dt-buttons .btn:hover,
        .kelas-builder-page .dt-button:hover {
            color: #ffffff !important;
            background: var(--page-primary-dark) !important;
            border-color: var(--page-primary-dark) !important;
            filter: none !important;
        }

        .kelas-builder-page .btn.btn-success {
            color: #ffffff !important;
            background: var(--page-success) !important;
            border-color: var(--page-success) !important;
        }

        .kelas-builder-page .btn.btn-warning {
            color: #ffffff !important;
            background: var(--page-warning) !important;
            border-color: var(--page-warning) !important;
        }

        .kelas-builder-page .btn.btn-danger {
            color: #ffffff !important;
            background: var(--page-danger) !important;
            border-color: var(--page-danger) !important;
        }

        .kelas-builder-page .btn.btn-info {
            color: #ffffff !important;
            background: var(--page-blue) !important;
            border-color: var(--page-blue) !important;
        }

        /* Tabel */
        .kelas-builder-page .neo-table-wrap,
        .kelas-builder-page .table-responsive {
            padding: 0 !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
            background: #ffffff;
            border: 1px solid var(--page-border) !important;
            border-radius: 10px !important;
            box-shadow: none !important;
        }

        .kelas-builder-page .neo-table-wrap {
            margin-top: 18px;
            overflow: visible;
        }

        .kelas-builder-page .table-responsive {
            overflow-x: auto;
            overflow-y: visible;
        }

        .kelas-builder-page table.table {
            width: 100% !important;
            margin: 0 !important;
            color: var(--page-text);
            border-collapse: separate !important;
            border-spacing: 0 !important;
        }

        .kelas-builder-page table.table thead th {
            padding: 13px 14px !important;
            color: #475569 !important;
            background: var(--page-soft) !important;
            border-bottom: 1px solid var(--page-border) !important;
            font-size: 12px !important;
            font-weight: 800 !important;
            text-transform: uppercase;
            letter-spacing: .03em;
            white-space: nowrap;
        }

        .kelas-builder-page table.table tbody td {
            padding: 13px 14px !important;
            color: #334155 !important;
            background: #ffffff !important;
            border-bottom: 1px solid #eef2f7 !important;
            vertical-align: middle;
            font-size: 13px;
            font-weight: 600;
        }

        .kelas-builder-page table.table tbody tr:last-child td {
            border-bottom: 0 !important;
        }

        .kelas-builder-page table.table tbody tr:hover td {
            background: #f8fafc !important;
        }

        /* Tombol aksi dalam tabel */
        .kelas-builder-page #mentor_table td:first-child,
        .kelas-builder-page #mentor_table th:first-child {
            width: 132px;
            min-width: 132px;
            white-space: nowrap;
            text-align: center;
        }

        .kelas-builder-page #mentor_table td:first-child .btn,
        .kelas-builder-page #mentor_table .action-icon-btn,
        .kelas-builder-page #mentor_table .btn-icon {
            width: 34px !important;
            height: 34px !important;
            min-width: 34px !important;
            min-height: 34px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 3px !important;
            padding: 0 !important;
            color: #ffffff !important;
            border: 1px solid transparent !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-size: 14px !important;
            line-height: 1 !important;
            transition: filter .18s ease, transform .18s ease;
        }

        .kelas-builder-page #mentor_table td:first-child .btn i,
        .kelas-builder-page #mentor_table .action-icon-btn i,
        .kelas-builder-page #mentor_table .btn-icon i {
            color: #ffffff !important;
            font-size: 15px !important;
            line-height: 1 !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /* Default aksi = detail/biru */
        .kelas-builder-page #mentor_table td:first-child .btn,
        .kelas-builder-page #mentor_table .btn-info,
        .kelas-builder-page #mentor_table .btn-primary,
        .kelas-builder-page #mentor_table [data-bs-target="#form_detail"],
        .kelas-builder-page #mentor_table [title*="Detail"],
        .kelas-builder-page #mentor_table [title*="Lihat"] {
            background: #2563eb !important;
            border-color: #2563eb !important;
        }

        /* Edit = kuning */
        .kelas-builder-page #mentor_table .btn-warning,
        .kelas-builder-page #mentor_table [data-bs-target="#form_edit"],
        .kelas-builder-page #mentor_table [title*="Edit"] {
            background: #f59e0b !important;
            border-color: #f59e0b !important;
        }

        /* Hapus = merah */
        .kelas-builder-page #mentor_table .btn-danger,
        .kelas-builder-page #mentor_table [onclick*="delete"],
        .kelas-builder-page #mentor_table [onclick*="Delete"],
        .kelas-builder-page #mentor_table [title*="Hapus"],
        .kelas-builder-page #mentor_table [data-action*="delete"],
        .kelas-builder-page #mentor_table [data-action*="hapus"] {
            background: #ef4444 !important;
            border-color: #ef4444 !important;
        }

        .kelas-builder-page #mentor_table td:first-child .btn:hover,
        .kelas-builder-page #mentor_table .action-icon-btn:hover,
        .kelas-builder-page #mentor_table .btn-icon:hover {
            color: #ffffff !important;
            filter: brightness(.96);
            transform: translateY(-1px) !important;
        }

        /* DataTables */
        .kelas-builder-page .dataTables_wrapper {
            padding: 16px;
            width: 100%;
        }

        .kelas-builder-page .dataTables_wrapper::after {
            content: "";
            display: block;
            clear: both;
        }

        .kelas-builder-page .dataTables_wrapper > .row:first-child {
            align-items: center;
            row-gap: 12px;
            margin-bottom: 14px;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_length label,
        .kelas-builder-page .dataTables_wrapper .dataTables_filter label,
        .kelas-builder-page .dataTables_wrapper .dataTables_info {
            color: var(--page-muted) !important;
            font-size: 12px;
            font-weight: 600;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_filter {
            text-align: right;
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
            margin-bottom: 12px;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_filter label {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: flex-end !important;
            gap: 8px !important;
            margin-bottom: 0 !important;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_filter input {
            width: 230px !important;
            margin-left: 6px !important;
        }

        .kelas-builder-page .dataTables_wrapper .form-control,
        .kelas-builder-page .dataTables_wrapper .form-select,
        .kelas-builder-page .dataTables_wrapper input[type="search"],
        .kelas-builder-page .dataTables_wrapper select {
            min-height: 38px;
            color: var(--page-text) !important;
            background: #ffffff !important;
            border: 1px solid var(--page-border) !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-size: 13px;
        }

        .kelas-builder-page .dataTables_wrapper input[type="search"]:focus,
        .kelas-builder-page .dataTables_wrapper select:focus {
            border-color: var(--page-primary) !important;
            box-shadow: 0 0 0 .2rem rgba(7, 67, 102, .10) !important;
        }

        .kelas-builder-page .dataTables_wrapper .pagination {
            gap: 5px;
            margin-bottom: 0;
        }

        .kelas-builder-page .dataTables_wrapper .page-link {
            min-width: 34px;
            min-height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #475569 !important;
            background: #ffffff !important;
            border: 1px solid var(--page-border) !important;
            border-radius: 7px !important;
            box-shadow: none !important;
            font-size: 12px;
            font-weight: 700;
        }

        .kelas-builder-page .dataTables_wrapper .page-item.active .page-link {
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

        /* Modal */
        .modal-backdrop.show {
            opacity: .34 !important;
            background: #0f172a !important;
        }

        .modal .modal-dialog {
            margin-top: 22px;
            margin-bottom: 22px;
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
        .modal dt {
            margin-bottom: 8px;
            color: #111827 !important;
            font-size: 13px;
            font-weight: 800 !important;
        }

        .modal dd {
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

        .modal textarea.form-control,
        .modal textarea {
            line-height: 1.58;
            padding: 10px 12px;
        }

        .modal .form-control:focus,
        .modal .form-select:focus,
        .modal textarea:focus,
        .modal .select2-container--focus .select2-selection {
            border-color: #074366 !important;
            background: #ffffff !important;
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

        .modal .btn:hover {
            filter: brightness(.96);
            transform: none !important;
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
            border-radius: 8px !important;
            box-shadow: none !important;
            font-weight: 700 !important;
        }


        /* =========================================================
           FIX FINAL WARNA TOMBOL AKSI DATATABLES
           DataTables membuat tombol setelah halaman dimuat.
           Jadi warna dipaksa dari class visual yang dipasang JS.
        ========================================================= */

        .kelas-builder-page #mentor_table td:first-child {
            white-space: nowrap !important;
            text-align: center !important;
        }

        .kelas-builder-page #mentor_table td:first-child .mentor-action-btn,
        .kelas-builder-page #mentor_table td:first-child a.mentor-action-btn,
        .kelas-builder-page #mentor_table td:first-child button.mentor-action-btn {
            width: 34px !important;
            height: 34px !important;
            min-width: 34px !important;
            min-height: 34px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 3px !important;
            padding: 0 !important;
            color: #ffffff !important;
            border: 1px solid transparent !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-size: 0 !important;
            line-height: 1 !important;
            text-decoration: none !important;
            vertical-align: middle !important;
            transform: none !important;
        }

        .kelas-builder-page #mentor_table td:first-child .mentor-action-btn i,
        .kelas-builder-page #mentor_table td:first-child .mentor-action-btn .bi,
        .kelas-builder-page #mentor_table td:first-child .mentor-action-btn .fa,
        .kelas-builder-page #mentor_table td:first-child .mentor-action-btn .fas {
            color: #ffffff !important;
            font-size: 15px !important;
            line-height: 1 !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .kelas-builder-page #mentor_table td:first-child .mentor-action-btn.action-detail {
            background: #2563eb !important;
            border-color: #2563eb !important;
        }

        .kelas-builder-page #mentor_table td:first-child .mentor-action-btn.action-edit {
            background: #f59e0b !important;
            border-color: #f59e0b !important;
        }

        .kelas-builder-page #mentor_table td:first-child .mentor-action-btn.action-delete {
            background: #ef4444 !important;
            border-color: #ef4444 !important;
        }

        .kelas-builder-page #mentor_table td:first-child .mentor-action-btn:hover {
            color: #ffffff !important;
            filter: brightness(.96);
            transform: translateY(-1px) !important;
        }

        @media (max-width: 767.98px) {
            .kelas-builder-page {
                padding: 0 16px 24px;
            }

            .kelas-builder-page .hero-top,
            .kelas-builder-page .content-header,
            .kelas-builder-page .assistant-header {
                flex-direction: column;
                align-items: stretch;
            }

            .kelas-builder-page .hero-body,
            .kelas-builder-page .content-body,
            .modal .modal-body {
                padding: 16px;
            }

            .kelas-builder-page .stat-item {
                width: 100%;
            }

            .kelas-builder-page .btn-neo-primary,
            .kelas-builder-page .content-header .btn,
            .modal .modal-footer .btn {
                width: 100%;
            }

            .kelas-builder-page .assistant-limit {
                width: 100%;
                justify-content: center;
                white-space: normal;
            }

            .kelas-builder-page .dataTables_wrapper .dt-buttons,
            .kelas-builder-page .dataTables_wrapper .dataTables_filter {
                float: none !important;
                width: 100% !important;
                display: flex !important;
                justify-content: flex-start !important;
                text-align: left !important;
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

            .modal .modal-footer {
                flex-direction: column-reverse;
                align-items: stretch;
            }
        }
    </style>
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
            $ratingLabel = $avgRating >= 4.5
                ? 'Sangat Baik'
                : ($avgRating >= 3.5
                    ? 'Baik'
                    : ($avgRating > 0
                        ? 'Cukup'
                        : 'Belum ada rating'));
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

                        @if (! empty($kelas->deskripsi_singkat))
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
                                    <a class="nav-link {{ request()->routeIs('admin.kelas.kelas.histori') ? 'active' : '' }}"
                                       href="{{ route('admin.kelas.kelas.histori', ['id' => $id]) }}">
                                        Beranda
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.kelas.mentor.*') ? 'active' : '' }}"
                                       href="{{ route('admin.kelas.mentor.index', ['id' => $id]) }}">
                                        Mentor
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.kelas.persyaratan.*') ? 'active' : '' }}"
                                       href="{{ route('admin.kelas.persyaratan.index', ['id' => $id]) }}">
                                        Persyaratan
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.kelas.tujuan_pembelajaran.*') ? 'active' : '' }}"
                                       href="{{ route('admin.kelas.tujuan_pembelajaran.index', ['id' => $id]) }}">
                                        Tujuan Pembelajaran
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.kelas.target_peserta.*') ? 'active' : '' }}"
                                       href="{{ route('admin.kelas.target_peserta.index', ['id' => $id]) }}">
                                        Target Peserta
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.kelas.kelas_tag.*') ? 'active' : '' }}"
                                       href="{{ route('admin.kelas.kelas_tag.index', ['id' => $id]) }}">
                                        Tag
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.kelas.usulan_peserta.*') ? 'active' : '' }}"
                                       href="{{ route('admin.kelas.usulan_peserta.index', ['id' => $id]) }}">
                                        Ulasan Peserta
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="content-body">
                        <div class="content-header mb-5">
                            <h3 class="section-title mb-0">
                                <i class="bi bi-person-check"></i>
                                Mentor Kelas
                            </h3>

                            <button type="button"
                                    id="btn_open_create"
                                    class="btn btn-neo-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#form_create">
                                <i class="bi bi-plus-circle"></i>
                                Tambah Asisten Mentor
                            </button>
                        </div>

                        <div class="mentor-main-card">
                            <div class="d-flex align-items-start gap-4">
                                <span class="mentor-main-icon">
                                    <i class="bi bi-person-badge"></i>
                                </span>

                                <div>
                                    <div class="mentor-name">
                                        {{ $kelas->pemilik ?? 'Mentor utama belum tersedia' }}
                                    </div>

                                    <p class="mentor-note">
                                        Mentor utama kelas tetap hanya satu. Jika ingin mengganti mentor utama,
                                        lakukan melalui form edit kelas pada field mentor/pemilik kelas.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="assistant-card">
                            <div class="assistant-header">
                                <div>
                                    <h4 class="assistant-title">
                                        <i class="bi bi-people"></i>
                                        Asisten Mentor
                                    </h4>
                                    <p class="assistant-subtitle">
                                        Setiap kelas dapat memiliki maksimal 2 asisten mentor.
                                    </p>
                                </div>

                                <span class="assistant-limit">
                                    <i class="bi bi-info-circle"></i>
                                    Maksimal 2 asisten mentor
                                </span>
                            </div>

                            <div class="neo-table-wrap mt-5">
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="mentor_table">
                                        <thead>
                                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                <th>Aksi</th>
                                                <th>Nama Asisten Mentor</th>
                                                <th>Peran</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-700 fw-semibold"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.kelas.kelas_mentor.view.create')
        @include('admin.kelas.kelas_mentor.view.edit')
        @include('admin.kelas.kelas_mentor.view.detail')
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

                    $(id).select2({
                        width: '100%',
                        allowClear: true,
                        placeholder: $(id).data('placeholder') || 'Pilih data',
                        dropdownParent: $(id).closest('.modal')
                    });

                    if (callback) {
                        callback();
                    }

                    return;
                }

                if (!response.errors) {
                    Swal.fire('Warning', response.message || 'Data dropdown gagal dimuat.', 'warning');
                }
            }).catch(error => {
                ErrorHandler.handleError(error);
            });
        }

        $(document).on('click', '#btn_open_create', function() {
            const modalElement = document.getElementById('form_create');

            if (!modalElement) {
                return;
            }

            if (window.bootstrap && bootstrap.Modal) {
                bootstrap.Modal.getOrCreateInstance(modalElement).show();
                return;
            }

            if ($.fn.modal) {
                $('#form_create').modal('show');
            }
        });


        function styleMentorActionButtons() {
            const $actionButtons = $('#mentor_table tbody td:first-child').find('a, button');

            $actionButtons.each(function () {
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

                $btn
                    .removeClass('btn-primary btn-info btn-warning btn-danger btn-success btn-light-primary btn-light-warning btn-light-danger action-detail action-edit action-delete')
                    .addClass('mentor-action-btn');

                if (
                    identity.includes('hapus') ||
                    identity.includes('delete') ||
                    identity.includes('trash') ||
                    identity.includes('remove') ||
                    identity.includes('destroy') ||
                    identity.includes('bi-trash') ||
                    identity.includes('fa-trash')
                ) {
                    $btn.addClass('action-delete');
                    return;
                }

                if (
                    identity.includes('edit') ||
                    identity.includes('ubah') ||
                    identity.includes('pencil') ||
                    identity.includes('pen') ||
                    identity.includes('bi-pencil') ||
                    identity.includes('fa-edit')
                ) {
                    $btn.addClass('action-edit');
                    return;
                }

                $btn.addClass('action-detail');
            });
        }

        $(document).on('draw.dt init.dt responsive-display.dt', '#mentor_table', function () {
            setTimeout(styleMentorActionButtons, 0);
        });

        $(document).ready(function () {
            styleMentorActionButtons();
            setTimeout(styleMentorActionButtons, 150);
            setTimeout(styleMentorActionButtons, 500);
            setTimeout(styleMentorActionButtons, 1000);
        });

    </script>

    @include('admin.kelas.kelas_mentor.script.list')
    @include('admin.kelas.kelas_mentor.script.create')
    @include('admin.kelas.kelas_mentor.script.edit')
    @include('admin.kelas.kelas_mentor.script.detail')
    @include('admin.kelas.kelas_mentor.script.delete')
@endsection