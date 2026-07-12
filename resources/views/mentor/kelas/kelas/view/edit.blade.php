<style>
    #form_edit {
        --simple-primary: #0f62fe;
        --simple-primary-dark: #0043ce;
        --simple-danger: #ef4444;
        --simple-danger-dark: #dc2626;
        --simple-warning: #f59e0b;
        --simple-success: #10b981;
        --simple-text: #111827;
        --simple-muted: #64748b;
        --simple-border: #e5e7eb;
        --simple-soft: #f8fafc;
        --simple-white: #ffffff;
    }

    #form_edit .modal-dialog {
        max-width: 1180px;
        margin: 1.75rem auto;
    }

    #form_edit .modal-content {
        overflow: hidden;
        border: 0 !important;
        border-radius: 14px !important;
        background: var(--simple-white) !important;
        box-shadow: 0 10px 28px rgba(15, 23, 42, .14) !important;
    }

    #form_edit .modal-header {
        min-height: auto;
        padding: 18px 22px;
        background: var(--simple-white) !important;
        border-bottom: 1px solid #eef2f7 !important;
    }

    #form_edit .neo-modal-title-wrap {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    #form_edit .neo-modal-title-icon {
        width: 40px;
        height: 40px;
        min-width: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        color: #ffffff;
        background: var(--simple-primary);
        font-size: 1rem;
    }

    #form_edit .modal-title {
        margin: 0;
        color: var(--simple-text);
        font-size: 1.08rem;
        line-height: 1.25;
        font-weight: 800;
    }

    #form_edit .neo-modal-subtitle {
        margin: 4px 0 0;
        color: var(--simple-muted);
        font-size: .86rem;
        line-height: 1.4;
        font-weight: 500;
    }

    #form_edit .neo-btn-close {
        width: 36px;
        height: 36px;
        min-width: 36px;
        padding: 0;
        border: 0 !important;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--simple-muted);
        background: transparent !important;
        box-shadow: none !important;
        opacity: 1;
        transition: .16s ease;
    }

    #form_edit .neo-btn-close:hover {
        color: var(--simple-danger);
        background: #fef2f2 !important;
    }

    #form_edit .neo-btn-close i {
        font-size: 1rem;
        line-height: 1;
    }

    #form_edit .modal-body {
        padding: 22px;
        background: var(--simple-soft) !important;
    }

    #form_edit .neo-form-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.35fr) minmax(340px, .85fr);
        gap: 18px;
        align-items: start;
    }

    #form_edit .neo-left-stack,
    #form_edit .neo-right-stack {
        display: flex;
        flex-direction: column;
        gap: 18px;
        min-width: 0;
    }

    #form_edit .neo-section {
        padding: 18px;
        border: 1px solid var(--simple-border);
        border-radius: 12px;
        background: var(--simple-white);
        box-shadow: none !important;
    }

    #form_edit .neo-section-title {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0 0 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid #eef2f7;
        color: var(--simple-text);
        font-size: .95rem;
        line-height: 1.3;
        font-weight: 800;
    }

    #form_edit .neo-section-title i {
        color: var(--simple-primary);
        font-size: 1rem;
    }

    #form_edit .neo-field-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    #form_edit .neo-field-grid-3 {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    #form_edit .neo-field {
        display: flex;
        flex-direction: column;
        gap: 7px;
        min-width: 0;
        margin-bottom: 14px;
    }

    #form_edit .neo-field:last-child,
    #form_edit .neo-field.no-margin {
        margin-bottom: 0;
    }

    #form_edit .neo-field.full {
        grid-column: 1 / -1;
    }

    #form_edit .neo-label {
        display: flex;
        align-items: center;
        gap: 6px;
        margin: 0;
        color: #374151;
        font-size: .84rem;
        line-height: 1.35;
        font-weight: 800;
    }

    #form_edit .neo-label.required::after {
        content: "*";
        color: var(--simple-danger);
        font-weight: 900;
    }

    #form_edit .form-control,
    #form_edit .form-select,
    #form_edit .select2-container--bootstrap5 .select2-selection {
        min-height: 42px;
        border: 1px solid var(--simple-border) !important;
        border-radius: 8px !important;
        color: var(--simple-text) !important;
        background: var(--simple-white) !important;
        font-size: .88rem !important;
        font-weight: 600;
        box-shadow: none !important;
        outline: none !important;
        transition: .16s ease;
    }

    #form_edit .form-control,
    #form_edit .form-select {
        padding: 10px 12px !important;
    }

    #form_edit textarea.form-control {
        resize: vertical;
        line-height: 1.55;
    }

    #form_edit .form-control:focus,
    #form_edit .form-select:focus,
    #form_edit .select2-container--bootstrap5.select2-container--focus .select2-selection,
    #form_edit .select2-container--bootstrap5.select2-container--open .select2-selection {
        border-color: var(--simple-primary) !important;
        box-shadow: 0 0 0 .2rem rgba(15, 98, 254, .10) !important;
        background: var(--simple-white) !important;
    }

    #form_edit .form-control::placeholder {
        color: #9ca3af;
        font-weight: 500;
    }

    #form_edit .select2-container {
        width: 100% !important;
    }

    #form_edit .select2-container--bootstrap5 .select2-selection {
        padding: 0 !important;
    }

    #form_edit .select2-container--bootstrap5 .select2-selection__rendered {
        color: var(--simple-text) !important;
        font-weight: 600;
        line-height: 42px !important;
        padding-left: 12px !important;
        padding-right: 36px !important;
    }

    #form_edit .select2-container--bootstrap5 .select2-selection__placeholder {
        color: #9ca3af !important;
        font-weight: 500;
    }

    #form_edit .select2-container--bootstrap5 .select2-selection__arrow {
        height: 42px !important;
    }

    #form_edit .invalid-feedback {
        margin-top: 2px;
        font-size: .78rem;
        font-weight: 700;
    }

    #form_edit #edit_deskripsi_lengkap_editor {
        min-height: 210px !important;
        padding: 12px !important;
        border: 1px solid var(--simple-border) !important;
        border-radius: 8px !important;
        color: var(--simple-text) !important;
        background: var(--simple-white) !important;
        font-size: .88rem !important;
        font-weight: 600;
        line-height: 1.6;
        box-shadow: none !important;
        overflow: auto;
    }

    #form_edit .neo-media-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
    }

    #form_edit .neo-media-title {
        margin: 0;
        color: var(--simple-text);
        font-size: .9rem;
        font-weight: 800;
        line-height: 1.35;
        text-align: center;
    }

    #form_edit .image-input {
        position: relative;
        width: 250px;
        height: 142px;
        border: 1px dashed #cbd5e1;
        border-radius: 12px;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: none !important;
    }

    #form_edit .image-input-wrapper {
        width: 220px !important;
        height: 112px !important;
        border: 1px solid var(--simple-border) !important;
        border-radius: 10px !important;
        background-color: #ffffff;
        background-size: cover !important;
        background-repeat: no-repeat !important;
        background-position: center !important;
        box-shadow: none !important;
    }

    #form_edit .image-input-wrapper::before {
        content: "\F42A";
        font-family: "bootstrap-icons";
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        font-size: 2rem;
    }

    #form_edit .image-input-wrapper[style*="background-image"]::before {
        content: "";
    }

    #form_edit .image-input [data-kt-image-input-action] {
        width: 32px !important;
        height: 32px !important;
        border: 0 !important;
        border-radius: 8px !important;
        color: #ffffff !important;
        background: var(--simple-primary) !important;
        box-shadow: 0 6px 14px rgba(15, 23, 42, .14) !important;
    }

    #form_edit .image-input [data-kt-image-input-action] i {
        color: #ffffff !important;
        font-size: .9rem !important;
    }

    #form_edit .image-input [data-kt-image-input-action="change"] {
        right: -8px;
        top: 12px;
        background: var(--simple-primary) !important;
    }

    #form_edit .image-input [data-kt-image-input-action="cancel"] {
        right: -8px;
        bottom: 56px;
        background: var(--simple-warning) !important;
    }

    #form_edit .image-input [data-kt-image-input-action="remove"] {
        right: -8px;
        bottom: 15px;
        background: var(--simple-danger) !important;
    }

    #form_edit .neo-form-help {
        margin: 0;
        color: var(--simple-muted);
        font-size: .8rem;
        line-height: 1.45;
        font-weight: 600;
        text-align: center;
    }

    #form_edit .neo-file-panel {
        margin-top: 18px;
        padding: 14px;
        border: 1px solid var(--simple-border);
        border-radius: 10px;
        background: #f8fafc;
        box-shadow: none !important;
    }

    #form_edit .neo-file-help {
        margin: 8px 0 0;
        color: var(--simple-muted);
        font-size: .8rem;
        line-height: 1.45;
        font-weight: 600;
        text-align: center;
    }

    #form_edit .modal-footer {
        gap: 10px;
        padding: 16px 22px 18px;
        border-top: 1px solid #eef2f7 !important;
        background: var(--simple-white) !important;
    }

    #form_edit .neo-btn {
        min-height: 40px;
        min-width: 104px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 9px 15px;
        border: 0 !important;
        border-radius: 8px;
        font-size: .86rem;
        line-height: 1;
        font-weight: 800;
        box-shadow: none !important;
        transition: .16s ease;
    }

    #form_edit .neo-btn-light {
        color: #ffffff !important;
        background: var(--simple-danger) !important;
    }

    #form_edit .neo-btn-light:hover {
        color: #ffffff !important;
        background: var(--simple-danger-dark) !important;
        transform: translateY(-1px);
    }

    #form_edit .neo-btn-primary {
        color: #ffffff !important;
        background: var(--simple-primary) !important;
    }

    #form_edit .neo-btn-primary:hover {
        color: #ffffff !important;
        background: var(--simple-primary-dark) !important;
        transform: translateY(-1px);
    }

    #form_edit .neo-btn:active {
        transform: translateY(0);
    }

    @media (max-width: 1199.98px) {
        #form_edit .modal-dialog {
            max-width: calc(100vw - 40px);
        }

        #form_edit .neo-form-grid {
            grid-template-columns: minmax(0, 1fr);
        }

        #form_edit .neo-right-stack {
            display: grid;
            grid-template-columns: minmax(0, 1fr);
        }
    }

    @media (max-width: 991.98px) {
        #form_edit .modal-dialog {
            max-width: calc(100vw - 32px);
            margin: 1.25rem auto;
        }

        #form_edit .modal-header,
        #form_edit .modal-body {
            padding: 20px;
        }

        #form_edit .modal-footer {
            padding: 16px 20px 20px;
        }

        #form_edit .neo-field-grid,
        #form_edit .neo-field-grid-3 {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 767.98px) {
        #form_edit .modal-dialog {
            max-width: calc(100vw - 24px);
            margin: .75rem auto;
        }

        #form_edit .modal-header {
            align-items: flex-start;
            padding: 18px;
        }

        #form_edit .modal-body {
            padding: 18px;
        }

        #form_edit .neo-modal-title-icon {
            width: 38px;
            height: 38px;
            min-width: 38px;
            border-radius: 9px;
        }

        #form_edit .modal-title {
            font-size: 1rem;
        }

        #form_edit .neo-modal-subtitle {
            font-size: .82rem;
        }

        #form_edit .neo-left-stack,
        #form_edit .neo-right-stack {
            gap: 14px;
        }

        #form_edit .neo-section {
            padding: 16px;
        }

        #form_edit .neo-field-grid,
        #form_edit .neo-field-grid-3 {
            grid-template-columns: 1fr;
            gap: 0;
        }
    }

    @media (max-width: 575.98px) {
        #form_edit .modal-dialog {
            max-width: calc(100vw - 16px);
            margin: .5rem auto;
        }

        #form_edit .modal-header,
        #form_edit .modal-body {
            padding: 16px;
        }

        #form_edit .neo-section {
            padding: 14px;
        }

        #form_edit .image-input {
            width: 100%;
            max-width: 250px;
            height: 140px;
        }

        #form_edit .image-input-wrapper {
            width: calc(100% - 30px) !important;
            max-width: 220px;
            height: 110px !important;
        }

        #form_edit .modal-footer {
            flex-direction: column-reverse;
            align-items: stretch;
            padding: 14px 16px 16px;
        }

        #form_edit .neo-btn {
            width: 100%;
        }
    }
