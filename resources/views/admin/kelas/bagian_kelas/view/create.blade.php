<div class="modal fade" id="form_create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="post" id="bt_submit_create">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Bagian Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="create_id_kelas" value="{{ $id }}">

                    <div class="row g-5">
                        <div class="col-lg-8">
                            <div class="p-4 border border-dashed border-gray-300 rounded-2 bg-light">
                                <div class="d-flex align-items-center mb-3">
                                    <span class="bullet bullet-dot bg-primary me-2"></span>
                                    <div class="fw-bold fs-7 text-gray-800">Informasi Bagian Kelas</div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">Judul Bagian</label>
                                    <input type="text" id="create_judul"
                                           class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                           maxlength="255"
                                           placeholder="Contoh: Pendahuluan, Dasar-dasar, Studi Kasus"
                                           required>
                                    <small class="text-muted fs-8 d-block mt-1">
                                        Gunakan judul yang ringkas namun mewakili isi materi di bagian ini.
                                    </small>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-0">
                                    <label class="form-label fs-sm-8 fs-lg-6 fw-bolder">Deskripsi</label>
                                    <div id="create_deskripsi_editor"
                                         class="border rounded-2 bg-white"
                                         style="min-height: 120px;"></div>
                                    <textarea id="create_deskripsi" class="d-none"></textarea>
                                    <small class="text-muted fs-8 d-block mt-1">
                                        Deskripsi akan membantu peserta memahami apa yang akan dipelajari pada bagian ini.
                                    </small>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="p-4 border border-dashed border-gray-300 rounded-2 h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <span class="bullet bullet-dot bg-success me-2"></span>
                                    <div class="fw-bold fs-7 text-gray-800">Pengaturan Urutan</div>
                                </div>

                                <div class="mb-0">
                                    <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">Urutan</label>
                                    <input type="number" id="create_urutan"
                                           class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                           min="0" value="0" required>
                                    <small class="text-muted fs-8 d-block mt-1">
                                        Tentukan posisi bagian ini dibanding bagian lain (0 untuk paling awal, 1, 2, dst).
                                    </small>
                                    <div class="invalid-feedback"></div>
                                </div>
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
