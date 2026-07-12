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
</style>

<div class="modal fade mentor-modal-simple"
     id="form_detail"
     data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1"
     role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Mentor</h5>
                <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>

            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="d-flex flex-column align-items-center mb-4 mb-md-0">
                            <h6 class="section-title w-100 text-center">Foto Profil</h6>

                            <div id="detail_foto_section">
                                <div class="rounded border bg-light d-flex align-items-center justify-content-center"
                                     style="width:150px;height:150px;overflow:hidden;">
                                    <img id="detail_foto_preview"
                                         class="w-100 h-100"
                                         style="object-fit:cover;"
                                         alt="Foto Mentor"/>
                                </div>
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
                    </div>

                    <div class="col-md-5">
                        <h6 class="section-title">Profil Profesional</h6>

                        <div class="mb-3">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Spesialisasi</span>
                            </label>
                            <p id="detail_spesialisasi" class="detail-box mb-0"></p>
                        </div>

                        <div class="mb-3">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Bio</span>
                            </label>
                            <p id="detail_bio" class="detail-box long-text mb-0"></p>
                        </div>

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="metric-box">
                                    <div class="metric-label">Total Peserta</div>
                                    <p id="detail_total_siswa" class="metric-value"></p>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="metric-box">
                                    <div class="metric-label">Rating Rata-rata</div>
                                    <p id="detail_rating_rata" class="metric-value"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
