@extends('mentor.layouts.index')

@section('css')
<style>
    .admin-dashboard {
        width: 100%;
    }

    .admin-dashboard-title h3 {
        margin-bottom: 4px;
        color: #111827;
    }

    .admin-dashboard-title p {
        color: #64748b;
    }

    .card-stat {
        min-height: 125px;
        border-radius: 12px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-stat h6,
    .card-stat h2 {
        color: #ffffff;
        margin: 0;
    }

    .card-stat h6 {
        font-size: 14px;
        font-weight: 700;
        opacity: .95;
    }

    .card-stat h2 {
        font-size: 32px;
        font-weight: 800;
        line-height: 1;
    }

    .card-stat-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #ffffff;
        font-size: 22px;
        flex-shrink: 0;
        box-shadow: 0 6px 14px rgba(15, 23, 42, .12);
    }

    .card-stat-icon i {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 22px !important;
        line-height: 1 !important;
        color: inherit !important;
    }

    .bg-blue {
        background: #3b82f6;
    }

    .bg-green {
        background: #10b981;
    }

    .bg-yellow {
        background: #f59e0b;
    }

    .bg-red {
        background: #ef4444;
    }

    .bg-blue .card-stat-icon {
        color: #2563eb;
    }

    .bg-green .card-stat-icon {
        color: #059669;
    }

    .bg-yellow .card-stat-icon {
        color: #d97706;
    }

    .bg-red .card-stat-icon {
        color: #dc2626;
    }

    .admin-dashboard .card {
        border: 0;
        border-radius: 12px;
        background: #ffffff;
        box-shadow: 0 6px 18px rgba(15, 23, 42, .06);
    }

    .admin-dashboard .card-header {
        min-height: auto;
        padding: 16px 18px;
        background: #ffffff;
        border-bottom: 1px solid #eef2f7;
        border-radius: 12px 12px 0 0;
    }

    .admin-dashboard .card-title {
        margin: 0;
    }

    .admin-dashboard .card-body {
        padding: 18px;
    }

    .mentor-summary-list {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    .mentor-summary-item {
        min-height: 86px;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px;
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
    }

    .mentor-summary-icon {
        width: 42px;
        height: 42px;
        min-width: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        font-size: 20px;
    }

    .mentor-summary-icon.blue {
        color: #2563eb;
    }

    .mentor-summary-icon.green {
        color: #059669;
    }

    .mentor-summary-icon.red {
        color: #dc2626;
    }

    .mentor-summary-label {
        margin: 0 0 3px;
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
    }

    .mentor-summary-value {
        margin: 0;
        color: #111827;
        font-size: 16px;
        font-weight: 800;
        line-height: 1.2;
    }

    .admin-dashboard .table {
        margin-bottom: 0;
    }

    .admin-dashboard .table thead th {
        color: #64748b;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .04em;
        border-bottom-color: #eef2f7;
        white-space: nowrap;
    }

    .admin-dashboard .table tbody td {
        color: #111827;
        font-size: 14px;
        vertical-align: middle;
    }

    .admin-dashboard .table tbody tr:last-child td {
        border-bottom: 0;
    }

    .admin-dashboard .badge {
        border-radius: 999px;
        padding: 6px 10px;
        font-weight: 700;
    }

    @media (max-width: 991.98px) {
        .mentor-summary-list {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767.98px) {
        .card-stat {
            min-height: 110px;
        }

        .card-stat h2 {
            font-size: 28px;
        }

        .admin-dashboard .card-header,
        .admin-dashboard .card-body {
            padding: 15px;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid admin-dashboard">

    <div class="admin-dashboard-title mb-4">
        <h3 class="fw-bold">Dashboard Mentor</h3>
        <p class="text-muted mb-0">Ringkasan data kelas, materi, dan peserta yang kamu kelola</p>
    </div>

    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card-stat bg-blue">
                <div class="d-flex align-items-start justify-content-between gap-3">
                    <div>
                        <h6>Total Kursus</h6>
                        <h2 class="mt-4">{{ $data['total_kursus'] ?? 0 }}</h2>
                    </div>

                    <span class="card-stat-icon">
                        <i class="bi bi-easel-fill"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-stat bg-green">
                <div class="d-flex align-items-start justify-content-between gap-3">
                    <div>
                        <h6>Total Materi</h6>
                        <h2 class="mt-4">{{ $data['total_materi'] ?? 0 }}</h2>
                    </div>

                    <span class="card-stat-icon">
                        <i class="bi bi-journal-text"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-stat bg-red">
                <div class="d-flex align-items-start justify-content-between gap-3">
                    <div>
                        <h6>Total Peserta</h6>
                        <h2 class="mt-4">{{ $data['total_peserta'] ?? 0 }}</h2>
                    </div>

                    <span class="card-stat-icon">
                        <i class="bi bi-people-fill"></i>
                    </span>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder mb-1">Ringkasan Aktivitas</span>
                    </h3>
                </div>

                <div class="card-body">
                    <div class="mentor-summary-list">
                        <div class="mentor-summary-item">
                            <span class="mentor-summary-icon blue">
                                <i class="bi bi-easel-fill"></i>
                            </span>
                            <div>
                                <p class="mentor-summary-label">Kursus Dikelola</p>
                                <p class="mentor-summary-value">{{ $data['total_kursus'] ?? 0 }} Kursus</p>
                            </div>
                        </div>

                        <div class="mentor-summary-item">
                            <span class="mentor-summary-icon green">
                                <i class="bi bi-journal-text"></i>
                            </span>
                            <div>
                                <p class="mentor-summary-label">Materi Tersedia</p>
                                <p class="mentor-summary-value">{{ $data['total_materi'] ?? 0 }} Materi</p>
                            </div>
                        </div>

                        <div class="mentor-summary-item">
                            <span class="mentor-summary-icon red">
                                <i class="bi bi-people-fill"></i>
                            </span>
                            <div>
                                <p class="mentor-summary-label">Peserta Terdaftar</p>
                                <p class="mentor-summary-value">{{ $data['total_peserta'] ?? 0 }} Peserta</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('javascript')
@endsection
