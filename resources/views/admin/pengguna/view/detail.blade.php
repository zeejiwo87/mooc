
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
    /* ===== DETAIL PENGGUNA: STYLE TOMBOL SESUAI REQUEST ===== */

/* Judul section jadi hitam */
#form_detail .neo-section-title,
#form_detail .neo-detail-label,
#form_detail .neo-metric-label {
    color: #111827 !important;
}

#form_detail .neo-section-title {
    border-bottom-color: #e5e7eb !important;
}

#form_detail .neo-section-title i,
#form_detail .neo-detail-label i,
#form_detail .neo-metric-label i {
    color: #074366 !important;
}

/* X close: tanpa background */
#form_detail .neo-btn-close {
    background: transparent !important;
    background-color: transparent !important;
    border: 0 !important;
    box-shadow: none !important;
    color: #64748b !important;
    border-radius: 0 !important;
    opacity: .75 !important;
}

#form_detail .neo-btn-close:hover {
    background: transparent !important;
    background-color: transparent !important;
    color: #ef4444 !important;
    opacity: 1 !important;
    transform: none !important;
}

#form_detail .neo-btn-close i {
    color: inherit !important;
}

/* Tombol Tutup bawah: merah */
#form_detail .neo-btn-light {
    background: #ef4444 !important;
    border-color: #ef4444 !important;
    color: #ffffff !important;
    box-shadow: 0 8px 18px rgba(239, 68, 68, .18) !important;
}

#form_detail .neo-btn-light:hover {
    background: #dc2626 !important;
    border-color: #dc2626 !important;
    color: #ffffff !important;
}

#form_detail .neo-btn-light i {
    color: #ffffff !important;
}

/* ===== DETAIL PENGGUNA: X CLOSE TANPA BACKGROUND ===== */
#form_detail.pengguna-modal-simple .btn-close {
    background-color: transparent !important;
    background-image: var(--bs-btn-close-bg) !important;
    border: 0 !important;
    box-shadow: none !important;
    opacity: .65 !important;
    border-radius: 0 !important;
}

#form_detail.pengguna-modal-simple .btn-close:hover {
    background-color: transparent !important;
    background-image: var(--bs-btn-close-bg) !important;
    opacity: 1 !important;
}
</style>

<div class="modal fade pengguna-modal-simple"
     id="form_detail"
     data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1"
     role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pengguna</h5>
                <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>

            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="d-flex flex-column align-items-center mb-4 mb-md-0">
                            <h6 class="section-title w-100 text-center">Foto Profil</h6>

                            <div id="detail_foto_section">
                                <img id="detail_foto_preview"
                                     class="w-150px h-150px rounded border object-fit-cover"
                                     alt="Foto Pengguna"/>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <h6 class="section-title">Data Dasar</h6>

                        <div class="mb-3">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Nama</span>
                            </label>
                            <p id="detail_nama" class="detail-box mb-0"></p>
                        </div>

                        <div class="mb-3">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Email</span>
                            </label>
                            <p id="detail_email" class="detail-box mb-0"></p>
                        </div>

                        <div class="mb-3">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Telepon</span>
                            </label>
                            <p id="detail_telepon" class="detail-box mb-0"></p>
                        </div>

                        <div class="mb-3">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Terverifikasi</span>
                            </label>
                            <p id="detail_terverifikasi" class="detail-box mb-0"></p>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <h6 class="section-title">Informasi Tambahan</h6>

                        <div class="mb-3">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Bio</span>
                            </label>
                            <p id="detail_bio" class="detail-box long-text mb-0"></p>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="metric-box">
                                    <div class="metric-label">Kelas Selesai</div>
                                    <p id="detail_total_kelas_selesai" class="metric-value"></p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="metric-box">
                                    <div class="metric-label">Total Poin</div>
                                    <p id="detail_total_poin" class="metric-value"></p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Terakhir Login</span>
                            </label>
                            <p id="detail_last_login" class="detail-box mb-0"></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
