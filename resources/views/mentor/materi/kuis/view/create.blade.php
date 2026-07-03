<div class="modal fade" id="form_create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="post" id="bt_submit_create">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kuis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="create_id_materi" value="{{ $id }}">

                    <div class="row g-5">
                        <div class="col-lg-7">
                            <div class="mb-4">
                                <span class="badge badge-light-primary fs-8 mb-2">Informasi Kuis</span>
                                <div class="text-muted fs-8">
                                    Gunakan judul dan deskripsi yang jelas agar peserta memahami tujuan kuis ini.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">Judul Kuis</label>
                                <input type="text" id="create_judul"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       maxlength="255"
                                       placeholder="Contoh: Kuis Akhir Bab 1"
                                       required>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder">Deskripsi Singkat</label>
                                <input type="text" id="create_deskripsi"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       maxlength="255"
                                       placeholder="Penjelasan singkat mengenai cakupan kuis">
                                <small class="text-muted fs-8 d-block mt-1">
                                    Deskripsi membantu peserta mengetahui materi apa saja yang akan diujikan.
                                </small>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder">Instruksi</label>
                                <textarea id="create_instruksi"
                                          class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                          rows="4"
                                          placeholder="Instruksi penting untuk peserta, misalnya cara menjawab, batas waktu, dan ketentuan lain."></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="mb-4">
                                <span class="badge badge-light-success fs-8 mb-2">Pengaturan Kuis</span>
                                <div class="text-muted fs-8">
                                    Atur tipe, durasi, nilai lulus, dan perilaku kuis agar sesuai tujuan evaluasi.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">Tipe Kuis</label>
                                <select id="create_tipe"
                                        data-control="select2"
                                        class="form-select form-select-sm fs-sm-8 fs-lg-6" data-allow-clear="true"
                                        data-placeholder="Pilih tipe kuis"
                                        data-dropdown-parent="#form_create"
                                        required>
                                    <option value="kuis_materi">Kuis Materi</option>
                                    <option value="ujian_akhir">Ujian Akhir</option>
                                </select>
                                <small class="text-muted fs-8 d-block mt-1">
                                    <strong>Kuis Materi</strong> cocok untuk latihan per bab, sedangkan <strong>Ujian Akhir</strong> untuk evaluasi keseluruhan.
                                </small>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">Durasi (menit)</label>
                                <input type="number" id="create_durasi_menit"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       min="1"
                                       placeholder="Contoh: 30"
                                       required>
                                <small class="text-muted fs-8 d-block mt-1">
                                    Durasi dihitung sejak peserta memulai kuis hingga waktu habis.
                                </small>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">Nilai Lulus</label>
                                <input type="number" id="create_nilai_lulus"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       min="0" max="100"
                                       placeholder="Minimal nilai kelulusan, 0 - 100"
                                       required>
                                <small class="text-muted fs-8 d-block mt-1">
                                    Tentukan standar kelulusan, misalnya 70 atau 80.
                                </small>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder">Pengaturan Kuis</label>
                                <div class="form-check form-switch mb-1">
                                    <input class="form-check-input" type="checkbox" id="create_tampilkan_jawaban_benar">
                                    <label class="form-check-label fs-sm-8 fs-lg-6" for="create_tampilkan_jawaban_benar">
                                        Tampilkan jawaban benar setelah selesai
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-1">
                                    <input class="form-check-input" type="checkbox" id="create_acak_soal">
                                    <label class="form-check-label fs-sm-8 fs-lg-6" for="create_acak_soal">
                                        Acak urutan soal
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-1">
                                    <input class="form-check-input" type="checkbox" id="create_acak_jawaban">
                                    <label class="form-check-label fs-sm-8 fs-lg-6" for="create_acak_jawaban">
                                        Acak urutan jawaban
                                    </label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="create_aktif" checked>
                                    <label class="form-check-label fs-sm-8 fs-lg-6" for="create_aktif">
                                        Kuis aktif
                                    </label>
                                </div>
                                <small class="text-muted fs-8 d-block mt-2">
                                    Kombinasikan pengacakan soal dan jawaban untuk mengurangi kemungkinan saling mencontek antar peserta.
                                </small>
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
