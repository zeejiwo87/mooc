<script defer>
    $('#form_detail').on('show.bs.modal', function (e) {
        $(this).attr('aria-hidden', 'false');
        const button = $(e.relatedTarget);
        const id = button.data("id");
        const detail = '{{ route('admin.app.pengguna.show', [':id']) }}';
        DataManager.fetchData(detail.replace(':id', id))
            .then(function (response) {
                if (response.success) {
                    $('#detail_nama').text(response.data.nama);
                    $('#detail_email').text(response.data.email);
                    $('#detail_telepon').text(response.data.telepon);
                    $('#detail_terverifikasi').text(response.data.terverifikasi ? 'Ya' : 'Tidak');
                    $('#detail_bio').text(response.data.bio);
                    $('#detail_total_kelas_selesai').text(response.data.total_kelas_selesai);
                    $('#detail_total_poin').text(response.data.total_poin);
                    $('#detail_last_login').text(response.data.last_login || '');

                    if (response.data.foto_profil) {
                        const photoUrl = '{{ route('view-file', [':folder', ':filename']) }}'
                            .replace(':folder', 'profil')
                            .replace(':filename', response.data.foto_profil);
                        $('#detail_foto_preview').attr('src', photoUrl);
                    } else {
                        $('#detail_foto_preview').attr('src', '');
                    }
                } else {
                    Swal.fire('Peringatan', response.message, 'warning');
                }
            }).catch(function (error) {
            ErrorHandler.handleError(error);
        });
    });
</script>

