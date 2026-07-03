<div class="modal fade" id="form_create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="post" id="bt_submit_create">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jawaban</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="create_id_soal" value="{{ $id }}">

                    <div class="p-4 border border-dashed border-gray-300 rounded-2 bg-light">
                        <div class="d-flex align-items-center mb-3">
                            <span class="bullet bullet-dot bg-primary me-2"></span>
                            <div class="fw-bold fs-7 text-gray-800">Opsi Jawaban</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">Teks Jawaban</label>
                            <textarea id="create_teks_jawaban"
                                      class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                      rows="3"
                                      placeholder="Tulis opsi jawaban yang singkat dan jelas"
                                      required></textarea>
                            <small class="text-muted fs-8 d-block mt-1">
                                Hindari jawaban yang terlalu mirip satu sama lain agar peserta tidak bingung.
                            </small>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-0">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="create_benar">
                                <label class="form-check-label fs-sm-8 fs-lg-6" for="create_benar">
                                    Tandai sebagai jawaban benar
                                </label>
                            </div>
                            <small class="text-muted fs-8 d-block mt-1">
                                Untuk soal pilihan ganda tunggal, pastikan hanya satu jawaban yang ditandai benar.
                            </small>
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
