<script defer>
    $('#form_detail').on('show.bs.modal', function (e) {
        $(this).attr('aria-hidden', 'false');
        const button = $(e.relatedTarget);
        const id = button.data("id");
        const detail = '{{ route('mentor.kelas.persyaratan.show', [':id']) }}';
        DataManager.fetchData(detail.replace(':id', id))
            .then(function (response) {
                if (response.success) {
                    const data = response.data;
                    $('#detail_kelas_judul').text(data.kelas_judul ?? '');
                    $('#detail_persyaratan').text(data.persyaratan ?? '');
                    $('#detail_urutan').text(data.urutan ?? '');
                } else {
                    Swal.fire('Peringatan', response.message, 'warning');
                }
            }).catch(function (error) {
            ErrorHandler.handleError(error);
        });
    });
</script>

