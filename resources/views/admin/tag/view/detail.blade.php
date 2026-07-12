<style>
    /* =========================================================
       DETAIL TAG
       Tampilan sederhana, lebar, dan responsive
    ========================================================= */

    #form_detail.tag-modal-simple .modal-dialog {
        width: calc(100% - 48px);
        max-width: 900px;
        margin: 24px auto;
    }

    #form_detail.tag-modal-simple .modal-content {
        width: 100%;
        overflow: hidden;
        border: 0;
        border-radius: 12px;
        background: #ffffff;
        box-shadow: 0 18px 50px rgba(15, 23, 42, .18);
    }

    /* Header */
    #form_detail.tag-modal-simple .modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        min-height: auto;
        padding: 16px 18px;
        background: #ffffff;
        border-bottom: 1px solid #eef2f7;
    }

    #form_detail.tag-modal-simple .modal-title {
        margin: 0;
        color: #111827;
        font-size: 18px;
        line-height: 1.4;
        font-weight: 800;
    }

    /* Tombol X tanpa background */
    #form_detail.tag-modal-simple .btn-close {
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

    #form_detail.tag-modal-simple .btn-close:hover {
        background-color: transparent !important;
        opacity: 1 !important;
    }

    #form_detail.tag-modal-simple .btn-close:focus {
        outline: none;
        background-color: transparent !important;
        box-shadow: none !important;
    }

    /* Body */
    #form_detail.tag-modal-simple .modal-body {
        padding: 24px;
        background: #ffffff;
    }

    #form_detail.tag-modal-simple .section-title {
        margin: 0 0 18px;
        padding-bottom: 10px;
        color: #111827;
        font-size: 14px;
        line-height: 1.4;
        font-weight: 800;
        border-bottom: 1px solid #e5e7eb;
    }

    #form_detail.tag-modal-simple .detail-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
    }

    #form_detail.tag-modal-simple .detail-field {
        min-width: 0;
    }

    #form_detail.tag-modal-simple .detail-label {
        display: block;
        margin: 0 0 8px;
        color: #111827;
        font-size: 13px;
        line-height: 1.4;
        font-weight: 800;
    }

    #form_detail.tag-modal-simple .detail-value {
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

    #form_detail.tag-modal-simple .detail-value:empty::before {
        content: "-";
        color: #94a3b8;
        font-weight: 600;
    }

    /* Tablet */
    @media (max-width: 991.98px) {
        #form_detail.tag-modal-simple .modal-dialog {
            width: calc(100% - 32px);
            max-width: 760px;
            margin: 16px auto;
        }

        #form_detail.tag-modal-simple .modal-body {
            padding: 20px;
        }

        #form_detail.tag-modal-simple .detail-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        #form_detail.tag-modal-simple .detail-field:last-child {
            grid-column: 1 / -1;
        }
    }

    /* Mobile */
    @media (max-width: 575.98px) {
        #form_detail.tag-modal-simple .modal-dialog {
            width: calc(100% - 20px);
            max-width: none;
            margin: 10px auto;
        }

        #form_detail.tag-modal-simple .modal-content {
            border-radius: 10px;
        }

        #form_detail.tag-modal-simple .modal-header {
            padding: 16px;
        }

        #form_detail.tag-modal-simple .modal-title {
            font-size: 16px;
        }

        #form_detail.tag-modal-simple .modal-body {
            padding: 16px;
        }

        #form_detail.tag-modal-simple .detail-grid {
            grid-template-columns: 1fr;
            gap: 14px;
        }

        #form_detail.tag-modal-simple .detail-field:last-child {
            grid-column: auto;
        }
    }
</style>

<div class="modal fade tag-modal-simple"
     id="form_detail"
     data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1"
     role="dialog"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered"
         role="document">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Detail Tag</h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>

            <div class="modal-body">
                <h6 class="section-title">Data Tag</h6>

                <div class="detail-grid">
                    <div class="detail-field">
                        <label class="detail-label">Nama Tag</label>
                        <p id="detail_nama"
                           class="detail-value"></p>
                    </div>

                    <div class="detail-field">
                        <label class="detail-label">Slug</label>
                        <p id="detail_slug"
                           class="detail-value"></p>
                    </div>

                    <div class="detail-field">
                        <label class="detail-label">Total Kelas</label>
                        <p id="detail_total_kelas"
                           class="detail-value"></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
