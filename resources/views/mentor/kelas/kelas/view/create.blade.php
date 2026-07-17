<style>
    /* =========================================================
       MODAL TAMBAH KELAS - SIMPLE, FLAT, KONSISTEN
       Visual only: tidak mengubah id, name, data attribute, form, atau logic.
    ========================================================= */
    #form_create {
        --modal-primary: #074366;
        --modal-primary-dark: #052f49;
        --modal-danger: #ef4444;
        --modal-danger-dark: #dc2626;
        --modal-warning: #f59e0b;
        --modal-text: #111827;
        --modal-muted: #64748b;
        --modal-border: #e5e7eb;
        --modal-soft: #f8fafc;
        --modal-white: #ffffff;
    }

    #form_create .modal-dialog {
        max-width: 1180px;
        margin: 1.5rem auto;
    }

    #form_create .modal-content {
        overflow: hidden;
        color: var(--modal-text);
        background: var(--modal-white) !important;
        border: 1px solid var(--modal-border) !important;
        border-radius: 12px !important;
        box-shadow: 0 18px 45px rgba(15, 23, 42, .16) !important;
    }

    #form_create .modal-header {
        min-height: auto;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
        padding: 18px 22px;
        background: var(--modal-white) !important;
        border-bottom: 1px solid #eef2f7 !important;
    }

    #form_create .neo-modal-title-wrap {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        min-width: 0;
    }

    #form_create .neo-modal-title-icon {
        width: 42px;
        height: 42px;
        min-width: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--modal-primary);
        background: var(--modal-soft);
        border: 1px solid var(--modal-border);
        border-radius: 9px;
        box-shadow: none;
        font-size: 18px;
    }

    #form_create .modal-title {
        margin: 0;
        color: var(--modal-text) !important;
        font-size: 18px;
        line-height: 1.3;
        font-weight: 800;
    }

    #form_create .neo-modal-subtitle {
        margin: 4px 0 0;
        color: var(--modal-muted);
        font-size: 13px;
        line-height: 1.45;
        font-weight: 600;
    }

    #form_create .neo-btn-close {
        width: 34px;
        height: 34px;
        min-width: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 !important;
        color: #64748b;
        background: transparent !important;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        opacity: .85;
        transition: color .18s ease, opacity .18s ease;
    }

    #form_create .neo-btn-close:hover {
        color: var(--modal-danger);
        opacity: 1;
        transform: none !important;
    }

    #form_create .neo-btn-close i {
        font-size: 18px;
        line-height: 1;
    }

    #form_create .modal-body {
        padding: 22px;
        background: var(--modal-white) !important;
    }

    #form_create .neo-form-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.35fr) minmax(340px, .85fr);
        gap: 18px;
        align-items: start;
    }

    #form_create .neo-left-stack,
    #form_create .neo-right-stack {
        display: flex;
        flex-direction: column;
        gap: 18px;
        min-width: 0;
    }

    #form_create .neo-section {
        padding: 18px;
        background: var(--modal-soft);
        border: 1px solid var(--modal-border);
        border-radius: 10px;
        box-shadow: none !important;
    }

    #form_create .neo-section-title {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0 0 16px;
        padding-bottom: 10px;
        color: var(--modal-text);
        border-bottom: 1px solid var(--modal-border);
        font-size: 15px;
        line-height: 1.3;
        font-weight: 800;
    }

    #form_create .neo-section-title i {
        color: var(--modal-primary);
        font-size: 16px;
    }

    #form_create .neo-field-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    #form_create .neo-field-grid-3 {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    #form_create .neo-field {
        display: flex;
        flex-direction: column;
        gap: 7px;
        min-width: 0;
        margin-bottom: 14px;
    }

    #form_create .neo-field:last-child,
    #form_create .neo-field.no-margin {
        margin-bottom: 0;
    }

    #form_create .neo-field.full {
        grid-column: 1 / -1;
    }

    #form_create .neo-label {
        display: flex;
        align-items: center;
        gap: 5px;
        margin: 0;
        color: var(--modal-text);
        font-size: 13px;
        line-height: 1.35;
        font-weight: 800;
    }

    #form_create .neo-label.required::after {
        content: "*";
        color: var(--modal-danger);
        font-weight: 900;
    }

    #form_create .form-control,
    #form_create .form-select,
    #form_create .select2-container--bootstrap5 .select2-selection {
        min-height: 42px;
        color: var(--modal-text) !important;
        background: var(--modal-white) !important;
        border: 1px solid var(--modal-border) !important;
        border-radius: 8px !important;
        box-shadow: none !important;
        font-size: 14px !important;
        font-weight: 600;
        outline: none !important;
        transition: border-color .18s ease, box-shadow .18s ease;
    }

    #form_create .form-control,
    #form_create .form-select {
        padding: 9px 12px !important;
    }

    #form_create textarea.form-control {
        resize: vertical;
        line-height: 1.55;
    }

    #form_create .form-control:focus,
    #form_create .form-select:focus,
    #form_create .select2-container--bootstrap5.select2-container--focus .select2-selection,
    #form_create .select2-container--bootstrap5.select2-container--open .select2-selection {
        background: var(--modal-white) !important;
        border-color: var(--modal-primary) !important;
        box-shadow: 0 0 0 .2rem rgba(7, 67, 102, .10) !important;
    }

    #form_create .form-control::placeholder {
        color: #94a3b8;
        font-weight: 500;
    }

    #form_create .select2-container {
        width: 100% !important;
    }

    #form_create .select2-container--bootstrap5 .select2-selection {
        padding: 0 !important;
    }

    #form_create .select2-container--bootstrap5 .select2-selection__rendered {
        color: var(--modal-text) !important;
        font-weight: 600;
        line-height: 40px !important;
        padding-left: 12px !important;
        padding-right: 34px !important;
    }

    #form_create .select2-container--bootstrap5 .select2-selection__placeholder {
        color: #94a3b8 !important;
        font-weight: 500;
    }

    #form_create .select2-container--bootstrap5 .select2-selection__arrow {
        height: 40px !important;
    }

    #form_create .invalid-feedback {
        margin-top: 2px;
        font-size: 12px;
        font-weight: 700;
    }

    #form_create #deskripsi_lengkap_editor {
        min-height: 210px !important;
        padding: 12px !important;
        color: var(--modal-text) !important;
        background: var(--modal-white) !important;
        border: 1px solid var(--modal-border) !important;
        border-radius: 8px !important;
        box-shadow: none !important;
        font-size: 14px !important;
        font-weight: 600;
        line-height: 1.6;
        overflow: auto;
    }

    #form_create #deskripsi_lengkap_editor:focus-within {
        border-color: var(--modal-primary) !important;
        box-shadow: 0 0 0 .2rem rgba(7, 67, 102, .10) !important;
    }

    #form_create .neo-media-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
    }

    #form_create .neo-media-title {
        margin: 0;
        color: var(--modal-text);
        font-size: 14px;
        font-weight: 800;
        line-height: 1.35;
        text-align: center;
    }

    #form_create .image-input {
        position: relative;
        width: 250px;
        height: 142px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--modal-white);
        border: 1px dashed #cbd5e1;
        border-radius: 10px;
        box-shadow: none !important;
    }

    #form_create .image-input-wrapper {
        width: 220px !important;
        height: 112px !important;
        background-color: var(--modal-soft) !important;
        background-size: cover !important;
        background-repeat: no-repeat !important;
        background-position: center !important;
        border: 1px solid var(--modal-border) !important;
        border-radius: 8px !important;
        box-shadow: none !important;
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
        font-size: 34px;
    }

    #form_create .image-input-wrapper[style*="background-image"]::before {
        content: "";
    }

    #form_create .image-input [data-kt-image-input-action] {
        width: 32px !important;
        height: 32px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: #475569 !important;
        background: var(--modal-white) !important;
        border: 1px solid var(--modal-border) !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 10px rgba(15, 23, 42, .10) !important;
    }

    #form_create .image-input [data-kt-image-input-action] i {
        font-size: 14px !important;
        line-height: 1;
    }

    #form_create .image-input [data-kt-image-input-action="change"] {
        right: -8px;
        top: 12px;
        color: var(--modal-primary) !important;
    }

    #form_create .image-input [data-kt-image-input-action="cancel"] {
        right: -8px;
        bottom: 56px;
        color: var(--modal-warning) !important;
    }

    #form_create .image-input [data-kt-image-input-action="remove"] {
        right: -8px;
        bottom: 14px;
        color: var(--modal-danger) !important;
    }

    #form_create .neo-form-help,
    #form_create .neo-file-help {
        margin: 0;
        color: var(--modal-muted);
        font-size: 12px;
        line-height: 1.45;
        font-weight: 600;
        text-align: center;
    }

    #form_create .neo-file-panel {
        margin-top: 18px;
        padding: 14px;
        background: var(--modal-white);
        border: 1px solid var(--modal-border);
        border-radius: 10px;
        box-shadow: none !important;
    }

    #form_create .neo-file-help {
        margin-top: 8px;
    }

    #form_create .modal-footer {
        gap: 10px;
        padding: 16px 22px 20px;
        background: var(--modal-white) !important;
        border-top: 1px solid #eef2f7 !important;
    }

    #form_create .neo-btn {
        min-height: 40px;
        min-width: 104px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 9px 14px;
        border-radius: 8px;
        box-shadow: none !important;
        font-size: 13px;
        line-height: 1;
        font-weight: 800;
        transition: background .18s ease, border-color .18s ease, color .18s ease;
    }

    #form_create .neo-btn-light {
        color: #ffffff;
        background: var(--modal-danger);
        border: 1px solid var(--modal-danger);
    }

    #form_create .neo-btn-light:hover {
        color: #ffffff;
        background: var(--modal-danger-dark);
        border-color: var(--modal-danger-dark);
        transform: none !important;
    }

    #form_create .neo-btn-primary {
        color: #ffffff;
        background: var(--modal-primary);
        border: 1px solid var(--modal-primary);
    }

    #form_create .neo-btn-primary:hover {
        color: #ffffff;
        background: var(--modal-primary-dark);
        border-color: var(--modal-primary-dark);
        transform: none !important;
    }

    #form_create .neo-btn:active {
        transform: none !important;
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

        #form_create .modal-header,
        #form_create .modal-body {
            padding: 18px;
        }

        #form_create .modal-footer {
            padding: 16px 18px 18px;
        }

        #form_create .neo-field-grid,
        #form_create .neo-field-grid-3 {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 767.98px) {
        #form_create .modal-dialog {
            max-width: calc(100vw - 24px);
            margin: .75rem auto;
        }

        #form_create .modal-header {
            align-items: flex-start;
        }

        #form_create .neo-modal-title-icon {
            width: 38px;
            height: 38px;
            min-width: 38px;
            font-size: 16px;
        }

        #form_create .modal-title {
            font-size: 16px;
        }

        #form_create .neo-modal-subtitle {
            font-size: 12px;
        }

        #form_create .neo-section {
            padding: 16px;
        }

        #form_create .neo-field-grid,
        #form_create .neo-field-grid-3 {
            grid-template-columns: 1fr;
            gap: 0;
        }
    }

    @media (max-width: 575.98px) {
        #form_create .modal-dialog {
            max-width: calc(100vw - 16px);
            margin: .5rem auto;
        }

        #form_create .modal-content {
            border-radius: 10px !important;
        }

        #form_create .modal-header,
        #form_create .modal-body {
            padding: 16px;
        }

        #form_create .modal-footer {
            flex-direction: column-reverse;
            align-items: stretch;
            padding: 14px 16px 16px;
        }

        #form_create .neo-btn {
            width: 100%;
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