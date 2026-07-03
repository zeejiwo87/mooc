<div class="modal fade" id="form_create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" id="bt_submit_create">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Asisten Mentor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="create_id_kelas" value="{{ $id }}">
                    <input type="hidden" id="create_peran" value="Asisten Mentor">

                    <div class="p-4 border border-dashed border-gray-300 rounded-2 bg-light">
                       
                        <div class="mb-4">
                            <label class="form-label fs-sm-8 fs-lg-6 fw-bolder required">
                                Asisten Mentor
                            </label>

                            <select data-control="select2" id="create_id_mentor"
                                    class="form-select form-select-sm fs-sm-8 fs-lg-6"
                                    data-allow-clear="true"
                                    data-placeholder="Pilih Asisten Mentor"
                                    data-dropdown-parent="#form_create"
                                    required>
                                <option></option>
                            </select>

                            <small class="text-muted fs-8 d-block mt-1">
                                Pilih mentor yang akan membantu mentor utama dalam kelas ini.
                                Mentor utama tidak boleh dipilih sebagai asisten mentor.
                            </small>

                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fs-sm-8 fs-lg-6 fw-bolder">
                                Peran
                            </label>

                            <input type="text"
                                   class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                   value="Asisten Mentor"
                                   readonly>

                            <small class="text-muted fs-8 d-block mt-1">
                                Peran dibuat otomatis sebagai Asisten Mentor agar tidak bercampur dengan mentor utama.
                            </small>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">
                        Tutup
                    </button>

                    <button type="submit" class="btn btn-primary btn-sm">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>