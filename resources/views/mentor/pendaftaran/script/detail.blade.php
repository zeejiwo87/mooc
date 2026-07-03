<script defer>
    $('#form_detail').on('show.bs.modal', function (e) {
        $(this).attr('aria-hidden', 'false');
        const button = $(e.relatedTarget);
        const id = button.data("id");
        const detail = '{{ route('mentor.kelas.pendaftaran.show', [':id']) }}';
        DataManager.fetchData(detail.replace(':id', id))
            .then(function (response) {
                if (response.success) {
                    $('#detail_pengguna_nama').text(response.data.pengguna_nama ?? '');
                    $('#detail_kelas_judul').text(response.data.kelas_judul ?? '');
                    $('#detail_terdaftar_pada').text(response.data.terdaftar_pada ?? '');
                    $('#detail_persentase_progres').text(response.data.persentase_progres ?? '');
                    $('#detail_status').text(response.data.status ?? '');
                    $('#detail_selesai_pada').text(response.data.selesai_pada ?? '');
                    $('#detail_terakhir_akses').text(response.data.terakhir_akses ?? '');
                } else {
                    Swal.fire('Peringatan', response.message, 'warning');
                }
            }).catch(function (error) {
            ErrorHandler.handleError(error);
        });
    });
</script>

