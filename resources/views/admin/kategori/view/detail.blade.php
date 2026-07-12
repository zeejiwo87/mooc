<style>
    /* =========================================================
       DETAIL KATEGORI
       Tampilan sederhana dan responsive
    ========================================================= */

    #form_detail.kategori-modal-simple .modal-dialog {
        width: calc(100% - 48px);
        max-width: 900px;
        margin: 24px auto;
    }

    #form_detail.kategori-modal-simple .modal-content {
        width: 100%;
        overflow: hidden;
        border: 0;
        border-radius: 12px;
        background: #ffffff;
        box-shadow: 0 18px 50px rgba(15, 23, 42, .18);
    }

    #form_detail.kategori-modal-simple .modal-header {
        min-height: auto;
        padding: 16px 18px;
        background: #ffffff;
        border-bottom: 1px solid #eef2f7;
    }

    #form_detail.kategori-modal-simple .modal-title {
        margin: 0;
        color: #111827;
        font-size: 18px;
        font-weight: 800;
    }

    #form_detail.kategori-modal-simple .btn-close {
        width: 32px;
        height: 32px;
        min-width: 32px;
        margin: 0;
        padding: 0;
        border: 0 !important;
        border-radius: 0 !important;
        background-color: transparent !important;
        box-shadow: none !important;
        opacity: .75 !important;
    }

    #form_detail.kategori-modal-simple .btn-close:hover {
        opacity: 1 !important;
    }

    #form_detail.kategori-modal-simple .btn-close:focus {
        outline: none;
        box-shadow: none !important;
    }

    #form_detail.kategori-modal-simple .modal-body {
        padding: 24px;
        background: #ffffff;
    }

    #form_detail.kategori-modal-simple .section-title {
        margin: 0 0 18px;
        padding-bottom: 10px;
        color: #111827;
        font-size: 14px;
        font-weight: 800;
        border-bottom: 1px solid #e5e7eb;
    }

    #form_detail.kategori-modal-simple .detail-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
        gap: 24px;
    }

    #form_detail.kategori-modal-simple .detail-main-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 14px;
    }

    #form_detail.kategori-modal-simple .detail-metric-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    #form_detail.kategori-modal-simple .detail-label {
        display: block;
        margin: 0 0 8px;
        color: #111827;
        font-size: 13px;
        font-weight: 800;
    }

    #form_detail.kategori-modal-simple .detail-value {
        width: 100%;
        min-height: 42px;
        margin: 0;
        padding: 10px 12px;
        color: #111827;
        font-size: 14px;
        line-height: 1.5;
        font-weight: 600;
        word-break: break-word;
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
    }

    #form_detail.kategori-modal-simple .detail-value:empty::before {
        content: "-";
        color: #94a3b8;
    }

    #form_detail.kategori-modal-simple .detail-value.long-text {
        min-height: 150px;
        white-space: pre-line;
    }

    @media (max-width: 767.98px) {
        #form_detail.kategori-modal-simple .modal-dialog {
            width: calc(100% - 24px);
            margin: 12px auto;
        }

        #form_detail.kategori-modal-simple .modal-body {
            padding: 18px;
        }

        #form_detail.kategori-modal-simple .detail-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }

    @media (max-width: 575.98px) {
        #form_detail.kategori-modal-simple .modal-dialog {
            width: calc(100% - 20px);
            margin: 10px auto;
        }

        #form_detail.kategori-modal-simple .modal-header,
        #form_detail.kategori-modal-simple .modal-body {
            padding-left: 16px;
            padding-right: 16px;
        }

        #form_detail.kategori-modal-simple .detail-metric-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="modal fade kategori-modal-simple"
     id="form_detail"
     data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1"
     role="dialog"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Detail Kategori Kelas</h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>

            <div class="modal-body">
                <div class="detail-grid">
                    <div>
                        <h6 class="section-title">Data Utama</h6>

                        <div class="detail-main-grid">
                            <div>
                                <label class="detail-label">Nama Kategori</label>
                                <p id="detail_nama" class="detail-value"></p>
                            </div>

                            <div class="detail-metric-grid">
                                <div>
                                    <label class="detail-label">Urutan</label>
                                    <p id="detail_urutan" class="detail-value"></p>
                                </div>

                                <div>
                                    <label class="detail-label">Status</label>
                                    <p id="detail_aktif" class="detail-value"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h6 class="section-title">Deskripsi</h6>

                        <div>
                            <label class="detail-label">Deskripsi</label>
                            <p id="detail_deskripsi"
                               class="detail-value long-text"></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
