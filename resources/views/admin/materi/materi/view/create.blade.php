<div class="modal fade" id="form_create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="post" id="bt_submit_create">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Materi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="create_id_bagian_kelas" value="{{ $id }}">

                    <div class="row g-5">
                        <div class="col-lg-7">
                            <div class="mb-4">
                                <span class="badge badge-light-primary fs-8 mb-2">Informasi Utama</span>
                                <div class="text-muted fs-8">
                                    Lengkapi judul dan tipe materi terlebih dahulu. Konten tambahan akan menyesuaikan tipe yang dipilih.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">Judul Materi</label>
                                <input type="text" id="create_judul"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       maxlength="255"
                                       placeholder="Contoh: Pengenalan Dasar HTML"
                                       required>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">Tipe Materi</label>
                                <select id="create_tipe"
                                        data-control="select2"
                                        class="form-select form-select-sm fs-sm-8 fs-lg-6" data-allow-clear="true"
                                        data-placeholder="Pilih tipe materi"
                                        data-dropdown-parent="#form_create"
                                        required>
                                    <option value="video">Video</option>
                                    <option value="text">Teks</option>
                                    <option value="kuis">Kuis</option>
                                </select>
                                <small class="text-muted fs-8 d-block mt-1">
                                    Tipe materi akan menentukan jenis konten yang diisi (video, teks, file, atau kuis).
                                </small>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3 tipe-field tipe-text d-none">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder">Konten Teks</label>
                                <input type="hidden" id="create_content">
                                <div id="create_content_editor"
                                     class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                     style="min-height: 220px;"
                                     placeholder="Tulis materi dalam bentuk teks lengkap, bisa berupa penjelasan, poin-poin, atau ringkasan."></div>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3 tipe-field tipe-video d-none">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder">URL Video</label>
                                <input type="text" id="create_url_video"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       maxlength="255"
                                       placeholder="https://...">
                                <small class="text-muted fs-8 d-block mt-1">
                                    Tempelkan link video dari platform yang didukung (misalnya YouTube, Vimeo, atau CDN internal).
                                </small>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 tipe-field tipe-file d-none">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder">URL Lampiran</label>
                                <input type="text" id="create_url_lampiran"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       maxlength="255"
                                       placeholder="https://... atau path file">
                                <small class="text-muted fs-8 d-block mt-1">
                                    Lampiran bisa berupa modul PDF, slide presentasi, atau berkas pendukung lainnya.
                                </small>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="mb-4">
                                <span class="badge badge-light-success fs-8 mb-2">Pengaturan Materi</span>
                                <div class="text-muted fs-8">
                                    Atur urutan tampil dan durasi materi agar alur belajar peserta tetap terstruktur.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">Urutan</label>
                                <input type="number" id="create_urutan"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       min="0" value="0" required>
                                <small class="text-muted fs-8 d-block mt-1">
                                    Angka urutan menentukan posisi materi ini dibanding materi lain dalam bagian yang sama.
                                </small>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder">Durasi (detik)</label>
                                <input type="number" id="create_durasi_detik"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       min="0">
                                <small class="text-muted fs-8 d-block mt-1">
                                    Perkiraan durasi konsumsi materi. Berguna untuk estimasi waktu belajar peserta.
                                </small>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-sm-8 fs-lg-6 fw-bolder">Preview Gratis</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="create_preview">
                                    <label class="form-check-label fs-sm-8 fs-lg-6" for="create_preview">
                                        Jadikan materi ini bisa dipreview tanpa login
                                    </label>
                                </div>
                                <small class="text-muted fs-8 d-block mt-1">
                                    Aktifkan jika Anda ingin materi ini bisa dilihat calon peserta sebagai contoh isi kelas.
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
