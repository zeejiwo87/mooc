<div class="modal fade" id="form_create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="post" id="bt_submit_create">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Tujuan Pembelajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="create_id_kelas" value="{{ $id }}">

                    <div class="row g-5">
                        <div class="col-lg-8">
                            <div class="p-4 border border-dashed border-gray-300 rounded-2 bg-light">
                                <div class="d-flex align-items-center mb-3">
                                    <span class="bullet bullet-dot bg-primary me-2"></span>
                                    <div class="fw-bold fs-7 text-gray-800">Tujuan Pembelajaran</div>
                                </div>

                                <div class="mb-0">
                                    <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">Tujuan Pembelajaran</label>
                                    <textarea id="create_tujuan"
                                              class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                              rows="3" maxlength="500"
                                              placeholder="Contoh: Setelah mengikuti kelas ini, peserta mampu menjelaskan konsep dasar hukum keluarga Islam."
                                              required></textarea>
                                    <small class="text-muted fs-8 d-block mt-1">
                                        Rumuskan tujuan dengan kata kerja yang terukur (menjelaskan, menganalisis, menerapkan, dll.).
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
                                           min="1" required>
                                    <small class="text-muted fs-8 d-block mt-1">
                                        Atur urutan tujuan pembelajaran sesuai alur materi (1, 2, 3, dst.).
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
