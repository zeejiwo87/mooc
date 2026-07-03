<style>
    #form_create {
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

    #form_create .modal-dialog {
        max-width: 1180px;
        margin: 1.75rem auto;
    }

    #form_create .modal-content {
        border: 0;
        border-radius: 28px;
        background: var(--neo-modal-bg);
        box-shadow:
            18px 18px 40px rgba(15, 23, 42, 0.22),
            -10px -10px 28px rgba(255, 255, 255, 0.8);
        overflow: hidden;
    }

    #form_create .modal-header {
        min-height: auto;
        padding: 24px 26px 18px;
        border-bottom: 1px solid var(--neo-modal-border);
        background: transparent;
    }

    #form_create .neo-modal-title-wrap {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
    }

    #form_create .neo-modal-title-icon {
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

    #form_create .modal-title {
        margin: 0;
        color: var(--neo-modal-text);
        font-size: 1.18rem;
        line-height: 1.25;
        font-weight: 850;
        letter-spacing: -0.02em;
    }

    #form_create .neo-modal-subtitle {
        margin: 5px 0 0;
        color: var(--neo-modal-muted);
        font-size: 0.86rem;
        line-height: 1.4;
        font-weight: 500;
    }

    #form_create .neo-btn-close {
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

    #form_create .neo-btn-close:hover {
        color: var(--neo-modal-danger);
        transform: translateY(-1px);
    }

    #form_create .neo-btn-close i {
        font-size: 1.2rem;
        line-height: 1;
    }

    #form_create .modal-body {
        padding: 24px 26px;
        background: transparent;
    }

    #form_create .neo-form-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.35fr) minmax(360px, 0.85fr);
        gap: 22px;
        align-items: start;
    }

    #form_create .neo-left-stack,
    #form_create .neo-right-stack {
        display: flex;
        flex-direction: column;
        gap: 22px;
        min-width: 0;
    }

    #form_create .neo-section {
        border-radius: 24px;
        padding: 20px;
        background: var(--neo-modal-surface);
        box-shadow:
            10px 10px 22px var(--neo-modal-shadow-dark),
            -10px -10px 22px var(--neo-modal-shadow-light);
    }

    #form_create .neo-section-title {
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

    #form_create .neo-section-title i {
        color: var(--neo-modal-primary);
        font-size: 1rem;
    }

    #form_create .neo-field-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    #form_create .neo-field-grid-3 {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
    }

    #form_create .neo-field {
        display: flex;
        flex-direction: column;
        gap: 7px;
        min-width: 0;
        margin-bottom: 16px;
    }

    #form_create .neo-field:last-child {
        margin-bottom: 0;
    }

    #form_create .neo-field.no-margin {
        margin-bottom: 0;
    }

    #form_create .neo-field.full {
        grid-column: 1 / -1;
    }

    #form_create .neo-label {
        display: flex;
        align-items: center;
        gap: 6px;
        margin: 0;
        color: var(--neo-modal-text);
        font-size: 0.86rem;
        line-height: 1.35;
        font-weight: 800;
    }

    #form_create .neo-label.required::after {
        content: "*";
        color: var(--neo-modal-danger);
        font-weight: 900;
    }

    #form_create .form-control,
    #form_create .form-select,
    #form_create .select2-container--bootstrap5 .select2-selection {
        min-height: 44px;
        border: 0 !important;
        border-radius: 16px !important;
        color: var(--neo-modal-text) !important;
        background: var(--neo-modal-surface) !important;
        font-size: 0.9rem !important;
        font-weight: 600;
        box-shadow:
            inset 5px 5px 10px rgba(163, 177, 198, 0.25),
            inset -5px -5px 10px rgba(255, 255, 255, 0.92) !important;
        outline: none !important;
        transition: .18s ease;
    }

    #form_create .form-control,
    #form_create .form-select {
        padding: 11px 14px !important;
    }

    #form_create textarea.form-control {
        resize: vertical;
        line-height: 1.55;
    }

    #form_create .form-control:focus,
    #form_create .form-select:focus {
        background: #f8fafc !important;
        box-shadow:
            inset 4px 4px 8px rgba(163, 177, 198, 0.22),
            inset -4px -4px 8px rgba(255, 255, 255, 0.96),
            0 0 0 3px rgba(59, 130, 246, 0.12) !important;
    }

    #form_create .form-control::placeholder {
        color: #9ca3af;
        font-weight: 500;
    }

    #form_create .select2-container {
        width: 100% !important;
    }

    #form_create .select2-container--bootstrap5 .select2-selection {
        padding: 0 !important;
    }

    #form_create .select2-container--bootstrap5 .select2-selection__rendered {
        color: var(--neo-modal-text) !important;
        font-weight: 600;
        line-height: 44px !important;
        padding-left: 14px !important;
        padding-right: 36px !important;
    }

    #form_create .select2-container--bootstrap5 .select2-selection__placeholder {
        color: #9ca3af !important;
        font-weight: 500;
    }

    #form_create .select2-container--bootstrap5 .select2-selection__arrow {
        height: 44px !important;
    }

    #form_create .invalid-feedback {
        margin-top: 2px;
        font-size: 0.78rem;
        font-weight: 700;
    }

    #form_create #deskripsi_lengkap_editor {
        min-height: 220px !important;
        border: 0 !important;
        border-radius: 16px !important;
        padding: 14px !important;
        color: var(--neo-modal-text) !important;
        background: var(--neo-modal-surface) !important;
        font-size: 0.9rem !important;
        font-weight: 600;
        line-height: 1.6;
        box-shadow:
            inset 5px 5px 10px rgba(163, 177, 198, 0.25),
            inset -5px -5px 10px rgba(255, 255, 255, 0.92) !important;
        overflow: auto;
    }

    #form_create .neo-media-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 14px;
    }

    #form_create .neo-media-title {
        margin: 0;
        color: var(--neo-modal-text);
        font-size: 0.9rem;
        font-weight: 850;
        line-height: 1.35;
        text-align: center;
    }

    #form_create .image-input {
        position: relative;
        width: 250px;
        height: 142px;
        border-radius: 28px;
        background: var(--neo-modal-surface);
        box-shadow:
            inset 6px 6px 13px rgba(163, 177, 198, 0.26),
            inset -6px -6px 13px rgba(255, 255, 255, 0.92);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #form_create .image-input-wrapper {
        width: 220px !important;
        height: 112px !important;
        border: 0 !important;
        border-radius: 22px !important;
        background-color: var(--neo-modal-surface-soft);
        background-size: cover !important;
        background-repeat: no-repeat !important;
        background-position: center !important;
        box-shadow:
            7px 7px 16px rgba(163, 177, 198, 0.32),
            -7px -7px 16px rgba(255, 255, 255, 0.92);
    }

    #form_create .image-input-wrapper::before {
        content: "\F42A";
        font-family: "bootstrap-icons";
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        font-size: 2.4rem;
    }

    #form_create .image-input-wrapper[style*="background-image"]::before {
        content: "";
    }

    #form_create .image-input [data-kt-image-input-action] {
        width: 34px !important;
        height: 34px !important;
        border: 0 !important;
        border-radius: 13px !important;
        color: var(--neo-modal-primary);
        background: var(--neo-modal-surface) !important;
        box-shadow:
            5px 5px 12px rgba(163, 177, 198, 0.36),
            -5px -5px 12px rgba(255, 255, 255, 0.92) !important;
    }

    #form_create .image-input [data-kt-image-input-action] i {
        font-size: 0.95rem !important;
    }

    #form_create .image-input [data-kt-image-input-action="change"] {
        right: -9px;
        top: 13px;
    }

    #form_create .image-input [data-kt-image-input-action="cancel"] {
        right: -9px;
        bottom: 58px;
        color: var(--neo-modal-warning);
    }

    #form_create .image-input [data-kt-image-input-action="remove"] {
        right: -9px;
        bottom: 16px;
        color: var(--neo-modal-danger);
    }

    #form_create .neo-form-help {
        margin: 0;
        color: var(--neo-modal-muted);
        font-size: 0.82rem;
        line-height: 1.45;
        font-weight: 600;
        text-align: center;
    }

    #form_create .neo-file-panel {
        margin-top: 22px;
        border-radius: 20px;
        padding: 18px;
        background: var(--neo-modal-surface);
        box-shadow:
            inset 5px 5px 10px rgba(163, 177, 198, 0.22),
            inset -5px -5px 10px rgba(255, 255, 255, 0.92);
    }

    #form_create .neo-file-help {
        margin: 8px 0 0;
        color: var(--neo-modal-muted);
        font-size: 0.8rem;
        line-height: 1.45;
        font-weight: 600;
        text-align: center;
    }

    #form_create .modal-footer {
        gap: 12px;
        padding: 18px 26px 24px;
        border-top: 1px solid var(--neo-modal-border);
        background: transparent;
    }

    #form_create .neo-btn {
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

    #form_create .neo-btn-light {
        color: var(--neo-modal-muted);
        background: var(--neo-modal-surface);
        box-shadow:
            7px 7px 16px rgba(163, 177, 198, 0.36),
            -7px -7px 16px rgba(255, 255, 255, 0.92);
    }

    #form_create .neo-btn-light:hover {
        color: var(--neo-modal-text);
        transform: translateY(-1px);
    }

    #form_create .neo-btn-primary {
        color: #ffffff;
        background: var(--neo-modal-primary);
        box-shadow:
            7px 7px 16px rgba(163, 177, 198, 0.42),
            -7px -7px 16px rgba(255, 255, 255, 0.88);
    }

    #form_create .neo-btn-primary:hover {
        color: #ffffff;
        background: var(--neo-modal-primary-dark);
        transform: translateY(-1px);
    }

    #form_create .neo-btn:active {
        transform: translateY(0);
    }

    @media (max-width: 1199.98px) {
        #form_create .modal-dialog {
            max-width: calc(100vw - 40px);
        }

        #form_create .neo-form-grid {
            grid-template-columns: minmax(0, 1fr);
        }

        #form_create .neo-right-stack {
            display: grid;
            grid-template-columns: minmax(0, 1fr);
        }
    }

    @media (max-width: 991.98px) {
        #form_create .modal-dialog {
            max-width: calc(100vw - 32px);
            margin: 1.25rem auto;
        }

        #form_create .modal-header {
            padding: 22px 22px 16px;
        }

        #form_create .modal-body {
            padding: 22px;
        }

        #form_create .modal-footer {
            padding: 16px 22px 22px;
        }

        #form_create .neo-field-grid,
        #form_create .neo-field-grid-3 {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 767.98px) {
        #form_create .modal-dialog {
            max-width: calc(100vw - 24px);
            margin: 0.75rem auto;
        }

        #form_create .modal-content {
            border-radius: 24px;
        }

        #form_create .modal-header {
            align-items: flex-start;
            padding: 20px 18px 15px;
        }

        #form_create .neo-modal-title-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            border-radius: 15px;
            font-size: 1.08rem;
        }

        #form_create .modal-title {
            font-size: 1.05rem;
        }

        #form_create .neo-modal-subtitle {
            font-size: 0.82rem;
        }

        #form_create .neo-btn-close {
            width: 38px;
            height: 38px;
            min-width: 38px;
            border-radius: 13px;
        }

        #form_create .modal-body {
            padding: 18px;
        }

        #form_create .neo-left-stack,
        #form_create .neo-right-stack {
            gap: 16px;
        }

        #form_create .neo-section {
            border-radius: 22px;
            padding: 18px;
        }

        #form_create .neo-field-grid,
        #form_create .neo-field-grid-3 {
            grid-template-columns: 1fr;
            gap: 0;
        }

        #form_create .modal-footer {
            padding: 15px 18px 18px;
        }
    }

    @media (max-width: 575.98px) {
        #form_create .modal-dialog {
            max-width: calc(100vw - 16px);
            margin: 0.5rem auto;
        }

        #form_create .modal-content {
            border-radius: 22px;
        }

        #form_create .modal-header {
            padding: 18px 16px 14px;
        }

        #form_create .modal-body {
            padding: 16px;
        }

        #form_create .neo-section {
            padding: 16px;
            border-radius: 20px;
        }

        #form_create .image-input {
            width: 100%;
            max-width: 250px;
            height: 140px;
        }

        #form_create .image-input-wrapper {
            width: calc(100% - 30px) !important;
            max-width: 220px;
            height: 110px !important;
        }

        #form_create .modal-footer {
            flex-direction: column-reverse;
            align-items: stretch;
            padding: 14px 16px 16px;
        }

        #form_create .neo-btn {
            width: 100%;
        }
    }
