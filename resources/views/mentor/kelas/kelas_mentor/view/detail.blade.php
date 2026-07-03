<div class="modal fade" id="form_detail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 rounded-4"
             style="background: #eef2f7; box-shadow: 8px 8px 18px rgba(163,177,198,.25), -8px -8px 18px rgba(255,255,255,.7);">

            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold text-dark">
                    <i class="bi bi-person-vcard me-2 text-primary"></i>
                    Detail Asisten Mentor
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="p-3 mb-4 rounded-4"
                     style="background: #eef2f7; box-shadow: inset 4px 4px 10px rgba(163,177,198,.18),
                            inset -4px -4px 10px rgba(255,255,255,.8);">

                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-info-circle-fill text-primary me-2"></i>
                        <span class="fw-semibold text-dark">Informasi Asisten Mentor</span>
                    </div>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Data ini menampilkan detail asisten mentor yang terlibat dalam kelas.
                        Mentor utama tetap ditentukan oleh pemilik kelas.
                    </p>
                </div>

                <dl class="row mb-0">

                    <dt class="col-sm-4 text-muted fw-semibold">Kelas</dt>
                    <dd class="col-sm-8 fw-bold text-dark" id="detail_kelas_judul">-</dd>

                    <dt class="col-sm-4 text-muted fw-semibold">Nama Asisten Mentor</dt>
                    <dd class="col-sm-8 fw-bold text-dark" id="detail_mentor_nama">-</dd>

                    <dt class="col-sm-4 text-muted fw-semibold">Peran</dt>
                    <dd class="col-sm-8">
                        <span class="badge bg-primary px-3 py-2" id="detail_peran">
                            Asisten Mentor
                        </span>
                    </dd>

                </dl>
            </div>

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>

        </div>
    </div>
</div>