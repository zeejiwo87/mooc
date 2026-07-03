<div class="modal fade" id="form_edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="post" id="bt_submit_edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Materi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="edit_id_bagian_kelas" value="{{ $id }}">
                    <input type="hidden" id="edit_id_materi">

                    <div class="row g-5">
                        <div class="col-lg-7">
                            <div class="mb-4">
                                <span class="badge badge-light-primary fs-8 mb-2">Informasi Utama</span>
                                <div class="text-muted fs-8">
                                    Perbarui judul dan tipe materi dengan hati-hati agar tidak membingungkan peserta.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">Judul Materi</label>
                                <input type="text" id="edit_judul"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       maxlength="255"
                                       placeholder="Judul materi yang mudah dipahami peserta"
                                       required>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">Tipe Materi</label>
                                <select id="edit_tipe"
                                        data-control="select2"
                                        class="form-select form-select-sm fs-sm-8 fs-lg-6" data-allow-clear="true"
                                        data-placeholder="Pilih tipe materi"
                                        data-dropdown-parent="#form_edit"
                                        required>
                                    <option value="video">Video</option>
                                    <option value="text">Teks</option>
                                    <option value="file">File</option>
                                    <option value="kuis">Kuis</option>
                                </select>
                                <small class="text-muted fs-8 d-block mt-1">
                                    Mengubah tipe materi dapat mengubah cara materi dikonsumsi oleh peserta.
                                </small>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3 tipe-field-edit tipe-text d-none">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder">Konten Teks</label>
                                <input type="hidden" id="edit_content">
                                <div id="edit_content_editor"
                                     class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                     style="min-height: 220px;"></div>
                                <small class="text-muted fs-8 d-block mt-1">
                                    Perbarui teks materi untuk memperjelas, tanpa mengubah maksud utama secara drastis.
                                </small>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3 tipe-field-edit tipe-video d-none">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder">URL Video</label>
                                <input type="text" id="edit_url_video"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       maxlength="255">
                                <small class="text-muted fs-8 d-block mt-1">
                                    Pastikan URL video masih aktif dan dapat diakses peserta.
                                </small>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 tipe-field-edit tipe-file d-none">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder">URL Lampiran</label>
                                <input type="text" id="edit_url_lampiran"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       maxlength="255">
                                <small class="text-muted fs-8 d-block mt-1">
                                    Lampiran sebaiknya diberi nama file yang jelas dan deskriptif.
                                </small>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="mb-4">
                                <span class="badge badge-light-success fs-8 mb-2">Pengaturan Materi</span>
                                <div class="text-muted fs-8">
                                    Sesuaikan urutan dan durasi untuk menjaga konsistensi alur belajar di kelas ini.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">Urutan</label>
                                <input type="number" id="edit_urutan"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       min="0" required>
                                <small class="text-muted fs-8 d-block mt-1">
                                    Ubah urutan jika materi ini harus muncul lebih awal atau lebih akhir.
                                </small>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder">Durasi (detik)</label>
                                <input type="number" id="edit_durasi_detik"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       min="0">
                                <small class="text-muted fs-8 d-block mt-1">
                                    Sesuaikan durasi jika materi diperbarui menjadi lebih panjang atau lebih singkat.
                                </small>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder">Preview Gratis</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="edit_preview">
                                    <label class="form-check-label fs-sm-8 fs-lg-6" for="edit_preview">
                                        Jadikan materi ini bisa dipreview tanpa login
                                    </label>
                                </div>
                                <small class="text-muted fs-8 d-block mt-1">
                                    Jadikan materi ini sebagai teaser agar calon peserta tertarik mengikuti kelas.
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
