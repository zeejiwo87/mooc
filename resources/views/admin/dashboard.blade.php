@extends('admin.layouts.index')

@section('css')
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

        --neo-blue: #3b82f6;
        --neo-green: #10b981;
        --neo-yellow: #f59e0b;
        --neo-red: #ef4444;
    }

    .neo-dashboard {
        width: 100%;
        padding: 0 30px 30px;
    }

    .neo-dashboard-shell {
        width: 100%;
        max-width: 1480px;
        margin: 0 auto;
    }

    .neo-dashboard-inner {
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

    .neo-page-title-wrap {
        min-width: 0;
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
        color: var(--neo-blue);
        box-shadow:
            inset 5px 5px 10px rgba(163, 177, 198, 0.28),
            inset -5px -5px 10px rgba(255, 255, 255, 0.92);
        font-size: 1.45rem;
    }

    .neo-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 20px;
    }

    .neo-stat-card {
        min-height: 154px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 22px;
        border-radius: 24px;
        background: var(--neo-surface);
        box-shadow:
            10px 10px 22px var(--neo-shadow-dark),
            -10px -10px 22px var(--neo-shadow-light);
        transition:
            transform .18s ease,
            box-shadow .18s ease;
    }

    .neo-stat-card:hover {
        transform: translateY(-2px);
        box-shadow:
            12px 12px 24px var(--neo-shadow-dark),
            -12px -12px 24px var(--neo-shadow-light);
    }

    .neo-stat-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
    }

    .neo-stat-label {
        margin: 0;
        color: var(--neo-muted);
        font-size: 0.88rem;
        line-height: 1.35;
        font-weight: 700;
    }

    .neo-stat-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 17px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--neo-surface);
        box-shadow:
            inset 4px 4px 8px rgba(163, 177, 198, 0.27),
            inset -4px -4px 8px rgba(255, 255, 255, 0.92);
        font-size: 1.2rem;
    }

    .neo-stat-value {
        margin: 18px 0 0;
        font-size: 2rem;
        line-height: 1;
        font-weight: 850;
        letter-spacing: -0.035em;
    }

    .neo-stat-footer {
        margin-top: 18px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .neo-stat-line {
        width: 54px;
        height: 6px;
        border-radius: 999px;
        background: currentColor;
    }

    .neo-stat-small {
        color: var(--neo-muted);
        font-size: 0.78rem;
        font-weight: 700;
    }

    .neo-stat-card.blue,
    .neo-stat-card.blue .neo-stat-value,
    .neo-stat-card.blue .neo-stat-icon,
    .neo-stat-card.blue .neo-stat-footer {
        color: var(--neo-blue);
    }

    .neo-stat-card.green,
    .neo-stat-card.green .neo-stat-value,
    .neo-stat-card.green .neo-stat-icon,
    .neo-stat-card.green .neo-stat-footer {
        color: var(--neo-green);
    }

    .neo-stat-card.yellow,
    .neo-stat-card.yellow .neo-stat-value,
    .neo-stat-card.yellow .neo-stat-icon,
    .neo-stat-card.yellow .neo-stat-footer {
        color: var(--neo-yellow);
    }

    .neo-stat-card.red,
    .neo-stat-card.red .neo-stat-value,
    .neo-stat-card.red .neo-stat-icon,
    .neo-stat-card.red .neo-stat-footer {
        color: var(--neo-red);
    }

    .neo-content-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .neo-panel {
        min-width: 0;
        height: 100%;
        border-radius: 24px;
        background: var(--neo-surface);
        box-shadow:
            10px 10px 22px var(--neo-shadow-dark),
            -10px -10px 22px var(--neo-shadow-light);
        overflow: hidden;
    }

    .neo-panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 22px 22px 16px;
        border-bottom: 1px solid var(--neo-border);
    }

    .neo-panel-title-wrap {
        min-width: 0;
    }

    .neo-panel-title {
        margin: 0;
        color: var(--neo-text);
        font-size: 1.04rem;
        line-height: 1.25;
        font-weight: 800;
    }

    .neo-panel-subtitle {
        margin: 6px 0 0;
        color: var(--neo-muted);
        font-size: 0.84rem;
        line-height: 1.4;
        font-weight: 500;
    }

    .neo-panel-icon {
        width: 42px;
        height: 42px;
        min-width: 42px;
        border-radius: 15px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--neo-surface);
        color: var(--neo-blue);
        box-shadow:
            inset 4px 4px 8px rgba(163, 177, 198, 0.26),
            inset -4px -4px 8px rgba(255, 255, 255, 0.92);
        font-size: 1.05rem;
    }

    .neo-panel-body {
        padding: 18px 22px 22px;
    }

    .neo-table-box {
        width: 100%;
        overflow-x: auto;
        border-radius: 18px;
        padding: 10px;
        background: var(--neo-surface);
        box-shadow:
            inset 5px 5px 10px rgba(163, 177, 198, 0.23),
            inset -5px -5px 10px rgba(255, 255, 255, 0.92);
    }

    .neo-table {
        width: 100%;
        min-width: 420px;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0 8px;
    }

    .neo-table thead th {
        padding: 4px 12px 8px;
        border: 0 !important;
        background: transparent !important;
        color: var(--neo-muted);
        font-size: 0.76rem;
        line-height: 1.3;
        font-weight: 800;
        letter-spacing: .055em;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .neo-table tbody td {
        padding: 13px 12px;
        border: 0 !important;
        background: var(--neo-surface-soft) !important;
        color: var(--neo-text);
        font-size: 0.9rem;
        line-height: 1.35;
        vertical-align: middle;
    }

    .neo-table tbody tr td:first-child {
        border-top-left-radius: 14px;
        border-bottom-left-radius: 14px;
    }

    .neo-table tbody tr td:last-child {
        border-top-right-radius: 14px;
        border-bottom-right-radius: 14px;
    }

    .neo-table-main {
        color: var(--neo-text);
        font-weight: 750;
        line-height: 1.35;
    }

    .neo-table-muted {
        color: var(--neo-muted);
        font-size: 0.86rem;
        font-weight: 500;
        line-height: 1.35;
        word-break: break-word;
    }

    .neo-empty {
        padding: 18px 12px !important;
        text-align: center;
        color: var(--neo-muted) !important;
        font-weight: 650;
    }

    .neo-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 32px;
        padding: 7px 13px;
        border-radius: 999px;
        color: #0f766e;
        background: #d9f7ef;
        font-size: 0.76rem;
        line-height: 1;
        font-weight: 800;
        white-space: nowrap;
        box-shadow:
            4px 4px 10px rgba(163, 177, 198, 0.24),
            -4px -4px 10px rgba(255, 255, 255, 0.9);
    }

    @media (max-width: 1199.98px) {
        .neo-dashboard {
            padding: 0 26px 28px;
        }

        .neo-stats-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 991.98px) {
        .neo-dashboard {
            padding: 0 22px 26px;
        }

        .neo-dashboard-inner {
            gap: 20px;
        }

        .neo-content-grid {
            grid-template-columns: 1fr;
        }

        .neo-page-heading {
            padding: 22px;
        }

        .neo-stat-card {
            min-height: 145px;
            padding: 20px;
        }

        .neo-panel-header {
            padding: 20px 20px 14px;
        }

        .neo-panel-body {
            padding: 16px 20px 20px;
        }
    }

    @media (max-width: 767.98px) {
        .neo-dashboard {
            padding: 0 18px 24px;
        }

        .neo-stats-grid {
            gap: 16px;
        }

        .neo-content-grid {
            gap: 16px;
        }

        .neo-page-heading {
            align-items: flex-start;
            padding: 20px;
            border-radius: 22px;
        }

        .neo-page-title {
            font-size: 1.42rem;
        }

        .neo-page-subtitle {
            font-size: 0.88rem;
        }

        .neo-page-icon {
            width: 50px;
            height: 50px;
            min-width: 50px;
            border-radius: 17px;
            font-size: 1.25rem;
        }

        .neo-stat-card {
            min-height: 138px;
            border-radius: 22px;
            padding: 18px;
        }

        .neo-stat-value {
            font-size: 1.72rem;
            margin-top: 15px;
        }

        .neo-stat-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            border-radius: 15px;
            font-size: 1.08rem;
        }

        .neo-panel {
            border-radius: 22px;
        }

        .neo-panel-header {
            padding: 18px 18px 13px;
        }

        .neo-panel-body {
            padding: 15px 18px 18px;
        }
    }

    @media (max-width: 575.98px) {
        .neo-dashboard {
            padding: 0 14px 20px;
        }

        .neo-dashboard-inner {
            gap: 16px;
        }

        .neo-stats-grid {
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .neo-page-heading {
            padding: 18px;
            border-radius: 20px;
        }

        .neo-page-icon {
            display: none;
        }

        .neo-stat-card {
            min-height: auto;
            padding: 17px;
            border-radius: 20px;
        }

        .neo-stat-header {
            align-items: center;
        }

        .neo-stat-value {
            font-size: 1.65rem;
        }

        .neo-stat-footer {
            margin-top: 15px;
        }

        .neo-panel {
            border-radius: 20px;
        }

        .neo-panel-header {
            padding: 17px 16px 12px;
        }

        .neo-panel-icon {
            width: 38px;
            height: 38px;
            min-width: 38px;
            border-radius: 13px;
            font-size: 0.95rem;
        }

        .neo-panel-body {
            padding: 14px 16px 16px;
        }

        .neo-table-box {
            padding: 8px;
            border-radius: 16px;
        }

        .neo-table {
            min-width: 360px;
            border-spacing: 0 7px;
        }

        .neo-table thead th {
            padding: 4px 10px 7px;
            font-size: 0.72rem;
        }

        .neo-table tbody td {
            padding: 12px 10px;
            font-size: 0.86rem;
        }

        .neo-table-muted {
            font-size: 0.82rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid neo-dashboard">
    <div class="neo-dashboard-shell">
        <div class="neo-dashboard-inner">

            <div class="neo-page-heading">
                <div class="neo-page-title-wrap">
                    <h3 class="neo-page-title">Dashboard Admin</h3>
                    <p class="neo-page-subtitle">Ringkasan data platform</p>
                </div>

                <div class="neo-page-icon">
                    <i class="bi bi-speedometer2"></i>
                </div>
            </div>

            <div class="neo-stats-grid">

                <div class="neo-stat-card blue">
                    <div class="neo-stat-header">
                        <div>
                            <p class="neo-stat-label">Total Pengguna</p>
                            <h2 class="neo-stat-value">{{ $data['total_pengguna'] }}</h2>
                        </div>

                        <div class="neo-stat-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    </div>

                    <div class="neo-stat-footer">
                        <span class="neo-stat-line"></span>
                        <span class="neo-stat-small">Pengguna</span>
                    </div>
                </div>

                <div class="neo-stat-card green">
                    <div class="neo-stat-header">
                        <div>
                            <p class="neo-stat-label">Total Mentor</p>
                            <h2 class="neo-stat-value">{{ $data['total_mentor'] }}</h2>
                        </div>

                        <div class="neo-stat-icon">
                            <i class="bi bi-person-check-fill"></i>
                        </div>
                    </div>

                    <div class="neo-stat-footer">
                        <span class="neo-stat-line"></span>
                        <span class="neo-stat-small">Mentor</span>
                    </div>
                </div>

                <div class="neo-stat-card yellow">
                    <div class="neo-stat-header">
                        <div>
                            <p class="neo-stat-label">Total Kursus</p>
                            <h2 class="neo-stat-value">{{ $data['total_kursus'] }}</h2>
                        </div>

                        <div class="neo-stat-icon">
                            <i class="bi bi-journal-richtext"></i>
                        </div>
                    </div>

                    <div class="neo-stat-footer">
                        <span class="neo-stat-line"></span>
                        <span class="neo-stat-small">Kursus</span>
                    </div>
                </div>

                <div class="neo-stat-card red">
                    <div class="neo-stat-header">
                        <div>
                            <p class="neo-stat-label">Total Peserta</p>
                            <h2 class="neo-stat-value">{{ $data['total_peserta'] }}</h2>
                        </div>

                        <div class="neo-stat-icon">
                            <i class="bi bi-person-check-fill"></i>
                        </div>
                    </div>

                    <div class="neo-stat-footer">
                        <span class="neo-stat-line"></span>
                        <span class="neo-stat-small">Peserta</span>
                    </div>
                </div>

            </div>

            <div class="neo-content-grid">

                <div class="neo-panel">
                    <div class="neo-panel-header">
                        <div class="neo-panel-title-wrap">
                            <h3 class="neo-panel-title">Pengguna Terbaru</h3>
                            <p class="neo-panel-subtitle">Daftar pengguna yang baru terdaftar</p>
                        </div>

                        <div class="neo-panel-icon">
                            <i class="bi bi-person-lines-fill"></i>
                        </div>
                    </div>

                    <div class="neo-panel-body">
                        <div class="neo-table-box">
                            <table class="neo-table">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data['pengguna_baru'] as $user)
                                        <tr>
                                            <td>
                                                <div class="neo-table-main">
                                                    {{ $user->nama ?? $user->name }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="neo-table-muted">
                                                    {{ $user->email }}
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="neo-empty">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="neo-panel">
                    <div class="neo-panel-header">
                        <div class="neo-panel-title-wrap">
                            <h3 class="neo-panel-title">Kursus Terbaru</h3>
                            <p class="neo-panel-subtitle">Daftar kursus yang baru ditambahkan</p>
                        </div>

                        <div class="neo-panel-icon">
                            <i class="bi bi-journal-text"></i>
                        </div>
                    </div>

                    <div class="neo-panel-body">
                        <div class="neo-table-box">
                            <table class="neo-table">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data['kursus_baru'] as $kursus)
                                        <tr>
                                            <td>
                                                <div class="neo-table-main">
                                                    {{ $kursus->judul ?? $kursus->title }}
                                                </div>
                                            </td>
                                            <td>
                                                <span class="neo-badge">
                                                    {{ $kursus->status ?? 'publish' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="neo-empty">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
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