@extends('admin.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/buttons.dataTables.min.css') }}"/>

    <style>
        :root {
            --neo-bg: #eef2f7;
            --neo-surface: #eef2f7;
            --neo-surface-soft: #f3f6fa;
            --neo-text: #1f2937;
            --neo-muted: #6b7280;
            --neo-border: rgba(148, 163, 184, 0.18);
            --neo-shadow-dark: rgba(163, 177, 198, 0.42);
            --neo-shadow-light: rgba(255, 255, 255, 0.95);
            --neo-primary: #3b82f6;
            --neo-primary-dark: #2563eb;
        }

        .neo-page {
            width: 100%;
            padding: 0 30px 30px;
        }

        .neo-page-shell {
            width: 100%;
            max-width: 1480px;
            margin: 0 auto;
        }

        .neo-page-inner {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .neo-page-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 24px;
            border-radius: 24px;
            background: var(--neo-surface);
            box-shadow:
                10px 10px 22px var(--neo-shadow-dark),
                -10px -10px 22px var(--neo-shadow-light);
        }

        .neo-page-title {
            margin: 0;
            color: var(--neo-text);
            font-size: 1.65rem;
            line-height: 1.2;
            font-weight: 800;
            letter-spacing: -0.025em;
        }

        .neo-page-subtitle {
            margin: 7px 0 0;
            color: var(--neo-muted);
            font-size: 0.94rem;
            line-height: 1.45;
            font-weight: 500;
        }

        .neo-page-icon {
            width: 58px;
            height: 58px;
            min-width: 58px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--neo-surface);
            color: var(--neo-primary);
            box-shadow:
                inset 5px 5px 10px rgba(163, 177, 198, 0.28),
                inset -5px -5px 10px rgba(255, 255, 255, 0.92);
            font-size: 1.45rem;
        }

        .neo-card {
            border: 0 !important;
            border-radius: 24px;
            background: var(--neo-surface) !important;
            box-shadow:
                10px 10px 22px var(--neo-shadow-dark),
                -10px -10px 22px var(--neo-shadow-light) !important;
            overflow: hidden;
        }

        .neo-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 22px 24px 18px;
            border-bottom: 1px solid var(--neo-border);
            background: transparent !important;
            min-height: auto !important;
        }

        .neo-card-title {
            margin: 0;
            color: var(--neo-text);
            font-size: 1.08rem;
            line-height: 1.25;
            font-weight: 800;
        }

        .neo-card-subtitle {
            margin: 6px 0 0;
            color: var(--neo-muted);
            font-size: 0.86rem;
            line-height: 1.4;
            font-weight: 500;
        }

        .neo-btn-primary {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            border: 0;
            border-radius: 16px;
            color: #ffffff !important;
            background: var(--neo-primary) !important;
            font-size: 0.88rem;
            line-height: 1;
            font-weight: 800;
            box-shadow:
                7px 7px 16px rgba(163, 177, 198, 0.44),
                -7px -7px 16px rgba(255, 255, 255, 0.9);
            transition: .18s ease;
        }

        .neo-btn-primary:hover {
            transform: translateY(-1px);
            color: #ffffff !important;
            background: var(--neo-primary-dark) !important;
        }

        .neo-card-body {
            padding: 22px 24px 24px !important;
        }

        .neo-table-panel {
            width: 100%;
            border-radius: 20px;
            padding: 12px;
            background: var(--neo-surface);
            box-shadow:
                inset 6px 6px 12px rgba(163, 177, 198, 0.24),
                inset -6px -6px 12px rgba(255, 255, 255, 0.92);
        }

        .neo-table-scroll {
            width: 100%;
            overflow-x: auto;
            border-radius: 16px;
        }

        #example {
            width: 100% !important;
            margin: 0 !important;
            border-collapse: separate !important;
            border-spacing: 0 8px !important;
        }

        #example thead th {
            padding: 8px 14px 10px !important;
            border: 0 !important;
            background: transparent !important;
            color: var(--neo-muted) !important;
            font-size: 0.76rem !important;
            line-height: 1.35;
            font-weight: 800 !important;
            letter-spacing: .055em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        #example tbody td {
            padding: 14px !important;
            border: 0 !important;
            background: var(--neo-surface-soft) !important;
            color: var(--neo-text) !important;
            font-size: 0.9rem;
            line-height: 1.35;
            vertical-align: middle;
        }

        #example tbody tr td:first-child {
            border-top-left-radius: 14px;
            border-bottom-left-radius: 14px;
        }

        #example tbody tr td:last-child {
            border-top-right-radius: 14px;
            border-bottom-right-radius: 14px;
        }

        #example tbody tr:hover td {
            background: #f8fafc !important;
        }

        #example .btn {
            border-radius: 12px !important;
            font-weight: 700;
        }

        #example .badge {
            border-radius: 999px;
            padding: 7px 11px;
            font-weight: 800;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            color: var(--neo-muted) !important;
            font-size: 0.86rem;
            font-weight: 600;
        }

        .dataTables_wrapper .dataTables_length {
            padding: 2px 0 14px;
        }

        .dataTables_wrapper .dataTables_filter {
            padding: 2px 0 14px;
            text-align: right;
        }

        .dataTables_wrapper .dataTables_length label,
        .dataTables_wrapper .dataTables_filter label {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin: 0;
            color: var(--neo-muted);
            font-size: 0.86rem;
            font-weight: 700;
        }

        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            min-height: 40px;
            border: 0 !important;
            border-radius: 14px !important;
            background: var(--neo-surface) !important;
            color: var(--neo-text) !important;
            box-shadow:
                inset 4px 4px 8px rgba(163, 177, 198, 0.26),
                inset -4px -4px 8px rgba(255, 255, 255, 0.92) !important;
            outline: none !important;
        }

        .dataTables_wrapper .dataTables_filter input {
            width: 230px !important;
            padding: 9px 14px !important;
        }

        .dataTables_wrapper .pagination {
            gap: 8px;
            margin: 0 !important;
            justify-content: flex-end;
        }

        .dataTables_wrapper .page-item .page-link {
            min-width: 38px;
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0 !important;
            border-radius: 13px !important;
            background: var(--neo-surface) !important;
            color: var(--neo-muted) !important;
            font-size: 0.86rem;
            font-weight: 800;
            box-shadow:
                5px 5px 10px rgba(163, 177, 198, 0.34),
                -5px -5px 10px rgba(255, 255, 255, 0.92);
        }

        .dataTables_wrapper .page-item.active .page-link {
            color: #ffffff !important;
            background: var(--neo-primary) !important;
        }

        @media (max-width: 767.98px) {
            .neo-page {
                padding: 0 18px 24px;
            }

            .neo-page-heading {
                align-items: flex-start;
                padding: 20px;
                border-radius: 22px;
            }

            .neo-page-title {
                font-size: 1.42rem;
            }

            .neo-card-header {
                align-items: flex-start;
                flex-direction: column;
                padding: 18px 18px 14px;
            }

            .neo-btn-primary {
                width: 100%;
            }

            .neo-card-body {
                padding: 18px !important;
            }

            .dataTables_wrapper .dataTables_filter {
                text-align: left;
            }

            .dataTables_wrapper .dataTables_filter input {
                width: 100% !important;
            }
        }

        @media (max-width: 575.98px) {
            .neo-page {
                padding: 0 14px 20px;
            }

            .neo-page-icon {
                display: none;
            }

            .neo-table-panel {
                padding: 8px;
                border-radius: 16px;
            }
        }
    </style>
