<div class="modal fade" id="form_create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" id="bt_submit_create">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pendaftaran</h5>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h6 class="text-primary fw-bold mb-3 border-bottom border-primary pb-2">Data Pendaftaran</h6>

                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Pengguna</span>
                                </label>
                                <select data-control="select2" id="id_pengguna"
                                        class="form-select form-select-sm fs-sm-8 fs-lg-6" data-allow-clear="true"
                                        data-placeholder="Pilih Pengguna" data-dropdown-parent="#form_create" required>
                                    <option></option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Kelas</span>
                                </label>
                                <select data-control="select2" id="id_kelas"
                                        class="form-select form-select-sm fs-sm-8 fs-lg-6" data-allow-clear="true"
                                        data-placeholder="Pilih Kelas" data-dropdown-parent="#form_create" required>
                                    <option></option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>Terdaftar Pada</span>
                                </label>
                                <input type="text" id="terdaftar_pada"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       placeholder="Pilih tanggal & waktu"/>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Status</span>
                                </label>
                                <select id="status" data-control="select2" class="form-select form-select-sm fs-sm-8 fs-lg-6" data-allow-clear="true"
                                        data-placeholder="Pilih Status" data-dropdown-parent="#form_create" required>
                                    <option value="aktif" selected>Aktif</option>
                                    <option value="selesai">Selesai</option>
                                </select>
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
