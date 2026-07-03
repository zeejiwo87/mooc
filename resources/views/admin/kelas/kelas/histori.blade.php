@extends('admin.layouts.index')

@section('css')
    <style>
        .kelas-builder-page {
            --bg: #eef2f7;
            --surface: #eef2f7;
            --text: #1f2937;
            --muted: #6b7280;
            --border: rgba(148, 163, 184, .2);
            --primary: #3b82f6;
            --success: #22c55e;
            --warning: #f59e0b;
            --danger: #ef4444;
            --shadow-dark: rgba(163, 177, 198, .42);
            --shadow-light: rgba(255, 255, 255, .95);
            padding: 0 30px 30px;
        }

        .kelas-builder-shell {
            max-width: 1480px;
            margin: 0 auto;
        }

        .neo-card,
        .panel,
        .builder-card,
        .video-panel {
            border: 0;
            border-radius: 28px;
            background: var(--surface);
            box-shadow: 10px 10px 22px var(--shadow-dark), -10px -10px 22px var(--shadow-light);
            overflow: hidden;
        }

        .hero-banner {
            min-height: 240px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .hero-banner::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(15, 23, 42, .28);
        }

        .hero-body,
        .content-body {
            padding: 26px 28px 28px;
        }

        .hero-top,
        .content-header,
        .builder-header,
        .bagian-header,
        .kuis-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 18px;
        }

        .kelas-title {
            margin: 0;
            color: var(--text);
            font-size: 1.75rem;
            line-height: 1.25;
            font-weight: 850;
        }

        .kelas-owner,
        .muted-text {
            color: var(--muted);
            font-weight: 650;
        }

        .kelas-owner span {
            color: var(--text);
            font-weight: 850;
        }

        .badge-neo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 30px;
            padding: 7px 12px;
            border-radius: 999px;
            background: var(--surface);
            color: var(--primary);
            font-size: .78rem;
            line-height: 1;
            font-weight: 850;
            box-shadow: 5px 5px 10px rgba(163, 177, 198, .28), -5px -5px 10px rgba(255, 255, 255, .92);
        }

        .badge-neo.success,
        .badge-neo.warning,
        .badge-neo.danger {
            color: #475569;
        }

        .stars {
            display: flex;
            align-items: center;
            gap: 3px;
            color: var(--warning);
        }

        .stars .bi-star {
            color: #94a3b8;
        }

        .rating-number {
            margin-left: 8px;
            color: var(--text);
            font-weight: 850;
        }

        .short-desc {
            max-width: 920px;
            margin: 18px 0 0;
            color: var(--muted);
            line-height: 1.65;
            font-weight: 600;
        }

        .stat-row,
        .meta-row,
        .action-row {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .stat-row {
            margin-top: 24px;
        }

        .stat-item {
            min-width: 185px;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 15px 16px;
            border-radius: 20px;
            background: var(--surface);
            box-shadow: inset 5px 5px 10px rgba(163, 177, 198, .22), inset -5px -5px 10px rgba(255, 255, 255, .92);
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            color: var(--primary);
            background: var(--surface);
            box-shadow: 5px 5px 10px rgba(163, 177, 198, .32), -5px -5px 10px rgba(255, 255, 255, .92);
            font-size: 1.15rem;
        }

        .stat-value {
            color: var(--text);
            font-size: 1rem;
            line-height: 1.2;
            font-weight: 850;
        }

        .stat-label {
            margin-top: 3px;
            color: var(--muted);
            font-size: .78rem;
            font-weight: 700;
        }

        .tabs-card {
            padding: 18px 20px 0;
            border-bottom: 1px solid var(--border);
        }

        .tabs-scroll {
            width: 100%;
            overflow-x: auto;
            padding-bottom: 14px;
        }

        .neo-tabs {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: max-content;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .neo-tabs .nav-link {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 15px !important;
            border: 0 !important;
            border-radius: 16px !important;
            color: var(--muted) !important;
            background: var(--surface) !important;
            font-size: .86rem;
            line-height: 1;
            font-weight: 850;
            box-shadow: 5px 5px 10px rgba(163, 177, 198, .28), -5px -5px 10px rgba(255, 255, 255, .9);
        }

        .neo-tabs .nav-link.active {
            color: #fff !important;
            background: var(--primary) !important;
        }

        .main-grid {
            display: grid;
            grid-template-columns: minmax(280px, .8fr) minmax(0, 1.2fr);
            gap: 24px;
            align-items: start;
        }

        .panel,
        .video-panel,
        .builder-card {
            padding: 20px;
        }

        .info-item {
            margin-bottom: 18px;
        }

        .info-label {
            margin: 0 0 7px;
            color: var(--muted);
            font-size: .78rem;
            font-weight: 850;
            text-transform: uppercase;
            letter-spacing: .035em;
        }

        .info-value {
            color: var(--text);
            font-weight: 850;
            word-break: break-word;
        }

        .mini-grid,
        .dashboard-grid,
        .builder-stat-grid {
            display: grid;
            gap: 14px;
        }

        .mini-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .dashboard-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            margin-top: 22px;
        }

        .builder-stat-grid {
            grid-template-columns: repeat(7, minmax(0, 1fr));
            margin-bottom: 20px;
        }

        .mini-stat,
        .dashboard-stat,
        .builder-stat {
            padding: 16px;
            border-radius: 20px;
            background: var(--surface);
            box-shadow: inset 5px 5px 10px rgba(163, 177, 198, .22), inset -5px -5px 10px rgba(255, 255, 255, .92);
        }

        .stat-title {
            margin: 0 0 8px;
            color: var(--muted);
            font-size: .78rem;
            font-weight: 850;
            text-transform: uppercase;
        }

        .stat-big {
            margin: 0;
            color: var(--text);
            font-size: 1.35rem;
            line-height: 1.15;
            font-weight: 900;
        }

        .mentor-card {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 18px;
            border-radius: 22px;
            background: var(--surface);
            box-shadow: inset 5px 5px 10px rgba(163, 177, 198, .22), inset -5px -5px 10px rgba(255, 255, 255, .92);
            margin-bottom: 22px;
        }

        .mentor-avatar {
            width: 66px;
            height: 66px;
            min-width: 66px;
            border-radius: 50%;
            padding: 5px;
            background: var(--surface);
            box-shadow: 6px 6px 14px rgba(163, 177, 198, .34), -6px -6px 14px rgba(255, 255, 255, .92);
        }

        .mentor-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 0 0 12px;
            color: var(--text);
            font-size: 1rem;
            font-weight: 850;
        }

        .section-title i {
            color: var(--primary);
        }

        .description {
            margin: 0;
            color: var(--muted);
            line-height: 1.7;
            font-weight: 600;
        }

        .btn-neo-primary,
        .btn-neo {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            border: 1px solid rgba(148, 163, 184, .22);
            border-radius: 14px;
            color: #334155 !important;
            background: var(--surface) !important;
            font-size: .84rem;
            line-height: 1;
            font-weight: 800;
            text-decoration: none !important;
            box-shadow: 5px 5px 12px rgba(163, 177, 198, .32), -5px -5px 12px rgba(255, 255, 255, .9);
            transition: .18s ease;
        }

        .btn-neo-primary {
            color: #1e293b !important;
            background: var(--surface) !important;
        }

        .btn-neo {
            min-height: 36px;
            padding: 8px 12px;
            border-radius: 13px;
            font-size: .76rem;
        }

        .btn-neo.primary,
        .btn-neo.success,
        .btn-neo.warning,
        .btn-neo.danger {
            background: var(--surface) !important;
        }

        .btn-neo.primary {
            color: #1d4ed8 !important;
        }

        .btn-neo.success {
            color: #166534 !important;
        }

        .btn-neo.warning {
            color: #92400e !important;
        }

        .btn-neo.danger {
            color: #b91c1c !important;
        }

        .btn-neo-primary:hover,
        .btn-neo:hover {
            transform: translateY(-1px);
            color: #0f172a !important;
            border-color: rgba(100, 116, 139, .32);
            box-shadow: 7px 7px 16px rgba(163, 177, 198, .4), -7px -7px 16px rgba(255, 255, 255, .95);
        }

        .video-panel,
        .builder-card {
            margin-top: 24px;
        }

        .video-frame {
            overflow: hidden;
            border-radius: 22px;
            background: #111827;
            padding: 12px;
        }

        .video-frame .ratio {
            overflow: hidden;
            border-radius: 18px;
        }

        .builder-title {
            margin: 0;
            color: var(--text);
            font-size: 1.18rem;
            font-weight: 900;
        }

        .empty-builder {
            padding: 32px 22px;
            border-radius: 22px;
            text-align: center;
            background: var(--surface);
            box-shadow: inset 5px 5px 10px rgba(163, 177, 198, .22), inset -5px -5px 10px rgba(255, 255, 255, .92);
        }

        .empty-builder i {
            display: block;
            margin-bottom: 10px;
            color: var(--primary);
            font-size: 2.4rem;
        }

        .bagian-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .bagian-card {
            overflow: hidden;
            border-radius: 24px;
            background: var(--surface);
            box-shadow: 8px 8px 18px rgba(163, 177, 198, .34), -8px -8px 18px rgba(255, 255, 255, .9);
        }

        .bagian-header {
            padding: 18px;
            border-bottom: 1px solid var(--border);
        }

        .bagian-kicker {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 8px;
            color: var(--primary);
            font-size: .74rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .bagian-title {
            margin: 0;
            color: var(--text);
            font-size: 1.02rem;
            font-weight: 900;
        }

        .bagian-desc {
            margin: 8px 0 0;
            color: var(--muted);
            font-size: .84rem;
            line-height: 1.6;
            font-weight: 600;
        }

        .materi-list {
            padding: 16px 18px 18px;
        }

        .materi-item {
            padding: 15px;
            border-radius: 18px;
            background: var(--surface);
            box-shadow: inset 4px 4px 9px rgba(163, 177, 198, .2), inset -4px -4px 9px rgba(255, 255, 255, .9);
        }

        .materi-item + .materi-item {
            margin-top: 12px;
        }

        .materi-main-row {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 14px;
            align-items: center;
        }

        .materi-title,
        .kuis-title {
            margin: 0;
            color: var(--text);
            font-size: .92rem;
            font-weight: 900;
        }

        .materi-empty,
        .kuis-empty {
            padding: 14px;
            border-radius: 16px;
            color: var(--muted);
            background: var(--surface);
            font-size: .84rem;
            font-weight: 700;
            box-shadow: inset 4px 4px 9px rgba(163, 177, 198, .2), inset -4px -4px 9px rgba(255, 255, 255, .9);
        }

        .kuis-list {
            margin-top: 14px;
            padding-left: 12px;
            border-left: 3px solid rgba(59, 130, 246, .25);
        }

        .kuis-item {
            padding: 12px;
            border-radius: 16px;
            background: rgba(255, 255, 255, .38);
            margin-top: 10px;
        }

        .quick-modal .modal-content {
            border: 0;
            border-radius: 24px;
            overflow: hidden;
        }

        .quick-modal .modal-title {
            font-weight: 900;
        }

        .quick-modal .ql-editor {
            min-height: 170px;
        }


        .kuis-item {
            display: block;
        }

        .kuis-top-row,
        .soal-top-row,
        .jawaban-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 14px;
        }

        .soal-list {
            width: 100%;
            margin-top: 14px;
            padding: 12px;
            border-radius: 18px;
            background: var(--surface);
            box-shadow: inset 4px 4px 9px rgba(163, 177, 198, .18), inset -4px -4px 9px rgba(255, 255, 255, .92);
        }

        .soal-list-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 12px;
        }

        .soal-list-title {
            margin: 0;
            color: var(--text);
            font-size: .86rem;
            font-weight: 900;
        }

        .soal-empty,
        .jawaban-empty {
            padding: 12px;
            border-radius: 15px;
            color: var(--muted);
            background: rgba(255, 255, 255, .42);
            font-size: .8rem;
            font-weight: 750;
        }

        .soal-item {
            padding: 13px;
            border-radius: 17px;
            background: rgba(255, 255, 255, .44);
            box-shadow: 4px 4px 10px rgba(163, 177, 198, .18), -4px -4px 10px rgba(255, 255, 255, .72);
        }

        .soal-item + .soal-item {
            margin-top: 11px;
        }

        .soal-title {
            margin: 0 0 7px;
            color: var(--text);
            font-size: .84rem;
            font-weight: 900;
        }

        .soal-text,
        .jawaban-text {
            color: var(--muted);
            font-size: .82rem;
            line-height: 1.55;
            font-weight: 650;
            word-break: break-word;
        }

        .jawaban-list {
            margin-top: 12px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .jawaban-item {
            padding: 10px 11px;
            border-radius: 14px;
            background: var(--surface);
            box-shadow: inset 3px 3px 7px rgba(163, 177, 198, .18), inset -3px -3px 7px rgba(255, 255, 255, .9);
        }

        .jawaban-item.correct {
            background: rgba(34, 197, 94, .12);
        }


        .builder-title-line {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            min-width: 0;
        }

        .builder-collapse-toggle {
            width: 32px;
            height: 32px;
            min-width: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(148, 163, 184, .22);
            border-radius: 12px;
            color: #475569;
            background: var(--surface);
            box-shadow: 4px 4px 9px rgba(163, 177, 198, .24), -4px -4px 9px rgba(255, 255, 255, .88);
            transition: .18s ease;
        }

        .builder-collapse-toggle:hover {
            color: #0f172a;
            border-color: rgba(100, 116, 139, .32);
            transform: translateY(-1px);
        }

        .builder-collapse-toggle i {
            transition: transform .18s ease;
        }

        .builder-collapse-toggle.is-open i {
            transform: rotate(90deg);
        }

        .builder-action-dropdown .dropdown-toggle {
            min-width: 92px;
        }

        .builder-action-dropdown .dropdown-menu {
            min-width: 210px;
            border: 0;
            border-radius: 16px;
            padding: 8px;
            background: #ffffff;
            box-shadow: 0 16px 36px rgba(15, 23, 42, .14);
        }

        .builder-action-dropdown .dropdown-item {
            display: flex;
            align-items: center;
            gap: 9px;
            min-height: 36px;
            padding: 8px 10px;
            border-radius: 11px;
            color: #334155 !important;
            font-size: .8rem;
            font-weight: 800;
            background: transparent !important;
            box-shadow: none !important;
            white-space: nowrap;
        }

        .builder-action-dropdown .dropdown-item:hover {
            color: #0f172a !important;
            background: #f1f5f9 !important;
            transform: none;
        }

        .builder-action-dropdown .dropdown-item i {
            width: 16px;
            text-align: center;
        }

        .builder-actions-header {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
        }

        .builder-compact-note {
            margin-top: 12px;
            color: var(--muted);
            font-size: .78rem;
            font-weight: 750;
        }



        /* =====================================================
           MODAL MELAYANG NEO - SOFT, SOLID, TIDAK MENYILAUKAN
           Hanya mengubah popup/modal, tidak mengubah layout builder.
        ====================================================== */
        .modal-backdrop.show {
            opacity: .34 !important;
            background: #0f172a !important;
        }

        .quick-modal .modal-dialog {
            margin-top: 22px;
            margin-bottom: 22px;
        }

        .quick-modal .modal-content {
            border: 1px solid rgba(148, 163, 184, .24) !important;
            border-radius: 26px !important;
            overflow: hidden;
            color: #1e293b;
            background: #eef2f7 !important;
            box-shadow: 0 22px 52px rgba(15, 23, 42, .18) !important;
        }

        .quick-modal .modal-header {
            min-height: 72px;
            padding: 20px 24px 16px;
            border-bottom: 1px solid rgba(148, 163, 184, .20) !important;
            background: #eef2f7 !important;
        }

        .quick-modal .modal-title {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin: 0;
            color: #0f172a;
            font-size: 1.02rem;
            font-weight: 900;
        }

        .quick-modal .modal-title::before {
            content: "";
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: #64748b;
            box-shadow: 0 0 0 5px rgba(100, 116, 139, .12);
        }

        .quick-modal .modal-body {
            padding: 24px;
            background: #eef2f7 !important;
        }

        .quick-modal .modal-footer {
            gap: 10px;
            padding: 16px 24px 22px;
            border-top: 1px solid rgba(148, 163, 184, .20) !important;
            background: #eef2f7 !important;
        }

        .quick-modal .btn-close {
            width: 38px;
            height: 38px;
            margin: 0 !important;
            padding: 0 !important;
            border: 1px solid rgba(148, 163, 184, .20);
            border-radius: 14px;
            opacity: 1;
            background-color: #eef2f7 !important;
            box-shadow: 4px 4px 10px rgba(163, 177, 198, .30), -4px -4px 10px rgba(255, 255, 255, .76);
            transition: .16s ease;
        }

        .quick-modal .btn-close:hover {
            transform: translateY(-1px);
            box-shadow: 5px 5px 12px rgba(163, 177, 198, .36), -5px -5px 12px rgba(255, 255, 255, .82);
        }

        .quick-modal .form-label {
            margin-bottom: 8px;
            color: #334155;
            font-size: .82rem;
            font-weight: 900 !important;
        }

        .quick-modal .form-control,
        .quick-modal .form-select,
        .quick-modal textarea {
            min-height: 42px;
            border: 1px solid rgba(148, 163, 184, .24) !important;
            border-radius: 15px !important;
            color: #0f172a !important;
            background: #f8fafc !important;
            font-weight: 700;
            box-shadow: inset 3px 3px 7px rgba(163, 177, 198, .20), inset -3px -3px 7px rgba(255, 255, 255, .82) !important;
            transition: .16s ease;
        }

        .quick-modal textarea.form-control,
        .quick-modal textarea {
            line-height: 1.58;
            padding: 12px 14px;
        }

        .quick-modal .form-control:focus,
        .quick-modal .form-select:focus,
        .quick-modal textarea:focus {
            border-color: rgba(59, 130, 246, .38) !important;
            background: #f8fafc !important;
            box-shadow: inset 3px 3px 7px rgba(163, 177, 198, .18), inset -3px -3px 7px rgba(255, 255, 255, .82), 0 0 0 3px rgba(59, 130, 246, .10) !important;
        }

        .quick-modal .form-check-input {
            width: 2.65rem;
            height: 1.35rem;
            border: 1px solid rgba(148, 163, 184, .34);
            background-color: #e2e8f0;
            box-shadow: inset 2px 2px 5px rgba(163, 177, 198, .24), inset -2px -2px 5px rgba(255, 255, 255, .72);
        }

        .quick-modal .form-check-input:checked {
            border-color: #334155;
            background-color: #334155;
        }

        .quick-modal .form-check-label {
            color: #475569;
            font-weight: 750;
        }

        .quick-modal .alert {
            border: 1px solid rgba(148, 163, 184, .22) !important;
            border-radius: 18px;
            color: #334155 !important;
            background: #f8fafc !important;
            box-shadow: inset 3px 3px 7px rgba(163, 177, 198, .14), inset -3px -3px 7px rgba(255, 255, 255, .82);
            font-weight: 750;
        }

        .quick-modal .ql-toolbar.ql-snow,
        .quick-modal .ql-container.ql-snow {
            border-color: rgba(148, 163, 184, .24) !important;
            background: #f8fafc !important;
        }

        .quick-modal .ql-toolbar.ql-snow {
            border-radius: 15px 15px 0 0;
            box-shadow: inset 3px 3px 7px rgba(163, 177, 198, .14), inset -3px -3px 7px rgba(255, 255, 255, .82);
        }

        .quick-modal .ql-container.ql-snow {
            border-radius: 0 0 15px 15px;
            box-shadow: inset 3px 3px 7px rgba(163, 177, 198, .14), inset -3px -3px 7px rgba(255, 255, 255, .82);
        }

        .quick-modal .ql-editor {
            min-height: 170px;
            color: #0f172a;
            font-weight: 650;
        }

        .quick-modal .btn.btn-light,
        .quick-modal .btn.btn-primary,
        .quick-modal .modal-footer .btn {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 9px 18px;
            border: 1px solid rgba(148, 163, 184, .24) !important;
            border-radius: 14px !important;
            color: #334155 !important;
            background: #eef2f7 !important;
            font-size: .82rem;
            line-height: 1;
            font-weight: 850;
            box-shadow: 4px 4px 10px rgba(163, 177, 198, .30), -4px -4px 10px rgba(255, 255, 255, .76) !important;
            transition: .16s ease;
        }

        .quick-modal .btn.btn-primary,
        .quick-modal .modal-footer .btn-primary {
            color: #1d4ed8 !important;
            border-color: rgba(59, 130, 246, .30) !important;
        }

        .quick-modal .btn.btn-light:hover,
        .quick-modal .btn.btn-primary:hover,
        .quick-modal .modal-footer .btn:hover {
            transform: translateY(-1px);
            color: #0f172a !important;
            background: #eef2f7 !important;
            box-shadow: 5px 5px 12px rgba(163, 177, 198, .34), -5px -5px 12px rgba(255, 255, 255, .82) !important;
        }

        .swal2-container .swal2-popup {
            border: 1px solid rgba(148, 163, 184, .24) !important;
            border-radius: 24px !important;
            color: #1e293b !important;
            background: #eef2f7 !important;
            box-shadow: 0 22px 52px rgba(15, 23, 42, .18) !important;
        }

        .swal2-container .swal2-title {
            color: #0f172a !important;
            font-weight: 900 !important;
        }

        .swal2-container .swal2-html-container {
            color: #475569 !important;
            font-weight: 650 !important;
        }

        .swal2-container .swal2-confirm,
        .swal2-container .swal2-cancel {
            min-height: 40px;
            border: 1px solid rgba(148, 163, 184, .24) !important;
            border-radius: 14px !important;
            font-weight: 850 !important;
            box-shadow: 4px 4px 10px rgba(163, 177, 198, .30), -4px -4px 10px rgba(255, 255, 255, .76) !important;
        }

        .swal2-container .swal2-confirm {
            color: #1d4ed8 !important;
            background: #eef2f7 !important;
        }

        .swal2-container .swal2-cancel {
            color: #475569 !important;
            background: #eef2f7 !important;
        }

        @media (max-width: 1199.98px) {
            .main-grid {
                grid-template-columns: 1fr;
            }

            .builder-stat-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 767.98px) {
            .kelas-builder-page {
                padding: 0 18px 24px;
            }

            .hero-top,
            .content-header,
            .builder-header,
            .bagian-header,
            .kuis-item {
                flex-direction: column;
                align-items: stretch;
            }

            .dashboard-grid,
            .mini-grid,
            .builder-stat-grid {
                grid-template-columns: 1fr;
            }

            .materi-main-row {
                grid-template-columns: 1fr;
            }

            .kuis-top-row,
            .soal-top-row,
            .jawaban-row,
            .soal-list-head {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-neo-primary,
            .btn-neo {
                width: 100%;
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
    <div class="container-fluid kelas-builder-page">
        @php
            $bannerUrl = $kelas->banner
                ? route('view-file', ['banner', $kelas->banner])
                : asset('assets/media/logos/banner-default.jpg');

            $avgRating = $kelas->rating ?? 0;
            $fullStars = floor($avgRating);
            $hasHalfStar = $avgRating - $fullStars >= 0.5;
            $ratingLabel = $avgRating >= 4.5 ? 'Sangat Baik' : ($avgRating >= 3.5 ? 'Baik' : ($avgRating > 0 ? 'Cukup' : 'Belum ada rating'));
            $statusBadgeClass = ($kelas->status ?? null) === 'terbit' ? 'success' : 'warning';

            $rawVideoUrl = trim((string) ($kelas->video_intro_url ?? ''));
            $videoUrl = null;
            $embedUrl = null;

            if ($rawVideoUrl !== '') {
                $videoId = function_exists('youtubeVideoId') ? youtubeVideoId($rawVideoUrl) : null;

                if ($videoId) {
                    $embedUrl = 'https://www.youtube.com/embed/' . $videoId . '?' . http_build_query([
                        'rel' => 0,
                        'modestbranding' => 1,
                        'playsinline' => 1,
                    ]);
                    $videoUrl = 'https://www.youtube.com/watch?v=' . $videoId;
                }
            }

            $builderBagianKelas = $bagianKelas ?? collect();
            $builderMateriByBagian = $materiByBagian ?? collect();
            $builderKuisByMateri = $kuisByMateri ?? collect();
            $builderKuisStatsByMateri = $kuisStatsByMateri ?? collect();
            $builderSoalByKuis = $soalByKuis ?? collect();
            $builderJawabanBySoal = $jawabanBySoal ?? collect();

            $builderJumlahBagian = $jumlahBagian ?? $builderBagianKelas->count();
            $builderJumlahMateri = $jumlahMateri ?? 0;
            $builderJumlahVideo = $jumlahVideo ?? 0;
            $builderJumlahText = $jumlahText ?? 0;
            $builderTotalKuis = $totalKuis ?? 0;
            $builderTotalSoal = $totalSoal ?? 0;
            $builderTotalJawaban = $totalJawaban ?? 0;
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
                                    <span class="badge-neo success">{{ $ratingLabel }}</span>
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
                                <i class="bi bi-house-door-fill"></i>
                                Kelas Ini
                            </h3>

                            <button type="button"
                                    class="btn-neo-primary"
                                    data-id="{{ $id }}"
                                    title="Edit"
                                    data-bs-toggle="modal"
                                    data-bs-target="#form_edit">
                                <i class="bi bi-pencil-square"></i>
                                Perbarui Kelas
                            </button>
                        </div>

                        <div class="main-grid">
                            <div class="panel">
                                <div class="meta-row mb-5">
                                    <span class="badge-neo">{{ $kelas->kategori_nama ?? '-' }}</span>
                                    <span class="badge-neo">{{ $kelas->kategori_sub_nama ?? '-' }}</span>
                                </div>

                                <div class="info-item">
                                    <div class="info-label">Tingkat</div>
                                    <div class="info-value text-capitalize">{{ $kelas->tingkat ?? '-' }}</div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label">Bahasa</div>
                                    <div class="info-value">{{ $kelas->bahasa ?? '-' }}</div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label">Status Kelas</div>
                                    <span class="badge-neo {{ $statusBadgeClass }}">
                                        {{ ucfirst($kelas->status ?? '-') }}
                                    </span>
                                </div>

                                <div class="info-item">
                                    <div class="info-label">Template Sertifikat</div>

                                    @if (!empty($kelas->sertifikat))
                                        <a href="{{ route('view-file', ['sertifikat', $kelas->sertifikat]) }}"
                                           target="_blank"
                                           class="btn-neo-primary">
                                            <i class="bi bi-download"></i>
                                            Download Template Sertifikat
                                        </a>
                                    @else
                                        <div class="info-value">Belum ada template sertifikat.</div>
                                    @endif
                                </div>

                                <div class="mini-grid mt-5">
                                    <div class="mini-stat">
                                        <p class="stat-title">Nilai Kelulusan</p>
                                        <p class="stat-big">{{ $kelas->nilai_lulus ?? 0 }}</p>
                                    </div>

                                    <div class="mini-stat">
                                        <p class="stat-title">Selesai Kelas</p>
                                        <p class="stat-big">{{ $kelas->total_selesai ?? 0 }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel">
                                <div class="mentor-card">
                                    <div class="mentor-avatar">
                                        <img src="{{ isset($kelas->foto_profil) ? route('view-file', ['profil', $kelas->foto_profil]) : asset('assets/media/avatars/blank.png') }}"
                                             alt="{{ $kelas->pemilik ?? 'Mentor' }}">
                                    </div>

                                    <div>
                                        <h4 class="mb-1 fw-bolder text-dark">{{ $kelas->pemilik ?? '-' }}</h4>

                                        @if (!empty($kelas->spesialisasi))
                                            <div class="muted-text fs-8">{{ $kelas->spesialisasi }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-5">
                                    <h4 class="section-title">
                                        <i class="bi bi-card-text"></i>
                                        Deskripsi Singkat
                                    </h4>

                                    <p class="description">{{ $kelas->deskripsi_singkat ?? '-' }}</p>
                                </div>

                                @if (!empty($kelas->deskripsi_lengkap))
                                    <div class="mb-5">
                                        <h4 class="section-title">
                                            <i class="bi bi-file-text-fill"></i>
                                            Tentang Kelas Ini
                                        </h4>

                                        <div class="description">{!! nl2br(e($kelas->deskripsi_lengkap)) !!}</div>
                                    </div>
                                @endif

                                <div class="dashboard-grid">
                                    <div class="dashboard-stat">
                                        <p class="stat-title">Durasi Total</p>
                                        <p class="stat-big">{{ $kelas->total_durasi_menit ?? 0 }} menit</p>
                                    </div>

                                    <div class="dashboard-stat">
                                        <p class="stat-title">Jumlah Materi</p>
                                        <p class="stat-big">{{ $kelas->jumlah_materi ?? 0 }}</p>
                                    </div>

                                    <div class="dashboard-stat">
                                        <p class="stat-title">Total Pendaftar</p>
                                        <p class="stat-big">{{ $kelas->total_pendaftaran ?? 0 }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (!empty($embedUrl))
                            <div class="video-panel">
                                <h4 class="section-title">
                                    <i class="bi bi-play-circle-fill"></i>
                                    Preview Kelas
                                </h4>

                                <div class="video-frame">
                                    <div class="ratio ratio-16x9">
                                        <iframe
                                            src="{{ $embedUrl }}"
                                            title="Video Intro"
                                            frameborder="0"
                                            referrerpolicy="strict-origin-when-cross-origin"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                </div>

                                <a href="{{ $videoUrl }}" target="_blank" rel="noopener" class="btn-neo mt-4">
                                    <i class="bi bi-youtube"></i>
                                    Buka video di YouTube
                                </a>
                            </div>
                        @endif

                        <div class="builder-card" id="kelola-isi-kelas">
                            <div class="builder-header mb-5">
                                <h4 class="builder-title">
                                    <i class="bi bi-diagram-3-fill me-2 text-primary"></i>
                                    Kelola Isi Kelas
                                </h4>

                                <div class="action-row justify-content-end">
                                    <button type="button"
                                            class="btn-neo-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#quick_create_bagian_modal">
                                        <i class="bi bi-plus-circle"></i>
                                        Tambah Bagian
                                    </button>
                                </div>
                            </div>

                            <div class="builder-stat-grid">
                                <div class="builder-stat">
                                    <p class="stat-title">Bagian</p>
                                    <p class="stat-big">{{ $builderJumlahBagian }}</p>
                                </div>

                                <div class="builder-stat">
                                    <p class="stat-title">Materi</p>
                                    <p class="stat-big">{{ $builderJumlahMateri }}</p>
                                </div>

                                <div class="builder-stat">
                                    <p class="stat-title">Video</p>
                                    <p class="stat-big">{{ $builderJumlahVideo }}</p>
                                </div>

                                <div class="builder-stat">
                                    <p class="stat-title">Teks</p>
                                    <p class="stat-big">{{ $builderJumlahText }}</p>
                                </div>

                                <div class="builder-stat">
                                    <p class="stat-title">Kuis</p>
                                    <p class="stat-big">{{ $builderTotalKuis }}</p>
                                </div>

                                <div class="builder-stat">
                                    <p class="stat-title">Soal</p>
                                    <p class="stat-big">{{ $builderTotalSoal }}</p>
                                </div>

                                <div class="builder-stat">
                                    <p class="stat-title">Jawaban</p>
                                    <p class="stat-big">{{ $builderTotalJawaban }}</p>
                                </div>
                            </div>

                            @if ($builderBagianKelas->isEmpty())
                                <div class="empty-builder">
                                    <i class="bi bi-folder-plus"></i>
                                    <h5 class="fw-bolder text-dark">Belum ada bagian kelas</h5>

                                    <button type="button"
                                            class="btn-neo-primary mt-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#quick_create_bagian_modal">
                                        <i class="bi bi-plus-circle"></i>
                                        Buat Bagian Pertama
                                    </button>
                                </div>
                            @else
                                <div class="bagian-list">
                                    @foreach ($builderBagianKelas as $bagian)
                                        @php
                                            $materiItems = $builderMateriByBagian->get($bagian->id_bagian_kelas, collect());
                                            $nextMateriUrutan = ((int) ($materiItems->max('urutan') ?? -1)) + 1;
                                        @endphp

                                        <div class="bagian-card">
                                            <div class="bagian-header">
                                                <div>
                                                    <div class="bagian-kicker">
                                                        <i class="bi bi-layers"></i>
                                                        Bagian {{ $bagian->urutan ?? $loop->iteration }}
                                                    </div>

                                                    <h5 class="bagian-title">{{ $bagian->judul ?? 'Tanpa Judul' }}</h5>

                                                    @if (!empty($bagian->deskripsi))
                                                        <div class="bagian-desc">{!! nl2br(e($bagian->deskripsi)) !!}</div>
                                                    @endif
                                                </div>

                                                <div class="action-row justify-content-end">
                                                    <button type="button"
                                                            class="btn-neo primary btn-quick-create-materi"
                                                            data-id-bagian-kelas="{{ $bagian->id_bagian_kelas }}"
                                                            data-judul-bagian="{{ $bagian->judul }}"
                                                            data-next-urutan="{{ $nextMateriUrutan }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#quick_create_materi_modal">
                                                        <i class="bi bi-plus-circle"></i>
                                                        Tambah Materi
                                                    </button>

                                                    <button type="button"
                                                            class="btn-neo warning btn-quick-edit-bagian"
                                                            data-id="{{ $bagian->id_bagian_kelas }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#quick_edit_bagian_modal">
                                                        <i class="bi bi-pencil-square"></i>
                                                        Edit
                                                    </button>

                                                    <button type="button"
                                                            class="btn-neo danger btn-quick-delete-bagian"
                                                            data-id="{{ $bagian->id_bagian_kelas }}">
                                                        <i class="bi bi-trash"></i>
                                                        Hapus
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="materi-list">
                                                @if ($materiItems->isEmpty())
                                                    <div class="materi-empty">
                                                        Belum ada materi di bagian ini.
                                                    </div>
                                                @else
                                                    @foreach ($materiItems as $materi)
                                                        @php
                                                            $kuisItems = $builderKuisByMateri->get($materi->id_materi, collect());
                                                            $kuisStats = $builderKuisStatsByMateri->get($materi->id_materi);
                                                            $jumlahKuisMateriItem = (int) ($kuisStats->total_kuis ?? 0);
                                                            $jumlahSoalMateriItem = (int) ($kuisStats->total_soal ?? 0);
                                                        @endphp

                                                        <div class="materi-item">
                                                            <div class="materi-main-row">
                                                                <div>
                                                                    <h6 class="materi-title">
                                                                        {{ $materi->urutan ?? $loop->iteration }}.
                                                                        {{ $materi->judul ?? 'Tanpa Judul' }}
                                                                    </h6>

                                                                    <div class="meta-row mt-2">
                                                                        <span class="badge-neo text-capitalize">{{ $materi->tipe ?? '-' }}</span>

                                                                        @if ((int) ($materi->preview ?? 0) === 1)
                                                                            <span class="badge-neo success">Preview</span>
                                                                        @endif

                                                                        @if (!empty($materi->durasi_detik))
                                                                            <span class="badge-neo warning">
                                                                                {{ function_exists('formatSeconds') ? formatSeconds($materi->durasi_detik) : ((int) $materi->durasi_detik . ' dtk') }}
                                                                            </span>
                                                                        @endif

                                                                        @if ($jumlahKuisMateriItem > 0)
                                                                            <span class="badge-neo">{{ $jumlahKuisMateriItem }} kuis</span>
                                                                        @endif

                                                                        @if ($jumlahSoalMateriItem > 0)
                                                                            <span class="badge-neo">{{ $jumlahSoalMateriItem }} soal</span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="action-row justify-content-end">
                                                                    <button type="button"
                                                                            class="btn-neo success btn-quick-create-kuis"
                                                                            data-id-materi="{{ $materi->id_materi }}"
                                                                            data-judul-materi="{{ $materi->judul }}"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#quick_create_kuis_modal">
                                                                        <i class="bi bi-plus-circle"></i>
                                                                        Tambah Kuis
                                                                    </button>

                                                                    <button type="button"
                                                                            class="btn-neo warning btn-quick-edit-materi"
                                                                            data-id="{{ $materi->id_materi }}"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#quick_edit_materi_modal">
                                                                        <i class="bi bi-pencil-square"></i>
                                                                        Edit
                                                                    </button>

                                                                    <button type="button"
                                                                            class="btn-neo danger btn-quick-delete-materi"
                                                                            data-id="{{ $materi->id_materi }}">
                                                                        <i class="bi bi-trash"></i>
                                                                        Hapus
                                                                    </button>
                                                                </div>
                                                            </div>

                                                            <div class="kuis-list">
                                                                @if ($kuisItems->isEmpty())
                                                                    <div class="kuis-empty">
                                                                        Belum ada kuis untuk materi ini.
                                                                    </div>
                                                                @else
                                                                    @foreach ($kuisItems as $kuis)
                                                                        @php
                                                                            $soalItems = $builderSoalByKuis->get($kuis->id_kuis, collect());
                                                                        @endphp

                                                                        <div class="kuis-item">
                                                                            <div class="kuis-top-row">
                                                                                <div>
                                                                                    <h6 class="kuis-title">
                                                                                        {{ $kuis->judul ?? 'Tanpa Judul Kuis' }}
                                                                                    </h6>

                                                                                    <div class="meta-row mt-2">
                                                                                        <span class="badge-neo text-capitalize">
                                                                                            {{ str_replace('_', ' ', $kuis->tipe ?? '-') }}
                                                                                        </span>

                                                                                        <span class="badge-neo warning">
                                                                                            {{ $kuis->durasi_menit ?? 0 }} menit
                                                                                        </span>

                                                                                        <span class="badge-neo success">
                                                                                            Nilai lulus {{ $kuis->nilai_lulus ?? 0 }}
                                                                                        </span>

                                                                                        <span class="badge-neo">
                                                                                            {{ $soalItems->count() }} soal
                                                                                        </span>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="action-row justify-content-end">
                                                                                    <button type="button"
                                                                                            class="btn-neo success btn-quick-create-soal"
                                                                                            data-id-kuis="{{ $kuis->id_kuis }}"
                                                                                            data-judul-kuis="{{ $kuis->judul }}"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target="#quick_create_soal_modal">
                                                                                        <i class="bi bi-plus-circle"></i>
                                                                                        Tambah Soal
                                                                                    </button>

                                                                                    <button type="button"
                                                                                            class="btn-neo primary btn-quick-import-soal"
                                                                                            data-id-kuis="{{ $kuis->id_kuis }}"
                                                                                            data-judul-kuis="{{ $kuis->judul }}"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target="#quick_import_soal_modal">
                                                                                        <i class="bi bi-upload"></i>
                                                                                        Import Soal
                                                                                    </button>

                                                                                    <button type="button"
                                                                                            class="btn-neo warning btn-quick-edit-kuis"
                                                                                            data-id="{{ $kuis->id_kuis }}"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target="#quick_edit_kuis_modal">
                                                                                        <i class="bi bi-pencil-square"></i>
                                                                                        Edit Kuis
                                                                                    </button>

                                                                                    <button type="button"
                                                                                            class="btn-neo danger btn-quick-delete-kuis"
                                                                                            data-id="{{ $kuis->id_kuis }}">
                                                                                        <i class="bi bi-trash"></i>
                                                                                        Hapus
                                                                                    </button>
                                                                                </div>
                                                                            </div>

                                                                            <div class="soal-list">
                                                                                <div class="soal-list-head">
                                                                                    <h6 class="soal-list-title">
                                                                                        <i class="bi bi-list-check me-1 text-primary"></i>
                                                                                        Daftar Soal
                                                                                    </h6>

                                                                                    <button type="button"
                                                                                            class="btn-neo success btn-quick-create-soal"
                                                                                            data-id-kuis="{{ $kuis->id_kuis }}"
                                                                                            data-judul-kuis="{{ $kuis->judul }}"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target="#quick_create_soal_modal">
                                                                                        <i class="bi bi-plus-circle"></i>
                                                                                        Tambah Soal
                                                                                    </button>
                                                                                </div>

                                                                                @if ($soalItems->isEmpty())
                                                                                    <div class="soal-empty">
                                                                                        Belum ada soal. Gunakan tombol Tambah Soal atau Import Soal.
                                                                                    </div>
                                                                                @else
                                                                                    @foreach ($soalItems as $soal)
                                                                                        @php
                                                                                            $jawabanItems = $builderJawabanBySoal->get($soal->id_soal, collect());
                                                                                        @endphp

                                                                                        <div class="soal-item">
                                                                                            <div class="soal-top-row">
                                                                                                <div>
                                                                                                    <h6 class="soal-title">
                                                                                                        Soal {{ $loop->iteration }}
                                                                                                        <span class="badge-neo warning ms-1">Nilai {{ $soal->nilai ?? 1 }}</span>
                                                                                                    </h6>

                                                                                                    <div class="soal-text">
                                                                                                        {!! nl2br(e($soal->teks_soal ?? '-')) !!}
                                                                                                    </div>

                                                                                                    @if (!empty($soal->gambar_soal))
                                                                                                        <a href="{{ route('view-file', ['soal', $soal->gambar_soal]) }}" target="_blank" class="btn-neo mt-3">
                                                                                                            <i class="bi bi-image"></i>
                                                                                                            Lihat Gambar
                                                                                                        </a>
                                                                                                    @endif

                                                                                                    @if (!empty($soal->penjelasan))
                                                                                                        <div class="soal-text mt-2">
                                                                                                            <b>Penjelasan:</b> {!! nl2br(e($soal->penjelasan)) !!}
                                                                                                        </div>
                                                                                                    @endif
                                                                                                </div>

                                                                                                <div class="action-row justify-content-end">
                                                                                                    <button type="button"
                                                                                                            class="btn-neo success btn-quick-create-jawaban"
                                                                                                            data-id-soal="{{ $soal->id_soal }}"
                                                                                                            data-teks-soal="{{ \Illuminate\Support\Str::limit(strip_tags($soal->teks_soal ?? ''), 70) }}"
                                                                                                            data-bs-toggle="modal"
                                                                                                            data-bs-target="#quick_create_jawaban_modal">
                                                                                                        <i class="bi bi-plus-circle"></i>
                                                                                                        Tambah Jawaban
                                                                                                    </button>

                                                                                                    <button type="button"
                                                                                                            class="btn-neo warning btn-quick-edit-soal"
                                                                                                            data-id="{{ $soal->id_soal }}"
                                                                                                            data-bs-toggle="modal"
                                                                                                            data-bs-target="#quick_edit_soal_modal">
                                                                                                        <i class="bi bi-pencil-square"></i>
                                                                                                        Edit Soal
                                                                                                    </button>

                                                                                                    <button type="button"
                                                                                                            class="btn-neo danger btn-quick-delete-soal"
                                                                                                            data-id="{{ $soal->id_soal }}">
                                                                                                        <i class="bi bi-trash"></i>
                                                                                                        Hapus
                                                                                                    </button>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="jawaban-list">
                                                                                                @if ($jawabanItems->isEmpty())
                                                                                                    <div class="jawaban-empty">
                                                                                                        Belum ada pilihan jawaban.
                                                                                                    </div>
                                                                                                @else
                                                                                                    @foreach ($jawabanItems as $jawaban)
                                                                                                        <div class="jawaban-item {{ (int) ($jawaban->benar ?? 0) === 1 ? 'correct' : '' }}">
                                                                                                            <div class="jawaban-row">
                                                                                                                <div>
                                                                                                                    <div class="jawaban-text">
                                                                                                                        {!! nl2br(e($jawaban->teks_jawaban ?? '-')) !!}
                                                                                                                    </div>

                                                                                                                    @if ((int) ($jawaban->benar ?? 0) === 1)
                                                                                                                        <span class="badge-neo success mt-2">Jawaban Benar</span>
                                                                                                                    @else
                                                                                                                        <span class="badge-neo mt-2">Distraktor</span>
                                                                                                                    @endif
                                                                                                                </div>

                                                                                                                <div class="action-row justify-content-end">
                                                                                                                    <button type="button"
                                                                                                                            class="btn-neo warning btn-quick-edit-jawaban"
                                                                                                                            data-id="{{ $jawaban->id_soal_jawaban }}"
                                                                                                                            data-bs-toggle="modal"
                                                                                                                            data-bs-target="#quick_edit_jawaban_modal">
                                                                                                                        <i class="bi bi-pencil-square"></i>
                                                                                                                        Edit
                                                                                                                    </button>

                                                                                                                    <button type="button"
                                                                                                                            class="btn-neo danger btn-quick-delete-jawaban"
                                                                                                                            data-id="{{ $jawaban->id_soal_jawaban }}">
                                                                                                                        <i class="bi bi-trash"></i>
                                                                                                                        Hapus
                                                                                                                    </button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    @endforeach
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL BAGIAN --}}
    <div class="modal fade quick-modal" id="quick_create_bagian_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form method="post" id="quick_create_bagian_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Bagian Kelas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="quick_create_bagian_id_kelas" value="{{ $id }}">

                        <div class="mb-3">
                            <label class="form-label fw-bolder required">Judul Bagian</label>
                            <input type="text" id="quick_create_bagian_judul" class="form-control form-control-sm" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bolder">Deskripsi</label>
                            <input type="hidden" id="quick_create_bagian_deskripsi">
                            <div id="quick_create_bagian_deskripsi_editor" class="form-control form-control-sm" style="min-height: 170px;"></div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-bolder required">Urutan</label>
                            <input type="number" id="quick_create_bagian_urutan" class="form-control form-control-sm" min="0" value="{{ $builderJumlahBagian ?? 0 }}" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan Bagian</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade quick-modal" id="quick_edit_bagian_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form method="post" id="quick_edit_bagian_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Bagian Kelas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="quick_edit_bagian_id">
                        <input type="hidden" id="quick_edit_bagian_id_kelas" value="{{ $id }}">

                        <div class="mb-3">
                            <label class="form-label fw-bolder required">Judul Bagian</label>
                            <input type="text" id="quick_edit_bagian_judul" class="form-control form-control-sm" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bolder">Deskripsi</label>
                            <input type="hidden" id="quick_edit_bagian_deskripsi">
                            <div id="quick_edit_bagian_deskripsi_editor" class="form-control form-control-sm" style="min-height: 170px;"></div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-bolder required">Urutan</label>
                            <input type="number" id="quick_edit_bagian_urutan" class="form-control form-control-sm" min="0" value="0" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL MATERI --}}
    <div class="modal fade quick-modal" id="quick_create_materi_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <form method="post" id="quick_create_materi_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Materi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="quick_create_materi_id_bagian_kelas">

                        <div class="alert alert-primary py-3">
                            Bagian: <b id="quick_create_materi_bagian_label">-</b>
                        </div>

                        <div class="row g-5">
                            <div class="col-lg-7">
                                <div class="mb-3">
                                    <label class="form-label fw-bolder required">Judul Materi</label>
                                    <input type="text" id="quick_create_materi_judul" class="form-control form-control-sm" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bolder required">Tipe Materi</label>
                                    <select id="quick_create_materi_tipe" class="form-select form-select-sm" required>
                                        <option value="video">Video</option>
                                        <option value="text">Teks</option>
                                        <option value="kuis">Kuis</option>
                                    </select>
                                </div>

                                <div class="mb-3 quick-create-materi-field quick-create-materi-text d-none">
                                    <label class="form-label fw-bolder">Konten Teks</label>
                                    <input type="hidden" id="quick_create_materi_content">
                                    <div id="quick_create_materi_content_editor" class="form-control form-control-sm" style="min-height: 220px;"></div>
                                </div>

                                <div class="mb-3 quick-create-materi-field quick-create-materi-video d-none">
                                    <label class="form-label fw-bolder">URL Video</label>
                                    <input type="text" id="quick_create_materi_url_video" class="form-control form-control-sm" placeholder="https://www.youtube.com/watch?v=...">
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="mb-3">
                                    <label class="form-label fw-bolder required">Urutan</label>
                                    <input type="number" id="quick_create_materi_urutan" class="form-control form-control-sm" min="0" value="0" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bolder">Durasi Detik</label>
                                    <input type="number" id="quick_create_materi_durasi_detik" class="form-control form-control-sm" min="0">
                                </div>

                                <div class="mb-0">
                                    <label class="form-label fw-bolder">Preview Gratis</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="quick_create_materi_preview">
                                        <label class="form-check-label" for="quick_create_materi_preview">Bisa dipreview peserta</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan Materi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade quick-modal" id="quick_edit_materi_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <form method="post" id="quick_edit_materi_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Materi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="quick_edit_materi_id">

                        <div class="row g-5">
                            <div class="col-lg-7">
                                <div class="mb-3">
                                    <label class="form-label fw-bolder required">Bagian Kelas</label>
                                    <select id="quick_edit_materi_id_bagian_kelas" class="form-select form-select-sm" required>
                                        @foreach (($bagianKelas ?? collect()) as $bagianOption)
                                            <option value="{{ $bagianOption->id_bagian_kelas }}">{{ $bagianOption->judul }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bolder required">Judul Materi</label>
                                    <input type="text" id="quick_edit_materi_judul" class="form-control form-control-sm" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bolder required">Tipe Materi</label>
                                    <select id="quick_edit_materi_tipe" class="form-select form-select-sm" required>
                                        <option value="video">Video</option>
                                        <option value="text">Teks</option>
                                        <option value="kuis">Kuis</option>
                                    </select>
                                </div>

                                <div class="mb-3 quick-edit-materi-field quick-edit-materi-text d-none">
                                    <label class="form-label fw-bolder">Konten Teks</label>
                                    <input type="hidden" id="quick_edit_materi_content">
                                    <div id="quick_edit_materi_content_editor" class="form-control form-control-sm" style="min-height: 220px;"></div>
                                </div>

                                <div class="mb-3 quick-edit-materi-field quick-edit-materi-video d-none">
                                    <label class="form-label fw-bolder">URL Video</label>
                                    <input type="text" id="quick_edit_materi_url_video" class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="mb-3">
                                    <label class="form-label fw-bolder required">Urutan</label>
                                    <input type="number" id="quick_edit_materi_urutan" class="form-control form-control-sm" min="0" value="0" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bolder">Durasi Detik</label>
                                    <input type="number" id="quick_edit_materi_durasi_detik" class="form-control form-control-sm" min="0">
                                </div>

                                <div class="mb-0">
                                    <label class="form-label fw-bolder">Preview Gratis</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="quick_edit_materi_preview">
                                        <label class="form-check-label" for="quick_edit_materi_preview">Bisa dipreview peserta</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL KUIS --}}
    <div class="modal fade quick-modal" id="quick_create_kuis_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <form method="post" id="quick_create_kuis_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kuis</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="quick_create_kuis_id_materi">

                        <div class="alert alert-success py-3">
                            Materi: <b id="quick_create_kuis_materi_label">-</b>
                        </div>

                        <div class="row g-5">
                            <div class="col-lg-7">
                                <div class="mb-3">
                                    <label class="form-label fw-bolder required">Judul Kuis</label>
                                    <input type="text" id="quick_create_kuis_judul" class="form-control form-control-sm" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bolder">Deskripsi</label>
                                    <input type="text" id="quick_create_kuis_deskripsi" class="form-control form-control-sm">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bolder">Instruksi</label>
                                    <textarea id="quick_create_kuis_instruksi" class="form-control form-control-sm" rows="4"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="mb-3">
                                    <label class="form-label fw-bolder required">Tipe Kuis</label>
                                    <select id="quick_create_kuis_tipe" class="form-select form-select-sm" required>
                                        <option value="kuis_materi">Kuis Materi</option>
                                        <option value="ujian_akhir">Ujian Akhir</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bolder required">Durasi Menit</label>
                                    <input type="number" id="quick_create_kuis_durasi_menit" class="form-control form-control-sm" min="1" value="10" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bolder required">Nilai Lulus</label>
                                    <input type="number" id="quick_create_kuis_nilai_lulus" class="form-control form-control-sm" min="0" max="100" value="80" required>
                                </div>

                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="quick_create_kuis_tampilkan_jawaban_benar" checked>
                                    <label class="form-check-label" for="quick_create_kuis_tampilkan_jawaban_benar">Tampilkan jawaban benar</label>
                                </div>

                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="quick_create_kuis_acak_soal" checked>
                                    <label class="form-check-label" for="quick_create_kuis_acak_soal">Acak soal</label>
                                </div>

                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="quick_create_kuis_acak_jawaban">
                                    <label class="form-check-label" for="quick_create_kuis_acak_jawaban">Acak jawaban</label>
                                </div>

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="quick_create_kuis_aktif" checked>
                                    <label class="form-check-label" for="quick_create_kuis_aktif">Aktif</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan Kuis</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade quick-modal" id="quick_edit_kuis_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <form method="post" id="quick_edit_kuis_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Kuis</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="quick_edit_kuis_id">
                        <input type="hidden" id="quick_edit_kuis_id_materi">

                        <div class="row g-5">
                            <div class="col-lg-7">
                                <div class="mb-3">
                                    <label class="form-label fw-bolder required">Judul Kuis</label>
                                    <input type="text" id="quick_edit_kuis_judul" class="form-control form-control-sm" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bolder">Deskripsi</label>
                                    <input type="text" id="quick_edit_kuis_deskripsi" class="form-control form-control-sm">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bolder">Instruksi</label>
                                    <textarea id="quick_edit_kuis_instruksi" class="form-control form-control-sm" rows="4"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="mb-3">
                                    <label class="form-label fw-bolder required">Tipe Kuis</label>
                                    <select id="quick_edit_kuis_tipe" class="form-select form-select-sm" required>
                                        <option value="kuis_materi">Kuis Materi</option>
                                        <option value="ujian_akhir">Ujian Akhir</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bolder required">Durasi Menit</label>
                                    <input type="number" id="quick_edit_kuis_durasi_menit" class="form-control form-control-sm" min="1" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bolder required">Nilai Lulus</label>
                                    <input type="number" id="quick_edit_kuis_nilai_lulus" class="form-control form-control-sm" min="0" max="100" required>
                                </div>

                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="quick_edit_kuis_tampilkan_jawaban_benar">
                                    <label class="form-check-label" for="quick_edit_kuis_tampilkan_jawaban_benar">Tampilkan jawaban benar</label>
                                </div>

                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="quick_edit_kuis_acak_soal">
                                    <label class="form-check-label" for="quick_edit_kuis_acak_soal">Acak soal</label>
                                </div>

                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="quick_edit_kuis_acak_jawaban">
                                    <label class="form-check-label" for="quick_edit_kuis_acak_jawaban">Acak jawaban</label>
                                </div>

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="quick_edit_kuis_aktif">
                                    <label class="form-check-label" for="quick_edit_kuis_aktif">Aktif</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL IMPORT SOAL --}}
    <div class="modal fade quick-modal" id="quick_import_soal_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <form method="post" id="quick_import_soal_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Import Soal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="quick_import_soal_id_kuis">

                        <div class="alert alert-primary py-3">
                            Kuis: <b id="quick_import_soal_kuis_label">-</b>
                        </div>

                        <label class="form-label fw-bolder required">Template Soal</label>
                        <textarea id="quick_import_soal_template" class="form-control" rows="16" required
                                  placeholder="1. Apa kepanjangan HTML?
