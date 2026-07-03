<div class="modal fade" id="form_edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="post" id="bt_submit_edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Mentor Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="edit_id_kelas" value="{{ $id }}">

                    <div class="p-4 border border-dashed border-gray-300 rounded-2 bg-light">
                        <div class="d-flex align-items-center mb-3">
                            <span class="bullet bullet-dot bg-primary me-2"></span>
                            <div class="fw-bold fs-7 text-gray-800">Informasi Mentor Kelas</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">Mentor</label>
                            <select data-control="select2" id="edit_id_mentor"
                                    class="form-select form-select-sm fs-sm-8 fs-lg-6"
                                    data-allow-clear="true" data-placeholder="Pilih Mentor"
                                    data-dropdown-parent="#form_edit" required>
                                <option></option>
                            </select>
                            <small class="text-muted fs-8 d-block mt-1">
                                Ubah mentor jika terjadi pergantian pengajar utama di kelas ini.
                            </small>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">Peran</label>
                            <input type="text" id="edit_peran"
                                   class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                   maxlength="255"
                                   placeholder="Peran spesifik mentor di kelas ini"
                                   required>
                            <small class="text-muted fs-8 d-block mt-1">
                                Pastikan peran sesuai dengan kontribusi mentor agar koordinasi tetap jelas.
                            </small>
                            <div class="invalid-feedback"></div>
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
