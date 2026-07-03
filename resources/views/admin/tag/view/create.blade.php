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
    }

    #form_create .modal-dialog {
        max-width: 680px;
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

    #form_create .neo-field {
        display: flex;
        flex-direction: column;
        gap: 7px;
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
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" id="bt_submit_create">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="neo-modal-title-wrap">
                        <span class="neo-modal-title-icon">
                            <i class="bi bi-tag-fill"></i>
                        </span>
                        <div>
                            <h5 class="modal-title">Tambah Tag</h5>
                            <p class="neo-modal-subtitle">Tambahkan tag baru untuk kelas</p>
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
                    <div class="neo-section">
                        <h6 class="neo-section-title">
                            <i class="bi bi-tags-fill"></i>
                            Data Tag
                        </h6>

                        <div class="neo-field">
                            <label class="neo-label required" for="nama">Nama Tag</label>
                            <input type="text"
                                   id="nama"
                                   class="form-control form-control-sm"
                                   maxlength="100"
                                   placeholder="Masukkan nama tag"
                                   required/>
                            <div class="invalid-feedback"></div>
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