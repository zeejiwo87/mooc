<style>
    #form_edit {
        --neo-modal-bg: #eef2f7;
        --neo-modal-surface: #eef2f7;
        --neo-modal-text: #1f2937;
        --neo-modal-muted: #6b7280;
        --neo-modal-border: rgba(148, 163, 184, 0.18);
        --neo-modal-shadow-dark: rgba(163, 177, 198, 0.42);
        --neo-modal-shadow-light: rgba(255, 255, 255, 0.95);
        --neo-modal-primary: #3b82f6;
        --neo-modal-primary-dark: #2563eb;
        --neo-modal-danger: #ef4444;
    }

    #form_edit .modal-dialog {
        max-width: 860px;
        margin: 1.75rem auto;
    }

    #form_edit .modal-content {
        border: 0;
        border-radius: 28px;
        background: var(--neo-modal-bg);
        box-shadow:
            18px 18px 40px rgba(15, 23, 42, 0.22),
            -10px -10px 28px rgba(255, 255, 255, 0.8);
        overflow: hidden;
    }

    #form_edit .modal-header {
        min-height: auto;
        padding: 24px 26px 18px;
        border-bottom: 1px solid var(--neo-modal-border);
        background: transparent;
    }

    #form_edit .neo-modal-title-wrap {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
    }

    #form_edit .neo-modal-title-icon {
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

    #form_edit .modal-title {
        margin: 0;
        color: var(--neo-modal-text);
        font-size: 1.18rem;
        line-height: 1.25;
        font-weight: 850;
        letter-spacing: -0.02em;
    }

    #form_edit .neo-modal-subtitle {
        margin: 5px 0 0;
        color: var(--neo-modal-muted);
        font-size: 0.86rem;
        line-height: 1.4;
        font-weight: 500;
    }

    #form_edit .neo-btn-close {
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

    #form_edit .neo-btn-close:hover {
        color: var(--neo-modal-danger);
        transform: translateY(-1px);
    }

    #form_edit .neo-btn-close i {
        font-size: 1.2rem;
        line-height: 1;
    }

    #form_edit .modal-body {
        padding: 24px 26px;
        background: transparent;
    }

    #form_edit .neo-form-grid {
        display: grid;
        grid-template-columns: minmax(0, 0.95fr) minmax(0, 1.05fr);
        gap: 22px;
        align-items: stretch;
    }

    #form_edit .neo-section {
        height: 100%;
        border-radius: 24px;
        padding: 20px;
        background: var(--neo-modal-surface);
        box-shadow:
            10px 10px 22px var(--neo-modal-shadow-dark),
            -10px -10px 22px var(--neo-modal-shadow-light);
    }

    #form_edit .neo-section-title {
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

    #form_edit .neo-section-title i {
        color: var(--neo-modal-primary);
        font-size: 1rem;
    }

    #form_edit .neo-field {
        display: flex;
        flex-direction: column;
        gap: 7px;
        margin-bottom: 16px;
    }

    #form_edit .neo-field:last-child {
        margin-bottom: 0;
    }

    #form_edit .neo-label {
        display: flex;
        align-items: center;
        gap: 6px;
        margin: 0;
        color: var(--neo-modal-text);
        font-size: 0.86rem;
        line-height: 1.35;
        font-weight: 800;
    }

    #form_edit .neo-label.required::after {
        content: "*";
        color: var(--neo-modal-danger);
        font-weight: 900;
    }

    #form_edit .form-control {
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

    #form_edit textarea.form-control {
        min-height: 168px;
        resize: vertical;
        line-height: 1.55;
    }

    #form_edit .form-control:focus {
        background: #f8fafc !important;
        box-shadow:
            inset 4px 4px 8px rgba(163, 177, 198, 0.22),
            inset -4px -4px 8px rgba(255, 255, 255, 0.96),
            0 0 0 3px rgba(59, 130, 246, 0.12) !important;
    }

    #form_edit .form-control::placeholder {
        color: #9ca3af;
        font-weight: 500;
    }

    #form_edit .invalid-feedback {
        margin-top: 2px;
        font-size: 0.78rem;
        font-weight: 700;
    }

    #form_edit .neo-radio-group {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    #form_edit .neo-radio-card {
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

    #form_edit .neo-radio-card:hover {
        transform: translateY(-1px);
    }

    #form_edit .neo-radio-card .form-check-input {
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

    #form_edit .neo-radio-card .form-check-input:checked {
        background-color: var(--neo-modal-primary);
    }

    #form_edit .neo-radio-card .form-check-input:focus {
        box-shadow:
            inset 3px 3px 6px rgba(163, 177, 198, 0.28),
            inset -3px -3px 6px rgba(255, 255, 255, 0.9),
            0 0 0 3px rgba(59, 130, 246, 0.12);
    }

    #form_edit .neo-radio-card .form-check-label {
        margin: 0;
        color: var(--neo-modal-text);
        font-size: 0.86rem;
        font-weight: 800;
        cursor: pointer;
    }

    #form_edit .modal-footer {
        gap: 12px;
        padding: 18px 26px 24px;
        border-top: 1px solid var(--neo-modal-border);
        background: transparent;
    }

    #form_edit .neo-btn {
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

    #form_edit .neo-btn-light {
        color: var(--neo-modal-muted);
        background: var(--neo-modal-surface);
        box-shadow:
            7px 7px 16px rgba(163, 177, 198, 0.36),
            -7px -7px 16px rgba(255, 255, 255, 0.92);
    }

    #form_edit .neo-btn-light:hover {
        color: var(--neo-modal-text);
        transform: translateY(-1px);
    }

    #form_edit .neo-btn-primary {
        color: #ffffff;
        background: var(--neo-modal-primary);
        box-shadow:
            7px 7px 16px rgba(163, 177, 198, 0.42),
            -7px -7px 16px rgba(255, 255, 255, 0.88);
    }

    #form_edit .neo-btn-primary:hover {
        color: #ffffff;
        background: var(--neo-modal-primary-dark);
        transform: translateY(-1px);
    }

    @media (max-width: 767.98px) {
        #form_edit .modal-dialog {
            max-width: calc(100vw - 24px);
            margin: 0.75rem auto;
        }

        #form_edit .modal-content {
            border-radius: 24px;
        }

        #form_edit .modal-header {
            align-items: flex-start;
            padding: 20px 18px 15px;
        }

        #form_edit .neo-modal-title-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            border-radius: 15px;
            font-size: 1.08rem;
        }

        #form_edit .modal-title {
            font-size: 1.05rem;
        }

        #form_edit .neo-modal-subtitle {
            font-size: 0.82rem;
        }

        #form_edit .neo-btn-close {
            width: 38px;
            height: 38px;
            min-width: 38px;
            border-radius: 13px;
        }

        #form_edit .modal-body {
            padding: 18px;
        }

        #form_edit .neo-form-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        #form_edit .neo-section {
            border-radius: 22px;
            padding: 18px;
        }

        #form_edit .modal-footer {
            padding: 15px 18px 18px;
        }
    }

    @media (max-width: 575.98px) {
        #form_edit .modal-dialog {
            max-width: calc(100vw - 16px);
            margin: 0.5rem auto;
        }

        #form_edit .modal-header {
            padding: 18px 16px 14px;
        }

        #form_edit .modal-body {
            padding: 16px;
        }

        #form_edit .neo-section {
            padding: 16px;
            border-radius: 20px;
        }

        #form_edit .neo-radio-group {
            grid-template-columns: 1fr;
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
                            <h5 class="modal-title">Edit Kategori Kelas</h5>
                            <p class="neo-modal-subtitle">Perbarui data kategori kelas</p>
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
                        <div class="neo-section">
                            <h6 class="neo-section-title">
                                <i class="bi bi-folder2-open"></i>
                                Data Utama
                            </h6>

                            <div class="neo-field">
                                <label class="neo-label required" for="edit_nama">Nama Kategori</label>
                                <input type="text"
                                       id="edit_nama"
                                       class="form-control form-control-sm"
                                       maxlength="100"
                                       placeholder="Masukkan nama kategori"
                                       required/>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="neo-field">
                                <label class="neo-label" for="edit_urutan">Urutan Tampil</label>
                                <input type="number"
                                       id="edit_urutan"
                                       class="form-control form-control-sm"
                                       min="0"
                                       step="1"
                                       placeholder="Masukkan urutan tampil"/>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="neo-field">
                                <label class="neo-label">Status</label>

                                <div class="neo-radio-group">
                                    <label class="neo-radio-card" for="edit_aktif_ya">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="edit_aktif"
                                               id="edit_aktif_ya"
                                               value="1">
                                        <span class="form-check-label">Aktif</span>
                                    </label>

                                    <label class="neo-radio-card" for="edit_aktif_tidak">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="edit_aktif"
                                               id="edit_aktif_tidak"
                                               value="0">
                                        <span class="form-check-label">Nonaktif</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="neo-section">
                            <h6 class="neo-section-title">
                                <i class="bi bi-card-text"></i>
                                Deskripsi
                            </h6>

                            <div class="neo-field">
                                <label class="neo-label" for="edit_deskripsi">Deskripsi</label>
                                <textarea id="edit_deskripsi"
                                          class="form-control form-control-sm"
                                          rows="6"
                                          maxlength="1000"
                                          placeholder="Tuliskan deskripsi singkat kategori, misalnya jenis kelas yang termasuk."></textarea>
                                <div class="invalid-feedback"></div>
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