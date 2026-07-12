<style>
    /* =========================================================
       DETAIL KELAS
       Tampilan flat, sederhana, dan konsisten
       Visual only
    ========================================================= */

    #form_detail {
        --modal-primary: #074366;
        --modal-primary-dark: #052f49;
        --modal-danger: #ef4444;
        --modal-text: #111827;
        --modal-muted: #64748b;
        --modal-border: #e5e7eb;
        --modal-soft: #f8fafc;
        --modal-white: #ffffff;
    }

    #form_detail .modal-dialog {
        width: calc(100% - 48px);
        max-width: 1050px;
        margin: 24px auto;
    }

    #form_detail .modal-content {
        width: 100%;
        overflow: hidden;
        color: var(--modal-text);
        background: var(--modal-white);
        border: 0;
        border-radius: 12px;
        box-shadow: 0 18px 45px rgba(15, 23, 42, .16);
    }

    /* Header */
    #form_detail .modal-header {
        min-height: auto;
        padding: 16px 20px;
        background: var(--modal-white);
        border-bottom: 1px solid #eef2f7;
    }

    #form_detail .neo-modal-title-wrap {
        min-width: 0;
    }

    #form_detail .neo-modal-title-icon,
    #form_detail .neo-modal-subtitle {
        display: none;
    }

    #form_detail .modal-title {
        margin: 0;
        color: var(--modal-text);
        font-size: 18px;
        line-height: 1.4;
        font-weight: 800;
        letter-spacing: normal;
    }

    #form_detail .neo-btn-close {
        width: 32px;
        height: 32px;
        min-width: 32px;
        margin: 0;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--modal-muted);
        background: transparent;
        border: 0;
        border-radius: 0;
        box-shadow: none;
        opacity: .78;
        transition: color .18s ease, opacity .18s ease;
    }

    #form_detail .neo-btn-close:hover {
        color: var(--modal-danger);
        background: transparent;
        opacity: 1;
        transform: none;
    }

    #form_detail .neo-btn-close:focus {
        outline: none;
        box-shadow: none;
    }

    #form_detail .neo-btn-close i {
        font-size: 18px;
        line-height: 1;
    }

    /* Body dan layout */
    #form_detail .modal-body {
        padding: 22px;
        background: var(--modal-white);
    }

    #form_detail .neo-detail-layout {
        display: grid;
        grid-template-columns: minmax(0, 1.45fr) minmax(320px, .75fr);
        gap: 24px;
        align-items: start;
    }

    #form_detail .neo-left-stack,
    #form_detail .neo-right-stack {
        display: flex;
        flex-direction: column;
        gap: 24px;
        min-width: 0;
    }

    #form_detail .neo-section {
        padding: 0;
        background: transparent;
        border: 0;
        border-radius: 0;
        box-shadow: none;
    }

    #form_detail .neo-section-title {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0 0 18px;
        padding: 0 0 10px;
        color: var(--modal-text);
        font-size: 14px;
        line-height: 1.4;
        font-weight: 800;
        background: transparent;
        border: 0;
        border-bottom: 1px solid var(--modal-border);
        border-radius: 0;
        box-shadow: none;
    }

    #form_detail .neo-section-title i {
        color: var(--modal-primary);
        font-size: 15px;
    }

    /* Informasi utama */
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
        color: var(--modal-text);
        font-size: 13px;
        line-height: 1.4;
        font-weight: 800;
        letter-spacing: normal;
        text-transform: none;
    }

    #form_detail .neo-info-label i {
        color: var(--modal-primary);
        font-size: 14px;
    }

    #form_detail .neo-info-value {
        min-height: 42px;
        margin: 0;
        padding: 10px 12px;
        color: var(--modal-text);
        background: var(--modal-soft);
        border: 1px solid var(--modal-border);
        border-radius: 8px;
        box-shadow: none;
        font-size: 14px;
        line-height: 1.5;
        font-weight: 600;
        word-break: break-word;
    }

    #form_detail .neo-info-value:empty::before {
        content: "-";
        color: #94a3b8;
        font-weight: 600;
    }

    /* Deskripsi */
    #form_detail .neo-text-box {
        min-height: 120px;
        margin: 0;
        padding: 12px;
        color: var(--modal-text);
        background: var(--modal-soft);
        border: 1px solid var(--modal-border);
        border-radius: 8px;
        box-shadow: none;
        font-size: 14px;
        line-height: 1.65;
        font-weight: 500;
        word-break: break-word;
        white-space: pre-line;
    }

    #form_detail .neo-text-box:empty::before {
        content: "-";
        color: #94a3b8;
        font-weight: 600;
    }

    #form_detail #detail_deskripsi_lengkap {
        min-height: 180px;
        overflow: auto;
    }

    #form_detail #detail_deskripsi_lengkap p:last-child {
        margin-bottom: 0;
    }

    /* Video */
    #form_detail .neo-video-link {
        min-height: 42px;
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 12px;
        color: var(--modal-primary) !important;
        background: var(--modal-soft);
        border: 1px solid var(--modal-border);
        border-radius: 8px;
        box-shadow: none;
        font-size: 14px;
        line-height: 1.5;
        font-weight: 700;
        text-decoration: none !important;
        word-break: break-word;
    }

    #form_detail .neo-video-link:hover {
        color: var(--modal-primary-dark) !important;
        border-color: #cbd5e1;
    }

    #form_detail .neo-video-link:empty::before {
        content: "Belum ada video intro.";
        color: var(--modal-muted);
        font-weight: 600;
    }

    #form_detail .neo-video-link:empty i {
        display: none;
    }

    /* Media */
    #form_detail .neo-media-box {
        display: flex;
        flex-direction: column;
        align-items: stretch;
        gap: 16px;
    }

    #form_detail .neo-banner-frame,
    #form_detail .neo-certificate-box {
        width: 100%;
        max-width: none;
        padding: 14px;
        background: var(--modal-soft);
        border: 1px solid var(--modal-border);
        border-radius: 8px;
        box-shadow: none;
    }

    #form_detail .neo-banner-title,
    #form_detail .neo-certificate-title {
        display: block;
        margin: 0 0 10px;
        color: var(--modal-text);
        font-size: 13px;
        line-height: 1.4;
        font-weight: 800;
        text-align: left;
    }

    #form_detail #detail_banner_preview {
        width: 100%;
        max-height: 180px;
        object-fit: cover;
        background: #f1f5f9;
        border: 1px solid var(--modal-border) !important;
        border-radius: 8px !important;
        box-shadow: none !important;
    }

    #form_detail .neo-certificate-box {
        text-align: left;
    }

    #form_detail .neo-certificate-btn {
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 9px 13px !important;
        color: #ffffff !important;
        background: var(--modal-primary) !important;
        border: 1px solid var(--modal-primary) !important;
        border-radius: 8px !important;
        box-shadow: none;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none !important;
    }

    #form_detail .neo-certificate-btn:hover {
        background: var(--modal-primary-dark) !important;
        border-color: var(--modal-primary-dark) !important;
    }

    #form_detail #detail_sertifikat_name {
        margin-top: 10px !important;
        color: var(--modal-muted) !important;
        font-size: 12px !important;
        line-height: 1.5;
        font-weight: 600;
        word-break: break-word;
    }

    #form_detail #detail_sertifikat_none {
        display: inline-flex;
        justify-content: flex-start;
        width: 100%;
        color: var(--modal-muted) !important;
        font-size: 13px !important;
        line-height: 1.5;
        font-weight: 600;
    }

    /* Footer disembunyikan karena sudah ada tombol X */
    #form_detail .modal-footer {
        display: none !important;
    }

    /* Responsive */
    @media (max-width: 1199.98px) {
        #form_detail .modal-dialog {
            width: calc(100% - 40px);
        }

        #form_detail .neo-detail-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767.98px) {
        #form_detail .modal-dialog {
            width: calc(100% - 24px);
            margin: 12px auto;
        }

        #form_detail .modal-body {
            padding: 18px;
        }

        #form_detail .neo-left-stack,
        #form_detail .neo-right-stack {
            gap: 20px;
        }

        #form_detail .neo-info-grid {
            grid-template-columns: 1fr;
        }

        #form_detail .neo-info-field.full {
            grid-column: auto;
        }
    }

    @media (max-width: 575.98px) {
        #form_detail .modal-dialog {
            width: calc(100% - 16px);
            margin: 8px auto;
        }

        #form_detail .modal-header {
            padding: 15px 16px;
        }

        #form_detail .modal-title {
            font-size: 16px;
        }

        #form_detail .modal-body {
            padding: 16px;
        }

        #form_detail .neo-banner-frame,
        #form_detail .neo-certificate-box {
            padding: 12px;
        }

        #form_detail .neo-certificate-btn {
            width: 100%;
        }
    }
</style>

<div class="modal fade consistent-modal"
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
