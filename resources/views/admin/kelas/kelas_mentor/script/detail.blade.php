<script defer>
    $('#form_detail').on('show.bs.modal', function(e) {
        const $modal = $(this);

        $modal.attr('aria-hidden', 'false');

        const button = $(e.relatedTarget);
        const id = button.data('id');

        const detail = '{{ route('admin.kelas.mentor.show', [':id']) }}';

        $('#detail_kelas_judul').text('-');
        $('#detail_mentor_nama').text('-');
        $('#detail_peran').text('-');

        DataManager.openLoading();

        DataManager.fetchData(detail.replace(':id', id))
            .then(function(response) {
                Swal.close();

                if (response.success) {
                    const data = response.data;

                    $('#detail_kelas_judul').text(data.kelas_judul || '-');
                    $('#detail_mentor_nama').text(data.mentor_nama || '-');
                    $('#detail_peran').text(data.peran || 'Asisten Mentor');

                    return;
                }

                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: response.message || 'Data asisten mentor tidak ditemukan.',
                    confirmButtonColor: '#3085d6',
                });

                $('#form_detail').modal('hide');
            })
            .catch(function(error) {
                Swal.close();
                ErrorHandler.handleError(error);
                $('#form_detail').modal('hide');
            });
    }).on('hidden.bs.modal', function() {
        const $modal = $(this);

        $modal.attr('aria-hidden', 'true');

        $('#detail_kelas_judul').text('-');
        $('#detail_mentor_nama').text('-');
        $('#detail_peran').text('-');
    });
</script>