<style>
    #form_detail {
        --neo-modal-bg: #eef2f7;
        --neo-modal-surface: #eef2f7;
        --neo-modal-surface-soft: #f3f6fa;
        --neo-modal-text: #1f2937;
        --neo-modal-muted: #6b7280;
        --neo-modal-border: rgba(148, 163, 184, 0.18);
        --neo-modal-shadow-dark: rgba(163, 177, 198, 0.42);
        --neo-modal-shadow-light: rgba(255, 255, 255, 0.95);
        --neo-modal-primary: #3b82f6;
        --neo-modal-danger: #ef4444;
        --neo-modal-success: #10b981;
        --neo-modal-warning: #f59e0b;
    }

    #form_detail .modal-dialog {
        max-width: 1080px;
        margin: 1.75rem auto;
    }

    #form_detail .modal-content {
        border: 0;
        border-radius: 28px;
        background: var(--neo-modal-bg);
        box-shadow:
            18px 18px 40px rgba(15, 23, 42, 0.22),
            -10px -10px 28px rgba(255, 255, 255, 0.8);
        overflow: hidden;
    }

    #form_detail .modal-header {
        min-height: auto;
        padding: 24px 26px 18px;
        border-bottom: 1px solid var(--neo-modal-border);
        background: transparent;
    }

    #form_detail .neo-modal-title-wrap {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
    }

    #form_detail .neo-modal-title-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 17px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--neo-modal-primary);
        background: var(--neo-modal-surface);
        box-shadow:
            inset 5px 5px 10px rgba(163, 177, 198, 0.28),
            inset -5px -5px 10px rgba(255, 255, 255, 0.92);
        font-size: 1.2rem;
    }

    #form_detail .modal-title {
        margin: 0;
        color: var(--neo-modal-text);
        font-size: 1.18rem;
        line-height: 1.25;
        font-weight: 850;
        letter-spacing: -0.02em;
    }

    #form_detail .neo-modal-subtitle {
        margin: 5px 0 0;
        color: var(--neo-modal-muted);
        font-size: 0.86rem;
        line-height: 1.4;
        font-weight: 500;
    }

    #form_detail .neo-btn-close {
        width: 42px;
        height: 42px;
        min-width: 42px;
        padding: 0;
        border: 0;
        border-radius: 15px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--neo-modal-muted);
        background: var(--neo-modal-surface);
        box-shadow:
            6px 6px 14px rgba(163, 177, 198, 0.34),
            -6px -6px 14px rgba(255, 255, 255, 0.9);
        opacity: 1;
        transition: .18s ease;
    }

    #form_detail .neo-btn-close:hover {
        color: var(--neo-modal-danger);
        transform: translateY(-1px);
    }

    #form_detail .neo-btn-close i {
        font-size: 1.2rem;
        line-height: 1;
    }

    #form_detail .modal-body {
        padding: 24px 26px;
        background: transparent;
    }

    #form_detail .neo-detail-grid {
        display: grid;
        grid-template-columns: 260px minmax(0, 1fr) minmax(0, 1.22fr);
        gap: 22px;
        align-items: stretch;
    }

    #form_detail .neo-section {
        height: 100%;
        border-radius: 24px;
        padding: 20px;
        background: var(--neo-modal-surface);
        box-shadow:
            10px 10px 22px var(--neo-modal-shadow-dark),
            -10px -10px 22px var(--neo-modal-shadow-light);
    }

    #form_detail .neo-section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0 0 18px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--neo-modal-border);
        color: var(--neo-modal-text);
        font-size: 0.95rem;
        line-height: 1.3;
        font-weight: 850;
    }

    #form_detail .neo-section-title i {
        color: var(--neo-modal-primary);
        font-size: 1rem;
    }

    #form_detail .neo-photo-section {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    #form_detail #detail_foto_section {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    #form_detail .neo-photo-frame {
        width: 170px;
        height: 170px;
        border-radius: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--neo-modal-surface);
        box-shadow:
            inset 6px 6px 13px rgba(163, 177, 198, 0.26),
            inset -6px -6px 13px rgba(255, 255, 255, 0.92);
    }

    #form_detail .neo-photo-inner {
        width: 140px;
        height: 140px;
        border-radius: 28px;
        overflow: hidden;
        background: var(--neo-modal-surface-soft);
        box-shadow:
            7px 7px 16px rgba(163, 177, 198, 0.32),
            -7px -7px 16px rgba(255, 255, 255, 0.92);
    }

    #form_detail #detail_foto_preview {
        width: 140px !important;
        height: 140px !important;
        object-fit: cover;
        border-radius: 28px !important;
        display: block;
    }

    #form_detail .neo-detail-field {
        margin-bottom: 16px;
    }

    #form_detail .neo-detail-field:last-child {
        margin-bottom: 0;
    }

    #form_detail .neo-detail-label {
        display: flex;
        align-items: center;
        gap: 7px;
        margin: 0 0 8px;
        color: var(--neo-modal-muted);
        font-size: 0.8rem;
        line-height: 1.35;
        font-weight: 850;
        letter-spacing: .035em;
        text-transform: uppercase;
    }

    #form_detail .neo-detail-label i {
        color: var(--neo-modal-primary);
        font-size: 0.9rem;
    }

    #form_detail .neo-detail-value {
        min-height: 44px;
        margin: 0;
        padding: 12px 14px;
        border-radius: 16px;
        color: var(--neo-modal-text);
        background: var(--neo-modal-surface);
        box-shadow:
            inset 5px 5px 10px rgba(163, 177, 198, 0.25),
            inset -5px -5px 10px rgba(255, 255, 255, 0.92);
        font-size: 0.9rem;
        line-height: 1.5;
        font-weight: 650;
        word-break: break-word;
    }

    #form_detail .neo-detail-value:empty::before {
        content: "-";
        color: var(--neo-modal-muted);
        font-weight: 600;
    }

    #form_detail .neo-detail-value.long-text {
        min-height: 112px;
        white-space: pre-line;
    }

    #form_detail .neo-status-value {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 38px;
        padding: 10px 14px;
        border-radius: 999px;
        color: var(--neo-modal-text);
        background: var(--neo-modal-surface);
        box-shadow:
            inset 5px 5px 10px rgba(163, 177, 198, 0.25),
            inset -5px -5px 10px rgba(255, 255, 255, 0.92);
        font-size: 0.86rem;
        line-height: 1.3;
        font-weight: 800;
        word-break: break-word;
    }

    #form_detail .neo-status-value:empty::before {
        content: "-";
        color: var(--neo-modal-muted);
    }

    #form_detail .neo-metric-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
        margin-top: 16px;
    }

    #form_detail .neo-metric-card {
        min-height: 94px;
        border-radius: 20px;
        padding: 15px;
        background: var(--neo-modal-surface);
        box-shadow:
            7px 7px 16px rgba(163, 177, 198, 0.34),
            -7px -7px 16px rgba(255, 255, 255, 0.92);
    }

    #form_detail .neo-metric-label {
        display: flex;
        align-items: center;
        gap: 7px;
        margin: 0 0 10px;
        color: var(--neo-modal-muted);
        font-size: 0.76rem;
        line-height: 1.3;
        font-weight: 850;
        letter-spacing: .035em;
        text-transform: uppercase;
    }

    #form_detail .neo-metric-label i {
        color: var(--neo-modal-primary);
    }

    #form_detail .neo-metric-value {
        margin: 0;
        color: var(--neo-modal-text);
        font-size: 1.15rem;
        line-height: 1.2;
        font-weight: 850;
        word-break: break-word;
    }

    #form_detail .neo-metric-value:empty::before {
        content: "-";
        color: var(--neo-modal-muted);
    }

    #form_detail .neo-last-login {
        margin-top: 14px;
    }

    #form_detail .modal-footer {
        gap: 12px;
        padding: 18px 26px 24px;
        border-top: 1px solid var(--neo-modal-border);
        background: transparent;
    }

    #form_detail .neo-btn {
        min-height: 42px;
        min-width: 104px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 16px;
        border: 0;
        border-radius: 16px;
        font-size: 0.88rem;
        line-height: 1;
        font-weight: 850;
        transition: .18s ease;
    }

    #form_detail .neo-btn-light {
        color: var(--neo-modal-muted);
        background: var(--neo-modal-surface);
        box-shadow:
            7px 7px 16px rgba(163, 177, 198, 0.36),
            -7px -7px 16px rgba(255, 255, 255, 0.92);
    }

    #form_detail .neo-btn-light:hover {
        color: var(--neo-modal-text);
        transform: translateY(-1px);
    }

    #form_detail .neo-btn:active {
        transform: translateY(0);
    }

    @media (max-width: 1199.98px) {
        #form_detail .modal-dialog {
            max-width: calc(100vw - 40px);
        }

        #form_detail .neo-detail-grid {
            grid-template-columns: 240px minmax(0, 1fr) minmax(0, 1fr);
            gap: 18px;
        }
    }

    @media (max-width: 991.98px) {
        #form_detail .modal-dialog {
            max-width: calc(100vw - 32px);
            margin: 1.25rem auto;
        }

        #form_detail .modal-header {
            padding: 22px 22px 16px;
        }

        #form_detail .modal-body {
            padding: 22px;
        }

        #form_detail .modal-footer {
            padding: 16px 22px 22px;
        }

        #form_detail .neo-detail-grid {
            grid-template-columns: 1fr 1fr;
        }

        #form_detail .neo-photo-section {
            grid-column: 1 / -1;
        }
    }

    @media (max-width: 767.98px) {
        #form_detail .modal-dialog {
            max-width: calc(100vw - 24px);
            margin: 0.75rem auto;
        }

        #form_detail .modal-content {
            border-radius: 24px;
        }

        #form_detail .modal-header {
            align-items: flex-start;
            padding: 20px 18px 15px;
        }

        #form_detail .neo-modal-title-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            border-radius: 15px;
            font-size: 1.08rem;
        }

        #form_detail .modal-title {
            font-size: 1.05rem;
        }

        #form_detail .neo-modal-subtitle {
            font-size: 0.82rem;
        }

        #form_detail .neo-btn-close {
            width: 38px;
            height: 38px;
            min-width: 38px;
            border-radius: 13px;
        }

        #form_detail .modal-body {
            padding: 18px;
        }

        #form_detail .neo-detail-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        #form_detail .neo-section {
            border-radius: 22px;
            padding: 18px;
        }

        #form_detail .modal-footer {
            padding: 15px 18px 18px;
        }
    }

    @media (max-width: 575.98px) {
        #form_detail .modal-dialog {
            max-width: calc(100vw - 16px);
            margin: 0.5rem auto;
        }

        #form_detail .modal-content {
            border-radius: 22px;
        }

        #form_detail .modal-header {
            padding: 18px 16px 14px;
        }

        #form_detail .modal-body {
            padding: 16px;
        }

        #form_detail .neo-section {
            padding: 16px;
            border-radius: 20px;
        }

        #form_detail .neo-photo-frame {
            width: 154px;
            height: 154px;
            border-radius: 30px;
        }

        #form_detail .neo-photo-inner,
        #form_detail #detail_foto_preview {
            width: 126px !important;
            height: 126px !important;
            border-radius: 24px !important;
        }

        #form_detail .neo-metric-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        #form_detail .modal-footer {
            flex-direction: column-reverse;
            align-items: stretch;
            padding: 14px 16px 16px;
        }

        #form_detail .neo-btn {
            width: 100%;
        }
    }
