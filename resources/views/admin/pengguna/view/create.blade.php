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
        --neo-modal-success: #10b981;
    }

    #form_create .modal-dialog {
        max-width: 1080px;
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
        grid-template-columns: 260px minmax(0, 1fr) minmax(0, 1.22fr);
        gap: 22px;
        align-items: stretch;
    }

    #form_create .neo-section {
        height: 100%;
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

    #form_create .neo-photo-section {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    #form_create .neo-photo-box {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    #form_create .image-input {
        position: relative;
        width: 162px;
        height: 162px;
        border-radius: 32px;
        background: var(--neo-modal-surface);
        box-shadow:
            inset 6px 6px 13px rgba(163, 177, 198, 0.26),
            inset -6px -6px 13px rgba(255, 255, 255, 0.92);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #form_create .image-input-wrapper {
        width: 138px !important;
        height: 138px !important;
        border: 0 !important;
        border-radius: 26px !important;
        background-color: var(--neo-modal-surface-soft);
        background-size: cover !important;
        background-repeat: no-repeat !important;
        background-position: center !important;
        box-shadow:
            7px 7px 16px rgba(163, 177, 198, 0.32),
            -7px -7px 16px rgba(255, 255, 255, 0.92);
    }

    #form_create .image-input-wrapper::before {
        content: "\F4E1";
        font-family: "bootstrap-icons";
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        font-size: 2.8rem;
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
        right: -8px;
        top: 12px;
    }

    #form_create .image-input [data-kt-image-input-action="cancel"] {
        right: -8px;
        bottom: 58px;
    }

    #form_create .image-input [data-kt-image-input-action="remove"] {
        right: -8px;
        bottom: 16px;
        color: var(--neo-modal-danger);
    }

    #form_create .neo-form-help {
        margin: 16px 0 0;
        color: var(--neo-modal-muted);
        font-size: 0.82rem;
        line-height: 1.45;
        font-weight: 600;
        text-align: center;
    }

    #form_create .neo-field {
        display: flex;
        flex-direction: column;
        gap: 7px;
        margin-bottom: 16px;
    }

    #form_create .neo-field:last-child {
        margin-bottom: 0;
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

    #form_create .form-control {
        min-height: 44px;
        border: 0 !important;
        border-radius: 16px !important;
        padding: 11px 14px !important;
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

    #form_create textarea.form-control {
        min-height: 128px;
        resize: vertical;
        line-height: 1.55;
    }

    #form_create .form-control:focus {
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

    #form_create .invalid-feedback {
        margin-top: 2px;
        font-size: 0.78rem;
        font-weight: 700;
    }

    #form_create .neo-radio-group {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    #form_create .neo-radio-card {
        position: relative;
        min-height: 46px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 11px 13px;
        border-radius: 16px;
        background: var(--neo-modal-surface);
        box-shadow:
            6px 6px 14px rgba(163, 177, 198, 0.28),
            -6px -6px 14px rgba(255, 255, 255, 0.92);
        cursor: pointer;
        transition: .18s ease;
    }

    #form_create .neo-radio-card:hover {
        transform: translateY(-1px);
    }

    #form_create .neo-radio-card .form-check-input {
        width: 18px;
        height: 18px;
        margin: 0;
        border: 0;
        background-color: var(--neo-modal-surface);
        box-shadow:
            inset 3px 3px 6px rgba(163, 177, 198, 0.28),
            inset -3px -3px 6px rgba(255, 255, 255, 0.9);
        cursor: pointer;
    }

    #form_create .neo-radio-card .form-check-input:checked {
        background-color: var(--neo-modal-primary);
    }

    #form_create .neo-radio-card .form-check-input:focus {
        box-shadow:
            inset 3px 3px 6px rgba(163, 177, 198, 0.28),
            inset -3px -3px 6px rgba(255, 255, 255, 0.9),
            0 0 0 3px rgba(59, 130, 246, 0.12);
    }

    #form_create .neo-radio-card .form-check-label {
        margin: 0;
        color: var(--neo-modal-text);
        font-size: 0.86rem;
        font-weight: 800;
        cursor: pointer;
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
            grid-template-columns: 240px minmax(0, 1fr) minmax(0, 1fr);
            gap: 18px;
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

        #form_create .neo-form-grid {
            grid-template-columns: 1fr 1fr;
        }

        #form_create .neo-photo-section {
            grid-column: 1 / -1;
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

        #form_create .neo-form-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        #form_create .neo-section {
            border-radius: 22px;
            padding: 18px;
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
            width: 150px;
            height: 150px;
            border-radius: 28px;
        }

        #form_create .image-input-wrapper {
            width: 126px !important;
            height: 126px !important;
            border-radius: 23px !important;
        }

        #form_create .neo-radio-group {
            grid-template-columns: 1fr;
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
                            <i class="bi bi-person-plus-fill"></i>
                        </span>
                        <div>
                            <h5 class="modal-title">Tambah Pengguna</h5>
                            <p class="neo-modal-subtitle">Lengkapi data pengguna baru</p>
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

                        <div class="neo-section neo-photo-section">
                            <h6 class="neo-section-title">
                                <i class="bi bi-image-fill"></i>
                                Foto Profil
                            </h6>

                            <div class="neo-photo-box">
                                <div class="image-input image-input-outline" data-kt-image-input="true">
                                    <div class="image-input-wrapper"
                                         style="background-size: contain; background-repeat: no-repeat; background-position: center;"></div>

                                    <label class="btn btn-icon btn-circle"
                                           data-kt-image-input-action="change"
                                           title="Ganti foto">
                                        <i class="bi bi-pencil-fill"></i>
                                        <input type="file" id="foto_profil" name="foto_profil" accept=".jpg,.jpeg,.png"/>
                                        <input type="hidden" name="foto_remove"/>
                                    </label>

                                    <span class="btn btn-icon btn-circle"
                                          data-kt-image-input-action="cancel"
                                          title="Batal ganti foto">
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                    </span>

                                    <span class="btn btn-icon btn-circle"
                                          data-kt-image-input-action="remove"
                                          title="Hapus foto">
                                        <i class="bi bi-trash-fill"></i>
                                    </span>
                                </div>

                                <div class="neo-form-help">
                                    JPG, JPEG, PNG<br>
                                    Maksimal 2MB
                                </div>
                            </div>
                        </div>

                        <div class="neo-section">
                            <h6 class="neo-section-title">
                                <i class="bi bi-person-vcard-fill"></i>
                                Data Dasar
                            </h6>

                            <div class="neo-field">
                                <label class="neo-label required" for="nama">Nama</label>
                                <input type="text"
                                       id="nama"
                                       class="form-control form-control-sm"
                                       maxlength="100"
                                       placeholder="Masukkan nama pengguna"
                                       required/>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="neo-field">
                                <label class="neo-label required" for="email">Email</label>
                                <input type="email"
                                       id="email"
                                       class="form-control form-control-sm"
                                       maxlength="100"
                                       placeholder="Masukkan email pengguna"
                                       required/>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="neo-field">
                                <label class="neo-label required" for="password">Password</label>
                                <input type="password"
                                       id="password"
                                       class="form-control form-control-sm"
                                       minlength="6"
                                       placeholder="Minimal 6 karakter"
                                       required/>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="neo-field">
                                <label class="neo-label" for="telepon">Telepon</label>
                                <input type="text"
                                       id="telepon"
                                       class="form-control form-control-sm"
                                       maxlength="20"
                                       placeholder="Masukkan nomor telepon"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="neo-section">
                            <h6 class="neo-section-title">
                                <i class="bi bi-info-circle-fill"></i>
                                Informasi Tambahan
                            </h6>

                            <div class="neo-field">
                                <label class="neo-label" for="bio">Bio</label>
                                <textarea id="bio"
                                          class="form-control form-control-sm"
                                          rows="4"
                                          maxlength="1000"
                                          placeholder="Tulis bio singkat pengguna"></textarea>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="neo-field">
                                <label class="neo-label">Status Verifikasi</label>

                                <div class="neo-radio-group">
                                    <label class="neo-radio-card" for="terverifikasi_ya">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="terverifikasi"
                                               id="terverifikasi_ya"
                                               value="1"
                                               checked>
                                        <span class="form-check-label">Ya</span>
                                    </label>

                                    <label class="neo-radio-card" for="terverifikasi_tidak">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="terverifikasi"
                                               id="terverifikasi_tidak"
                                               value="0">
                                        <span class="form-check-label">Tidak</span>
                                    </label>
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