<div class="modal fade" id="form_edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="post" id="bt_submit_edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Bagian Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_id_kelas" value="{{ $id }}">
                    <input type="hidden" id="edit_id_bagian_kelas">

                    <div class="row g-5">
                        <div class="col-lg-8">
                            <div class="p-4 border border-dashed border-gray-300 rounded-2 bg-light">
                                <div class="d-flex align-items-center mb-3">
                                    <span class="bullet bullet-dot bg-primary me-2"></span>
                                    <div class="fw-bold fs-7 text-gray-800">Informasi Bagian Kelas</div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">Judul Bagian</label>
                                    <input type="text" id="edit_judul"
                                           class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                           maxlength="255"
                                           placeholder="Judul yang mewakili isi materi di bagian ini"
                                           required>
                                    <small class="text-muted fs-8 d-block mt-1">
                                        Ubah judul hanya jika memang perlu, agar peserta tidak bingung dengan perubahan nama bagian.
                                    </small>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-0">
                                    <label class="form-label fs-sm-8 fs-lg-6 fw-bolder">Deskripsi</label>
                                    <div id="edit_deskripsi_editor"
                                         class="border rounded-2 bg-white"
                                         style="min-height: 120px;"></div>
                                    <textarea id="edit_deskripsi" class="d-none"></textarea>
                                    <small class="text-muted fs-8 d-block mt-1">
                                        Deskripsi yang baik membantu peserta memahami konteks perubahan pada bagian ini.
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
                                    <input type="number" id="edit_urutan"
                                           class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                           min="0" required>
                                    <small class="text-muted fs-8 d-block mt-1">
                                        Ubah urutan jika bagian ini perlu dipindahkan ke posisi yang lebih awal atau lebih akhir.
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
