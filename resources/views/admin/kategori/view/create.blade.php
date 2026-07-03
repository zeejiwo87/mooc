<div class="modal fade" id="form_create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="post" id="bt_submit_create" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori Kelas</h5>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Kolom 2: Data Utama -->
                        <div class="col-md-6">
                            <h6 class="text-primary fw-bold mb-3 border-bottom border-primary pb-2">Data Utama</h6>

                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Nama Kategori</span>
                                </label>
                                <input type="text" id="nama" class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       maxlength="100" required/>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>Urutan Tampil</span>
                                </label>
                                <input type="number" id="urutan" class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       min="0" step="1"/>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-2 mt-3">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>Status</span>
                                </label>
                                <div class="d-flex align-items-center">
                                    <div class="form-check me-4">
                                        <input class="form-check-input" type="radio" name="aktif" id="aktif_ya" value="1" checked>
                                        <label class="form-check-label fs-sm-8 fs-lg-6" for="aktif_ya">
                                            Aktif
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="aktif" id="aktif_tidak" value="0">
                                        <label class="form-check-label fs-sm-8 fs-lg-6" for="aktif_tidak">
                                            Nonaktif
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom 3: Deskripsi -->
                        <div class="col-md-6">
                            <h6 class="text-primary fw-bold mb-3 border-bottom border-primary pb-2">Deskripsi</h6>

                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>Deskripsi</span>
                                </label>
                                <textarea id="deskripsi" class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                          rows="6" maxlength="1000"
                                          placeholder="Tuliskan deskripsi singkat kategori, misalnya jenis kelas yang termasuk."></textarea>
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
