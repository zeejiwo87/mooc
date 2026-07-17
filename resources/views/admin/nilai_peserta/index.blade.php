@extends('admin.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/buttons.dataTables.min.css') }}">
    <style>

    .nilai-page .dt-buttons {
        margin-bottom: 14px;
    }

    .nilai-page .dt-buttons .buttons-excel,
    .nilai-page .dt-buttons .buttons-excelHtml5 {
        min-height: 38px;
        padding: 8px 14px !important;
        color: #ffffff !important;
        background: #059669 !important;
        border: 0 !important;
        border-radius: 8px !important;
        font-size: 13px;
        font-weight: 800;
        box-shadow: none !important;
    }

    .nilai-page .dt-buttons .buttons-excel:hover,
    .nilai-page .dt-buttons .buttons-excelHtml5:hover {
        color: #ffffff !important;
        background: #047857 !important;
    }

    .nilai-page .dataTables_length {
        margin-bottom: 12px;
    }

    .nilai-page .dataTables_filter {
        margin-bottom: 12px;
    }

        .nilai-page {
            width: 100%;
        }

        .nilai-page .page-title h3 {
            margin-bottom: 5px;
            color: #111827;
        }

        .nilai-page .page-title p {
            color: #64748b;
        }

        .nilai-page .card {
            overflow: hidden;
            border: 0;
            border-radius: 12px;
            background: #ffffff;
            box-shadow: 0 6px 18px rgba(15, 23, 42, .06);
        }

        .nilai-page .card-header {
            min-height: auto;
            padding: 16px 18px;
            background: #ffffff;
            border-bottom: 1px solid #eef2f7;
        }

        .nilai-page .card-body {
            padding: 18px;
        }

        .filter-panel {
            margin-bottom: 20px;
            padding: 16px;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
        }

        .filter-label {
            display: block;
            margin-bottom: 7px;
            color: #111827;
            font-size: 13px;
            font-weight: 800;
        }

        .filter-panel .form-select,
        .filter-panel .select2-container .select2-selection--single {
            min-height: 40px;
            color: #111827 !important;
            background: #ffffff !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 8px !important;
            box-shadow: none !important;
        }

        .filter-panel .select2-container {
            width: 100% !important;
        }

        .filter-panel .select2-container .select2-selection--single {
            display: flex;
            align-items: center;
            padding: 6px 10px;
        }

        .filter-panel .form-select:focus,
        .filter-panel .select2-container--focus .select2-selection {
            border-color: #074366 !important;
            box-shadow: 0 0 0 .2rem rgba(7, 67, 102, .10) !important;
        }

        .select2-container--open {
            z-index: 1065 !important;
        }

        .nilai-page .table {
            width: 100% !important;
            margin-bottom: 0;
        }

        .nilai-page .table thead th {
            padding: 12px 10px;
            color: #64748b;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
        }

        .nilai-page .table tbody td {
            padding: 12px 10px;
            color: #111827;
            font-size: 13px;
            vertical-align: middle;
        }

        .nilai-page .table tbody tr:hover {
            background: #f8fafc;
        }

        .participant-name {
            color: #111827;
            font-weight: 800;
        }

        .participant-email {
            margin-top: 2px;
            color: #64748b;
            font-size: 12px;
            font-weight: 500;
        }

        .score-value {
            color: #074366;
            font-size: 15px;
            font-weight: 800;
        }

        .badge {
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
        }

        .badge-light-success {
            color: #047857 !important;
            background: #ecfdf5 !important;
            border: 1px solid #bbf7d0;
        }

        .badge-light-warning {
            color: #92400e !important;
            background: #fffbeb !important;
            border: 1px solid #fde68a;
        }

        .badge-light-danger {
            color: #b91c1c !important;
            background: #fef2f2 !important;
            border: 1px solid #fecaca;
        }

        .badge-light-primary {
            color: #1d4ed8 !important;
            background: #eff6ff !important;
            border: 1px solid #bfdbfe;
        }

        .badge-light-dark,
        .badge-light-secondary {
            color: #475569 !important;
            background: #f1f5f9 !important;
            border: 1px solid #cbd5e1;
        }

        #nilai-table td:first-child,
        #nilai-table th:first-child {
            width: 70px !important;
            min-width: 70px !important;
            text-align: center;
        }

        #nilai-table .action-icon-btn {
            width: 34px !important;
            height: 34px !important;
            padding: 0 !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            color: #ffffff !important;
            background: #2563eb !important;
            border: 0 !important;
            border-radius: 8px !important;
        }

        #nilai-table .action-icon-btn:hover {
            background: #1d4ed8 !important;
        }

        #nilai-table .action-icon-btn[onclick*="deleteConfirmation"] {
            color: #ffffff !important;
            background: #dc2626 !important;
        }

        #nilai-table .action-icon-btn[onclick*="deleteConfirmation"]:hover {
            background: #b91c1c !important;
        }

        .progress-wrapper {
            min-width: 125px;
        }

        .progress-value {
            margin-bottom: 5px;
            color: #334155;
            font-size: 12px;
            font-weight: 700;
        }

        .progress {
            height: 7px;
            overflow: hidden;
            background: #e5e7eb;
            border-radius: 999px;
        }

        .progress-bar {
            background: #074366;
            border-radius: 999px;
        }

        .modal-content {
            overflow: hidden;
            border: 0;
            border-radius: 12px;
            box-shadow: 0 18px 45px rgba(15, 23, 42, .18);
        }

        .modal-header {
            padding: 17px 20px;
            border-bottom: 1px solid #eef2f7;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            padding: 14px 20px;
            border-top: 1px solid #eef2f7;
        }

        .participant-card {
            margin-bottom: 18px;
            padding: 16px;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
        }

        .participant-card h5 {
            margin-bottom: 4px;
            color: #111827;
            font-size: 17px;
            font-weight: 800;
        }

        .participant-card p {
            margin-bottom: 0;
            color: #64748b;
            font-size: 13px;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 20px;
        }

        .summary-item {
            padding: 14px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
        }

        .summary-label {
            margin-bottom: 6px;
            color: #64748b;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .summary-value {
            color: #111827;
            font-size: 18px;
            font-weight: 800;
        }

        .detail-table-wrapper {
            overflow-x: auto;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
        }

        #detail-nilai-table {
            margin-bottom: 0;
        }

        #detail-nilai-table thead th {
            padding: 11px;
            color: #64748b;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            white-space: nowrap;
            background: #f8fafc;
        }

        #detail-nilai-table tbody td {
            padding: 11px;
            color: #334155;
            font-size: 12px;
            vertical-align: middle;
        }

        .quiz-title {
            color: #111827;
            font-weight: 800;
        }

        .quiz-material {
            margin-top: 3px;
            color: #64748b;
            font-size: 11px;
        }

        .loading-detail {
            padding: 35px;
            color: #64748b;
            text-align: center;
        }

        .btn-close-modal {
            min-height: 38px;
            padding: 8px 16px;
            color: #ffffff !important;
            font-weight: 700;
            background: #ef4444 !important;
            border: 0;
            border-radius: 8px;
        }

        .dataTables_wrapper .dataTables_filter input {
            min-height: 38px;
            padding: 7px 10px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
        }

        .dataTables_wrapper .dataTables_length select {
            min-height: 38px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
        }

        @media (max-width: 991.98px) {
            .filter-grid {
                grid-template-columns: 1fr;
            }

            .summary-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 575.98px) {
            .summary-grid {
                grid-template-columns: 1fr;
            }

            .modal-body {
                padding: 15px;
            }
        }
    </style>
