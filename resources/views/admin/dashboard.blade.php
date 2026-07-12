@extends('admin.layouts.index')

@section('css')
<style>
    .admin-dashboard {
        width: 100%;
    }

    .admin-dashboard-title h3 {
        margin-bottom: 4px;
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

    .admin-dashboard .card {
        border: 0;
        border-radius: 12px;
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
        <h3 class="fw-bold">Dashboard Admin</h3>
        <p class="text-muted mb-0">Ringkasan data platform</p>
    </div>

    <div class="row g-3 mb-4">

        <div class="col-md-3">
            <div class="card-stat bg-blue">
                <div class="d-flex align-items-start justify-content-between gap-3">
                    <div>
                        <h6>Total Pengguna</h6>
                        <h2 class="mt-4">{{ $data['total_pengguna'] }}</h2>
                    </div>

                    <span class="card-stat-icon">
                        <i class="bi bi-people-fill"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-stat bg-green">
                <div class="d-flex align-items-start justify-content-between gap-3">
                    <div>
                        <h6>Total Mentor</h6>
                        <h2 class="mt-4">{{ $data['total_mentor'] }}</h2>
                    </div>

                    <span class="card-stat-icon">
                        <i class="bi bi-person-check-fill"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-stat bg-yellow">
                <div class="d-flex align-items-start justify-content-between gap-3">
                    <div>
                        <h6>Total Kursus</h6>
                        <h2 class="mt-4">{{ $data['total_kursus'] }}</h2>
                    </div>

                    <span class="card-stat-icon">
                        <i class="bi bi-journal-richtext"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-stat bg-red">
                <div class="d-flex align-items-start justify-content-between gap-3">
                    <div>
                        <h6>Total Peserta</h6>
                        <h2 class="mt-4">{{ $data['total_peserta'] }}</h2>
                    </div>

                    <span class="card-stat-icon">
                        <i class="bi bi-person-check-fill"></i>
                    </span>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder mb-1">Pengguna Terbaru</span>
                    </h3>
                </div>

                <div class="card-body">
                    <table class="table table-sm align-middle table-row-bordered table-row-solid gs-0 gy-2 dataTable no-footer dtr-inline">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($data['pengguna_baru'] as $user)
                                <tr>
                                    <td>{{ $user->nama ?? $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder mb-1">Kursus Terbaru</span>
                    </h3>
                </div>

                <div class="card-body">
                    <table class="table table-sm align-middle table-row-bordered table-row-solid gs-0 gy-2 dataTable no-footer dtr-inline">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($data['kursus_baru'] as $kursus)
                                <tr>
                                    <td>{{ $kursus->judul ?? $kursus->title }}</td>
                                    <td>
                                        <span class="badge bg-success">
                                            {{ $kursus->status ?? 'publish' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

@section('javascript')
@endsection
