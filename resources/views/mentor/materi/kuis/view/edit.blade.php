<div class="modal fade" id="form_edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="post" id="bt_submit_edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kuis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="edit_id_materi" value="{{ $id }}">
                    <input type="hidden" id="edit_id_kuis">

                    <div class="row g-5">
                        <div class="col-lg-7">
                            <div class="mb-4">
                                <span class="badge badge-light-primary fs-8 mb-2">Informasi Kuis</span>
                                <div class="text-muted fs-8">
                                    Perbarui judul dan deskripsi dengan jelas agar peserta tetap memahami tujuan kuis.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">Judul Kuis</label>
                                <input type="text" id="edit_judul"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       maxlength="255"
                                       placeholder="Judul kuis yang singkat dan deskriptif"
                                       required>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder">Deskripsi Singkat</label>
                                <input type="text" id="edit_deskripsi"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       maxlength="255"
                                       placeholder="Ringkasan materi yang diujikan dalam kuis ini">
                                <small class="text-muted fs-8 d-block mt-1">
                                    Sesuaikan deskripsi jika cakupan kuis berubah.
                                </small>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder">Instruksi</label>
                                <textarea id="edit_instruksi"
                                          class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                          rows="4"
                                          placeholder="Instruksi teknis atau etika pengerjaan kuis."></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="mb-4">
                                <span class="badge badge-light-success fs-8 mb-2">Pengaturan Kuis</span>
                                <div class="text-muted fs-8">
                                    Ubah pengaturan durasi dan penilaian dengan mempertimbangkan tingkat kesulitan materi.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">Tipe Kuis</label>
                                <select id="edit_tipe"
                                        data-control="select2"
                                        class="form-select form-select-sm fs-sm-8 fs-lg-6" data-allow-clear="true"
                                        data-placeholder="Pilih tipe kuis"
                                        data-dropdown-parent="#form_edit"
                                        required>
                                    <option value="kuis_materi">Kuis Materi</option>
                                    <option value="ujian_akhir">Ujian Akhir</option>
                                </select>
                                <small class="text-muted fs-8 d-block mt-1">
                                    Pertimbangkan untuk menggunakan Ujian Akhir hanya di akhir kelas atau modul.
                                </small>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">Durasi (menit)</label>
                                <input type="number" id="edit_durasi_menit"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       min="1"
                                       placeholder="Durasi pengerjaan kuis"
                                       required>
                                <small class="text-muted fs-8 d-block mt-1">
                                    Sesuaikan durasi dengan jumlah dan tingkat kesulitan soal.
                                </small>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">Nilai Lulus</label>
                                <input type="number" id="edit_nilai_lulus"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       min="0" max="100"
                                       placeholder="Minimal nilai kelulusan"
                                       required>
                                <small class="text-muted fs-8 d-block mt-1">
                                    Ubah standar kelulusan jika strategi penilaian kelas berubah.
                                </small>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder">Pengaturan Kuis</label>
                                <div class="form-check form-switch mb-1">
                                    <input class="form-check-input" type="checkbox" id="edit_tampilkan_jawaban_benar">
                                    <label class="form-check-label fs-sm-8 fs-lg-6" for="edit_tampilkan_jawaban_benar">
                                        Tampilkan jawaban benar setelah selesai
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-1">
                                    <input class="form-check-input" type="checkbox" id="edit_acak_soal">
                                    <label class="form-check-label fs-sm-8 fs-lg-6" for="edit_acak_soal">
                                        Acak urutan soal
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-1">
                                    <input class="form-check-input" type="checkbox" id="edit_acak_jawaban">
                                    <label class="form-check-label fs-sm-8 fs-lg-6" for="edit_acak_jawaban">
                                        Acak urutan jawaban
                                    </label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="edit_aktif">
                                    <label class="form-check-label fs-sm-8 fs-lg-6" for="edit_aktif">
                                        Kuis aktif
                                    </label>
                                </div>
                                <small class="text-muted fs-8 d-block mt-2">
                                    Matikan status aktif jika kuis tidak lagi digunakan atau digantikan versi baru.
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