@endsection

@section('list')
    <li class="breadcrumb-item text-muted">Kelas</li>

    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>

    <li class="breadcrumb-item text-dark">Nilai Peserta</li>
@endsection

@section('content')
    <div class="container-fluid nilai-page">

        <div class="page-title mb-4">
            <h3 class="fw-bold">Nilai Peserta</h3>

            <p class="mb-0">
                Rekap nilai seluruh peserta yang sudah terdaftar pada kelas
            </p>
        </div>

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title mb-0">
                    <span class="card-label fw-bolder">
                        Daftar Nilai Peserta
                    </span>
                </h3>
            </div>

            <div class="card-body">

                <div class="filter-panel">
                    <div class="filter-grid">

                        <div>
                            <label for="filter_id_mentor" class="filter-label">
                                Mentor
                            </label>

                            <select
                                id="filter_id_mentor"
                                class="form-select form-select-sm"
                                data-control="select2"
                                data-allow-clear="true"
                                data-placeholder="Semua mentor"
                            >
                                <option value=""></option>
                            </select>
                        </div>

                        <div>
                            <label for="filter_id_kelas" class="filter-label">
                                Kelas
                            </label>

                            <select
                                id="filter_id_kelas"
                                class="form-select form-select-sm"
                                data-control="select2"
                                data-allow-clear="true"
                                data-placeholder="Semua kelas"
                            >
                                <option value=""></option>
                            </select>
                        </div>

                        <div>
                            <label for="filter_status_nilai" class="filter-label">
                                Status Nilai
                            </label>

                            <select
                                id="filter_status_nilai"
                                class="form-select form-select-sm"
                                data-control="select2"
                            >
                                <option value="">Semua status nilai</option>
                                <option value="belum_ada_kuis">Belum ada kuis</option>
                                <option value="belum_mengerjakan">Belum mengerjakan</option>
                                <option value="sedang_mengerjakan">Sedang mengerjakan</option>
                                <option value="semua_lulus">Semua kuis lulus</option>
                            </select>
                        </div>

                        <div>
                            <label for="filter_status_pendaftaran" class="filter-label">
                                Status Pendaftaran
                            </label>

                            <select
                                id="filter_status_pendaftaran"
                                class="form-select form-select-sm"
                                data-control="select2"
                            >
                                <option value="">Semua status pendaftaran</option>
                                <option value="aktif">Aktif</option>
                                <option value="selesai">Selesai</option>
                                <option value="expired">Expired</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="table-responsive">
                    <table
                        id="nilai-table"
                        class="table table-sm align-middle table-row-bordered gy-3"
                    >
                        <thead>
                            <tr>
                                <th>Aksi</th>
                                <th>Peserta</th>
                                <th>Kelas</th>
                                <th>Mentor</th>
                                <th>Kuis Dikerjakan</th>
                                <th>Rata-rata</th>
                                <th>Kuis Lulus</th>
                                <th>Status Nilai</th>
                                <th>Progres Kelas</th>
                                <th>Status Daftar</th>
                                <th>Terakhir Mengerjakan</th>
                            </tr>
                        </thead>

                        <tbody></tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    {{-- Modal detail nilai --}}
    <div
        class="modal fade"
        id="form_detail"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <div>
                        <h5 class="modal-title fw-bold">
                            Detail Nilai Peserta
                        </h5>

                        <small class="text-muted">
                            Rincian seluruh kuis pada kelas
                        </small>
                    </div>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Tutup"
                    ></button>
                </div>

                <div class="modal-body">

                    <div id="detail-loading" class="loading-detail">
                        <span class="spinner-border spinner-border-sm me-2"></span>
                        Mengambil data nilai...
                    </div>

                    <div id="detail-content" class="d-none">

                        <div class="participant-card">
                            <h5 id="detail-pengguna-nama">-</h5>

                            <p>
                                <span id="detail-pengguna-email">-</span>
                                <span class="mx-2">•</span>
                                <span id="detail-kelas-judul">-</span>
                                <span class="mx-2">•</span>
                                Mentor: <span id="detail-mentor-nama">-</span>
                            </p>
                        </div>

                        <div class="summary-grid">

                            <div class="summary-item">
                                <div class="summary-label">
                                    Total Kuis
                                </div>

                                <div class="summary-value" id="detail-total-kuis">
                                    0
                                </div>
                            </div>

                            <div class="summary-item">
                                <div class="summary-label">
                                    Sudah Dikerjakan
                                </div>

                                <div class="summary-value" id="detail-kuis-dikerjakan">
                                    0
                                </div>
                            </div>

                            <div class="summary-item">
                                <div class="summary-label">
                                    Kuis Lulus
                                </div>

                                <div class="summary-value" id="detail-kuis-lulus">
                                    0
                                </div>
                            </div>

                            <div class="summary-item">
                                <div class="summary-label">
                                    Rata-rata Nilai
                                </div>

                                <div class="summary-value" id="detail-rata-rata">
                                    -
                                </div>
                            </div>

                        </div>

                        <div class="detail-table-wrapper">
                            <table
                                id="detail-nilai-table"
                                class="table table-sm align-middle"
                            >
                                <thead>
                                    <tr>
                                        <th>Kuis</th>
                                        <th>Jenis</th>
                                        <th>Nilai</th>
                                        <th>Nilai Lulus</th>
                                        <th>Jawaban Benar</th>
                                        <th>Percobaan</th>
                                        <th>Status</th>
                                        <th>Terakhir Dikerjakan</th>
                                    </tr>
                                </thead>

                                <tbody id="detail-nilai-body"></tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-close-modal"
                        data-bs-dismiss="modal"
                    >
                        Tutup
                    </button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/lodash.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>

    {{-- DataTables Buttons dan Excel --}}
    <script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/print.js') }}"></script>

    <script src="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            const listUrl = @json(route('admin.kelas.nilai_peserta.list'));

            const detailUrlTemplate = @json(
                route('admin.kelas.nilai_peserta.detail', [
                    'id' => '__ID__'
                ])
            );

            const deleteUrlTemplate = @json(
                route('admin.kelas.nilai_peserta.delete', [
                    'id' => '__ID__'
                ])
            );

            const kelasApiUrl = @json(
                route('admin.api.pendaftaran.kelas')
            );

            const mentorApiUrl = @json(
                route('admin.api.kelas.mentor')
            );

            function escapeHtml(value) {
                return $('<div>').text(value ?? '').html();
            }

            function formatNumber(value, decimal = 2) {
                if (
                    value === null ||
                    value === undefined ||
                    value === ''
                ) {
                    return '-';
                }

                return Number(value).toLocaleString('id-ID', {
                    minimumFractionDigits: decimal,
                    maximumFractionDigits: decimal
                });
            }

            function formatDate(value) {
                if (!value) {
                    return '-';
                }

                const date = new Date(
                    String(value).replace(' ', 'T')
                );

                if (Number.isNaN(date.getTime())) {
                    return value;
                }

                return date.toLocaleString('id-ID', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }

            function statusPendaftaranBadge(status) {
                const value = String(status ?? '').toLowerCase();

                if (value === 'selesai') {
                    return `
                        <span class="badge badge-light-success">
                            Selesai
                        </span>
                    `;
                }

                if (value === 'expired') {
                    return `
                        <span class="badge badge-light-danger">
                            Expired
                        </span>
                    `;
                }

                return `
                    <span class="badge badge-light-primary">
                        Aktif
                    </span>
                `;
            }

            function statusKuisBadge(status) {
                if (status === 'Lulus') {
                    return `
                        <span class="badge badge-light-success">
                            Lulus
                        </span>
                    `;
                }

                if (status === 'Belum lulus') {
                    return `
                        <span class="badge badge-light-warning">
                            Belum lulus
                        </span>
                    `;
                }

                return `
                    <span class="badge badge-light-dark">
                        Belum mengerjakan
                    </span>
                `;
            }

            const table = $('#nilai-table').DataTable({
                dom: 'lBfrtip',
                processing: true,
                serverSide: true,
                responsive: true,
                ordering: false,
                stateSave: true,
                stateDuration: -1,
                pageLength: 10,

                lengthMenu: [
                    [10, 15, 20, 25, 50],
                    [10, 15, 20, 25, 50]
                ],

                buttons: [
                    {
                        extend: 'excel',
                        action: newexportaction,
                        text: '<i class="bi bi-file-earmark-excel me-1"></i> Export Excel',
                        className: 'btn btn-sm btn-success rounded-2',
                        title: 'Rekap Nilai Peserta',

                        filename: function () {
                            const tanggal = new Date()
                                .toISOString()
                                .slice(0, 10);

                            return `rekap-nilai-peserta-admin-${tanggal}`;
                        },

                        exportOptions: {
                            // Kolom Aksi tidak ikut diekspor.
                            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],

                            format: {
                                body: function (data) {
                                    return $('<div>')
                                        .html(data ?? '')
                                        .text()
                                        .replace(/\s+/g, ' ')
                                        .trim();
                                }
                            }
                        }
                    }
                ],

                ajax: {
                    url: listUrl,
                    cache: false,

                    data: function (data) {
                        data.id_mentor =
                            $('#filter_id_mentor').val();

                        data.id_kelas =
                            $('#filter_id_kelas').val();

                        data.status_nilai =
                            $('#filter_status_nilai').val();

                        data.status_pendaftaran =
                            $('#filter_status_pendaftaran').val();
                    }
                },

                columns: [
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: null,
                        name: 'pengguna_nama',

                        render: function (data, type, row) {
                            return `
                                <div>
                                    <div class="participant-name">
                                        ${escapeHtml(row.pengguna_nama)}
                                    </div>

                                    <div class="participant-email">
                                        ${escapeHtml(row.pengguna_email)}
                                    </div>
                                </div>
                            `;
                        }
                    },
                    {
                        data: 'kelas_judul',
                        name: 'kelas_judul',

                        render: function (data) {
                            return `
                                <span class="fw-bold">
                                    ${escapeHtml(data)}
                                </span>
                            `;
                        }
                    },
                    {
                        data: 'mentor_nama',
                        name: 'mentor_nama',

                        render: function (data) {
                            return `
                                <span class="fw-semibold">
                                    ${escapeHtml(data ?? '-')}
                                </span>
                            `;
                        }
                    },
                    {
                        data: 'rekap_kuis',
                        name: 'rekap_kuis',
                        searchable: false,

                        render: function (data) {
                            return `
                                <span class="badge badge-light-primary">
                                    ${escapeHtml(data)}
                                </span>
                            `;
                        }
                    },
                    {
                        data: 'rata_rata',
                        name: 'rata_rata',
                        searchable: false,

                        render: function (data) {
                            return `
                                <span class="score-value">
                                    ${escapeHtml(data)}
                                </span>
                            `;
                        }
                    },
                    {
                        data: 'kuis_lulus',
                        name: 'kuis_lulus',
                        searchable: false,

                        render: function (data, type, row) {
                            return `
                                <span class="fw-bold">
                                    ${Number(data ?? 0)}
                                    /
                                    ${Number(row.total_kuis ?? 0)}
                                </span>
                            `;
                        }
                    },
                    {
                        data: 'status_nilai',
                        name: 'status_nilai',
                        searchable: false
                    },
                    {
                        data: 'persentase_progres',
                        name: 'persentase_progres',
                        searchable: false,

                        render: function (data) {
                            const progress = Math.min(
                                100,
                                Math.max(0, Number(data ?? 0))
                            );

                            return `
                                <div class="progress-wrapper">
                                    <div class="progress-value">
                                        ${formatNumber(progress, 0)}%
                                    </div>

                                    <div class="progress">
                                        <div
                                            class="progress-bar"
                                            style="width: ${progress}%"
                                        ></div>
                                    </div>
                                </div>
                            `;
                        }
                    },
                    {
                        data: 'status_pendaftaran',
                        name: 'status_pendaftaran',
                        searchable: false,

                        render: function (data) {
                            return statusPendaftaranBadge(data);
                        }
                    },
                    {
                        data: 'terakhir_mengerjakan',
                        name: 'terakhir_mengerjakan',
                        searchable: false,

                        render: function (data) {
                            return formatDate(data);
                        }
                    }
                ]
            });

            /*
             * Mengisi filter kelas.
             * Mengisi filter kelas dan mentor untuk admin.
             */
            $.ajax({
                url: mentorApiUrl,
                method: 'GET',
                dataType: 'json'
            })
            .done(function (response) {
                const select = $('#filter_id_mentor');

                select.empty();
                select.append('<option value=""></option>');

                if (response.success && Array.isArray(response.data)) {
                    response.data.forEach(function (mentor) {
                        select.append(
                            $('<option>', {
                                value: mentor.id_mentor,
                                text: mentor.nama
                            })
                        );
                    });
                }

                select.select2({
                    placeholder: 'Semua mentor',
                    allowClear: true,
                    width: '100%'
                });
            })
            .fail(function () {
                Swal.fire(
                    'Peringatan',
                    'Daftar mentor tidak dapat dimuat.',
                    'warning'
                );
            });

            $.ajax({
                url: kelasApiUrl,
                method: 'GET',
                dataType: 'json'
            })
            .done(function (response) {
                const select = $('#filter_id_kelas');

                select.empty();
                select.append('<option value=""></option>');

                if (response.success && Array.isArray(response.data)) {
                    response.data.forEach(function (kelas) {
                        select.append(
                            $('<option>', {
                                value: kelas.id_kelas,
                                text: kelas.judul
                            })
                        );
                    });
                }

                select.select2({
                    placeholder: 'Semua kelas',
                    allowClear: true,
                    width: '100%'
                });
            })
            .fail(function () {
                Swal.fire(
                    'Peringatan',
                    'Daftar kelas tidak dapat dimuat.',
                    'warning'
                );
            });

            $('#filter_status_nilai').select2({
                minimumResultsForSearch: Infinity,
                width: '100%'
            });

            $('#filter_status_pendaftaran').select2({
                minimumResultsForSearch: Infinity,
                width: '100%'
            });

            $('#filter_id_mentor, #filter_id_kelas, #filter_status_nilai, #filter_status_pendaftaran')
                .on('change', function () {
                    table.ajax.reload();
                });

            /*
             * Pencarian dijalankan setelah pengguna berhenti mengetik.
             */
            const searchData = _.debounce(function (keyword) {
                if (keyword.length >= 3 || keyword.length === 0) {
                    table.search(keyword).draw();
                }
            }, 700);

            $('#nilai-table_filter input')
                .off()
                .on('input', function () {
                    searchData($(this).val());
                });

            /*
             * Menghapus pendaftaran peserta beserta nilai dan progresnya.
             */
            window.deleteConfirmation = function (id) {
                Swal.fire({
                    title: 'Hapus data peserta?',
                    text: 'Pendaftaran, progres belajar, nilai kuis, histori jawaban, dan sertifikat peserta pada kelas ini akan dihapus permanen.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#2563eb',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    focusCancel: true,
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then(function (result) {
                    if (!result.isConfirmed) {
                        return;
                    }

                    DataManager.openLoading();

                    const deleteUrl = deleteUrlTemplate.replace(
                        '__ID__',
                        id
                    );

                    DataManager.deleteData(deleteUrl)
                        .then(function (response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil dihapus',
                                    text: response.message ?? '',
                                    showConfirmButton: false,
                                    timer: 1600,
                                    timerProgressBar: true
                                }).then(function () {
                                    table.ajax.reload(null, false);
                                });

                                return;
                            }

                            Swal.fire({
                                icon: 'warning',
                                title: 'Peringatan',
                                text: response.message ??
                                    'Data peserta gagal dihapus.',
                                confirmButtonColor: '#2563eb'
                            });
                        })
                        .catch(function (error) {
                            ErrorHandler.handleError(error);
                        });
                });
            };

            /*
             * Membuka detail nilai.
             */
            $('#form_detail').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget);
                const idPendaftaran = button.data('id');

                $('#detail-loading').removeClass('d-none');
                $('#detail-content').addClass('d-none');
                $('#detail-nilai-body').empty();

                const detailUrl = detailUrlTemplate.replace(
                    '__ID__',
                    idPendaftaran
                );

                $.ajax({
                    url: detailUrl,
                    method: 'GET',
                    dataType: 'json'
                })
                .done(function (response) {
                    if (!response.success) {
                        Swal.fire(
                            'Peringatan',
                            response.message ?? 'Data tidak ditemukan.',
                            'warning'
                        );

                        $('#form_detail').modal('hide');
                        return;
                    }

                    const pendaftaran =
                        response.data.pendaftaran ?? {};

                    const nilaiKuis =
                        response.data.nilai_kuis ?? [];

                    $('#detail-pengguna-nama').text(
                        pendaftaran.pengguna_nama ?? '-'
                    );

                    $('#detail-pengguna-email').text(
                        pendaftaran.pengguna_email ?? '-'
                    );

                    $('#detail-kelas-judul').text(
                        pendaftaran.kelas_judul ?? '-'
                    );

                    $('#detail-mentor-nama').text(
                        pendaftaran.mentor_nama ?? '-'
                    );

                    const sudahDikerjakan = nilaiKuis.filter(
                        item => item.nilai !== null
                    );

                    const jumlahLulus = nilaiKuis.filter(
                        item => item.status === 'Lulus'
                    ).length;

                    let rataRata = null;

                    if (sudahDikerjakan.length > 0) {
                        const totalNilai = sudahDikerjakan.reduce(
                            function (total, item) {
                                return total + Number(item.nilai ?? 0);
                            },
                            0
                        );

                        rataRata =
                            totalNilai / sudahDikerjakan.length;
                    }

                    $('#detail-total-kuis').text(
                        nilaiKuis.length
                    );

                    $('#detail-kuis-dikerjakan').text(
                        sudahDikerjakan.length
                    );

                    $('#detail-kuis-lulus').text(
                        jumlahLulus
                    );

                    $('#detail-rata-rata').text(
                        rataRata === null
                            ? '-'
                            : formatNumber(rataRata)
                    );

                    const tbody = $('#detail-nilai-body');

                    if (nilaiKuis.length === 0) {
                        tbody.html(`
                            <tr>
                                <td
                                    colspan="8"
                                    class="text-center text-muted py-5"
                                >
                                    Kelas ini belum memiliki kuis.
                                </td>
                            </tr>
                        `);
                    } else {
                        nilaiKuis.forEach(function (item) {
                            const jenisKuis =
                                item.kuis_tipe === 'ujian_akhir'
                                    ? 'Ujian Akhir'
                                    : 'Kuis Materi';

                            const nilai =
                                item.nilai === null
                                    ? '-'
                                    : formatNumber(item.nilai);

                            const jawabanBenar =
                                item.jawaban_benar === null
                                    ? '-'
                                    : `${item.jawaban_benar}/${item.total_soal}`;

                            tbody.append(`
                                <tr>
                                    <td>
                                        <div class="quiz-title">
                                            ${escapeHtml(item.kuis_judul)}
                                        </div>

                                        <div class="quiz-material">
                                            Materi:
                                            ${escapeHtml(item.materi_judul)}
                                        </div>
                                    </td>

                                    <td>
                                        ${escapeHtml(jenisKuis)}
                                    </td>

                                    <td>
                                        <span class="score-value">
                                            ${nilai}
                                        </span>
                                    </td>

                                    <td>
                                        ${formatNumber(item.nilai_lulus, 0)}
                                    </td>

                                    <td>
                                        ${escapeHtml(jawabanBenar)}
                                    </td>

                                    <td>
                                        ${Number(item.jumlah_percobaan ?? 0)}
                                    </td>

                                    <td>
                                        ${statusKuisBadge(item.status)}
                                    </td>

                                    <td>
                                        ${formatDate(item.diserahkan_pada)}
                                    </td>
                                </tr>
                            `);
                        });
                    }

                    $('#detail-loading').addClass('d-none');
                    $('#detail-content').removeClass('d-none');
                })
                .fail(function (xhr) {
                    $('#form_detail').modal('hide');

                    Swal.fire(
                        'Kesalahan',
                        xhr.responseJSON?.message ??
                            'Detail nilai tidak dapat dimuat.',
                        'error'
                    );
                });
            });

            $('#form_detail').on('hidden.bs.modal', function () {
                $('#detail-loading').removeClass('d-none');
                $('#detail-content').addClass('d-none');
                $('#detail-nilai-body').empty();
            });
        });
    </script>
@endsection