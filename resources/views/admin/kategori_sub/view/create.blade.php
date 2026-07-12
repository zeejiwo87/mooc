<style>
    /* =========================================================
       CREATE SUB KATEGORI
       Tampilan sederhana dan konsisten
    ========================================================= */

    #form_create.subkategori-modal-simple .modal-dialog {
        width: calc(100% - 48px);
        max-width: 900px;
        margin: 24px auto;
    }

    #form_create.subkategori-modal-simple .modal-dialog > form {
        width: 100%;
    }

    #form_create.subkategori-modal-simple .modal-content {
        width: 100%;
        overflow: hidden;
        border: 0;
        border-radius: 12px;
        background: #ffffff;
        box-shadow: 0 18px 50px rgba(15, 23, 42, .18);
    }

    #form_create.subkategori-modal-simple .modal-header {
        min-height: auto;
        padding: 16px 18px;
        background: #ffffff;
        border-bottom: 1px solid #eef2f7;
    }

    #form_create.subkategori-modal-simple .modal-title {
        margin: 0;
        color: #111827;
        font-size: 18px;
        font-weight: 800;
    }

    #form_create.subkategori-modal-simple .btn-close {
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

    #form_create.subkategori-modal-simple .btn-close:hover {
        opacity: 1 !important;
    }

    #form_create.subkategori-modal-simple .btn-close:focus {
        outline: none;
        box-shadow: none !important;
    }

    #form_create.subkategori-modal-simple .modal-body {
        padding: 24px;
        background: #ffffff;
    }

    #form_create.subkategori-modal-simple .section-title {
        margin: 0 0 18px;
        padding-bottom: 10px;
        color: #111827;
        font-size: 14px;
        font-weight: 800;
        border-bottom: 1px solid #e5e7eb;
    }

    #form_create.subkategori-modal-simple label,
    #form_create.subkategori-modal-simple label span {
        color: #111827;
        font-size: 13px;
        font-weight: 800;
    }

    #form_create.subkategori-modal-simple .form-control,
    #form_create.subkategori-modal-simple .form-select,
    #form_create.subkategori-modal-simple .select2-container--bootstrap5 .select2-selection {
        min-height: 42px;
        color: #111827 !important;
        background: #ffffff !important;
        border: 1px solid #e5e7eb !important;
        border-radius: 8px !important;
        box-shadow: none !important;
    }

    #form_create.subkategori-modal-simple .form-control,
    #form_create.subkategori-modal-simple .form-select {
        padding: 9px 12px;
        font-size: 14px;
    }

    #form_create.subkategori-modal-simple textarea.form-control {
        min-height: 150px;
        resize: vertical;
    }

    #form_create.subkategori-modal-simple .form-control:focus,
    #form_create.subkategori-modal-simple .form-select:focus {
        border-color: #074366 !important;
        box-shadow: 0 0 0 .2rem rgba(7, 67, 102, .10) !important;
    }

    #form_create.subkategori-modal-simple .select2-container {
        width: 100% !important;
    }

    #form_create.subkategori-modal-simple .select2-container--bootstrap5 .select2-selection {
        display: flex;
        align-items: center;
        padding: 7px 12px;
    }

    #form_create.subkategori-modal-simple .invalid-feedback {
        margin-top: 5px;
        font-size: 12px;
        font-weight: 600;
    }

    #form_create.subkategori-modal-simple .status-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
    }

    #form_create.subkategori-modal-simple .radio-option {
        min-height: 42px;
        display: flex;
        align-items: center;
        gap: 9px;
        margin: 0;
        padding: 9px 11px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        background: #f8fafc;
        cursor: pointer;
    }

    #form_create.subkategori-modal-simple .radio-option .form-check-input {
        margin: 0;
    }

    #form_create.subkategori-modal-simple .radio-option .form-check-input:checked {
        background-color: #074366;
        border-color: #074366;
    }

    #form_create.subkategori-modal-simple .modal-footer {
        gap: 8px;
        padding: 14px 18px 18px;
        background: #ffffff;
        border-top: 1px solid #eef2f7;
    }

    #form_create.subkategori-modal-simple .modal-footer .btn {
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

    #form_create.subkategori-modal-simple .btn-light {
        color: #ffffff !important;
        background: #ef4444 !important;
        border-color: #ef4444 !important;
        box-shadow: 0 8px 18px rgba(239, 68, 68, .18) !important;
    }

    #form_create.subkategori-modal-simple .btn-light:hover {
        background: #dc2626 !important;
        border-color: #dc2626 !important;
    }

    #form_create.subkategori-modal-simple .btn-primary {
        color: #ffffff !important;
        background: #074366 !important;
        border-color: #074366 !important;
        box-shadow: 0 8px 18px rgba(7, 67, 102, .22) !important;
    }

    #form_create.subkategori-modal-simple .btn-primary:hover {
        background: #052f49 !important;
        border-color: #052f49 !important;
    }

    @media (max-width: 767.98px) {
        #form_create.subkategori-modal-simple .modal-dialog {
            width: calc(100% - 24px);
            margin: 12px auto;
        }

        #form_create.subkategori-modal-simple .modal-body {
            padding: 18px;
        }
    }

    @media (max-width: 575.98px) {
        #form_create.subkategori-modal-simple .modal-dialog {
            width: calc(100% - 20px);
            margin: 10px auto;
        }

        #form_create.subkategori-modal-simple .modal-header,
        #form_create.subkategori-modal-simple .modal-body {
            padding-left: 16px;
            padding-right: 16px;
        }

        #form_create.subkategori-modal-simple .status-grid {
            grid-template-columns: 1fr;
        }

        #form_create.subkategori-modal-simple .modal-footer {
            flex-direction: column-reverse;
            align-items: stretch;
            padding: 14px 16px 16px;
        }

        #form_create.subkategori-modal-simple .modal-footer .btn {
            width: 100%;
        }
    }