</style>

<div class="modal fade"
     id="form_detail"
     data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1"
     role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="neo-modal-title-wrap">
                    <span class="neo-modal-title-icon">
                        <i class="bi bi-person-lines-fill"></i>
                    </span>
                    <div>
                        <h5 class="modal-title">Detail Pengguna</h5>
                        <p class="neo-modal-subtitle">Informasi lengkap data pengguna</p>
                    </div>
                </div>

                <button type="button"
                        class="neo-btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="neo-detail-grid">

                    <div class="neo-section neo-photo-section">
                        <h6 class="neo-section-title">
                            <i class="bi bi-image-fill"></i>
                            Foto Profil
                        </h6>

                        <div id="detail_foto_section">
                            <div class="neo-photo-frame">
                                <div class="neo-photo-inner">
                                    <img id="detail_foto_preview"
                                         alt="Foto Pengguna"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="neo-section">
                        <h6 class="neo-section-title">
                            <i class="bi bi-person-vcard-fill"></i>
                            Data Dasar
                        </h6>

                        <div class="neo-detail-field">
                            <label class="neo-detail-label">
                                <i class="bi bi-person-fill"></i>
                                Nama
                            </label>
                            <p id="detail_nama" class="neo-detail-value"></p>
                        </div>

                        <div class="neo-detail-field">
                            <label class="neo-detail-label">
                                <i class="bi bi-envelope-fill"></i>
                                Email
                            </label>
                            <p id="detail_email" class="neo-detail-value"></p>
                        </div>

                        <div class="neo-detail-field">
                            <label class="neo-detail-label">
                                <i class="bi bi-telephone-fill"></i>
                                Telepon
                            </label>
                            <p id="detail_telepon" class="neo-detail-value"></p>
                        </div>

                        <div class="neo-detail-field">
                            <label class="neo-detail-label">
                                <i class="bi bi-patch-check-fill"></i>
                                Terverifikasi
                            </label>
                            <p id="detail_terverifikasi" class="neo-status-value"></p>
                        </div>
                    </div>

                    <div class="neo-section">
                        <h6 class="neo-section-title">
                            <i class="bi bi-info-circle-fill"></i>
                            Informasi Tambahan
                        </h6>

                        <div class="neo-detail-field">
                            <label class="neo-detail-label">
                                <i class="bi bi-card-text"></i>
                                Bio
                            </label>
                            <p id="detail_bio" class="neo-detail-value long-text"></p>
                        </div>

                        <div class="neo-metric-grid">
                            <div class="neo-metric-card">
                                <p class="neo-metric-label">
                                    <i class="bi bi-mortarboard-fill"></i>
                                    Kelas Selesai
                                </p>
                                <p id="detail_total_kelas_selesai" class="neo-metric-value"></p>
                            </div>

                            <div class="neo-metric-card">
                                <p class="neo-metric-label">
                                    <i class="bi bi-stars"></i>
                                    Total Poin
                                </p>
                                <p id="detail_total_poin" class="neo-metric-value"></p>
                            </div>
                        </div>

                        <div class="neo-detail-field neo-last-login">
                            <label class="neo-detail-label">
                                <i class="bi bi-clock-history"></i>
                                Terakhir Login
                            </label>
                            <p id="detail_last_login" class="neo-detail-value"></p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button"
                        class="neo-btn neo-btn-light"
                        data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i>
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>