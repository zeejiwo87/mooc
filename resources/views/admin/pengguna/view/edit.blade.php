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

    /* X close polos seperti edit mentor */
    #form_edit.pengguna-modal-simple .btn-close {
        background-color: transparent !important;
        background-image: var(--bs-btn-close-bg) !important;
        border: 0 !important;
        box-shadow: none !important;
        opacity: .7 !important;
        border-radius: 0 !important;
    }

    #form_edit.pengguna-modal-simple .btn-close:hover {
        background-color: transparent !important;
        background-image: var(--bs-btn-close-bg) !important;
        opacity: 1 !important;
    }

    .pengguna-modal-simple .image-input-wrapper {
        background-color: #f8fafc;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }

    /* Tombol foto: background putih seperti bg-body shadow */
    #form_edit.pengguna-modal-simple .btn-icon[data-kt-image-input-action] {
        background: #ffffff !important;
        background-color: #ffffff !important;
        border: 0 !important;
        color: #111827 !important;
        box-shadow: 0 4px 10px rgba(15, 23, 42, .14) !important;
    }

    #form_edit.pengguna-modal-simple .btn-icon[data-kt-image-input-action] i {
        color: #111827 !important;
    }

    #form_edit.pengguna-modal-simple .btn-icon[data-kt-image-input-action]:hover {
        background: #ffffff !important;
        background-color: #ffffff !important;
        filter: brightness(.97);
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

    /* Tombol Tutup: light biasa seperti edit mentor */
    #form_edit.pengguna-modal-simple .btn-light {
        background: #f8f9fa !important;
        border-color: #f1f1f4 !important;
        color: #3f4254 !important;
        box-shadow: none !important;
    }

    #form_edit.pengguna-modal-simple .btn-light:hover {
        background: #f1f5f9 !important;
        border-color: #e5e7eb !important;
        color: #111827 !important;
    }

    /* Tombol Simpan: biru gelap */
    #form_edit.pengguna-modal-simple .btn-primary {
        background: #074366 !important;
        border-color: #074366 !important;
        color: #ffffff !important;
        box-shadow: 0 8px 18px rgba(7, 67, 102, .22) !important;
    }

    #form_edit.pengguna-modal-simple .btn-primary:hover {
        background: #052f49 !important;
        border-color: #052f49 !important;
        color: #ffffff !important;
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
</style>

<div class="modal fade pengguna-modal-simple"
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
                    <h5 class="modal-title">Edit Pengguna</h5>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>

                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-3">
                            <div class="d-flex flex-column align-items-center mb-4 mb-md-0">
                                <h6 class="section-title w-100 text-center">Foto Profil</h6>

                                <div class="image-input image-input-outline" data-kt-image-input="true">
                                    <div id="edit_image_preview"
                                         class="image-input-wrapper w-150px h-150px rounded border"
                                         style="background-size: contain; background-repeat: no-repeat; background-position: center;"></div>

                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                           data-kt-image-input-action="change"
                                           data-bs-toggle="tooltip"
                                           title="Ganti foto">
                                        <i class="bi bi-pencil fs-5"></i>
                                        <input type="file" id="edit_foto_profil" name="foto_profil" accept=".jpg,.jpeg,.png"/>
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
                                    Maksimal 2MB<br>
                                    <small>Kosongkan jika tidak ingin mengubah</small>
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
                                       id="edit_nama"
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
                                       id="edit_email"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       maxlength="100"
                                       placeholder="Masukkan email pengguna"
                                       required/>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="d-flex flex-column mb-3">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>Password Opsional</span>
                                </label>
                                <input type="password"
                                       id="edit_password"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       minlength="6"
                                       placeholder="Kosongkan jika tidak diubah"/>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="d-flex flex-column mb-3">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>Telepon</span>
                                </label>
                                <input type="text"
                                       id="edit_telepon"
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
                                <textarea id="edit_bio"
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
                                        <label class="radio-option" for="edit_terverifikasi_ya">
                                            <input class="form-check-input"
                                                   type="radio"
                                                   name="edit_terverifikasi"
                                                   id="edit_terverifikasi_ya"
                                                   value="1">
                                            <span class="form-check-label">Ya</span>
                                        </label>
                                    </div>

                                    <div class="col-6">
                                        <label class="radio-option" for="edit_terverifikasi_tidak">
                                            <input class="form-check-input"
                                                   type="radio"
                                                   name="edit_terverifikasi"
                                                   id="edit_terverifikasi_tidak"
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