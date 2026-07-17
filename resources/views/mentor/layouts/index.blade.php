<!DOCTYPE html>
<html lang="id" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Massive Open Online Course</title>

    <meta name="description"
        content="Massive Open Online Course Universitas Nurul Jadid - Akses semua layanan digital dengan satu akun">
    <meta name="author" content="Universitas Nurul Jadid">
    <meta name="publisher" content="Pusat Data & Sistem Informasi Universitas Nurul Jadid">
    <meta name="language" content="Indonesian">
    <meta name="robots" content="noindex, nofollow, noarchive, nosnippet, noodp, noydir, nocache, notranslate">
    <meta name="googlebot" content="noindex, nofollow, noarchive, nosnippet, notranslate">
    <meta name="bingbot" content="noindex, nofollow, noarchive, nosnippet">
    <meta name="slurp" content="noindex, nofollow, noarchive, nosnippet">
    <meta name="duckduckbot" content="noindex, nofollow, noarchive, nosnippet">

    <link rel="icon" href="{{ asset('assets/media/logos/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fonts/font.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('assets/plugins/plugins.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.bundle.css') }}">

    <meta name="X-CSRF-TOKEN" content="{{ csrf_token() }}">

    <script src="{{ asset('assets/js/request.js') }}"></script>
    <script src="{{ asset('assets/js/errorhandler.js') }}"></script>

    <style>
        .table tbody tr:nth-child(odd) {
            background-color: #f5f5f586;
        }

        .table tbody tr:nth-child(even) {
            background-color: #ffffff;
        }

        .table th {
            color: #000000;
        }

        /* Tombol pada kolom Aksi dibuat mendatar, rapi, dan tidak turun ke bawah di tampilan desktop. */
        table.dataTable tbody td:first-child,
        table.dataTable thead th:first-child {
            white-space: nowrap;
        }

        .action-icon-btn {
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            vertical-align: middle;
        }

        @media (max-width: 576px) {
            table.dataTable tbody td:first-child {
                white-space: normal;
            }
        }
    </style>

    @yield('css')

    <style>
        /* =========================================================
           FIX FINAL TOMBOL KELAS SELALU TERLIHAT
           - Memperbaiki tombol modal kelas yang baru terlihat saat hover.
           - Berlaku untuk Admin dan Mentor.
           - Tidak mengubah route, controller, AJAX, CRUD, atau alert sukses otomatis.
           - Tombol SweetAlert yang memang disembunyikan oleh showConfirmButton:false tetap tersembunyi.
        ========================================================= */
        html body .kelas-builder-page .modal .modal-footer,
        html body .quick-modal .modal-footer,
        html body .modal#form_create .modal-footer,
        html body .modal#form_edit .modal-footer,
        html body .modal#form_detail .modal-footer {
            display: flex !important;
            align-items: center !important;
            justify-content: flex-end !important;
            flex-wrap: wrap !important;
            gap: 10px !important;
            min-height: 66px !important;
            padding: 14px 20px 18px !important;
            background: #ffffff !important;
            border-top: 1px solid #e5e7eb !important;
            opacity: 1 !important;
            visibility: visible !important;
            overflow: visible !important;
            position: relative !important;
            z-index: 10 !important;
        }

        html body .kelas-builder-page .modal .modal-footer button.btn:not(.btn-close),
        html body .kelas-builder-page .modal .modal-footer a.btn:not(.btn-close),
        html body .quick-modal .modal-footer button.btn:not(.btn-close),
        html body .quick-modal .modal-footer a.btn:not(.btn-close),
        html body .modal#form_create .modal-footer button.btn:not(.btn-close),
        html body .modal#form_create .modal-footer a.btn:not(.btn-close),
        html body .modal#form_edit .modal-footer button.btn:not(.btn-close),
        html body .modal#form_edit .modal-footer a.btn:not(.btn-close),
        html body .modal#form_detail .modal-footer button.btn:not(.btn-close),
        html body .modal#form_detail .modal-footer a.btn:not(.btn-close) {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 7px !important;
            min-width: 92px !important;
            width: auto !important;
            min-height: 40px !important;
            height: auto !important;
            margin: 0 !important;
            padding: 9px 16px !important;
            border-radius: 8px !important;
            border-width: 1px !important;
            border-style: solid !important;
            box-shadow: none !important;
            font-size: 13px !important;
            line-height: 1.15 !important;
            font-weight: 800 !important;
            text-decoration: none !important;
            text-indent: 0 !important;
            opacity: 1 !important;
            visibility: visible !important;
            pointer-events: auto !important;
            transform: none !important;
            clip: auto !important;
            clip-path: none !important;
            position: relative !important;
            z-index: 11 !important;
            -webkit-text-fill-color: currentColor !important;
        }

        html body .kelas-builder-page .modal .modal-footer .btn-primary,
        html body .quick-modal .modal-footer .btn-primary,
        html body .modal#form_create .modal-footer .btn-primary,
        html body .modal#form_edit .modal-footer .btn-primary,
        html body .modal#form_detail .modal-footer .btn-primary {
            color: #ffffff !important;
            background: #074366 !important;
            background-color: #074366 !important;
            border-color: #074366 !important;
            -webkit-text-fill-color: #ffffff !important;
        }

        html body .kelas-builder-page .modal .modal-footer .btn-light,
        html body .quick-modal .modal-footer .btn-light,
        html body .modal#form_create .modal-footer .btn-light,
        html body .modal#form_edit .modal-footer .btn-light,
        html body .modal#form_detail .modal-footer .btn-light {
            color: #ffffff !important;
            background: #ef4444 !important;
            background-color: #ef4444 !important;
            border-color: #ef4444 !important;
            -webkit-text-fill-color: #ffffff !important;
        }

        html body .kelas-builder-page .modal .modal-footer .btn-secondary,
        html body .quick-modal .modal-footer .btn-secondary,
        html body .modal#form_create .modal-footer .btn-secondary,
        html body .modal#form_edit .modal-footer .btn-secondary,
        html body .modal#form_detail .modal-footer .btn-secondary {
            color: #ffffff !important;
            background: #64748b !important;
            background-color: #64748b !important;
            border-color: #64748b !important;
            -webkit-text-fill-color: #ffffff !important;
        }

        html body .kelas-builder-page .modal .modal-footer .btn:hover,
        html body .quick-modal .modal-footer .btn:hover,
        html body .modal#form_create .modal-footer .btn:hover,
        html body .modal#form_edit .modal-footer .btn:hover,
        html body .modal#form_detail .modal-footer .btn:hover {
            opacity: 1 !important;
            visibility: visible !important;
            filter: brightness(.96) !important;
            transform: none !important;
        }

        html body .kelas-builder-page .btn-neo,
        html body .kelas-builder-page .btn-neo-primary,
        html body .kelas-builder-page .builder-action-dropdown .dropdown-toggle,
        html body .kelas-builder-page table.table td:first-child .btn,
        html body .kelas-builder-page table.table td:first-child button,
        html body .kelas-builder-page table.table td:first-child a.action-icon-btn {
            opacity: 1 !important;
            visibility: visible !important;
            pointer-events: auto !important;
            text-indent: 0 !important;
            clip-path: none !important;
        }

        html body .swal2-container {
            z-index: 2147483647 !important;
        }

        html body .swal2-container .swal2-popup {
            background: #ffffff !important;
            color: #0f172a !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 14px !important;
            box-shadow: 0 18px 45px rgba(15, 23, 42, .18) !important;
        }

        html body .swal2-container .swal2-title,
        html body .swal2-container .swal2-html-container {
            color: #0f172a !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        html body .swal2-container .swal2-actions {
            flex-direction: row !important;
            flex-wrap: wrap !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 10px !important;
            margin-top: 20px !important;
            opacity: 1 !important;
            visibility: visible !important;
            overflow: visible !important;
        }

        html body .swal2-container .swal2-actions button:not([style*="display: none"]),
        html body .swal2-container button.swal2-styled:not([style*="display: none"]),
        html body .swal2-container button.swal2-confirm:not([style*="display: none"]),
        html body .swal2-container button.swal2-cancel:not([style*="display: none"]),
        html body .swal2-container button.swal2-deny:not([style*="display: none"]) {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 7px !important;
            min-width: 104px !important;
            width: auto !important;
            min-height: 42px !important;
            height: auto !important;
            margin: 0 !important;
            padding: 10px 18px !important;
            border-radius: 8px !important;
            border-width: 1px !important;
            border-style: solid !important;
            box-shadow: none !important;
            font-size: 14px !important;
            line-height: 1.15 !important;
            font-weight: 800 !important;
            text-indent: 0 !important;
            text-decoration: none !important;
            opacity: 1 !important;
            visibility: visible !important;
            pointer-events: auto !important;
            transform: none !important;
            clip: auto !important;
            clip-path: none !important;
            -webkit-text-fill-color: currentColor !important;
        }

        html body .swal2-container button.swal2-confirm:not([style*="display: none"]) {
            color: #ffffff !important;
            background: #074366 !important;
            background-color: #074366 !important;
            border-color: #074366 !important;
            -webkit-text-fill-color: #ffffff !important;
        }

        html body .swal2-container button.swal2-cancel:not([style*="display: none"]) {
            color: #ffffff !important;
            background: #ef4444 !important;
            background-color: #ef4444 !important;
            border-color: #ef4444 !important;
            -webkit-text-fill-color: #ffffff !important;
        }

        html body .swal2-container button.swal2-deny:not([style*="display: none"]) {
            color: #ffffff !important;
            background: #64748b !important;
            background-color: #64748b !important;
            border-color: #64748b !important;
            -webkit-text-fill-color: #ffffff !important;
        }

        @media (max-width: 767.98px) {
            html body .kelas-builder-page .modal .modal-footer,
            html body .quick-modal .modal-footer,
            html body .modal#form_create .modal-footer,
            html body .modal#form_edit .modal-footer,
            html body .modal#form_detail .modal-footer {
                flex-direction: column-reverse !important;
                align-items: stretch !important;
            }

            html body .kelas-builder-page .modal .modal-footer .btn,
            html body .quick-modal .modal-footer .btn,
            html body .modal#form_create .modal-footer .btn,
            html body .modal#form_edit .modal-footer .btn,
            html body .modal#form_detail .modal-footer .btn {
                width: 100% !important;
            }
        }
    </style>



    <style>
        /* =========================================================
           FIX FINAL V4 FIELD / KOLOM FORM KELAS SELALU TERLIHAT
           - Masalah: field tampak muncul hanya saat hover karena border normal terlalu muda/tertutup style theme.
           - Solusi: paksa state normal input/select/textarea/editor di modal kelas terlihat jelas.
           - Berlaku untuk modal kelas Admin dan Mentor, termasuk quick modal isi kelas.
        ========================================================= */
        html body .modal .form-control,
        html body .modal input.form-control,
        html body .modal textarea.form-control,
        html body .modal select.form-control,
        html body .modal .form-select,
        html body .modal select.form-select,
        html body .modal .select2-container--bootstrap5 .select2-selection,
        html body .modal .select2-container .select2-selection,
        html body .modal .select2-selection,
        html body .kelas-builder-page .form-control,
        html body .kelas-builder-page input.form-control,
        html body .kelas-builder-page textarea.form-control,
        html body .kelas-builder-page select.form-control,
        html body .kelas-builder-page .form-select,
        html body .kelas-builder-page select.form-select,
        html body .kelas-builder-page .dataTables_wrapper input[type="search"],
        html body .kelas-builder-page .dataTables_wrapper select,
        html body .kelas-builder-page .select2-container--bootstrap5 .select2-selection,
        html body .kelas-builder-page .select2-container .select2-selection,
        html body .quick-modal .form-control,
        html body .quick-modal input.form-control,
        html body .quick-modal textarea.form-control,
        html body .quick-modal select.form-control,
        html body .quick-modal .form-select,
        html body .quick-modal select.form-select,
        html body .quick-modal .select2-container--bootstrap5 .select2-selection,
        html body .quick-modal .select2-container .select2-selection {
            min-height: 42px !important;
            display: block !important;
            color: #0f172a !important;
            -webkit-text-fill-color: #0f172a !important;
            background: #ffffff !important;
            background-color: #ffffff !important;
            border: 1.5px solid #94a3b8 !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            outline: none !important;
            opacity: 1 !important;
            visibility: visible !important;
            filter: none !important;
            clip: auto !important;
            clip-path: none !important;
            text-indent: 0 !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            line-height: 1.45 !important;
        }

        html body .modal input.form-control,
        html body .modal textarea.form-control,
        html body .modal select.form-control,
        html body .modal .form-select,
        html body .kelas-builder-page input.form-control,
        html body .kelas-builder-page textarea.form-control,
        html body .kelas-builder-page select.form-control,
        html body .kelas-builder-page .form-select,
        html body .quick-modal input.form-control,
        html body .quick-modal textarea.form-control,
        html body .quick-modal select.form-control,
        html body .quick-modal .form-select {
            padding: 9px 12px !important;
        }

        html body .modal .form-control:hover,
        html body .modal .form-select:hover,
        html body .modal .select2-selection:hover,
        html body .kelas-builder-page .form-control:hover,
        html body .kelas-builder-page .form-select:hover,
        html body .kelas-builder-page .select2-selection:hover,
        html body .quick-modal .form-control:hover,
        html body .quick-modal .form-select:hover,
        html body .quick-modal .select2-selection:hover {
            color: #0f172a !important;
            -webkit-text-fill-color: #0f172a !important;
            background: #ffffff !important;
            background-color: #ffffff !important;
            border-color: #64748b !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        html body .modal .form-control:focus,
        html body .modal .form-select:focus,
        html body .modal .select2-container--focus .select2-selection,
        html body .modal .select2-container--open .select2-selection,
        html body .kelas-builder-page .form-control:focus,
        html body .kelas-builder-page .form-select:focus,
        html body .kelas-builder-page .select2-container--focus .select2-selection,
        html body .kelas-builder-page .select2-container--open .select2-selection,
        html body .quick-modal .form-control:focus,
        html body .quick-modal .form-select:focus,
        html body .quick-modal .select2-container--focus .select2-selection,
        html body .quick-modal .select2-container--open .select2-selection {
            color: #0f172a !important;
            -webkit-text-fill-color: #0f172a !important;
            background: #ffffff !important;
            background-color: #ffffff !important;
            border-color: #074366 !important;
            box-shadow: 0 0 0 .2rem rgba(7, 67, 102, .14) !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        html body .modal .form-control::placeholder,
        html body .kelas-builder-page .form-control::placeholder,
        html body .quick-modal .form-control::placeholder {
            color: #64748b !important;
            -webkit-text-fill-color: #64748b !important;
            opacity: 1 !important;
            font-weight: 500 !important;
        }

        html body .modal textarea.form-control,
        html body .kelas-builder-page textarea.form-control,
        html body .quick-modal textarea.form-control {
            min-height: 96px !important;
            resize: vertical !important;
        }

        html body .modal input[type="file"].form-control,
        html body .kelas-builder-page input[type="file"].form-control,
        html body .quick-modal input[type="file"].form-control {
            padding: 7px 12px !important;
        }

        html body .modal input[type="file"].form-control::file-selector-button,
        html body .kelas-builder-page input[type="file"].form-control::file-selector-button,
        html body .quick-modal input[type="file"].form-control::file-selector-button {
            color: #0f172a !important;
            background: #e2e8f0 !important;
            border: 0 !important;
            border-radius: 6px !important;
            padding: 7px 12px !important;
            margin: -7px 12px -7px -12px !important;
            font-weight: 700 !important;
        }

        html body .modal .form-check-input,
        html body .kelas-builder-page .form-check-input,
        html body .quick-modal .form-check-input {
            width: 18px !important;
            height: 18px !important;
            background-color: #ffffff !important;
            border: 1.5px solid #64748b !important;
            box-shadow: none !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        html body .modal .form-check-input:checked,
        html body .kelas-builder-page .form-check-input:checked,
        html body .quick-modal .form-check-input:checked {
            background-color: #074366 !important;
            border-color: #074366 !important;
        }

        html body .modal .form-label,
        html body .modal label,
        html body .kelas-builder-page .form-label,
        html body .kelas-builder-page label,
        html body .quick-modal .form-label,
        html body .quick-modal label {
            color: #0f172a !important;
            opacity: 1 !important;
            visibility: visible !important;
            font-weight: 800 !important;
        }

        /* Quill editor: deskripsi/materi di dalam kelas */
        html body .modal .ql-toolbar.ql-snow,
        html body .kelas-builder-page .ql-toolbar.ql-snow,
        html body .quick-modal .ql-toolbar.ql-snow {
            display: block !important;
            background: #ffffff !important;
            border: 1.5px solid #94a3b8 !important;
            border-bottom: 1px solid #cbd5e1 !important;
            border-radius: 8px 8px 0 0 !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        html body .modal .ql-container.ql-snow,
        html body .kelas-builder-page .ql-container.ql-snow,
        html body .quick-modal .ql-container.ql-snow {
            display: block !important;
            min-height: 170px !important;
            background: #ffffff !important;
            border: 1.5px solid #94a3b8 !important;
            border-top: 0 !important;
            border-radius: 0 0 8px 8px !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        html body .modal .ql-editor,
        html body .kelas-builder-page .ql-editor,
        html body .quick-modal .ql-editor {
            min-height: 170px !important;
            color: #0f172a !important;
            -webkit-text-fill-color: #0f172a !important;
            background: #ffffff !important;
            opacity: 1 !important;
            visibility: visible !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            line-height: 1.6 !important;
        }

        html body .modal .ql-editor.ql-blank::before,
        html body .kelas-builder-page .ql-editor.ql-blank::before,
        html body .quick-modal .ql-editor.ql-blank::before {
            color: #64748b !important;
            opacity: 1 !important;
            font-style: normal !important;
        }

        html body .modal .ql-snow .ql-stroke,
        html body .kelas-builder-page .ql-snow .ql-stroke,
        html body .quick-modal .ql-snow .ql-stroke {
            stroke: #334155 !important;
        }

        html body .modal .ql-snow .ql-fill,
        html body .kelas-builder-page .ql-snow .ql-fill,
        html body .quick-modal .ql-snow .ql-fill {
            fill: #334155 !important;
        }

        html body .modal .ql-snow .ql-picker,
        html body .kelas-builder-page .ql-snow .ql-picker,
        html body .quick-modal .ql-snow .ql-picker {
            color: #334155 !important;
        }

        /* Select2 text agar tidak putih/transparan */
        html body .modal .select2-container .select2-selection__rendered,
        html body .kelas-builder-page .select2-container .select2-selection__rendered,
        html body .quick-modal .select2-container .select2-selection__rendered {
            color: #0f172a !important;
            -webkit-text-fill-color: #0f172a !important;
            opacity: 1 !important;
            line-height: 40px !important;
            font-weight: 600 !important;
        }

        html body .modal .select2-container .select2-selection__placeholder,
        html body .kelas-builder-page .select2-container .select2-selection__placeholder,
        html body .quick-modal .select2-container .select2-selection__placeholder {
            color: #64748b !important;
            -webkit-text-fill-color: #64748b !important;
            opacity: 1 !important;
        }

        html body .select2-dropdown,
        html body .select2-container--open .select2-dropdown {
            background: #ffffff !important;
            border: 1.5px solid #94a3b8 !important;
            border-radius: 8px !important;
            box-shadow: 0 15px 35px rgba(15, 23, 42, .16) !important;
            color: #0f172a !important;
            opacity: 1 !important;
            visibility: visible !important;
            z-index: 2147483647 !important;
        }

        html body .select2-results__option {
            color: #0f172a !important;
            background: #ffffff !important;
        }

        html body .select2-results__option--highlighted,
        html body .select2-container--bootstrap5 .select2-results__option--highlighted {
            color: #ffffff !important;
            background: #074366 !important;
        }
    </style>

</head>

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed aside-enabled aside-fixed">

    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">

            <div id="kt_aside" class="aside aside-dark aside-hoverable"
                data-kt-drawer="true"
                data-kt-drawer-name="aside"
                data-kt-drawer-activate="{default: true, lg: false}"
                data-kt-drawer-overlay="true"
                data-kt-drawer-width="{default:'200px', '300px': '250px'}"
                data-kt-drawer-direction="start"
                data-kt-drawer-toggle="#kt_aside_mobile_toggle">

                <div class="aside-logo flex-column-auto" id="kt_aside_logo">
                    <p class="text-white fw-bold fs-4 p-2">Universitas Nurul Jadid</p>
                </div>

                <div class="aside-menu flex-column-fluid">
                    @include('mentor.layouts.menu')
                </div>
            </div>

            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                @include('mentor.layouts.header')

                <div class="container-fluid d-flex align-items-stretch justify-content-between">
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold mt-5">
                        @yield('list')
                    </ul>
                </div>

                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        @yield('content')
                    </div>
                </div>

                @include('mentor.layouts.footer')
            </div>

        </div>
    </div>

    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <span class="svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none">
                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1"
                    transform="rotate(90 13 6)" fill="black" />
                <path
                    d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                    fill="black" />
            </svg>
        </span>
    </div>

    <script src="{{ asset('assets/plugins/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

    <script>
        /**
         * Global SweetAlert Handler Mentor
         *
         * Fungsi:
         * - Semua alert success tanpa tombol OK
         * - Timer otomatis 2500ms
         * - Tambah  => Data berhasil ditambahkan
         * - Update  => Data berhasil diperbarui
         * - Hapus   => Data berhasil dihapus
         */
        if (window.Swal && Swal.fire) {
            const originalSwalFire = Swal.fire.bind(Swal);

            function getGlobalSuccessTitle(options) {
                const title = String(options.title || '').toLowerCase();
                const text = String(options.text || '').toLowerCase();
                const html = String(options.html || '').toLowerCase();
                const message = `${title} ${text} ${html}`;

                if (
                    message.includes('hapus') ||
                    message.includes('dihapus') ||
                    message.includes('delete') ||
                    message.includes('deleted') ||
                    message.includes('destroy')
                ) {
                    return 'Data berhasil dihapus';
                }

                if (
                    message.includes('update') ||
                    message.includes('updated') ||
                    message.includes('ubah') ||
                    message.includes('diubah') ||
                    message.includes('perbarui') ||
                    message.includes('diperbarui')
                ) {
                    return 'Data berhasil diperbarui';
                }

                if (
                    message.includes('tambah') ||
                    message.includes('ditambahkan') ||
                    message.includes('buat') ||
                    message.includes('dibuat') ||
                    message.includes('simpan') ||
                    message.includes('tersimpan') ||
                    message.includes('create') ||
                    message.includes('created') ||
                    message.includes('store')
                ) {
                    return 'Data berhasil ditambahkan';
                }

                if (
                    title === 'success' ||
                    title === 'berhasil' ||
                    title === 'berhasil!'
                ) {
                    return text || 'Berhasil';
                }

                return options.title || 'Berhasil';
            }

            function normalizeGlobalSweetAlert(args) {
                let options = {};

                if (args.length === 1 && typeof args[0] === 'object') {
                    options = { ...args[0] };
                } else if (typeof args[0] === 'string') {
                    options = {
                        title: args[0],
                        text: args[1] || '',
                        icon: args[2] || undefined
                    };
                } else {
                    return null;
                }

                const title = String(options.title || '').toLowerCase();
                const text = String(options.text || '').toLowerCase();
                const html = String(options.html || '').toLowerCase();
                const message = `${title} ${text} ${html}`;

                const isSuccessAlert =
                    options.icon === 'success' ||
                    message.includes('success') ||
                    message.includes('berhasil');

                if (!isSuccessAlert) {
                    return options;
                }

                return {
                    ...options,
                    icon: 'success',
                    title: getGlobalSuccessTitle(options),
                    text: '',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true
                };
            }

            Swal.fire = function (...args) {
                const normalizedOptions = normalizeGlobalSweetAlert(args);

                if (normalizedOptions) {
                    return originalSwalFire(normalizedOptions);
                }

                return originalSwalFire(...args);
            };
        }
    </script>

    <script src="{{ asset('assets/js/validation.js') }}"></script>
    <script src="{{ asset('assets/js/dateformat.js') }}"></script>
<script>
        @if(session()->has('successlogin'))
            Swal.fire({
                icon: 'success',
                title: "{{ session()->get('successlogin') }}",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true
            });
        @endif
    </script>

    @yield('javascript')

<script>
    /* =========================================================
       FIX FINAL RENDER TOMBOL KELAS
       Memaksa tombol yang memang ada supaya langsung berwarna,
       bukan baru terlihat ketika cursor diarahkan ke tombol.
    ========================================================= */
    (function installFinalKelasButtonVisibilityFix() {
        function isHiddenByIntent(element) {
            if (!element) return true;
            if (element.hidden) return true;
            if (element.getAttribute('aria-hidden') === 'true') return true;
            const inline = String(element.getAttribute('style') || '').toLowerCase().replace(/\s+/g, ' ');
            if (inline.includes('display: none')) return true;
            if (element.classList.contains('d-none')) return true;
            return false;
        }

        function paintButton(button, type) {
            if (!button || button.classList.contains('btn-close') || isHiddenByIntent(button)) return;

            button.style.setProperty('display', 'inline-flex', 'important');
            button.style.setProperty('align-items', 'center', 'important');
            button.style.setProperty('justify-content', 'center', 'important');
            button.style.setProperty('gap', '7px', 'important');
            button.style.setProperty('min-height', type === 'swal' ? '42px' : '40px', 'important');
            button.style.setProperty('height', 'auto', 'important');
            button.style.setProperty('width', 'auto', 'important');
            button.style.setProperty('min-width', type === 'swal' ? '104px' : '92px', 'important');
            button.style.setProperty('margin', '0', 'important');
            button.style.setProperty('padding', type === 'swal' ? '10px 18px' : '9px 16px', 'important');
            button.style.setProperty('border-radius', '8px', 'important');
            button.style.setProperty('border-width', '1px', 'important');
            button.style.setProperty('border-style', 'solid', 'important');
            button.style.setProperty('box-shadow', 'none', 'important');
            button.style.setProperty('font-size', type === 'swal' ? '14px' : '13px', 'important');
            button.style.setProperty('line-height', '1.15', 'important');
            button.style.setProperty('font-weight', '800', 'important');
            button.style.setProperty('text-indent', '0', 'important');
            button.style.setProperty('text-decoration', 'none', 'important');
            button.style.setProperty('opacity', '1', 'important');
            button.style.setProperty('visibility', 'visible', 'important');
            button.style.setProperty('pointer-events', 'auto', 'important');
            button.style.setProperty('transform', 'none', 'important');
            button.style.setProperty('clip-path', 'none', 'important');
            button.style.setProperty('-webkit-text-fill-color', '#ffffff', 'important');
            button.style.setProperty('color', '#ffffff', 'important');

            const className = button.className || '';
            const text = (button.textContent || '').toLowerCase();
            const isCancel = button.classList.contains('swal2-cancel') || button.classList.contains('btn-light') || text.includes('batal') || text.includes('tutup');
            const isDeny = button.classList.contains('swal2-deny') || button.classList.contains('btn-secondary');
            const isDanger = button.classList.contains('btn-danger') || className.includes('danger') || text.includes('hapus');

            let bg = '#074366';
            if (isDeny) bg = '#64748b';
            if (isCancel || isDanger) bg = '#ef4444';

            button.style.setProperty('background', bg, 'important');
            button.style.setProperty('background-color', bg, 'important');
            button.style.setProperty('border-color', bg, 'important');
        }

        function paintModalButtons(root) {
            const scope = root && root.querySelectorAll ? root : document;

            scope.querySelectorAll('.quick-modal .modal-footer, .kelas-builder-page .modal .modal-footer, .modal#form_create .modal-footer, .modal#form_edit .modal-footer, .modal#form_detail .modal-footer')
                .forEach(function (footer) {
                    footer.style.setProperty('display', 'flex', 'important');
                    footer.style.setProperty('align-items', 'center', 'important');
                    footer.style.setProperty('justify-content', 'flex-end', 'important');
                    footer.style.setProperty('flex-wrap', 'wrap', 'important');
                    footer.style.setProperty('gap', '10px', 'important');
                    footer.style.setProperty('min-height', '66px', 'important');
                    footer.style.setProperty('background', '#ffffff', 'important');
                    footer.style.setProperty('border-top', '1px solid #e5e7eb', 'important');
                    footer.style.setProperty('opacity', '1', 'important');
                    footer.style.setProperty('visibility', 'visible', 'important');
                    footer.style.setProperty('overflow', 'visible', 'important');
                    footer.querySelectorAll('button.btn:not(.btn-close), a.btn:not(.btn-close)').forEach(function (button) {
                        paintButton(button, 'modal');
                    });
                });
        }

        function paintSweetAlertButtons() {
            const actions = document.querySelector('.swal2-actions');
            if (actions) {
                actions.style.setProperty('display', 'flex', 'important');
                actions.style.setProperty('align-items', 'center', 'important');
                actions.style.setProperty('justify-content', 'center', 'important');
                actions.style.setProperty('gap', '10px', 'important');
                actions.style.setProperty('opacity', '1', 'important');
                actions.style.setProperty('visibility', 'visible', 'important');
                actions.style.setProperty('overflow', 'visible', 'important');
            }

            document.querySelectorAll('.swal2-actions button, button.swal2-confirm, button.swal2-cancel, button.swal2-deny')
                .forEach(function (button) {
                    if (isHiddenByIntent(button)) return;
                    paintButton(button, 'swal');
                });
        }

        function applyAll(root) {
            paintModalButtons(root || document);
            paintSweetAlertButtons();
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function () { applyAll(document); });
        } else {
            applyAll(document);
        }

        document.addEventListener('show.bs.modal', function (event) { applyAll(event.target || document); });
        document.addEventListener('shown.bs.modal', function (event) { applyAll(event.target || document); });
        document.addEventListener('mouseover', function (event) {
            const modal = event.target && event.target.closest ? event.target.closest('.modal, .swal2-container') : null;
            if (modal) applyAll(modal);
        }, true);

        var observer = new MutationObserver(function (mutations) {
            var shouldApply = false;
            mutations.forEach(function (mutation) {
                if (mutation.type === 'childList' && mutation.addedNodes.length) shouldApply = true;
                if (mutation.type === 'attributes' && mutation.target && mutation.target.matches && mutation.target.matches('.btn, .swal2-confirm, .swal2-cancel, .swal2-deny, .modal-footer')) shouldApply = true;
            });
            if (shouldApply) {
                window.requestAnimationFrame(function () { applyAll(document); });
            }
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true,
            attributes: true,
            attributeFilter: ['class', 'style', 'hidden', 'aria-hidden']
        });

        window.requestAnimationFrame(function () { applyAll(document); });
        window.setTimeout(function () { applyAll(document); }, 300);
        window.setTimeout(function () { applyAll(document); }, 900);
    })();
</script>


</body>
</html>