</style>

<div class="modal fade"
     id="form_create"
     data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1"
     role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="post" id="bt_submit_create" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="neo-modal-title-wrap">
                        <span class="neo-modal-title-icon">
                            <i class="bi bi-journal-plus"></i>
                        </span>
                        <div>
                            <h5 class="modal-title">Tambah Kelas</h5>
                            <p class="neo-modal-subtitle">Lengkapi informasi kelas baru</p>
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
                    <div class="neo-form-grid">
                        <div class="neo-left-stack">
                            <div class="neo-section">
                                <h6 class="neo-section-title">
                                    <i class="bi bi-clipboard-data-fill"></i>
                                    Data Utama
                                </h6>

                                <div class="neo-field-grid">
                                    <div class="neo-field">
                                        <label class="neo-label required" for="id_kategori">Kategori</label>
                                        <select data-control="select2"
                                                id="id_kategori"
                                                class="form-select form-select-sm"
                                                data-allow-clear="true"
                                                data-placeholder="Pilih kategori"
                                                data-dropdown-parent="#form_create"
                                                required>
                                            <option></option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>

                                    <div class="neo-field">
                                        <label class="neo-label required" for="id_kategori_sub">Sub Kategori</label>
                                        <select data-control="select2"
                                                id="id_kategori_sub"
                                                class="form-select form-select-sm"
                                                data-allow-clear="true"
                                                data-placeholder="Pilih sub kategori"
                                                data-dropdown-parent="#form_create"
                                                required>
                                            <option></option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="neo-field">
                                    <label class="neo-label required" for="id_pemilik">Pemilik Mentor</label>
                                    <select data-control="select2"
                                            id="id_pemilik"
                                            class="form-select form-select-sm"
                                            data-allow-clear="true"
                                            data-placeholder="Pilih mentor"
                                            data-dropdown-parent="#form_create"
                                            required>
                                        <option></option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="neo-field">
                                    <label class="neo-label required" for="judul">Judul Kelas</label>
                                    <input type="text"
                                           id="judul"
                                           class="form-control form-control-sm"
                                           maxlength="255"
                                           placeholder="Contoh: Hukum Keluarga Islam: Regulasi Perkawinan dan Perceraian Syariah"
                                           required>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="neo-field-grid-3">
                                    <div class="neo-field">
                                        <label class="neo-label required" for="tingkat">Tingkat</label>
                                        <select id="tingkat" class="form-select form-select-sm" required>
                                            <option value="">Pilih tingkat</option>
                                            <option value="pemula">Pemula</option>
                                            <option value="menengah">Menengah</option>
                                            <option value="lanjutan">Lanjutan</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>

                                    <div class="neo-field">
                                        <label class="neo-label required" for="bahasa">Bahasa</label>
                                        <select id="bahasa" class="form-select form-select-sm" required>
                                            <option value="">Pilih bahasa</option>
                                            <option value="ID">Indonesia</option>
                                            <option value="EN">Inggris</option>
                                            <option value="AR">Arab</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>

                                    <div class="neo-field">
                                        <label class="neo-label required" for="status">Status</label>
                                        <select id="status" class="form-select form-select-sm" required>
                                            <option value="draft">Draft</option>
                                            <option value="terbit">Terbit</option>
                                            <option value="arsip">Arsip</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="neo-field">
                                    <label class="neo-label" for="nilai_lulus">Nilai Kelulusan (%)</label>
                                    <input type="number"
                                           id="nilai_lulus"
                                           class="form-control form-control-sm"
                                           min="0"
                                           max="100"
                                           step="1"
                                           placeholder="Contoh: 70">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="neo-section">
                                <h6 class="neo-section-title">
                                    <i class="bi bi-card-text"></i>
                                    Deskripsi
                                </h6>

                                <div class="neo-field">
                                    <label class="neo-label" for="deskripsi_singkat">Deskripsi Singkat</label>
                                    <textarea id="deskripsi_singkat"
                                              class="form-control form-control-sm"
                                              rows="3"
                                              maxlength="500"
                                              placeholder="Ringkasan singkat mengenai fokus utama kelas."></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="neo-field">
                                    <label class="neo-label" for="deskripsi_lengkap">Deskripsi Lengkap</label>
                                    <textarea id="deskripsi_lengkap"
                                              class="form-control form-control-sm d-none"
                                              rows="6"
                                              placeholder="Jelaskan materi, tujuan pembelajaran, dan manfaat mengikuti kelas ini."></textarea>
                                    <div id="deskripsi_lengkap_editor"
                                         class="form-control form-control-sm"></div>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="neo-field">
                                    <label class="neo-label" for="video_intro_url">Video Intro URL</label>
                                    <input type="url"
                                           id="video_intro_url"
                                           class="form-control form-control-sm"
                                           maxlength="255"
                                           placeholder="https://contoh.com/video-intro">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="neo-right-stack">
                            <div class="neo-section">
                                <h6 class="neo-section-title">
                                    <i class="bi bi-image-fill"></i>
                                    Media
                                </h6>

                                <div class="neo-media-box">
                                    <h6 class="neo-media-title">Banner Kelas</h6>

                                    <div class="image-input image-input-outline" data-kt-image-input="true">
                                        <div class="image-input-wrapper"
                                             style="background-size: cover; background-repeat: no-repeat; background-position: center;">
                                        </div>

                                        <label class="btn btn-icon btn-circle"
                                               data-kt-image-input-action="change"
                                               title="Pilih banner">
                                            <i class="bi bi-pencil-fill"></i>
                                            <input type="file"
                                                   id="banner"
                                                   name="banner"
                                                   accept=".png,.jpg,.jpeg,.webp">
                                            <input type="hidden" name="banner_remove">
                                        </label>

                                        <span class="btn btn-icon btn-circle"
                                              data-kt-image-input-action="cancel"
                                              title="Batal ganti banner">
                                            <i class="bi bi-arrow-counterclockwise"></i>
                                        </span>

                                        <span class="btn btn-icon btn-circle"
                                              data-kt-image-input-action="remove"
                                              title="Hapus banner">
                                            <i class="bi bi-trash-fill"></i>
                                        </span>
                                    </div>

                                    <p class="neo-form-help">
                                        JPG, PNG, WEBP<br>
                                        Maksimal 2 MB
                                    </p>

                                    <div class="invalid-feedback d-block text-center" id="banner-error"></div>
                                </div>

                                <div class="neo-file-panel">
                                    <div class="neo-field no-margin">
                                        <label class="neo-label" for="sertifikat">Template Sertifikat DOC/DOCX</label>
                                        <input type="file"
                                               id="sertifikat"
                                               name="sertifikat"
                                               class="form-control form-control-sm"
                                               accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                        <p class="neo-file-help">
                                            Format file: .doc atau .docx, maksimal 5 MB.
                                        </p>
                                        <div class="invalid-feedback d-block text-center" id="sertifikat-error"></div>
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

                    <button type="submit"
                            class="neo-btn neo-btn-primary">
                        <i class="bi bi-check-circle"></i>
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>