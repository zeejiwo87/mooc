<style>
    .mentor-modal-simple .modal-content {
        border: 0;
        border-radius: 12px;
        box-shadow: 0 18px 50px rgba(15, 23, 42, .18);
        overflow: hidden;
    }

    .mentor-modal-simple .modal-header {
        min-height: auto;
        padding: 16px 18px;
        background: #ffffff;
        border-bottom: 1px solid #eef2f7;
    }

    .mentor-modal-simple .modal-title {
        color: #111827;
        font-weight: 800;
        margin: 0;
    }

    .mentor-modal-simple .modal-body {
        padding: 18px;
        background: #ffffff;
    }

    .mentor-modal-simple .modal-footer {
        padding: 14px 18px 18px;
        background: #ffffff;
        border-top: 1px solid #eef2f7;
        gap: 8px;
    }

    .mentor-modal-simple .section-title {
        color: #009ef7;
        font-weight: 800;
        margin-bottom: 12px;
        padding-bottom: 8px;
        border-bottom: 1px solid rgba(0, 158, 247, .25);
    }

    .mentor-modal-simple label {
        color: #111827;
        font-weight: 800;
    }

    .mentor-modal-simple .form-control {
        border: 1px solid #e5e7eb !important;
        border-radius: 8px !important;
        min-height: 38px;
        color: #111827;
        box-shadow: none !important;
    }

    .mentor-modal-simple .form-control:focus {
        border-color: #009ef7 !important;
        box-shadow: 0 0 0 .2rem rgba(0, 158, 247, .10) !important;
    }

    .mentor-modal-simple textarea.form-control {
        resize: vertical;
    }

    .mentor-modal-simple .btn {
        border-radius: 8px;
        font-weight: 700;
    }

    .mentor-modal-simple .btn-primary {
        background: #009ef7;
        border-color: #009ef7;
    }

    .mentor-modal-simple .btn-primary:hover {
        background: #008bd8;
        border-color: #008bd8;
    }

    .mentor-modal-simple .image-input-wrapper {
        background-color: #f8fafc;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }

    .mentor-modal-simple .detail-box {
        min-height: 38px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 8px 10px;
        color: #111827;
        background: #f8fafc;
        font-weight: 600;
        word-break: break-word;
    }

    .mentor-modal-simple .detail-box.long-text {
        min-height: 90px;
        white-space: pre-line;
    }

    .mentor-modal-simple .metric-box {
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 12px;
        background: #f8fafc;
    }

    .mentor-modal-simple .metric-label {
        color: #64748b;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .04em;
        margin-bottom: 5px;
    }

    .mentor-modal-simple .metric-value {
        color: #111827;
        font-size: 18px;
        font-weight: 800;
        margin: 0;
    }

    @media (max-width: 767.98px) {
        .mentor-modal-simple .modal-body {
            padding: 15px;
        }

        .mentor-modal-simple .modal-footer {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .mentor-modal-simple .modal-footer .btn {
            width: 100%;
        }
    }

    /* ===== WARNA FONT JUDUL SECTION: HITAM ===== */
#form_edit.mentor-modal-simple .section-title {
    color: #111827 !important;
    border-bottom-color: #e5e7eb !important;
}

#form_edit.mentor-modal-simple label,
#form_edit.mentor-modal-simple label span {
    color: #111827 !important;
}

/* ===== TOMBOL SIMPAN: BIRU GELAP ===== */
#form_edit.mentor-modal-simple .btn-primary {
    background: #074366 !important;
    border-color: #074366 !important;
    color: #ffffff !important;
    box-shadow: 0 8px 18px rgba(7, 67, 102, .22) !important;
}

#form_edit.mentor-modal-simple .btn-primary:hover {
    background: #052f49 !important;
    border-color: #052f49 !important;
    color: #ffffff !important;
}


</style>

<div class="modal fade mentor-modal-simple"
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
                    <h5 class="modal-title">Edit Mentor</h5>
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
                                        <i class="bi bi-trash fs-5"></i>
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
                                       minlength="6"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <h6 class="section-title">Profil Profesional</h6>

                            <div class="d-flex flex-column mb-3">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>Spesialisasi</span>
                                </label>
                                <input type="text"
                                       id="edit_spesialisasi"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       maxlength="150"/>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="d-flex flex-column mb-3">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>Bio</span>
                                </label>
                                <textarea id="edit_bio"
                                          class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                          rows="4"
                                          maxlength="1000"></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
