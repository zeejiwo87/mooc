<div class="modal fade" id="form_detail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Asisten Mentor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="p-4 border border-dashed border-gray-300 rounded-2 bg-light">
                    <div class="d-flex align-items-center mb-4">
                        <span class="bullet bullet-dot bg-primary me-2"></span>
                        <div class="fw-bold fs-7 text-gray-800">Informasi Asisten Mentor</div>
                    </div>

                    <div class="alert alert-primary d-flex align-items-start p-4 mb-4">
                        <i class="bi bi-info-circle fs-3 me-3"></i>
                        <div class="fs-7">
                            Data ini adalah asisten mentor kelas. Mentor utama tetap diambil dari data pemilik kelas.
                        </div>
                    </div>

                    <dl class="row fs-sm-8 fs-lg-6 mb-0">
                        <dt class="col-sm-4 mb-3">Kelas</dt>
                        <dd class="col-sm-8 mb-3 fw-semibold text-gray-800" id="detail_kelas_judul">-</dd>

                        <dt class="col-sm-4 mb-3">Nama Asisten Mentor</dt>
                        <dd class="col-sm-8 mb-3 fw-semibold text-gray-800" id="detail_mentor_nama">-</dd>

                        <dt class="col-sm-4 mb-0">Peran</dt>
                        <dd class="col-sm-8 mb-0">
                            <span class="badge badge-light-primary fw-bold" id="detail_peran">
                                Asisten Mentor
                            </span>
                        </dd>
                    </dl>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>