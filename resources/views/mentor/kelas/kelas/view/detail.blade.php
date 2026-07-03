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
        --neo-modal-primary-dark: #2563eb;
        --neo-modal-danger: #ef4444;
        --neo-modal-warning: #f59e0b;
    }

    #form_detail .modal-dialog {
        max-width: 1180px;
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

    #form_detail .neo-detail-layout {
        display: grid;
        grid-template-columns: minmax(0, 1.25fr) minmax(360px, 0.75fr);
        gap: 22px;
        align-items: start;
    }

    #form_detail .neo-left-stack,
    #form_detail .neo-right-stack {
        display: flex;
        flex-direction: column;
        gap: 22px;
        min-width: 0;
    }

    #form_detail .neo-section {
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

    #form_detail .neo-info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    #form_detail .neo-info-field {
        min-width: 0;
    }

    #form_detail .neo-info-field.full {
        grid-column: 1 / -1;
    }

    #form_detail .neo-info-label {
        display: flex;
        align-items: center;
        gap: 7px;
        margin: 0 0 8px;
        color: var(--neo-modal-muted);
        font-size: 0.78rem;
        line-height: 1.35;
        font-weight: 850;
        letter-spacing: .035em;
        text-transform: uppercase;
    }

    #form_detail .neo-info-label i {
        color: var(--neo-modal-primary);
        font-size: 0.9rem;
    }

    #form_detail .neo-info-value {
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

    #form_detail .neo-info-value:empty::before {
        content: "-";
        color: var(--neo-modal-muted);
        font-weight: 600;
    }

    #form_detail .neo-text-box {
        min-height: 126px;
        margin: 0;
        padding: 14px;
        border-radius: 16px;
        color: var(--neo-modal-text);
        background: var(--neo-modal-surface);
        box-shadow:
            inset 5px 5px 10px rgba(163, 177, 198, 0.25),
            inset -5px -5px 10px rgba(255, 255, 255, 0.92);
        font-size: 0.9rem;
        line-height: 1.65;
        font-weight: 600;
        word-break: break-word;
        white-space: pre-line;
    }

    #form_detail .neo-text-box:empty::before {
        content: "-";
        color: var(--neo-modal-muted);
        font-weight: 600;
    }

    #form_detail #detail_deskripsi_lengkap {
        min-height: 180px;
        overflow: auto;
    }

    #form_detail #detail_deskripsi_lengkap p:last-child {
        margin-bottom: 0;
    }

    #form_detail .neo-video-link {
        min-height: 44px;
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 12px 14px;
        border-radius: 16px;
        color: var(--neo-modal-primary) !important;
        background: var(--neo-modal-surface);
        box-shadow:
            inset 5px 5px 10px rgba(163, 177, 198, 0.25),
            inset -5px -5px 10px rgba(255, 255, 255, 0.92);
        font-size: 0.9rem;
        line-height: 1.45;
        font-weight: 800;
        text-decoration: none !important;
        word-break: break-word;
    }

    #form_detail .neo-video-link:hover {
        color: var(--neo-modal-primary-dark) !important;
    }

    #form_detail .neo-video-link:empty::before {
        content: "Belum ada video intro.";
        color: var(--neo-modal-muted);
        font-weight: 600;
    }

    #form_detail .neo-video-link:empty i {
        display: none;
    }

    #form_detail .neo-media-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 18px;
    }

    #form_detail .neo-banner-frame {
        width: 100%;
        max-width: 360px;
        min-height: 190px;
        border-radius: 24px;
        padding: 14px;
        background: var(--neo-modal-surface);
        box-shadow:
            inset 6px 6px 13px rgba(163, 177, 198, 0.26),
            inset -6px -6px 13px rgba(255, 255, 255, 0.92);
    }

    #form_detail .neo-banner-title {
        display: block;
        margin: 0 0 12px;
        color: var(--neo-modal-text);
        font-size: 0.88rem;
        font-weight: 850;
        text-align: center;
    }

    #form_detail #detail_banner_preview {
        width: 100%;
        max-height: 150px;
        object-fit: cover;
        border: 0 !important;
        border-radius: 18px !important;
        background: var(--neo-modal-surface-soft);
        box-shadow:
            7px 7px 16px rgba(163, 177, 198, 0.32),
            -7px -7px 16px rgba(255, 255, 255, 0.92);
    }

    #form_detail .neo-certificate-box {
        width: 100%;
        max-width: 360px;
        border-radius: 22px;
        padding: 18px;
        background: var(--neo-modal-surface);
        box-shadow:
            8px 8px 18px rgba(163, 177, 198, 0.34),
            -8px -8px 18px rgba(255, 255, 255, 0.92);
        text-align: center;
    }

    #form_detail .neo-certificate-title {
        display: block;
        margin: 0 0 12px;
        color: var(--neo-modal-text);
        font-size: 0.88rem;
        font-weight: 850;
        text-align: center;
    }

    #form_detail .neo-certificate-btn {
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border: 0 !important;
        border-radius: 15px !important;
        padding: 10px 14px !important;
        color: #ffffff !important;
        background: var(--neo-modal-primary) !important;
        font-size: 0.84rem;
        font-weight: 850;
        box-shadow:
            6px 6px 14px rgba(163, 177, 198, 0.36),
            -6px -6px 14px rgba(255, 255, 255, 0.92);
        text-decoration: none !important;
    }

    #form_detail .neo-certificate-btn:hover {
        background: var(--neo-modal-primary-dark) !important;
    }

    #form_detail #detail_sertifikat_name {
        margin-top: 10px !important;
        color: var(--neo-modal-muted) !important;
        font-size: 0.8rem !important;
        line-height: 1.45;
        font-weight: 650;
        word-break: break-word;
    }

    #form_detail #detail_sertifikat_none {
        display: inline-flex;
        justify-content: center;
        width: 100%;
        color: var(--neo-modal-muted) !important;
        font-size: 0.86rem !important;
        line-height: 1.45;
        font-weight: 650;
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

        #form_detail .neo-detail-layout {
            grid-template-columns: minmax(0, 1fr);
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

        #form_detail .neo-left-stack,
        #form_detail .neo-right-stack {
            gap: 16px;
        }

        #form_detail .neo-section {
            border-radius: 22px;
            padding: 18px;
        }

        #form_detail .neo-info-grid {
            grid-template-columns: 1fr;
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

        #form_detail .neo-banner-frame,
        #form_detail .neo-certificate-box {
            max-width: 100%;
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
                        <i class="bi bi-journal-text"></i>
                    </span>
                    <div>
                        <h5 class="modal-title">Detail Kelas</h5>
                        <p class="neo-modal-subtitle">Informasi lengkap kelas</p>
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
                <div class="neo-detail-layout">

                    <div class="neo-left-stack">
                        <div class="neo-section">
                            <h6 class="neo-section-title">
                                <i class="bi bi-clipboard-data-fill"></i>
                                Informasi Utama
                            </h6>

                            <div class="neo-info-grid">
                                <div class="neo-info-field full">
                                    <label class="neo-info-label">
                                        <i class="bi bi-type"></i>
                                        Judul
                                    </label>
                                    <p id="detail_judul" class="neo-info-value"></p>
                                </div>

                                <div class="neo-info-field full">
                                    <label class="neo-info-label">
                                        <i class="bi bi-link-45deg"></i>
                                        Slug
                                    </label>
                                    <p id="detail_slug" class="neo-info-value"></p>
                                </div>

                                <div class="neo-info-field">
                                    <label class="neo-info-label">
                                        <i class="bi bi-folder-fill"></i>
                                        Kategori
                                    </label>
                                    <p id="detail_kategori_nama" class="neo-info-value"></p>
                                </div>

                                <div class="neo-info-field">
                                    <label class="neo-info-label">
                                        <i class="bi bi-diagram-3-fill"></i>
                                        Sub Kategori
                                    </label>
                                    <p id="detail_kategori_sub_nama" class="neo-info-value"></p>
                                </div>

                                <div class="neo-info-field">
                                    <label class="neo-info-label">
                                        <i class="bi bi-person-badge-fill"></i>
                                        Pemilik Mentor
                                    </label>
                                    <p id="detail_pemilik" class="neo-info-value"></p>
                                </div>

                                <div class="neo-info-field">
                                    <label class="neo-info-label">
                                        <i class="bi bi-bar-chart-fill"></i>
                                        Tingkat
                                    </label>
                                    <p id="detail_tingkat" class="neo-info-value"></p>
                                </div>

                                <div class="neo-info-field">
                                    <label class="neo-info-label">
                                        <i class="bi bi-translate"></i>
                                        Bahasa
                                    </label>
                                    <p id="detail_bahasa" class="neo-info-value"></p>
                                </div>

                                <div class="neo-info-field">
                                    <label class="neo-info-label">
                                        <i class="bi bi-check2-circle"></i>
                                        Nilai Kelulusan
                                    </label>
                                    <p id="detail_nilai_lulus" class="neo-info-value"></p>
                                </div>

                                <div class="neo-info-field full">
                                    <label class="neo-info-label">
                                        <i class="bi bi-toggle-on"></i>
                                        Status
                                    </label>
                                    <p id="detail_status" class="neo-info-value"></p>
                                </div>
                            </div>
                        </div>

                        <div class="neo-section">
                            <h6 class="neo-section-title">
                                <i class="bi bi-card-text"></i>
                                Deskripsi Singkat
                            </h6>

                            <p id="detail_deskripsi_singkat" class="neo-text-box"></p>
                        </div>

                        <div class="neo-section">
                            <h6 class="neo-section-title">
                                <i class="bi bi-file-text-fill"></i>
                                Deskripsi Lengkap
                            </h6>

                            <div id="detail_deskripsi_lengkap" class="neo-text-box"></div>
                        </div>
                    </div>

                    <div class="neo-right-stack">
                        <div class="neo-section">
                            <h6 class="neo-section-title">
                                <i class="bi bi-play-circle-fill"></i>
                                Video Intro
                            </h6>

                            <a href="#"
                               target="_blank"
                               id="detail_video_intro_url"
                               class="neo-video-link">
                                <i class="bi bi-box-arrow-up-right"></i>
                            </a>
                        </div>

                        <div class="neo-section">
                            <h6 class="neo-section-title">
                                <i class="bi bi-image-fill"></i>
                                Media
                            </h6>

                            <div class="neo-media-box">
                                <div class="neo-banner-frame">
                                    <span class="neo-banner-title">Banner</span>
                                    <img id="detail_banner_preview"
                                         src=""
                                         alt="Banner">
                                </div>

                                <div class="neo-certificate-box">
                                    <span class="neo-certificate-title">Template Sertifikat</span>

                                    <a href="#"
                                       target="_blank"
                                       id="detail_sertifikat_link"
                                       class="neo-certificate-btn d-none">
                                        <i class="bi bi-download"></i>
                                        Download Template Sertifikat
                                    </a>

                                    <div id="detail_sertifikat_name" class="d-none"></div>

                                    <span id="detail_sertifikat_none">
                                        Belum ada template sertifikat.
                                    </span>
                                </div>
                            </div>
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