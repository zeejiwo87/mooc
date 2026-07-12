@extends('admin.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/buttons.dataTables.min.css') }}">

    <style>
    /* =========================================================
       KELAS ADMIN - FLAT, SIMPLE, KONSISTEN
       Visual only: tidak mengubah route, ID, data attribute, atau JS
    ========================================================= */
    .kelas-builder-page {
        --page-primary: #074366;
        --page-primary-dark: #052f49;
        --page-success: #10b981;
        --page-warning: #f59e0b;
        --page-danger: #ef4444;
        --page-info: #2563eb;
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
    .kelas-builder-page .assistant-subtitle,
    .kelas-builder-page .mentor-note {
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
    .kelas-builder-page .stat-row,
    .kelas-builder-page .action-row {
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
        background: var(--page-soft, #f8fafc) !important;
        border: 1px solid var(--page-border, #e5e7eb) !important;
        border-radius: 999px;
        box-shadow: none !important;
        font-size: 12px;
        line-height: 1;
        font-weight: 700;
    }

    .kelas-builder-page .badge-light-success,
    .kelas-builder-page .badge-neo.success,
    .modal .badge-light-success {
        color: #047857 !important;
        background: #ecfdf5 !important;
        border-color: #bbf7d0 !important;
    }

    .kelas-builder-page .badge-light-warning,
    .kelas-builder-page .badge-neo.warning,
    .modal .badge-light-warning {
        color: #92400e !important;
        background: #fffbeb !important;
        border-color: #fde68a !important;
    }

    .kelas-builder-page .badge-light-danger,
    .kelas-builder-page .badge-neo.danger,
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
    }

    .kelas-builder-page .neo-tabs .nav-link {
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

    .kelas-builder-page .section-title {
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

    .kelas-builder-page .btn-neo-primary,
    .kelas-builder-page .content-header > .btn,
    .kelas-builder-page .btn.btn-primary,
    .kelas-builder-page .btn.btn-sm.btn-primary {
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
        font-weight: 700;
        text-decoration: none !important;
    }

    .kelas-builder-page .btn-neo-primary:hover,
    .kelas-builder-page .content-header > .btn:hover,
    .kelas-builder-page .btn.btn-primary:hover {
        color: #ffffff !important;
        background: var(--page-primary-dark) !important;
        border-color: var(--page-primary-dark) !important;
        transform: none !important;
    }

    .kelas-builder-page .mentor-main-card,
    .kelas-builder-page .assistant-card {
        padding: 18px;
        box-shadow: none;
        border-color: var(--page-border);
    }

    .kelas-builder-page .mentor-main-card {
        margin-bottom: 18px;
        background: var(--page-soft);
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

    .kelas-builder-page .assistant-title {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0;
        color: var(--page-text);
        font-size: 16px;
        font-weight: 800;
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
    }

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

    .kelas-builder-page table.table .btn,
    .kelas-builder-page .dataTables_wrapper .btn {
        min-height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 7px 10px !important;
        border-radius: 7px !important;
        box-shadow: none !important;
        font-size: 12px;
        line-height: 1;
        font-weight: 700;
        transform: none !important;
    }

    .kelas-builder-page table.table .btn-primary,
    .kelas-builder-page table.table .btn-info {
        color: #ffffff !important;
        background: #2563eb !important;
        border-color: #2563eb !important;
    }

    .kelas-builder-page table.table .btn-warning {
        color: #ffffff !important;
        background: var(--page-warning) !important;
        border-color: var(--page-warning) !important;
    }

    .kelas-builder-page table.table .btn-danger {
        color: #ffffff !important;
        background: var(--page-danger) !important;
        border-color: var(--page-danger) !important;
    }

    .kelas-builder-page table.table .btn-success {
        color: #ffffff !important;
        background: var(--page-success) !important;
        border-color: var(--page-success) !important;
    }

    .kelas-builder-page .dataTables_wrapper {
        padding: 16px;
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

    .kelas-builder-page .dataTables_wrapper .dt-buttons .btn,
    .kelas-builder-page .dataTables_wrapper .dt-button {
        color: #ffffff !important;
        background: var(--page-primary) !important;
        border: 1px solid var(--page-primary) !important;
    }

    .kelas-builder-page .dataTables_wrapper .pagination {
        gap: 5px;
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

    .kelas-builder-page .dropdown,
    .kelas-builder-page .btn-group,
    .kelas-builder-page table td {
        position: relative;
    }

    .kelas-builder-page .dropdown-menu {
        z-index: 10000 !important;
        padding: 8px;
        background: #ffffff !important;
        border: 1px solid var(--page-border) !important;
        border-radius: 10px !important;
        box-shadow: 0 16px 36px rgba(15, 23, 42, .14) !important;
    }

    .kelas-builder-page .dropdown-item {
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

    .kelas-builder-page .dropdown-item:hover {
        color: #0f172a !important;
        background: #f1f5f9 !important;
    }

    /* Modal pada halaman ini */
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

    .modal .ql-toolbar.ql-snow,
    .modal .ql-container.ql-snow {
        background: #ffffff !important;
        border-color: #e5e7eb !important;
        box-shadow: none !important;
    }

    .modal .ql-toolbar.ql-snow {
        border-radius: 8px 8px 0 0;
    }

    .modal .ql-container.ql-snow {
        border-radius: 0 0 8px 8px;
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

        .kelas-builder-page .content-header > .btn,
        .kelas-builder-page .btn-neo-primary,
        .modal .modal-footer .btn {
            width: 100%;
        }

        .kelas-builder-page .dataTables_wrapper .dataTables_filter,
        .kelas-builder-page .dataTables_wrapper .dataTables_length {
            text-align: left;
        }

        .modal .modal-footer {
            flex-direction: column-reverse;
            align-items: stretch;
        }
    }


    /* =========================================================
       ACTION BUTTONS - RAPI DAN BERWARNA
       Detail biru, materi hijau, edit kuning, hapus merah.
       Visual only: menggunakan atribut tombol yang sudah ada.
    ========================================================= */
    .kelas-builder-page {
        --action-detail: #3b82f6;
        --action-detail-hover: #2563eb;
        --action-manage: #10b981;
        --action-manage-hover: #059669;
        --action-edit: #f59e0b;
        --action-edit-hover: #d97706;
        --action-delete: #ef4444;
        --action-delete-hover: #dc2626;
        --action-extra: #8b5cf6;
        --action-extra-hover: #7c3aed;
    }

    /* Kolom aksi dibuat stabil agar tombol tidak berantakan atau turun baris. */
    .kelas-builder-page #bagian_kelas_table th:first-child,
    .kelas-builder-page #mentor_table th:first-child,
    .kelas-builder-page #persyaratan_table th:first-child,
    .kelas-builder-page #tag_table th:first-child,
    .kelas-builder-page #target_table th:first-child,
    .kelas-builder-page #tujuan_table th:first-child {
        width: 172px !important;
        min-width: 172px !important;
        padding-left: 14px !important;
        padding-right: 14px !important;
        text-align: center !important;
    }

    .kelas-builder-page #bagian_kelas_table td:first-child,
    .kelas-builder-page #mentor_table td:first-child,
    .kelas-builder-page #persyaratan_table td:first-child,
    .kelas-builder-page #tag_table td:first-child,
    .kelas-builder-page #target_table td:first-child,
    .kelas-builder-page #tujuan_table td:first-child {
        width: 172px !important;
        min-width: 172px !important;
        padding-left: 12px !important;
        padding-right: 12px !important;
        text-align: center !important;
        white-space: nowrap !important;
        line-height: 1 !important;
    }

    /* Ukuran semua tombol aksi sama seperti halaman Admin Mentor. */
    .kelas-builder-page table.table .action-icon-btn,
    .kelas-builder-page table.table .btn.btn-icon.action-icon-btn {
        width: 36px !important;
        height: 36px !important;
        min-width: 36px !important;
        min-height: 36px !important;
        margin: 0 4px 0 0 !important;
        padding: 0 !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        vertical-align: middle !important;
        color: #ffffff !important;
        background: var(--action-detail) !important;
        border: 1px solid transparent !important;
        border-radius: 9px !important;
        box-shadow: 0 5px 12px rgba(15, 23, 42, .12) !important;
        transition: background .18s ease, transform .18s ease, box-shadow .18s ease !important;
    }

    .kelas-builder-page table.table .action-icon-btn:last-child {
        margin-right: 0 !important;
    }

    .kelas-builder-page table.table .action-icon-btn .bi,
    .kelas-builder-page table.table .btn.btn-icon.action-icon-btn .bi {
        color: #ffffff !important;
        font-size: 15px !important;
        line-height: 1 !important;
    }

    /* Detail / lihat data. */
    .kelas-builder-page table.table .action-icon-btn[data-bs-target="#form_detail"] {
        background: var(--action-detail) !important;
        border-color: var(--action-detail) !important;
    }

    /* Edit data. */
    .kelas-builder-page table.table .action-icon-btn[data-bs-target="#form_edit"] {
        background: var(--action-edit) !important;
        border-color: var(--action-edit) !important;
    }

    /* Hapus data. */
    .kelas-builder-page table.table .action-icon-btn[onclick*="deleteConfirmation"] {
        background: var(--action-delete) !important;
        border-color: var(--action-delete) !important;
    }

    /* Link pengelolaan materi pada halaman Bagian Kelas. */
    .kelas-builder-page table.table a.action-icon-btn[title="Materi"] {
        background: var(--action-manage) !important;
        border-color: var(--action-manage) !important;
    }

    /* Warna cadangan jika link Histori/Sertifikat digunakan pada tabel lain. */
    .kelas-builder-page table.table a.action-icon-btn[title="Histori"],
    .kelas-builder-page table.table a.action-icon-btn[title="Sertifikat"] {
        background: var(--action-extra) !important;
        border-color: var(--action-extra) !important;
    }

    .kelas-builder-page table.table .action-icon-btn:hover {
        color: #ffffff !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 7px 16px rgba(15, 23, 42, .16) !important;
        filter: none !important;
    }

    .kelas-builder-page table.table .action-icon-btn[data-bs-target="#form_detail"]:hover {
        background: var(--action-detail-hover) !important;
        border-color: var(--action-detail-hover) !important;
    }

    .kelas-builder-page table.table a.action-icon-btn[title="Materi"]:hover {
        background: var(--action-manage-hover) !important;
        border-color: var(--action-manage-hover) !important;
    }

    .kelas-builder-page table.table .action-icon-btn[data-bs-target="#form_edit"]:hover {
        background: var(--action-edit-hover) !important;
        border-color: var(--action-edit-hover) !important;
    }

    .kelas-builder-page table.table .action-icon-btn[onclick*="deleteConfirmation"]:hover {
        background: var(--action-delete-hover) !important;
        border-color: var(--action-delete-hover) !important;
    }

    .kelas-builder-page table.table a.action-icon-btn[title="Histori"]:hover,
    .kelas-builder-page table.table a.action-icon-btn[title="Sertifikat"]:hover {
        background: var(--action-extra-hover) !important;
        border-color: var(--action-extra-hover) !important;
    }

    .kelas-builder-page table.table .action-icon-btn:active {
        transform: translateY(0) !important;
        box-shadow: 0 3px 8px rgba(15, 23, 42, .12) !important;
    }

    .kelas-builder-page table.table .action-icon-btn:focus-visible {
        outline: 3px solid rgba(59, 130, 246, .22) !important;
        outline-offset: 2px !important;
    }

    /* Tombol Export Excel dibuat hijau agar mudah dibedakan dari Tambah. */
    .kelas-builder-page .dataTables_wrapper .dt-buttons .buttons-excel,
    .kelas-builder-page .dataTables_wrapper .dt-button.buttons-excel {
        color: #ffffff !important;
        background: var(--action-manage) !important;
        border-color: var(--action-manage) !important;
        box-shadow: none !important;
    }

    .kelas-builder-page .dataTables_wrapper .dt-buttons .buttons-excel:hover,
    .kelas-builder-page .dataTables_wrapper .dt-button.buttons-excel:hover {
        color: #ffffff !important;
        background: var(--action-manage-hover) !important;
        border-color: var(--action-manage-hover) !important;
    }

    /* Toolbar tabel diberi jarak yang konsisten. */
    .kelas-builder-page .dataTables_wrapper .dt-buttons {
        display: inline-flex !important;
        align-items: center !important;
        flex-wrap: wrap !important;
        gap: 8px !important;
        margin-bottom: 14px !important;
    }

    .kelas-builder-page .dataTables_wrapper .dataTables_filter,
    .kelas-builder-page .dataTables_wrapper .dataTables_length {
        margin-bottom: 14px !important;
    }

    @media (max-width: 767.98px) {
        .kelas-builder-page #bagian_kelas_table th:first-child,
        .kelas-builder-page #mentor_table th:first-child,
        .kelas-builder-page #persyaratan_table th:first-child,
        .kelas-builder-page #tag_table th:first-child,
        .kelas-builder-page #target_table th:first-child,
        .kelas-builder-page #tujuan_table th:first-child,
        .kelas-builder-page #bagian_kelas_table td:first-child,
        .kelas-builder-page #mentor_table td:first-child,
        .kelas-builder-page #persyaratan_table td:first-child,
        .kelas-builder-page #tag_table td:first-child,
        .kelas-builder-page #target_table td:first-child,
        .kelas-builder-page #tujuan_table td:first-child {
            width: 156px !important;
            min-width: 156px !important;
        }

        .kelas-builder-page table.table .action-icon-btn,
        .kelas-builder-page table.table .btn.btn-icon.action-icon-btn {
            width: 34px !important;
            height: 34px !important;
            min-width: 34px !important;
            min-height: 34px !important;
            margin-right: 3px !important;
        }
    }


    /* =========================================================
       FINAL FIX TAG TABLE ACTION BUTTONS
       Warna langsung muncul dari awal, bukan hanya saat hover.
       Detail biru, edit kuning, hapus merah.
    ========================================================= */
    .kelas-builder-page {
        --tag-action-detail: #3b82f6;
        --tag-action-detail-hover: #2563eb;
        --tag-action-edit: #f59e0b;
        --tag-action-edit-hover: #d97706;
        --tag-action-delete: #ef4444;
        --tag-action-delete-hover: #dc2626;
    }

    .kelas-builder-page #tag_table th:first-child,
    .kelas-builder-page #tag_table td:first-child {
        width: 150px !important;
        min-width: 150px !important;
        text-align: center !important;
        white-space: nowrap !important;
    }

    .kelas-builder-page #tag_table td:first-child .btn,
    .kelas-builder-page #tag_table td:first-child button,
    .kelas-builder-page #tag_table td:first-child a {
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
        background: var(--tag-action-detail) !important;
        border: 1px solid var(--tag-action-detail) !important;
        border-radius: 8px !important;
        box-shadow: none !important;
        font-size: 14px !important;
        line-height: 1 !important;
        vertical-align: middle !important;
        transform: none !important;
    }

    .kelas-builder-page #tag_table td:first-child .btn i,
    .kelas-builder-page #tag_table td:first-child button i,
    .kelas-builder-page #tag_table td:first-child a i,
    .kelas-builder-page #tag_table td:first-child .bi {
        color: #ffffff !important;
        font-size: 15px !important;
        line-height: 1 !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .kelas-builder-page #tag_table td:first-child .tag-action-detail {
        background: var(--tag-action-detail) !important;
        border-color: var(--tag-action-detail) !important;
    }

    .kelas-builder-page #tag_table td:first-child .tag-action-edit {
        background: var(--tag-action-edit) !important;
        border-color: var(--tag-action-edit) !important;
    }

    .kelas-builder-page #tag_table td:first-child .tag-action-delete {
        background: var(--tag-action-delete) !important;
        border-color: var(--tag-action-delete) !important;
    }

    .kelas-builder-page #tag_table td:first-child .tag-action-detail:hover {
        background: var(--tag-action-detail-hover) !important;
        border-color: var(--tag-action-detail-hover) !important;
    }

    .kelas-builder-page #tag_table td:first-child .tag-action-edit:hover {
        background: var(--tag-action-edit-hover) !important;
        border-color: var(--tag-action-edit-hover) !important;
    }

    .kelas-builder-page #tag_table td:first-child .tag-action-delete:hover {
        background: var(--tag-action-delete-hover) !important;
        border-color: var(--tag-action-delete-hover) !important;
    }

    .kelas-builder-page #tag_table td:first-child .btn:hover,
    .kelas-builder-page #tag_table td:first-child button:hover,
    .kelas-builder-page #tag_table td:first-child a:hover {
        color: #ffffff !important;
        transform: translateY(-1px) !important;
        filter: brightness(.96) !important;
    }

    .kelas-builder-page #tag_table td:first-child .btn:active,
    .kelas-builder-page #tag_table td:first-child button:active,
    .kelas-builder-page #tag_table td:first-child a:active {
        transform: translateY(0) !important;
    }

    @media (max-width: 767.98px) {
        .kelas-builder-page #tag_table th:first-child,
        .kelas-builder-page #tag_table td:first-child {
            width: 140px !important;
            min-width: 140px !important;
        }

        .kelas-builder-page #tag_table td:first-child .btn,
        .kelas-builder-page #tag_table td:first-child button,
        .kelas-builder-page #tag_table td:first-child a {
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
                        <i class="bi bi-tags"></i>
                        Tag Kelas
                    </h3>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#form_create">
                        Tambah Tag
                    </button>
                </div>

                <div
                    class="table-responsive mb-8  p-4 mx-0 border-hover-dark border-primary border-1 fs-sm-8 fs-lg-6 rounded-2">
                    <table id="tag_table" class="table table-sm align-middle table-row-bordered table-row-solid gs-0 gy-2">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0 fs-sm-8 fs-lg-6">
                                <th class="min-w-125px ps-5 text-nowrap">Aksi</th>
                                <th class="min-w-200px">Nama Tag</th>
                                <th class="min-w-150px">Slug</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 fw-bolder fs-sm-8 fs-lg-6">
                        </tbody>
                    </table>
                </div>                    </div>
                </div>
            </div>
        </div>

    @include('admin.kelas.kelas_tag.view.create')
    @include('admin.kelas.kelas_tag.view.edit')
    @include('admin.kelas.kelas_tag.view.detail')
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
            DataManager.fetchData(url).then(response => {
                const $select = $(id);
                const dropdownParent = $select.data('dropdown-parent');

                if ($select.hasClass('select2-hidden-accessible')) {
                    $select.select2('destroy');
                }

                $select.empty().append('<option></option>');

                if (response.success) {
                    response.data.forEach(item => {
                        $select.append(`<option value="${item['id_' + placeholder]}">${item[name]}</option>`);
                    });

                    $select.select2({
                        placeholder: $select.data('placeholder') || `Pilih ${placeholder}`,
                        allowClear: true,
                        dropdownParent: dropdownParent ? $(dropdownParent) : $(document.body),
                    });

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
    @include('admin.kelas.kelas_tag.script.list')
    @include('admin.kelas.kelas_tag.script.create')
    @include('admin.kelas.kelas_tag.script.edit')
    @include('admin.kelas.kelas_tag.script.detail')
    @include('admin.kelas.kelas_tag.script.delete')

    <script>
        function warnaTombolAksiTag() {
            $('#tag_table tbody tr').each(function () {
                $(this).find('td:first-child .btn, td:first-child button, td:first-child a').each(function () {
                    const btn = this;
                    const $btn = $(btn);

                    const html = ($btn.html() || '').toLowerCase();
                    const title = String($btn.attr('title') || '').toLowerCase();
                    const target = String($btn.attr('data-bs-target') || '').toLowerCase();
                    const onclick = String($btn.attr('onclick') || '').toLowerCase();
                    const className = String($btn.attr('class') || '').toLowerCase();

                    $btn.removeClass('tag-action-detail tag-action-edit tag-action-delete');

                    btn.style.setProperty('width', '36px', 'important');
                    btn.style.setProperty('height', '36px', 'important');
                    btn.style.setProperty('min-width', '36px', 'important');
                    btn.style.setProperty('min-height', '36px', 'important');
                    btn.style.setProperty('padding', '0', 'important');
                    btn.style.setProperty('margin', '0 3px', 'important');
                    btn.style.setProperty('display', 'inline-flex', 'important');
                    btn.style.setProperty('align-items', 'center', 'important');
                    btn.style.setProperty('justify-content', 'center', 'important');
                    btn.style.setProperty('color', '#ffffff', 'important');
                    btn.style.setProperty('border-radius', '8px', 'important');
                    btn.style.setProperty('box-shadow', 'none', 'important');

                    $btn.find('i, .bi').each(function () {
                        this.style.setProperty('color', '#ffffff', 'important');
                        this.style.setProperty('font-size', '15px', 'important');
                        this.style.setProperty('margin', '0', 'important');
                        this.style.setProperty('padding', '0', 'important');
                    });

                    if (
                        target.includes('form_edit') ||
                        title.includes('edit') ||
                        className.includes('btn-warning') ||
                        html.includes('pencil') ||
                        html.includes('bi-pencil')
                    ) {
                        $btn.addClass('tag-action-edit');
                        btn.style.setProperty('background-color', '#f59e0b', 'important');
                        btn.style.setProperty('border-color', '#f59e0b', 'important');
                        return;
                    }

                    if (
                        onclick.includes('delete') ||
                        onclick.includes('hapus') ||
                        title.includes('hapus') ||
                        className.includes('btn-danger') ||
                        html.includes('trash') ||
                        html.includes('bi-trash')
                    ) {
                        $btn.addClass('tag-action-delete');
                        btn.style.setProperty('background-color', '#ef4444', 'important');
                        btn.style.setProperty('border-color', '#ef4444', 'important');
                        return;
                    }

                    $btn.addClass('tag-action-detail');
                    btn.style.setProperty('background-color', '#3b82f6', 'important');
                    btn.style.setProperty('border-color', '#3b82f6', 'important');
                });
            });
        }

        $(document).ready(function () {
            warnaTombolAksiTag();

            $('#tag_table').on('draw.dt', function () {
                warnaTombolAksiTag();
            });

            setTimeout(warnaTombolAksiTag, 300);
            setTimeout(warnaTombolAksiTag, 700);
            setTimeout(warnaTombolAksiTag, 1200);
        });
    </script>

@endsection
