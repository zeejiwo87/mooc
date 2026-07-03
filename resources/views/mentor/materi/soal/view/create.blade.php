<div class="modal fade" id="form_create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="post" id="bt_submit_create" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Soal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="create_id_kuis" value="{{ $id }}">

                    <div class="row g-5">
                        <div class="col-lg-7">
                            <div class="p-4 border border-dashed border-gray-300 rounded-2 bg-light">
                                <div class="d-flex align-items-center mb-3">
                                    <span class="bullet bullet-dot bg-primary me-2"></span>
                                    <div class="fw-bold fs-7 text-gray-800">Informasi Soal</div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">Teks Soal</label>
                                    <textarea id="create_teks_soal"
                                              class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                              rows="4"
                                              placeholder="Tulis pertanyaan dengan jelas dan spesifik"
                                              required></textarea>
                                    <small class="text-muted fs-8 d-block mt-1">
                                        Hindari kalimat ambigu dan pastikan hanya ada satu interpretasi benar dari soal.
                                    </small>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-0">
                                    <label class="form-label fs-sm-8 fs-lg-6 fw-bolder">Penjelasan (tampilkan setelah kuis)</label>
                                    <textarea id="create_penjelasan"
                                              class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                              rows="3"
                                              placeholder="Opsional. Jelaskan alasan jawaban yang benar atau berikan pembahasan singkat."></textarea>
                                    <small class="text-muted fs-8 d-block mt-1">
                                        Penjelasan membantu peserta belajar dari kesalahan setelah menyelesaikan kuis.
                                    </small>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="p-4 border border-dashed border-gray-300 rounded-2 h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <span class="bullet bullet-dot bg-success me-2"></span>
                                    <div class="fw-bold fs-7 text-gray-800">Pengaturan Tambahan</div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fs-sm-8 fs-lg-6 fw-bolder">Gambar Soal (opsional)</label>
                                    <input type="file" id="create_gambar_soal"
                                           class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                           accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                                    <small class="text-muted fs-8 d-block mt-1">
                                        Opsional. Format yang diizinkan: JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                                    </small>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-0">
                                    <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">Nilai</label>
                                    <input type="number" id="create_nilai"
                                           class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                           min="1"
                                           placeholder="Bobot nilai untuk soal ini"
                                           required>
                                    <small class="text-muted fs-8 d-block mt-1">
                                        Soal yang lebih sulit sebaiknya memiliki bobot nilai lebih tinggi.
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