A. Hyper Text Markup Language *
B. High Text Machine Language
C. Hyper Tool Multi Language
D. Home Tool Markup Language

Penjelasan: HTML digunakan untuk membuat struktur halaman web."></textarea>

                        <div class="muted-text fs-8 mt-3">
                            Gunakan tanda <b>*</b> pada jawaban benar. Format pilihan boleh A. atau A)
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary btn-sm">Import Soal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    {{-- MODAL SOAL --}}
    <div class="modal fade quick-modal" id="quick_create_soal_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <form method="post" id="quick_create_soal_form" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Soal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="quick_create_soal_id_kuis">

                        <div class="alert alert-success py-3">
                            Kuis: <b id="quick_create_soal_kuis_label">-</b>
                        </div>

                        <div class="row g-5">
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label class="form-label fw-bolder required">Teks Soal</label>
                                    <textarea id="quick_create_soal_teks_soal" class="form-control form-control-sm" rows="5" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bolder">Penjelasan</label>
                                    <textarea id="quick_create_soal_penjelasan" class="form-control form-control-sm" rows="4"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label fw-bolder required">Nilai</label>
                                    <input type="number" id="quick_create_soal_nilai" class="form-control form-control-sm" min="1" value="1" required>
                                </div>

                                <div class="mb-0">
                                    <label class="form-label fw-bolder">Gambar Soal</label>
                                    <input type="file" id="quick_create_soal_gambar_soal" class="form-control form-control-sm" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan Soal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade quick-modal" id="quick_edit_soal_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <form method="post" id="quick_edit_soal_form" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Soal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="quick_edit_soal_id">
                        <input type="hidden" id="quick_edit_soal_id_kuis">

                        <div class="row g-5">
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label class="form-label fw-bolder required">Teks Soal</label>
                                    <textarea id="quick_edit_soal_teks_soal" class="form-control form-control-sm" rows="5" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bolder">Penjelasan</label>
                                    <textarea id="quick_edit_soal_penjelasan" class="form-control form-control-sm" rows="4"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label fw-bolder required">Nilai</label>
                                    <input type="number" id="quick_edit_soal_nilai" class="form-control form-control-sm" min="1" value="1" required>
                                </div>

                                <div class="mb-0">
                                    <label class="form-label fw-bolder">Gambar Soal Baru</label>
                                    <input type="file" id="quick_edit_soal_gambar_soal" class="form-control form-control-sm" accept="image/*">
                                    <div class="muted-text fs-8 mt-2">Kosongkan jika tidak ingin mengganti gambar.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL JAWABAN --}}
    <div class="modal fade quick-modal" id="quick_create_jawaban_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form method="post" id="quick_create_jawaban_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Jawaban</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="quick_create_jawaban_id_soal">

                        <div class="alert alert-primary py-3">
                            Soal: <b id="quick_create_jawaban_soal_label">-</b>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bolder required">Teks Jawaban</label>
                            <textarea id="quick_create_jawaban_teks_jawaban" class="form-control form-control-sm" rows="4" required></textarea>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="quick_create_jawaban_benar">
                            <label class="form-check-label" for="quick_create_jawaban_benar">Tandai sebagai jawaban benar</label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan Jawaban</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade quick-modal" id="quick_edit_jawaban_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form method="post" id="quick_edit_jawaban_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Jawaban</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="quick_edit_jawaban_id">
                        <input type="hidden" id="quick_edit_jawaban_id_soal">

                        <div class="mb-3">
                            <label class="form-label fw-bolder required">Teks Jawaban</label>
                            <textarea id="quick_edit_jawaban_teks_jawaban" class="form-control form-control-sm" rows="4" required></textarea>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="quick_edit_jawaban_benar">
                            <label class="form-check-label" for="quick_edit_jawaban_benar">Tandai sebagai jawaban benar</label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('admin.kelas.kelas.view.edit')
