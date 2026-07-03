<div class="modal fade" id="form_edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="post" id="bt_submit_edit" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Soal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="edit_id_kuis" value="{{ $id }}">
                    <input type="hidden" id="edit_id_soal">

                    <div class="row g-5">
                        <div class="col-lg-7">
                            <div class="p-4 border border-dashed border-gray-300 rounded-2 bg-light">
                                <div class="d-flex align-items-center mb-3">
                                    <span class="bullet bullet-dot bg-primary me-2"></span>
                                    <div class="fw-bold fs-7 text-gray-800">Informasi Soal</div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">Teks Soal</label>
                                    <textarea id="edit_teks_soal"
                                              class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                              rows="4"
                                              placeholder="Perbarui teks soal agar tetap jelas dan tidak membingungkan"
                                              required></textarea>
                                    <small class="text-muted fs-8 d-block mt-1">
                                        Jika mengubah soal, periksa kembali relevansi opsi jawaban yang sudah ada.
                                    </small>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-0">
                                    <label class="form-label fs-sm-8 fs-lg-6 fw-bolder">Penjelasan</label>
                                    <textarea id="edit_penjelasan"
                                              class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                              rows="3"
                                              placeholder="Perbaiki atau lengkapi pembahasan jawaban jika diperlukan."></textarea>
                                    <small class="text-muted fs-8 d-block mt-1">
                                        Penjelasan yang baik membantu peserta memahami konsep, bukan sekadar menghafal jawaban.
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
                                    <input type="file" id="edit_gambar_soal"
                                           class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                           accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                                    <div class="invalid-feedback"></div>
                                    <small class="text-muted fs-8 d-block mt-1" id="edit_gambar_soal_info"></small>
                                    <small class="text-muted fs-8 d-block mt-1">
                                        Format yang diizinkan: JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                                    </small>
                                </div>

                                <div class="mb-0">
                                    <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">Nilai</label>
                                    <input type="number" id="edit_nilai"
                                           class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                           min="1"
                                           placeholder="Bobot nilai soal"
                                           required>
                                    <small class="text-muted fs-8 d-block mt-1">
                                        Sesuaikan bobot nilai jika tingkat kesulitan soal berubah.
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