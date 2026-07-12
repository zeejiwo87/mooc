
<style>
    .pengguna-modal-simple .modal-content {
        border: 0;
        border-radius: 12px;
        box-shadow: 0 18px 50px rgba(15, 23, 42, .18);
        overflow: hidden;
    }

    .pengguna-modal-simple .modal-header {
        min-height: auto;
        padding: 16px 18px;
        background: #ffffff;
        border-bottom: 1px solid #eef2f7;
    }

    .pengguna-modal-simple .modal-title {
        color: #111827;
        font-weight: 800;
        margin: 0;
    }

    .pengguna-modal-simple .modal-body {
        padding: 18px;
        background: #ffffff;
    }

    .pengguna-modal-simple .modal-footer {
        padding: 14px 18px 18px;
        background: #ffffff;
        border-top: 1px solid #eef2f7;
        gap: 8px;
    }

    .pengguna-modal-simple .section-title {
        color: #111827 !important;
        font-weight: 800;
        margin-bottom: 12px;
        padding-bottom: 8px;
        border-bottom: 1px solid #e5e7eb !important;
    }

    .pengguna-modal-simple label,
    .pengguna-modal-simple label span {
        color: #111827 !important;
        font-weight: 800;
    }

    .pengguna-modal-simple .form-control {
        border: 1px solid #e5e7eb !important;
        border-radius: 8px !important;
        min-height: 38px;
        color: #111827;
        box-shadow: none !important;
    }

    .pengguna-modal-simple .form-control:focus {
        border-color: #074366 !important;
        box-shadow: 0 0 0 .2rem rgba(7, 67, 102, .10) !important;
    }

    .pengguna-modal-simple textarea.form-control {
        resize: vertical;
    }

    .pengguna-modal-simple .btn {
        border-radius: 8px;
        font-weight: 700;
    }

    .pengguna-modal-simple .btn-primary {
        background: #074366 !important;
        border-color: #074366 !important;
        color: #ffffff !important;
        box-shadow: 0 8px 18px rgba(7, 67, 102, .22) !important;
    }

    .pengguna-modal-simple .btn-primary:hover {
        background: #052f49 !important;
        border-color: #052f49 !important;
        color: #ffffff !important;
    }

    .pengguna-modal-simple .btn-light {
        background: #ef4444 !important;
        border-color: #ef4444 !important;
        color: #ffffff !important;
        box-shadow: 0 8px 18px rgba(239, 68, 68, .18) !important;
    }

    .pengguna-modal-simple .btn-light:hover {
        background: #dc2626 !important;
        border-color: #dc2626 !important;
        color: #ffffff !important;
    }

    .pengguna-modal-simple .btn-close {
        background-color: #ef4444 !important;
        opacity: 1 !important;
        border-radius: 8px !important;
        box-shadow: none !important;
    }

    .pengguna-modal-simple .image-input-wrapper {
        background-color: #f8fafc;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }

    .pengguna-modal-simple .btn-icon[data-kt-image-input-action="change"] {
        background: #074366 !important;
        border-color: #074366 !important;
        color: #ffffff !important;
    }

    .pengguna-modal-simple .btn-icon[data-kt-image-input-action="cancel"],
    .pengguna-modal-simple .btn-icon[data-kt-image-input-action="remove"] {
        background: #ef4444 !important;
        border-color: #ef4444 !important;
        color: #ffffff !important;
    }

    .pengguna-modal-simple .btn-icon[data-kt-image-input-action] i {
        color: #ffffff !important;
    }

    .pengguna-modal-simple .btn-icon[data-kt-image-input-action]:hover {
        filter: brightness(.92);
    }

    .pengguna-modal-simple .form-text,
    .pengguna-modal-simple small {
        font-size: 12px;
    }

    .pengguna-modal-simple .radio-option {
        min-height: 38px;
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 8px 10px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        background: #f8fafc;
        cursor: pointer;
    }

    .pengguna-modal-simple .radio-option .form-check-input {
        margin: 0;
    }

    .pengguna-modal-simple .radio-option .form-check-input:checked {
        background-color: #074366;
        border-color: #074366;
    }

    .pengguna-modal-simple .radio-option .form-check-label {
        margin: 0;
        color: #111827;
        font-size: 13px;
        font-weight: 800;
        cursor: pointer;
    }

    .pengguna-modal-simple .detail-box {
        min-height: 38px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 8px 10px;
        color: #111827;
        background: #f8fafc;
        font-weight: 600;
        word-break: break-word;
    }

    .pengguna-modal-simple .detail-box:empty::before {
        content: "-";
        color: #64748b;
    }

    .pengguna-modal-simple .detail-box.long-text {
        min-height: 90px;
        white-space: pre-line;
    }

    .pengguna-modal-simple .metric-box {
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 12px;
        background: #f8fafc;
    }

    .pengguna-modal-simple .metric-label {
        color: #64748b;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .04em;
        margin-bottom: 5px;
    }

    .pengguna-modal-simple .metric-value {
        color: #111827;
        font-size: 18px;
        font-weight: 800;
        margin: 0;
    }

    @media (max-width: 767.98px) {
        .pengguna-modal-simple .modal-body {
            padding: 15px;
        }

        .pengguna-modal-simple .modal-footer {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .pengguna-modal-simple .modal-footer .btn {
            width: 100%;
        }
    }
    /* ===== CLOSE MODAL: TANPA BACKGROUND ===== */
.pengguna-modal-simple .btn-close {
    background-color: transparent !important;
    border: 0 !important;
    box-shadow: none !important;
    opacity: .75 !important;
    border-radius: 0 !important;
}

.pengguna-modal-simple .btn-close:hover {
    background-color: transparent !important;
    opacity: 1 !important;
}

/* ===== TOMBOL FOTO: TANPA BACKGROUND ===== */
.pengguna-modal-simple .btn-icon[data-kt-image-input-action] {
    background: transparent !important;
    background-color: transparent !important;
    border: 0 !important;
    box-shadow: none !important;
    color: inherit !important;
}

/* Ganti foto = icon biru gelap tanpa bg */
.pengguna-modal-simple .btn-icon[data-kt-image-input-action="change"] i {
    color: #074366 !important;
}

/* Batal dan hapus foto = icon merah tanpa bg */
.pengguna-modal-simple .btn-icon[data-kt-image-input-action="cancel"] i,
.pengguna-modal-simple .btn-icon[data-kt-image-input-action="remove"] i {
    color: #ef4444 !important;
}

.pengguna-modal-simple .btn-icon[data-kt-image-input-action]:hover {
    background: transparent !important;
    background-color: transparent !important;
    filter: brightness(.85);
}
</style>

<div class="modal fade pengguna-modal-simple"
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
                    <h5 class="modal-title">Tambah Pengguna</h5>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>

                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-3">
                            <div class="d-flex flex-column align-items-center mb-4 mb-md-0">
                                <h6 class="section-title w-100 text-center">Foto Profil</h6>

                                <div class="image-input image-input-outline" data-kt-image-input="true">
                                    <div class="image-input-wrapper w-150px h-150px rounded border"
                                         style="background-size: contain; background-repeat: no-repeat; background-position: center;"></div>

                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                           data-kt-image-input-action="change"
                                           data-bs-toggle="tooltip"
                                           title="Ganti foto">
                                        <i class="bi bi-pencil fs-5"></i>
                                        <input type="file" id="foto_profil" name="foto_profil" accept=".jpg,.jpeg,.png"/>
                                        <input type="hidden" name="foto_remove"/>
                                    </label>

                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                          data-kt-image-input-action="cancel"
                                          data-bs-toggle="tooltip"
                                          title="Batal ganti foto">
                                        <i class="bi bi-arrow-counterclockwise fs-5"></i>
                                    </span>

                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                          data-kt-image-input-action="remove"
                                          data-bs-toggle="tooltip"
                                          title="Hapus foto">
                                        <i class="bi bi-trash fs-5"></i>
                                    </span>
                                </div>

                                <div class="form-text text-muted text-center mt-2">
                                    JPG, JPEG, PNG<br>
                                    Maksimal 2MB
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <h6 class="section-title">Data Dasar</h6>

                            <div class="d-flex flex-column mb-3">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Nama</span>
                                </label>
                                <input type="text"
                                       id="nama"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       maxlength="100"
                                       placeholder="Masukkan nama pengguna"
                                       required/>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="d-flex flex-column mb-3">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Email</span>
                                </label>
                                <input type="email"
                                       id="email"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       maxlength="100"
                                       placeholder="Masukkan email pengguna"
                                       required/>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="d-flex flex-column mb-3">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Password</span>
                                </label>
                                <input type="password"
                                       id="password"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       minlength="6"
                                       placeholder="Minimal 6 karakter"
                                       required/>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="d-flex flex-column mb-3">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>Telepon</span>
                                </label>
                                <input type="text"
                                       id="telepon"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       maxlength="20"
                                       placeholder="Masukkan nomor telepon"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <h6 class="section-title">Informasi Tambahan</h6>

                            <div class="d-flex flex-column mb-3">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>Bio</span>
                                </label>
                                <textarea id="bio"
                                          class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                          rows="4"
                                          maxlength="1000"
                                          placeholder="Tulis bio singkat pengguna"></textarea>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="d-flex flex-column mb-3">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-2">
                                    <span>Status Verifikasi</span>
                                </label>

                                <div class="row g-2">
                                    <div class="col-6">
                                        <label class="radio-option" for="terverifikasi_ya">
                                            <input class="form-check-input"
                                                   type="radio"
                                                   name="terverifikasi"
                                                   id="terverifikasi_ya"
                                                   value="1"
                                                   checked>
                                            <span class="form-check-label">Ya</span>
                                        </label>
                                    </div>

                                    <div class="col-6">
                                        <label class="radio-option" for="terverifikasi_tidak">
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
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>
                        Tutup
                    </button>

                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="bi bi-check-circle me-1"></i>
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
