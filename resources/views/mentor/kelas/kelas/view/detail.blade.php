<style>
    #form_detail {
        --modal-primary: #074366;
        --modal-blue: #3b82f6;
        --modal-red: #ef4444;
        --modal-green: #10b981;
        --modal-purple: #8b5cf6;
        --modal-text: #111827;
        --modal-muted: #64748b;
        --modal-border: #eef2f7;
        --modal-soft: #f8fafc;
        --modal-white: #ffffff;
    }

    #form_detail .modal-dialog {
        max-width: 1120px;
        margin: 1.5rem auto;
    }

    #form_detail .modal-content {
        overflow: hidden;
        border: 0 !important;
        border-radius: 14px !important;
        background: var(--modal-white) !important;
        box-shadow: 0 18px 45px rgba(15, 23, 42, .16) !important;
    }

    #form_detail .modal-header {
        min-height: auto;
        padding: 18px 22px;
        background: var(--modal-white) !important;
        border-bottom: 1px solid var(--modal-border) !important;
    }

    #form_detail .neo-modal-title-wrap {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    #form_detail .neo-modal-title-icon {
        width: 42px;
        height: 42px;
        min-width: 42px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        background: var(--modal-primary);
        font-size: 1.05rem;
    }

    #form_detail .modal-title {
        margin: 0;
        color: var(--modal-text);
        font-size: 1.08rem;
        line-height: 1.25;
        font-weight: 800;
    }

    #form_detail .neo-modal-subtitle {
        margin: 4px 0 0;
        color: var(--modal-muted);
        font-size: .84rem;
        line-height: 1.4;
        font-weight: 500;
    }

    #form_detail .neo-btn-close {
        width: 36px;
        height: 36px;
        min-width: 36px;
        padding: 0;
        border: 0 !important;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--modal-muted);
        background: transparent !important;
        box-shadow: none !important;
        opacity: 1;
        transition: .16s ease;
    }

    #form_detail .neo-btn-close:hover {
        color: var(--modal-red);
        background: #fef2f2 !important;
    }

    #form_detail .neo-btn-close i {
        font-size: 1.1rem;
        line-height: 1;
    }

    #form_detail .modal-body {
        padding: 22px;
        background: #f8fafc !important;
    }

    #form_detail .neo-detail-layout {
        display: grid;
        grid-template-columns: minmax(0, 1.25fr) minmax(330px, .75fr);
        gap: 18px;
        align-items: start;
    }

    #form_detail .neo-left-stack,
    #form_detail .neo-right-stack {
        display: flex;
        flex-direction: column;
        gap: 18px;
        min-width: 0;
    }

    #form_detail .neo-section {
        border: 1px solid var(--modal-border);
        border-radius: 12px;
        padding: 18px;
        background: var(--modal-white);
        box-shadow: 0 6px 18px rgba(15, 23, 42, .04);
    }

    #form_detail .neo-section-title {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0 0 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--modal-border);
        color: var(--modal-text);
        font-size: .95rem;
        line-height: 1.3;
        font-weight: 800;
    }

    #form_detail .neo-section-title i {
        color: var(--modal-primary);
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
        gap: 6px;
        margin: 0 0 7px;
        color: var(--modal-muted);
        font-size: .74rem;
        line-height: 1.35;
        font-weight: 800;
        letter-spacing: .04em;
        text-transform: uppercase;
    }

    #form_detail .neo-info-label i {
        color: var(--modal-blue);
        font-size: .85rem;
    }

    #form_detail .neo-info-value,
    #form_detail .neo-text-box,
    #form_detail .neo-video-link {
        margin: 0;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        color: var(--modal-text);
        background: var(--modal-soft);
        box-shadow: none !important;
        font-size: .9rem;
        line-height: 1.55;
        font-weight: 600;
        word-break: break-word;
    }

    #form_detail .neo-info-value {
        min-height: 42px;
        padding: 11px 13px;
    }

    #form_detail .neo-info-value:empty::before,
    #form_detail .neo-text-box:empty::before {
        content: "-";
        color: var(--modal-muted);
        font-weight: 600;
    }

    #form_detail .neo-text-box {
        min-height: 112px;
        padding: 13px;
        white-space: pre-line;
    }

    #form_detail #detail_deskripsi_lengkap {
        min-height: 165px;
        overflow: auto;
    }

    #form_detail #detail_deskripsi_lengkap p:last-child {
        margin-bottom: 0;
    }

    #form_detail .neo-video-link {
        min-height: 42px;
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 11px 13px;
        color: var(--modal-blue) !important;
        text-decoration: none !important;
    }

    #form_detail .neo-video-link:hover {
        color: var(--modal-primary) !important;
        border-color: #bfdbfe;
        background: #eff6ff;
    }

    #form_detail .neo-video-link:empty::before {
        content: "Belum ada video intro.";
        color: var(--modal-muted);
        font-weight: 600;
    }

    #form_detail .neo-video-link:empty i {
        display: none;
    }

    #form_detail .neo-media-box {
        display: flex;
        flex-direction: column;
        align-items: stretch;
        gap: 16px;
    }

    #form_detail .neo-banner-frame,
    #form_detail .neo-certificate-box {
        width: 100%;
        border: 1px solid var(--modal-border);
        border-radius: 12px;
        padding: 14px;
        background: var(--modal-soft);
        box-shadow: none !important;
        text-align: center;
    }

    #form_detail .neo-banner-title,
    #form_detail .neo-certificate-title {
        display: block;
        margin: 0 0 12px;
        color: var(--modal-text);
        font-size: .86rem;
        font-weight: 800;
        text-align: center;
    }

    #form_detail #detail_banner_preview {
        width: 100%;
        max-height: 170px;
        object-fit: cover;
        border: 1px solid #e5e7eb !important;
        border-radius: 10px !important;
        background: #ffffff;
        box-shadow: none !important;
    }

    #form_detail .neo-certificate-btn {
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border: 0 !important;
        border-radius: 8px !important;
        padding: 10px 14px !important;
        color: #ffffff !important;
        background: var(--modal-purple) !important;
        font-size: .84rem;
        font-weight: 800;
        box-shadow: 0 6px 14px rgba(139, 92, 246, .18) !important;
        text-decoration: none !important;
    }

    #form_detail .neo-certificate-btn:hover {
        color: #ffffff !important;
        background: #7c3aed !important;
    }

    #form_detail #detail_sertifikat_name {
        margin-top: 10px !important;
        color: var(--modal-muted) !important;
        font-size: .8rem !important;
        line-height: 1.45;
        font-weight: 600;
        word-break: break-word;
    }

    #form_detail #detail_sertifikat_none {
        display: inline-flex;
        justify-content: center;
        width: 100%;
        color: var(--modal-muted) !important;
        font-size: .86rem !important;
        line-height: 1.45;
        font-weight: 600;
    }

    #form_detail .modal-footer {
        gap: 10px;
        padding: 16px 22px;
        border-top: 1px solid var(--modal-border) !important;
        background: var(--modal-white) !important;
    }

    #form_detail .neo-btn {
        min-height: 40px;
        min-width: 100px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 16px;
        border: 0 !important;
        border-radius: 8px;
        font-size: .86rem;
        line-height: 1;
        font-weight: 800;
        transition: .16s ease;
    }

    #form_detail .neo-btn-light {
        color: #ffffff !important;
        background: var(--modal-red) !important;
        box-shadow: 0 6px 14px rgba(239, 68, 68, .18) !important;
    }

    #form_detail .neo-btn-light:hover {
        color: #ffffff !important;
        background: #dc2626 !important;
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

        #form_detail .modal-header,
        #form_detail .modal-body,
        #form_detail .modal-footer {
            padding-left: 18px;
            padding-right: 18px;
        }
    }

    @media (max-width: 767.98px) {
        #form_detail .modal-dialog {
            max-width: calc(100vw - 24px);
            margin: .75rem auto;
        }

        #form_detail .modal-content {
            border-radius: 12px !important;
        }

        #form_detail .modal-header {
            align-items: flex-start;
            padding-top: 16px;
            padding-bottom: 14px;
        }

        #form_detail .neo-modal-title-icon {
            width: 38px;
            height: 38px;
            min-width: 38px;
            border-radius: 9px;
        }

        #form_detail .modal-title {
            font-size: 1rem;
        }

        #form_detail .neo-modal-subtitle {
            font-size: .8rem;
        }

        #form_detail .modal-body {
            padding-top: 18px;
            padding-bottom: 18px;
        }

        #form_detail .neo-left-stack,
        #form_detail .neo-right-stack {
            gap: 14px;
        }

        #form_detail .neo-section {
            padding: 15px;
        }

        #form_detail .neo-info-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 575.98px) {
        #form_detail .modal-dialog {
            max-width: calc(100vw - 16px);
            margin: .5rem auto;
        }

        #form_detail .modal-header,
        #form_detail .modal-body,
        #form_detail .modal-footer {
            padding-left: 14px;
            padding-right: 14px;
        }

        #form_detail .modal-footer {
            flex-direction: column-reverse;
            align-items: stretch;
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