@endsection

@section('javascript')
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

    <script defer>
        let quickCreateBagianQuill = null;
        let quickEditBagianQuill = null;
        let quickCreateMateriQuill = null;
        let quickEditMateriQuill = null;

        const quickBuilderRoutes = {
            bagianShow: "{{ route('admin.materi.bagian_kelas.show', ':id') }}",
            bagianStore: "{{ route('admin.materi.bagian_kelas.store') }}",
            bagianUpdate: "{{ route('admin.materi.bagian_kelas.update', ':id') }}",
            bagianDelete: "{{ route('admin.materi.bagian_kelas.delete', ':id') }}",

            materiShow: "{{ route('admin.materi.materi.show', ':id') }}",
            materiStore: "{{ route('admin.materi.materi.store') }}",
            materiUpdate: "{{ route('admin.materi.materi.update', ':id') }}",
            materiDelete: "{{ route('admin.materi.materi.delete', ':id') }}",

            kuisShow: "{{ route('admin.materi.kuis.show', ':id') }}",
            kuisStore: "{{ route('admin.materi.kuis.store') }}",
            kuisUpdate: "{{ route('admin.materi.kuis.update', ':id') }}",
            kuisDelete: "{{ route('admin.materi.kuis.delete', ':id') }}",

            soalShow: "{{ route('admin.materi.soal.show', ':id') }}",
            soalStore: "{{ route('admin.materi.soal.store') }}",
            soalUpdate: "{{ route('admin.materi.soal.update', ':id') }}",
            soalDelete: "{{ route('admin.materi.soal.delete', ':id') }}",
            soalImport: "{{ route('admin.materi.soal.import', ':id') }}",

            jawabanShow: "{{ route('admin.materi.jawaban.show', ':id') }}",
            jawabanStore: "{{ route('admin.materi.jawaban.store') }}",
            jawabanUpdate: "{{ route('admin.materi.jawaban.update', ':id') }}",
            jawabanDelete: "{{ route('admin.materi.jawaban.delete', ':id') }}",
        };

        function quickUrl(url, id) {
            return url.replace(':id', id);
        }

        function quickInitQuill(selector, currentInstance) {
            if (!window.Quill) {
                return null;
            }

            if (currentInstance) {
                return currentInstance;
            }

            return new Quill(selector, {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ header: [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ list: 'ordered' }, { list: 'bullet' }],
                        [{ align: [] }],
                        ['link'],
                        [{ color: [] }, { background: [] }],
                        ['clean']
                    ]
                }
            });
        }

        function quickSuccessAndReload(title, message) {
            Swal.fire({
                icon: 'success',
                title: title,
                text: message || '',
                showConfirmButton: false,
                timer: 1200,
                timerProgressBar: true
            }).then(() => location.reload());
        }

        function quickWarning(response) {
            if (response && response.errors) {
                const firstKey = Object.keys(response.errors)[0];
                const message = firstKey && response.errors[firstKey] && response.errors[firstKey][0]
                    ? response.errors[firstKey][0]
                    : 'Validasi bermasalah.';

                Swal.fire('Warning', message, 'warning');
                return;
            }

            Swal.fire('Warning', response?.message || 'Terjadi kesalahan.', 'warning');
        }

        function quickConfirmSubmit(title, callback) {
            Swal.fire({
                title: title,
                text: 'Pastikan data sudah benar.',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                showCancelButton: true,
                cancelButtonColor: '#dd3333',
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal',
                focusCancel: true,
            }).then((result) => {
                if (result.value || result.isConfirmed) {
                    callback();
                }
            });
        }

        function quickConfirmDelete(callback) {
            Swal.fire({
                title: 'Hapus data ini?',
                text: 'Data turunannya juga akan ikut terhapus.',
                icon: 'warning',
                confirmButtonColor: '#dd3333',
                showCancelButton: true,
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                focusCancel: true,
            }).then((result) => {
                if (result.value || result.isConfirmed) {
                    callback();
                }
            });
        }

        function quickToggleCreateMateriFields() {
            const tipe = $('#quick_create_materi_tipe').val();
            $('.quick-create-materi-field').addClass('d-none');

            if (tipe === 'text') {
                $('.quick-create-materi-text').removeClass('d-none');
            }

            if (tipe === 'video') {
                $('.quick-create-materi-video').removeClass('d-none');
            }
        }

        function quickToggleEditMateriFields() {
            const tipe = $('#quick_edit_materi_tipe').val();
            $('.quick-edit-materi-field').addClass('d-none');

            if (tipe === 'text') {
                $('.quick-edit-materi-text').removeClass('d-none');
            }

            if (tipe === 'video') {
                $('.quick-edit-materi-video').removeClass('d-none');
            }
        }

        $('#quick_create_bagian_modal').on('shown.bs.modal', function () {
            quickCreateBagianQuill = quickInitQuill('#quick_create_bagian_deskripsi_editor', quickCreateBagianQuill);
        }).on('hidden.bs.modal', function () {
            this.querySelector('form').reset();

            if (quickCreateBagianQuill) {
                quickCreateBagianQuill.setContents([]);
            }
        });

        $('#quick_edit_bagian_modal').on('shown.bs.modal', function () {
            quickEditBagianQuill = quickInitQuill('#quick_edit_bagian_deskripsi_editor', quickEditBagianQuill);
        });

        $('#quick_create_materi_modal').on('shown.bs.modal', function () {
            quickCreateMateriQuill = quickInitQuill('#quick_create_materi_content_editor', quickCreateMateriQuill);
            quickToggleCreateMateriFields();
        }).on('hidden.bs.modal', function () {
            this.querySelector('form').reset();
            $('.quick-create-materi-field').addClass('d-none');

            if (quickCreateMateriQuill) {
                quickCreateMateriQuill.setContents([]);
            }
        });

        $('#quick_edit_materi_modal').on('shown.bs.modal', function () {
            quickEditMateriQuill = quickInitQuill('#quick_edit_materi_content_editor', quickEditMateriQuill);
            quickToggleEditMateriFields();
        });

        $('#quick_create_materi_tipe').on('change', quickToggleCreateMateriFields);
        $('#quick_edit_materi_tipe').on('change', quickToggleEditMateriFields);

        $('#quick_create_bagian_form').on('submit', function (e) {
            e.preventDefault();

            quickConfirmSubmit('Simpan bagian baru?', function () {
                DataManager.openLoading();

                if (quickCreateBagianQuill) {
                    $('#quick_create_bagian_deskripsi').val(quickCreateBagianQuill.root.innerHTML);
                }

                const formData = new FormData();
                formData.append('id_kelas', $('#quick_create_bagian_id_kelas').val());
                formData.append('judul', $('#quick_create_bagian_judul').val());
                formData.append('deskripsi', $('#quick_create_bagian_deskripsi').val());
                formData.append('urutan', $('#quick_create_bagian_urutan').val());

                DataManager.formData(quickBuilderRoutes.bagianStore, formData)
                    .then(response => response.success ? quickSuccessAndReload('Bagian berhasil ditambahkan', response.message) : quickWarning(response))
                    .catch(error => ErrorHandler.handleError(error));
            });
        });

        $(document).on('click', '.btn-quick-edit-bagian', function () {
            const id = $(this).data('id');
            $('#quick_edit_bagian_id').val(id);

            DataManager.fetchData(quickUrl(quickBuilderRoutes.bagianShow, id)).then(response => {
                if (!response.success) {
                    quickWarning(response);
                    return;
                }

                const data = response.data || {};
                $('#quick_edit_bagian_id_kelas').val(data.id_kelas || "{{ $id }}");
                $('#quick_edit_bagian_judul').val(data.judul || '');
                $('#quick_edit_bagian_urutan').val(data.urutan ?? 0);

                setTimeout(() => {
                    quickEditBagianQuill = quickInitQuill('#quick_edit_bagian_deskripsi_editor', quickEditBagianQuill);

                    if (quickEditBagianQuill) {
                        quickEditBagianQuill.root.innerHTML = data.deskripsi || '';
                    }
                }, 150);
            }).catch(error => ErrorHandler.handleError(error));
        });

        $('#quick_edit_bagian_form').on('submit', function (e) {
            e.preventDefault();

            quickConfirmSubmit('Simpan perubahan bagian?', function () {
                DataManager.openLoading();

                const id = $('#quick_edit_bagian_id').val();

                if (quickEditBagianQuill) {
                    $('#quick_edit_bagian_deskripsi').val(quickEditBagianQuill.root.innerHTML);
                }

                const formData = new FormData();
                formData.append('id_kelas', $('#quick_edit_bagian_id_kelas').val());
                formData.append('judul', $('#quick_edit_bagian_judul').val());
                formData.append('deskripsi', $('#quick_edit_bagian_deskripsi').val());
                formData.append('urutan', $('#quick_edit_bagian_urutan').val());

                DataManager.formData(quickUrl(quickBuilderRoutes.bagianUpdate, id), formData)
                    .then(response => response.success ? quickSuccessAndReload('Bagian berhasil diperbarui', response.message) : quickWarning(response))
                    .catch(error => ErrorHandler.handleError(error));
            });
        });

        $(document).on('click', '.btn-quick-delete-bagian', function () {
            const id = $(this).data('id');

            quickConfirmDelete(function () {
                DataManager.openLoading();

                DataManager.deleteData(quickUrl(quickBuilderRoutes.bagianDelete, id))
                    .then(response => response.success ? quickSuccessAndReload('Bagian berhasil dihapus', response.message) : quickWarning(response))
                    .catch(error => ErrorHandler.handleError(error));
            });
        });

        $(document).on('click', '.btn-quick-create-materi', function () {
            $('#quick_create_materi_id_bagian_kelas').val($(this).data('id-bagian-kelas'));
            $('#quick_create_materi_bagian_label').text($(this).data('judul-bagian') || '-');
            $('#quick_create_materi_urutan').val($(this).data('next-urutan') || 0);
            $('#quick_create_materi_tipe').val('video').trigger('change');
        });

        $('#quick_create_materi_form').on('submit', function (e) {
            e.preventDefault();

            quickConfirmSubmit('Simpan materi baru?', function () {
                DataManager.openLoading();

                if (quickCreateMateriQuill) {
                    $('#quick_create_materi_content').val(quickCreateMateriQuill.root.innerHTML);
                }

                const formData = new FormData();
                formData.append('id_bagian_kelas', $('#quick_create_materi_id_bagian_kelas').val());
                formData.append('judul', $('#quick_create_materi_judul').val());
                formData.append('tipe', $('#quick_create_materi_tipe').val());
                formData.append('content', $('#quick_create_materi_content').val());
                formData.append('url_video', $('#quick_create_materi_url_video').val());
                formData.append('url_lampiran', '');
                formData.append('urutan', $('#quick_create_materi_urutan').val());
                formData.append('durasi_detik', $('#quick_create_materi_durasi_detik').val());
                formData.append('preview', $('#quick_create_materi_preview').is(':checked') ? 1 : 0);

                DataManager.formData(quickBuilderRoutes.materiStore, formData)
                    .then(response => response.success ? quickSuccessAndReload('Materi berhasil ditambahkan', response.message) : quickWarning(response))
                    .catch(error => ErrorHandler.handleError(error));
            });
        });

        $(document).on('click', '.btn-quick-edit-materi', function () {
            const id = $(this).data('id');
            $('#quick_edit_materi_id').val(id);

            DataManager.fetchData(quickUrl(quickBuilderRoutes.materiShow, id)).then(response => {
                if (!response.success) {
                    quickWarning(response);
                    return;
                }

                const data = response.data || {};
                $('#quick_edit_materi_id_bagian_kelas').val(data.id_bagian_kelas || '');
                $('#quick_edit_materi_judul').val(data.judul || '');
                $('#quick_edit_materi_tipe').val(data.tipe || 'video').trigger('change');
                $('#quick_edit_materi_url_video').val(data.url_video || '');
                $('#quick_edit_materi_urutan').val(data.urutan ?? 0);
                $('#quick_edit_materi_durasi_detik').val(data.durasi_detik ?? '');
                $('#quick_edit_materi_preview').prop('checked', parseInt(data.preview || 0) === 1);

                setTimeout(() => {
                    quickEditMateriQuill = quickInitQuill('#quick_edit_materi_content_editor', quickEditMateriQuill);

                    if (quickEditMateriQuill) {
                        quickEditMateriQuill.root.innerHTML = data.content || '';
                    }

                    quickToggleEditMateriFields();
                }, 150);
            }).catch(error => ErrorHandler.handleError(error));
        });

        $('#quick_edit_materi_form').on('submit', function (e) {
            e.preventDefault();

            quickConfirmSubmit('Simpan perubahan materi?', function () {
                DataManager.openLoading();

                const id = $('#quick_edit_materi_id').val();

                if (quickEditMateriQuill) {
                    $('#quick_edit_materi_content').val(quickEditMateriQuill.root.innerHTML);
                }

                const formData = new FormData();
                formData.append('id_bagian_kelas', $('#quick_edit_materi_id_bagian_kelas').val());
                formData.append('judul', $('#quick_edit_materi_judul').val());
                formData.append('tipe', $('#quick_edit_materi_tipe').val());
                formData.append('content', $('#quick_edit_materi_content').val());
                formData.append('url_video', $('#quick_edit_materi_url_video').val());
                formData.append('url_lampiran', '');
                formData.append('urutan', $('#quick_edit_materi_urutan').val());
                formData.append('durasi_detik', $('#quick_edit_materi_durasi_detik').val());
                formData.append('preview', $('#quick_edit_materi_preview').is(':checked') ? 1 : 0);

                DataManager.formData(quickUrl(quickBuilderRoutes.materiUpdate, id), formData)
                    .then(response => response.success ? quickSuccessAndReload('Materi berhasil diperbarui', response.message) : quickWarning(response))
                    .catch(error => ErrorHandler.handleError(error));
            });
        });

        $(document).on('click', '.btn-quick-delete-materi', function () {
            const id = $(this).data('id');

            quickConfirmDelete(function () {
                DataManager.openLoading();

                DataManager.deleteData(quickUrl(quickBuilderRoutes.materiDelete, id))
                    .then(response => response.success ? quickSuccessAndReload('Materi berhasil dihapus', response.message) : quickWarning(response))
                    .catch(error => ErrorHandler.handleError(error));
            });
        });

        $(document).on('click', '.btn-quick-create-kuis', function () {
            $('#quick_create_kuis_id_materi').val($(this).data('id-materi'));
            $('#quick_create_kuis_materi_label').text($(this).data('judul-materi') || '-');
            $('#quick_create_kuis_judul').val('Kuis - ' + ($(this).data('judul-materi') || 'Materi'));
        });

        $('#quick_create_kuis_modal').on('hidden.bs.modal', function () {
            this.querySelector('form').reset();
            $('#quick_create_kuis_tampilkan_jawaban_benar').prop('checked', true);
            $('#quick_create_kuis_acak_soal').prop('checked', true);
            $('#quick_create_kuis_aktif').prop('checked', true);
        });

        $('#quick_create_kuis_form').on('submit', function (e) {
            e.preventDefault();

            quickConfirmSubmit('Simpan kuis baru?', function () {
                DataManager.openLoading();

                const formData = new FormData();
                formData.append('id_materi', $('#quick_create_kuis_id_materi').val());
                formData.append('judul', $('#quick_create_kuis_judul').val());
                formData.append('deskripsi', $('#quick_create_kuis_deskripsi').val());
                formData.append('instruksi', $('#quick_create_kuis_instruksi').val());
                formData.append('tipe', $('#quick_create_kuis_tipe').val());
                formData.append('durasi_menit', $('#quick_create_kuis_durasi_menit').val());
                formData.append('nilai_lulus', $('#quick_create_kuis_nilai_lulus').val());
                formData.append('tampilkan_jawaban_benar', $('#quick_create_kuis_tampilkan_jawaban_benar').is(':checked') ? 1 : 0);
                formData.append('acak_soal', $('#quick_create_kuis_acak_soal').is(':checked') ? 1 : 0);
                formData.append('acak_jawaban', $('#quick_create_kuis_acak_jawaban').is(':checked') ? 1 : 0);
                formData.append('aktif', $('#quick_create_kuis_aktif').is(':checked') ? 1 : 0);

                DataManager.formData(quickBuilderRoutes.kuisStore, formData)
                    .then(response => response.success ? quickSuccessAndReload('Kuis berhasil ditambahkan', response.message) : quickWarning(response))
                    .catch(error => ErrorHandler.handleError(error));
            });
        });

        $(document).on('click', '.btn-quick-edit-kuis', function () {
            const id = $(this).data('id');
            $('#quick_edit_kuis_id').val(id);

            DataManager.fetchData(quickUrl(quickBuilderRoutes.kuisShow, id)).then(response => {
                if (!response.success) {
                    quickWarning(response);
                    return;
                }

                const data = response.data || {};
                $('#quick_edit_kuis_id_materi').val(data.id_materi || '');
                $('#quick_edit_kuis_judul').val(data.judul || '');
                $('#quick_edit_kuis_deskripsi').val(data.deskripsi || '');
                $('#quick_edit_kuis_instruksi').val(data.instruksi || '');
                $('#quick_edit_kuis_tipe').val(data.tipe || 'kuis_materi');
                $('#quick_edit_kuis_durasi_menit').val(data.durasi_menit || 10);
                $('#quick_edit_kuis_nilai_lulus').val(data.nilai_lulus || 80);
                $('#quick_edit_kuis_tampilkan_jawaban_benar').prop('checked', parseInt(data.tampilkan_jawaban_benar || 0) === 1);
                $('#quick_edit_kuis_acak_soal').prop('checked', parseInt(data.acak_soal || 0) === 1);
                $('#quick_edit_kuis_acak_jawaban').prop('checked', parseInt(data.acak_jawaban || 0) === 1);
                $('#quick_edit_kuis_aktif').prop('checked', parseInt(data.aktif || 0) === 1);
            }).catch(error => ErrorHandler.handleError(error));
        });

        $('#quick_edit_kuis_form').on('submit', function (e) {
            e.preventDefault();

            quickConfirmSubmit('Simpan perubahan kuis?', function () {
                DataManager.openLoading();

                const id = $('#quick_edit_kuis_id').val();

                const formData = new FormData();
                formData.append('id_materi', $('#quick_edit_kuis_id_materi').val());
                formData.append('judul', $('#quick_edit_kuis_judul').val());
                formData.append('deskripsi', $('#quick_edit_kuis_deskripsi').val());
                formData.append('instruksi', $('#quick_edit_kuis_instruksi').val());
                formData.append('tipe', $('#quick_edit_kuis_tipe').val());
                formData.append('durasi_menit', $('#quick_edit_kuis_durasi_menit').val());
                formData.append('nilai_lulus', $('#quick_edit_kuis_nilai_lulus').val());
                formData.append('tampilkan_jawaban_benar', $('#quick_edit_kuis_tampilkan_jawaban_benar').is(':checked') ? 1 : 0);
                formData.append('acak_soal', $('#quick_edit_kuis_acak_soal').is(':checked') ? 1 : 0);
                formData.append('acak_jawaban', $('#quick_edit_kuis_acak_jawaban').is(':checked') ? 1 : 0);
                formData.append('aktif', $('#quick_edit_kuis_aktif').is(':checked') ? 1 : 0);

                DataManager.formData(quickUrl(quickBuilderRoutes.kuisUpdate, id), formData)
                    .then(response => response.success ? quickSuccessAndReload('Kuis berhasil diperbarui', response.message) : quickWarning(response))
                    .catch(error => ErrorHandler.handleError(error));
            });
        });

        $(document).on('click', '.btn-quick-delete-kuis', function () {
            const id = $(this).data('id');

            quickConfirmDelete(function () {
                DataManager.openLoading();

                DataManager.deleteData(quickUrl(quickBuilderRoutes.kuisDelete, id))
                    .then(response => response.success ? quickSuccessAndReload('Kuis berhasil dihapus', response.message) : quickWarning(response))
                    .catch(error => ErrorHandler.handleError(error));
            });
        });

        $(document).on('click', '.btn-quick-import-soal', function () {
            $('#quick_import_soal_id_kuis').val($(this).data('id-kuis'));
            $('#quick_import_soal_kuis_label').text($(this).data('judul-kuis') || '-');
        });

        $('#quick_import_soal_modal').on('hidden.bs.modal', function () {
            this.querySelector('form').reset();
        });

        $('#quick_import_soal_form').on('submit', function (e) {
            e.preventDefault();

            quickConfirmSubmit('Import soal ke kuis ini?', function () {
                DataManager.openLoading();

                const id = $('#quick_import_soal_id_kuis').val();

                const formData = new FormData();
                formData.append('template_soal', $('#quick_import_soal_template').val());

                DataManager.formData(quickUrl(quickBuilderRoutes.soalImport, id), formData)
                    .then(response => response.success ? quickSuccessAndReload('Soal berhasil diimport', response.message) : quickWarning(response))
                    .catch(error => ErrorHandler.handleError(error));
            });
        });

        $(document).on('click', '.btn-quick-create-soal', function () {
            $('#quick_create_soal_id_kuis').val($(this).data('id-kuis'));
            $('#quick_create_soal_kuis_label').text($(this).data('judul-kuis') || '-');
            $('#quick_create_soal_nilai').val(1);
        });

        $('#quick_create_soal_modal').on('hidden.bs.modal', function () {
            this.querySelector('form').reset();
            $('#quick_create_soal_kuis_label').text('-');
        });

        $('#quick_create_soal_form').on('submit', function (e) {
            e.preventDefault();

            quickConfirmSubmit('Simpan soal baru?', function () {
                DataManager.openLoading();

                const formData = new FormData();
                const gambar = $('#quick_create_soal_gambar_soal')[0]?.files?.[0];

                formData.append('id_kuis', $('#quick_create_soal_id_kuis').val());
                formData.append('teks_soal', $('#quick_create_soal_teks_soal').val());
                formData.append('nilai', $('#quick_create_soal_nilai').val());
                formData.append('penjelasan', $('#quick_create_soal_penjelasan').val());

                if (gambar) {
                    formData.append('gambar_soal', gambar);
                }

                DataManager.formData(quickBuilderRoutes.soalStore, formData)
                    .then(response => response.success ? quickSuccessAndReload('Soal berhasil ditambahkan', response.message) : quickWarning(response))
                    .catch(error => ErrorHandler.handleError(error));
            });
        });

        $(document).on('click', '.btn-quick-edit-soal', function () {
            const id = $(this).data('id');
            $('#quick_edit_soal_id').val(id);

            DataManager.fetchData(quickUrl(quickBuilderRoutes.soalShow, id)).then(response => {
                if (!response.success) {
                    quickWarning(response);
                    return;
                }

                const data = response.data || {};
                $('#quick_edit_soal_id_kuis').val(data.id_kuis || '');
                $('#quick_edit_soal_teks_soal').val(data.teks_soal || '');
                $('#quick_edit_soal_nilai').val(data.nilai || 1);
                $('#quick_edit_soal_penjelasan').val(data.penjelasan || '');
                $('#quick_edit_soal_gambar_soal').val('');
            }).catch(error => ErrorHandler.handleError(error));
        });

        $('#quick_edit_soal_form').on('submit', function (e) {
            e.preventDefault();

            quickConfirmSubmit('Simpan perubahan soal?', function () {
                DataManager.openLoading();

                const id = $('#quick_edit_soal_id').val();
                const formData = new FormData();
                const gambar = $('#quick_edit_soal_gambar_soal')[0]?.files?.[0];

                formData.append('id_kuis', $('#quick_edit_soal_id_kuis').val());
                formData.append('teks_soal', $('#quick_edit_soal_teks_soal').val());
                formData.append('nilai', $('#quick_edit_soal_nilai').val());
                formData.append('penjelasan', $('#quick_edit_soal_penjelasan').val());

                if (gambar) {
                    formData.append('gambar_soal', gambar);
                }

                DataManager.formData(quickUrl(quickBuilderRoutes.soalUpdate, id), formData)
                    .then(response => response.success ? quickSuccessAndReload('Soal berhasil diperbarui', response.message) : quickWarning(response))
                    .catch(error => ErrorHandler.handleError(error));
            });
        });

        $(document).on('click', '.btn-quick-delete-soal', function () {
            const id = $(this).data('id');

            quickConfirmDelete(function () {
                DataManager.openLoading();

                DataManager.deleteData(quickUrl(quickBuilderRoutes.soalDelete, id))
                    .then(response => response.success ? quickSuccessAndReload('Soal berhasil dihapus', response.message) : quickWarning(response))
                    .catch(error => ErrorHandler.handleError(error));
            });
        });

        $(document).on('click', '.btn-quick-create-jawaban', function () {
            $('#quick_create_jawaban_id_soal').val($(this).data('id-soal'));
            $('#quick_create_jawaban_soal_label').text($(this).data('teks-soal') || '-');
            $('#quick_create_jawaban_benar').prop('checked', false);
        });

        $('#quick_create_jawaban_modal').on('hidden.bs.modal', function () {
            this.querySelector('form').reset();
            $('#quick_create_jawaban_soal_label').text('-');
        });

        $('#quick_create_jawaban_form').on('submit', function (e) {
            e.preventDefault();

            quickConfirmSubmit('Simpan jawaban baru?', function () {
                DataManager.openLoading();

                const formData = new FormData();
                formData.append('id_soal', $('#quick_create_jawaban_id_soal').val());
                formData.append('teks_jawaban', $('#quick_create_jawaban_teks_jawaban').val());
                formData.append('benar', $('#quick_create_jawaban_benar').is(':checked') ? 1 : 0);

                DataManager.formData(quickBuilderRoutes.jawabanStore, formData)
                    .then(response => response.success ? quickSuccessAndReload('Jawaban berhasil ditambahkan', response.message) : quickWarning(response))
                    .catch(error => ErrorHandler.handleError(error));
            });
        });

        $(document).on('click', '.btn-quick-edit-jawaban', function () {
            const id = $(this).data('id');
            $('#quick_edit_jawaban_id').val(id);

            DataManager.fetchData(quickUrl(quickBuilderRoutes.jawabanShow, id)).then(response => {
                if (!response.success) {
                    quickWarning(response);
                    return;
                }

                const data = response.data || {};
                $('#quick_edit_jawaban_id_soal').val(data.id_soal || '');
                $('#quick_edit_jawaban_teks_jawaban').val(data.teks_jawaban || '');
                $('#quick_edit_jawaban_benar').prop('checked', parseInt(data.benar || 0) === 1);
            }).catch(error => ErrorHandler.handleError(error));
        });

        $('#quick_edit_jawaban_form').on('submit', function (e) {
            e.preventDefault();

            quickConfirmSubmit('Simpan perubahan jawaban?', function () {
                DataManager.openLoading();

                const id = $('#quick_edit_jawaban_id').val();
                const formData = new FormData();
                formData.append('id_soal', $('#quick_edit_jawaban_id_soal').val());
                formData.append('teks_jawaban', $('#quick_edit_jawaban_teks_jawaban').val());
                formData.append('benar', $('#quick_edit_jawaban_benar').is(':checked') ? 1 : 0);

                DataManager.formData(quickUrl(quickBuilderRoutes.jawabanUpdate, id), formData)
                    .then(response => response.success ? quickSuccessAndReload('Jawaban berhasil diperbarui', response.message) : quickWarning(response))
                    .catch(error => ErrorHandler.handleError(error));
            });
        });

        $(document).on('click', '.btn-quick-delete-jawaban', function () {
            const id = $(this).data('id');

            quickConfirmDelete(function () {
                DataManager.openLoading();

                DataManager.deleteData(quickUrl(quickBuilderRoutes.jawabanDelete, id))
                    .then(response => response.success ? quickSuccessAndReload('Jawaban berhasil dihapus', response.message) : quickWarning(response))
                    .catch(error => ErrorHandler.handleError(error));
            });
        });


        const quickBuilderExportBase = "{{ route('admin.kelas.kelas.builder.export', ['id' => $id]) }}";

        function quickExportBuilderUrl(scope, target = null) {
            const query = new URLSearchParams();
            query.set('scope', scope || 'kelas');

            if (target !== null && target !== undefined && target !== '') {
                query.set('target', target);
            }

            return `${quickBuilderExportBase}?${query.toString()}`;
        }

        function quickEscapeHtml(value) {
            return $('<div>').text(value === null || value === undefined || value === '' ? '-' : String(value)).html();
        }

        function quickDetailTable(data) {
            const ignored = ['created_at', 'updated_at', 'deleted_at'];

            if (!data || typeof data !== 'object') {
                return '<div class="text-muted fw-bold">Data detail tidak tersedia.</div>';
            }

            const rows = Object.entries(data)
                .filter(([key]) => !ignored.includes(key))
                .map(([key, value]) => {
                    const label = key.replaceAll('_', ' ').replace(/\b\w/g, char => char.toUpperCase());
                    let shown = value;

                    if (typeof value === 'object' && value !== null) {
                        shown = JSON.stringify(value);
                    }

                    return `
                        <tr>
                            <th style="width: 34%; white-space: nowrap; color:#475569;">${quickEscapeHtml(label)}</th>
                            <td style="color:#0f172a;">${quickEscapeHtml(shown)}</td>
                        </tr>
                    `;
                })
                .join('');

            return `
                <div class="table-responsive text-start">
                    <table class="table table-sm table-bordered align-middle mb-0">
                        <tbody>${rows || '<tr><td>Data kosong.</td></tr>'}</tbody>
                    </table>
                </div>
            `;
        }

        function quickInjectAction($row, key, $element, prepend = false) {
            if (!$row || !$row.length || $row.find(`[data-builder-action="${key}"]`).length) {
                return;
            }

            $element.attr('data-builder-action', key);

            if (prepend) {
                $row.prepend($element);
                return;
            }

            $row.append($element);
        }

        function quickDetailButton(kind, id, title) {
            const routeMap = {
                bagian: quickBuilderRoutes.bagianShow,
                materi: quickBuilderRoutes.materiShow,
                kuis: quickBuilderRoutes.kuisShow,
                soal: quickBuilderRoutes.soalShow,
                jawaban: quickBuilderRoutes.jawabanShow,
            };

            return $(`
                <button type="button"
                        class="btn-neo btn-quick-detail-builder"
                        data-url="${quickUrl(routeMap[kind], id)}"
                        data-title="${quickEscapeHtml(title)}">
                    <i class="bi bi-eye"></i>
                    Detail
                </button>
            `);
        }

        function quickExportButton(scope, target = null, label = 'Export Excel') {
            return $(`
                <a href="${quickExportBuilderUrl(scope, target)}"
                   target="_blank"
                   rel="noopener"
                   class="btn-neo">
                    <i class="bi bi-file-earmark-spreadsheet"></i>
                    ${label}
                </a>
            `);
        }

        function quickEnhanceBuilderExtraActions() {
            const $headerActions = $('#kelola-isi-kelas > .builder-header .action-row');

            if ($headerActions.length && !$headerActions.find('[data-builder-action="export-kelas"]').length) {
                quickInjectAction($headerActions, 'export-kelas', quickExportButton('kelas', null, 'Export Semua'), true);
            }

            $('.btn-quick-edit-bagian').each(function () {
                const id = $(this).data('id');
                const $row = $(this).closest('.action-row');
                quickInjectAction($row, `detail-bagian-${id}`, quickDetailButton('bagian', id, 'Detail Bagian Kelas'), true);
                quickInjectAction($row, `export-bagian-${id}`, quickExportButton('bagian', id, 'Export Bagian'));
            });

            $('.btn-quick-edit-materi').each(function () {
                const id = $(this).data('id');
                const $row = $(this).closest('.action-row');
                quickInjectAction($row, `detail-materi-${id}`, quickDetailButton('materi', id, 'Detail Materi'), true);
                quickInjectAction($row, `export-materi-${id}`, quickExportButton('materi', id, 'Export Materi'));
            });

            $('.btn-quick-edit-kuis').each(function () {
                const id = $(this).data('id');
                const $row = $(this).closest('.action-row');
                quickInjectAction($row, `detail-kuis-${id}`, quickDetailButton('kuis', id, 'Detail Kuis'), true);
                quickInjectAction($row, `export-kuis-${id}`, quickExportButton('kuis', id, 'Export Kuis'));
            });

            $('.btn-quick-edit-soal').each(function () {
                const id = $(this).data('id');
                const $row = $(this).closest('.action-row');
                quickInjectAction($row, `detail-soal-${id}`, quickDetailButton('soal', id, 'Detail Soal'), true);
                quickInjectAction($row, `export-soal-${id}`, quickExportButton('soal', id, 'Export Soal'));
            });

            $('.btn-quick-edit-jawaban').each(function () {
                const id = $(this).data('id');
                const $row = $(this).closest('.action-row');
                quickInjectAction($row, `detail-jawaban-${id}`, quickDetailButton('jawaban', id, 'Detail Jawaban'), true);
            });
        }

        function quickSetupBuilderCollapse($container, contentSelector, titleSelector, label) {
            $container.each(function () {
                const $box = $(this);

                if ($box.data('collapse-ready')) {
                    return;
                }

                const $content = $box.children(contentSelector).first();
                const $title = $box.find(titleSelector).first();

                if (!$content.length || !$title.length) {
                    return;
                }

                $box.data('collapse-ready', true);
                $content.hide();

                const $line = $('<div class="builder-title-line"></div>');
                const $toggle = $(`
                    <button type="button"
                            class="builder-collapse-toggle"
                            aria-expanded="false"
                            title="Buka/tutup ${label}">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                `);

                $title.before($line);
                $line.append($toggle).append($title.detach());

                $toggle.on('click', function (event) {
                    event.preventDefault();
                    event.stopPropagation();

                    const isOpen = $toggle.hasClass('is-open');
                    $toggle.toggleClass('is-open', !isOpen);
                    $toggle.attr('aria-expanded', !isOpen ? 'true' : 'false');
                    $content.stop(true, true).slideToggle(180);
                });
            });
        }

        function quickSetupCompactBuilder() {
            quickSetupBuilderCollapse($('.materi-item'), '.kuis-list', '.materi-title', 'kuis materi');
            quickSetupBuilderCollapse($('.kuis-item'), '.soal-list', '.kuis-title', 'daftar soal');
            quickSetupBuilderCollapse($('.soal-item'), '.jawaban-list', '.soal-title', 'pilihan jawaban');
        }

        function quickMakeBuilderActionsDropdown() {
            const selector = [
                '#kelola-isi-kelas .bagian-header .action-row',
                '#kelola-isi-kelas .materi-main-row .action-row',
                '#kelola-isi-kelas .kuis-top-row .action-row',
                '#kelola-isi-kelas .soal-top-row .action-row',
                '#kelola-isi-kelas .jawaban-row .action-row'
            ].join(', ');

            $(selector).each(function () {
                const $row = $(this);

                if ($row.data('dropdown-ready')) {
                    return;
                }

                const $items = $row.children('button, a');

                if ($items.length <= 1) {
                    return;
                }

                $row.data('dropdown-ready', true);

                const $dropdown = $(`
                    <div class="dropdown builder-action-dropdown">
                        <button class="btn-neo dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                            Aksi
                        </button>
                        <div class="dropdown-menu dropdown-menu-end"></div>
                    </div>
                `);

                const $menu = $dropdown.find('.dropdown-menu');

                $items.each(function () {
                    const $item = $(this);
                    $item
                        .removeClass('btn-neo btn-neo-primary primary success warning danger mt-3')
                        .addClass('dropdown-item')
                        .removeAttr('style');

                    if ($item.is('button')) {
                        $item.attr('type', 'button');
                    }

                    $menu.append($item);
                });

                $row.empty().append($dropdown);
            });
        }

        $(document).on('click', '.btn-quick-detail-builder', function (e) {
            e.preventDefault();

            const url = $(this).data('url');
            const title = $(this).data('title') || 'Detail Data';

            DataManager.openLoading();

            DataManager.fetchData(url).then(response => {
                Swal.close();

                if (!response.success) {
                    quickWarning(response);
                    return;
                }

                Swal.fire({
                    title: title,
                    html: quickDetailTable(response.data || {}),
                    width: 760,
                    confirmButtonText: 'Tutup',
                    confirmButtonColor: '#334155',
                });
            }).catch(error => {
                Swal.close();
                ErrorHandler.handleError(error);
            });
        });

        $(function () {
            quickEnhanceBuilderExtraActions();
            quickSetupCompactBuilder();
            quickMakeBuilderActionsDropdown();
        });

    </script>

    @include('admin.kelas.kelas.script.edit')
@endsection