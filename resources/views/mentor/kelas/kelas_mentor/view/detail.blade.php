<style>
    #form_detail .modal-content {
        background: #ffffff !important;
        border: 1px solid #e5e7eb !important;
        border-radius: 12px !important;
        box-shadow: none !important;
        overflow: hidden;
    }

    #form_detail .modal-header {
        padding: 16px 20px;
        background: #ffffff !important;
        border-bottom: 1px solid #eef2f7 !important;
    }

    #form_detail .modal-title {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #111827 !important;
        font-size: 18px;
        font-weight: 800;
        margin: 0;
    }

    #form_detail .modal-title i {
        color: #074366 !important;
    }

    #form_detail .btn-close {
        width: 32px;
        height: 32px;
        padding: 0 !important;
        margin: 0 !important;
        background-color: transparent !important;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        opacity: .75;
    }

    #form_detail .btn-close:hover {
        opacity: 1;
    }

    #form_detail .modal-body {
        padding: 20px;
        background: #ffffff !important;
    }

    #form_detail .detail-info-box {
        padding: 14px 16px;
        margin-bottom: 18px;
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        box-shadow: none !important;
    }

    #form_detail .detail-info-title {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 6px;
        color: #111827;
        font-size: 14px;
        font-weight: 800;
    }

    #form_detail .detail-info-title i {
        color: #074366;
    }

    #form_detail .detail-info-text {
        margin: 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.55;
        font-weight: 600;
    }

    #form_detail dl {
        margin: 0;
    }

    #form_detail dt {
        color: #64748b !important;
        font-size: 13px;
        font-weight: 800 !important;
    }

    #form_detail dd {
        color: #111827 !important;
        font-size: 14px;
        font-weight: 700 !important;
        margin-bottom: 14px;
    }

    #form_detail dd:last-child {
        margin-bottom: 0;
    }

    #form_detail #detail_peran {
        display: inline-flex;
        align-items: center;
        min-height: 30px;
        padding: 7px 11px !important;
        color: #ffffff !important;
        background: #074366 !important;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 800;
    }

    #form_detail .modal-footer {
        padding: 14px 20px 18px;
        background: #ffffff !important;
        border-top: 1px solid #eef2f7 !important;
    }

    #form_detail .btn-light {
        min-height: 38px;
        padding: 8px 16px;
        color: #ffffff !important;
        background: #ef4444 !important;
        border: 1px solid #ef4444 !important;
        border-radius: 8px !important;
        box-shadow: none !important;
        font-size: 13px;
        font-weight: 700;
    }

    #form_detail .btn-light:hover {
        background: #dc2626 !important;
        border-color: #dc2626 !important;
    }

    @media (max-width: 575.98px) {
        #form_detail .modal-body {
            padding: 16px;
        }

        #form_detail .modal-footer {
            padding: 14px 16px 16px;
        }

        #form_detail .btn-light {
            width: 100%;
        }
    }
</style>

<div class="modal fade" id="form_detail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-person-vcard"></i>
                    Detail Asisten Mentor
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="detail-info-box">
                    <div class="detail-info-title">
                        <i class="bi bi-info-circle-fill"></i>
                        Informasi Asisten Mentor
                    </div>

                    <p class="detail-info-text">
                        Data ini menampilkan detail asisten mentor yang terlibat dalam kelas.
                        Mentor utama tetap ditentukan oleh pemilik kelas.
                    </p>
                </div>

                <dl class="row mb-0">
                    <dt class="col-sm-4">Kelas</dt>
                    <dd class="col-sm-8" id="detail_kelas_judul">-</dd>

                    <dt class="col-sm-4">Nama Asisten Mentor</dt>
                    <dd class="col-sm-8" id="detail_mentor_nama">-</dd>

                    <dt class="col-sm-4">Peran</dt>
                    <dd class="col-sm-8">
                        <span class="badge" id="detail_peran">
                            Asisten Mentor
                        </span>
                    </dd>
                </dl>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>

        </div>
    </div>
</div>