</style>

<div class="modal fade subkategori-modal-simple"
     id="form_create"
     data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1"
     role="dialog"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="post" id="bt_submit_create" enctype="multipart/form-data">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Sub Kategori Kelas</h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <h6 class="section-title">Data Utama</h6>

                            <div class="d-flex flex-column mb-3">
                                <label class="required mb-2" for="id_kategori">
                                    <span>Kategori</span>
                                </label>

                                <select data-control="select2"
                                        id="id_kategori"
                                        class="form-select form-select-sm"
                                        data-allow-clear="true"
                                        data-placeholder="Kategori"
                                        data-dropdown-parent="#form_create"
                                        required>
                                    <option></option>
                                </select>

                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="d-flex flex-column mb-3">
                                <label class="required mb-2" for="nama">
                                    <span>Nama Sub Kategori</span>
                                </label>

                                <input type="text"
                                       id="nama"
                                       class="form-control form-control-sm"
                                       maxlength="100"
                                       placeholder="Masukkan nama sub kategori"
                                       required/>

                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="d-flex flex-column mb-3">
                                <label class="mb-2" for="urutan">
                                    <span>Urutan Tampil</span>
                                </label>

                                <input type="number"
                                       id="urutan"
                                       class="form-control form-control-sm"
                                       min="0"
                                       step="1"
                                       placeholder="Masukkan urutan tampil"/>

                                <div class="invalid-feedback"></div>
                            </div>

                            <div>
                                <label class="mb-2">
                                    <span>Status</span>
                                </label>

                                <div class="status-grid">
                                    <label class="radio-option" for="aktif_ya">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="aktif"
                                               id="aktif_ya"
                                               value="1"
                                               checked>
                                        <span>Aktif</span>
                                    </label>

                                    <label class="radio-option" for="aktif_tidak">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="aktif"
                                               id="aktif_tidak"
                                               value="0">
                                        <span>Nonaktif</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h6 class="section-title">Deskripsi</h6>

                            <div class="d-flex flex-column">
                                <label class="mb-2" for="deskripsi">
                                    <span>Deskripsi</span>
                                </label>

                                <textarea id="deskripsi"
                                          name="deskripsi"
                                          class="form-control form-control-sm"
                                          rows="6"
                                          maxlength="1000"
                                          placeholder="Tuliskan deskripsi singkat sub kategori."></textarea>

                                <div class="invalid-feedback"></div>
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
