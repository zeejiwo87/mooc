<style>
    /* =========================================================
       CREATE TAG
       Konsisten dengan tampilan Create Pengguna
    ========================================================= */

    #form_create.tag-modal-simple .modal-dialog {
        width: calc(100% - 48px);
        max-width: 900px;
        margin: 24px auto;
    }

    #form_create.tag-modal-simple .modal-dialog > form {
        width: 100%;
    }

    #form_create.tag-modal-simple .modal-content {
        width: 100%;
        overflow: hidden;
        border: 0;
        border-radius: 12px;
        background: #ffffff;
        box-shadow: 0 18px 50px rgba(15, 23, 42, .18);
    }

    /* Header */
    #form_create.tag-modal-simple .modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        min-height: auto;
        padding: 16px 18px;
        background: #ffffff;
        border-bottom: 1px solid #eef2f7;
    }

    #form_create.tag-modal-simple .modal-title {
        margin: 0;
        color: #111827;
        font-size: 18px;
        line-height: 1.4;
        font-weight: 800;
    }

    /* Tombol X tanpa background */
    #form_create.tag-modal-simple .btn-close {
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

    #form_create.tag-modal-simple .btn-close:hover {
        background-color: transparent !important;
        opacity: 1 !important;
    }

    #form_create.tag-modal-simple .btn-close:focus {
        outline: none;
        background-color: transparent !important;
        box-shadow: none !important;
    }

    /* Body */
    #form_create.tag-modal-simple .modal-body {
        padding: 24px;
        background: #ffffff;
    }

    #form_create.tag-modal-simple .section-title {
        margin: 0 0 18px;
        padding-bottom: 10px;
        color: #111827 !important;
        font-size: 14px;
        line-height: 1.4;
        font-weight: 800;
        border-bottom: 1px solid #e5e7eb !important;
    }

    #form_create.tag-modal-simple .form-field {
        width: 100%;
        margin: 0;
    }

    #form_create.tag-modal-simple label,
    #form_create.tag-modal-simple label span {
        color: #111827 !important;
        font-size: 13px;
        line-height: 1.4;
        font-weight: 800 !important;
    }

    #form_create.tag-modal-simple label {
        display: flex;
        align-items: center;
        margin-bottom: 8px !important;
    }

    /* Input */
    #form_create.tag-modal-simple .form-control {
        width: 100%;
        min-height: 42px;
        padding: 9px 12px;
        color: #111827;
        font-size: 14px;
        background: #ffffff;
        border: 1px solid #e5e7eb !important;
        border-radius: 8px !important;
        outline: none;
        box-shadow: none !important;
        transition:
            border-color .18s ease,
            box-shadow .18s ease;
    }

    #form_create.tag-modal-simple .form-control:hover {
        border-color: #cbd5e1 !important;
    }

    #form_create.tag-modal-simple .form-control:focus {
        border-color: #074366 !important;
        box-shadow: 0 0 0 .2rem rgba(7, 67, 102, .10) !important;
    }

    #form_create.tag-modal-simple .form-control::placeholder {
        color: #94a3b8;
    }

    #form_create.tag-modal-simple .invalid-feedback {
        margin-top: 5px;
        font-size: 12px;
        font-weight: 600;
    }

    #form_create.tag-modal-simple .form-text {
        margin-top: 7px;
        color: #64748b !important;
        font-size: 12px;
        line-height: 1.5;
    }

    /* Footer */
    #form_create.tag-modal-simple .modal-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 8px;
        padding: 14px 18px 18px;
        background: #ffffff;
        border-top: 1px solid #eef2f7;
    }

    #form_create.tag-modal-simple .modal-footer .btn {
        min-width: 100px;
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        margin: 0;
        padding: 8px 15px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
    }



    /* Tombol Simpan biru gelap */
    #form_create.tag-modal-simple .btn-primary {
        color: #ffffff !important;
        background: #074366 !important;
        border-color: #074366 !important;
        box-shadow: 0 8px 18px rgba(7, 67, 102, .22) !important;
    }

    #form_create.tag-modal-simple .btn-primary:hover,
    #form_create.tag-modal-simple .btn-primary:focus {
        color: #ffffff !important;
        background: #052f49 !important;
        border-color: #052f49 !important;
    }

    /* Tablet */
    @media (max-width: 991.98px) {
        #form_create.tag-modal-simple .modal-dialog {
            width: calc(100% - 32px);
            max-width: 760px;
            margin: 16px auto;
        }

        #form_create.tag-modal-simple .modal-body {
            padding: 20px;
        }
    }

    /* Mobile */
    @media (max-width: 575.98px) {
        #form_create.tag-modal-simple .modal-dialog {
            width: calc(100% - 20px);
            max-width: none;
            margin: 10px auto;
        }

        #form_create.tag-modal-simple .modal-content {
            border-radius: 10px;
        }

        #form_create.tag-modal-simple .modal-header {
            padding: 16px;
        }

        #form_create.tag-modal-simple .modal-title {
            font-size: 16px;
        }

        #form_create.tag-modal-simple .modal-body {
            padding: 16px;
        }

        #form_create.tag-modal-simple .modal-footer {
            flex-direction: column-reverse;
            align-items: stretch;
            padding: 14px 16px 16px;
        }

        #form_create.tag-modal-simple .modal-footer .btn {
            width: 100%;
            min-height: 42px;
        }
    }
</style>

<div class="modal fade tag-modal-simple"
     id="form_create"
     data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1"
     role="dialog"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered"
         role="document">

        <form method="post" id="bt_submit_create">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Tag</h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-12">
                            <h6 class="section-title">Data Tag</h6>

                            <div class="form-field">
                                <label class="required"
                                       for="nama">
                                    <span>Nama Tag</span>
                                </label>

                                <input type="text"
                                       id="nama"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       maxlength="100"
                                       placeholder="Masukkan nama tag"
                                       required/>

                                <div class="invalid-feedback"></div>

                                <div class="form-text">
                                    Slug akan dibuat otomatis berdasarkan nama tag.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                  

                    <button type="submit"
                            class="btn btn-primary btn-sm">
                        <i class="bi bi-check-circle"></i>
                        Simpan
                    </button>
                </div>

            </div>
        </form>

    </div>
</div>