@endsection

@section('list')
    <li class="breadcrumb-item text-muted">Kelas</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">Sub Kategori</li>
@endsection

@section('content')
    <div class="container-fluid neo-page">
        <div class="neo-page-shell">
            <div class="neo-page-inner">

                <div class="neo-page-heading">
                    <div>
                        <h3 class="neo-page-title">Data Sub Kategori Kelas</h3>
                        <p class="neo-page-subtitle">Kelola sub kategori berdasarkan kategori kelas utama</p>
                    </div>

                    <div class="neo-page-icon">
                        <i class="bi bi-diagram-3-fill"></i>
                    </div>
                </div>

                <div class="neo-card">
                    <div class="neo-card-header">
                        <div>
                            <h3 class="neo-card-title">Daftar Sub Kategori</h3>
                            <p class="neo-card-subtitle">Lihat, tambah, ubah, dan kelola sub kategori kelas</p>
                        </div>

                        <a type="button"
                           class="neo-btn-primary"
                           data-bs-toggle="modal"
                           data-bs-target="#form_create"
                           title="Tambah Sub Kategori">
                            <i class="bi bi-plus-lg"></i>
                            Tambah Sub Kategori
                        </a>
                    </div>

                    <div class="neo-card-body">
                        <div class="neo-table-panel">
                            <div class="neo-table-scroll">
                                <table id="example"
                                       class="table table-sm align-middle table-row-bordered table-row-solid gs-0 gy-2">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0 fs-sm-8 fs-lg-6">
                                            <th class="min-w-125px ps-5 text-nowrap">Aksi</th>
                                            <th class="min-w-150px">Kategori</th>
                                            <th class="min-w-150px">Nama Sub</th>
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

            </div>
        </div>
    </div>

    @include('admin.kategori_sub.view.detail')
    @include('admin.kategori_sub.view.create')
    @include('admin.kategori_sub.view.edit')
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

    @include('admin.kategori_sub.script.list')
    @include('admin.kategori_sub.script.create')
    @include('admin.kategori_sub.script.edit')
    @include('admin.kategori_sub.script.detail')
@endsection