</style>

<div class="modal fade"
     id="form_edit"
     data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1"
     role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="post" id="bt_submit_edit" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="neo-modal-title-wrap">
                        <span class="neo-modal-title-icon">
                            <i class="bi bi-pencil-square"></i>
                        </span>
                        <div>
                            <h5 class="modal-title">Edit Kelas</h5>
                            <p class="neo-modal-subtitle">Perbarui informasi kelas</p>
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
                                        <label class="neo-label required" for="edit_id_kategori">Kategori</label>
                                        <select data-control="select2"
                                                id="edit_id_kategori"
                                                class="form-select form-select-sm"
                                                data-allow-clear="true"
                                                data-placeholder="Pilih kategori"
                                                data-dropdown-parent="#form_edit"
                                                required>
                                            <option></option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>

                                    <div class="neo-field">
                                        <label class="neo-label required" for="edit_id_kategori_sub">Sub Kategori</label>
                                        <select data-control="select2"
                                                id="edit_id_kategori_sub"
                                                class="form-select form-select-sm"
                                                data-allow-clear="true"
                                                data-placeholder="Pilih sub kategori"
                                                data-dropdown-parent="#form_edit"
                                                required>
                                            <option></option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="neo-field">
                                    <label class="neo-label required" for="edit_id_pemilik">Pemilik Mentor</label>
                                    <select data-control="select2"
                                            id="edit_id_pemilik"
                                            class="form-select form-select-sm"
                                            data-allow-clear="true"
                                            data-placeholder="Pilih mentor"
                                            data-dropdown-parent="#form_edit"
                                            required>
                                        <option></option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="neo-field">
                                    <label class="neo-label required" for="edit_judul">Judul Kelas</label>
                                    <input type="text"
                                           id="edit_judul"
                                           class="form-control form-control-sm"
                                           maxlength="255"
                                           placeholder="Masukkan judul kelas"
                                           required>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="neo-field-grid">
                                    <div class="neo-field">
                                        <label class="neo-label required" for="edit_tingkat">Tingkat</label>
                                        <select id="edit_tingkat"
                                                class="form-select form-select-sm"
                                                required>
                                            <option value="">Pilih tingkat</option>
                                            <option value="pemula">Pemula</option>
                                            <option value="menengah">Menengah</option>
                                            <option value="lanjutan">Lanjutan</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>

                                    <div class="neo-field">
                                        <label class="neo-label required" for="edit_bahasa">Bahasa</label>
                                        <select id="edit_bahasa"
                                                class="form-select form-select-sm"
                                                required>
                                            <option value="">Pilih bahasa</option>
                                            <option value="ID">Indonesia</option>
                                            <option value="EN">Inggris</option>
                                            <option value="AR">Arab</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="neo-field-grid">
                                    <div class="neo-field">
                                        <label class="neo-label" for="edit_nilai_lulus">Nilai Kelulusan (%)</label>
                                        <input type="number"
                                               id="edit_nilai_lulus"
                                               class="form-control form-control-sm"
                                               min="0"
                                               max="100"
                                               step="1"
                                               placeholder="Contoh: 70">
                                        <div class="invalid-feedback"></div>
                                    </div>

                                    <div class="neo-field">
                                        <label class="neo-label required" for="edit_status">Status</label>
                                        <select id="edit_status"
                                                class="form-select form-select-sm"
                                                required>
                                            <option value="draft">Draft</option>
                                            <option value="terbit">Terbit</option>
                                            <option value="arsip">Arsip</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="neo-section">
                                <h6 class="neo-section-title">
                                    <i class="bi bi-card-text"></i>
                                    Deskripsi
                                </h6>

                                <div class="neo-field">
                                    <label class="neo-label" for="edit_deskripsi_singkat">Deskripsi Singkat</label>
                                    <textarea id="edit_deskripsi_singkat"
                                              class="form-control form-control-sm"
                                              rows="3"
                                              maxlength="500"
                                              placeholder="Ringkasan singkat mengenai fokus utama kelas."></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="neo-field">
                                    <label class="neo-label" for="edit_deskripsi_lengkap">Deskripsi Lengkap</label>
                                    <textarea id="edit_deskripsi_lengkap"
                                              class="form-control form-control-sm d-none"
                                              rows="6"
                                              placeholder="Jelaskan materi, tujuan pembelajaran, dan manfaat mengikuti kelas ini."></textarea>
                                    <div id="edit_deskripsi_lengkap_editor"
                                         class="form-control form-control-sm"></div>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="neo-field">
                                    <label class="neo-label" for="edit_video_intro_url">Video Intro URL</label>
                                    <input type="url"
                                           id="edit_video_intro_url"
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
                                    <h6 class="neo-media-title">Banner</h6>

                                    <div class="image-input image-input-outline" data-kt-image-input="true">
                                        <div id="edit_banner_preview"
                                             class="image-input-wrapper"
                                             style="background-size: cover; background-repeat: no-repeat; background-position: center;">
                                        </div>

                                        <label class="btn btn-icon btn-circle"
                                               data-kt-image-input-action="change"
                                               title="Pilih banner">
                                            <i class="bi bi-pencil-fill"></i>
                                            <input type="file"
                                                   id="edit_banner"
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

                                    <div class="invalid-feedback d-block text-center" id="edit_banner-error"></div>
                                </div>

                                <div class="neo-file-panel">
                                    <div class="neo-field no-margin">
                                        <label class="neo-label" for="edit_sertifikat">Template Sertifikat DOC/DOCX</label>
                                        <input type="file"
                                               id="edit_sertifikat"
                                               name="sertifikat"
                                               class="form-control form-control-sm"
                                               accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                        <p class="neo-file-help">
                                            Kosongkan jika tidak ingin mengubah template sertifikat.
                                        </p>
                                        <div class="invalid-feedback d-block text-center" id="edit_sertifikat-error"></div>
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