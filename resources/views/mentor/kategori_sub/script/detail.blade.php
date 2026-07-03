<script defer>
    $('#form_detail').on('show.bs.modal', function (e) {
        $(this).attr('aria-hidden', 'false');
        const button = $(e.relatedTarget);
        const id = button.data("id");
        const detail = '{{ route('mentor.kelas.kategori_sub.show', [':id']) }}';
        DataManager.fetchData(detail.replace(':id', id))
            .then(function (response) {
                if (response.success) {
                    $('#detail_kategori_nama').text(response.data.kategori_nama);
                    $('#detail_nama').text(response.data.nama);
                    $('#detail_deskripsi').text(response.data.deskripsi);
                    $('#detail_urutan').text(response.data.urutan);
                    $('#detail_aktif').text(response.data.aktif ? 'Aktif' : 'Nonaktif');
                } else {
                    Swal.fire('Peringatan', response.message, 'warning');
                }
            }).catch(function (error) {
            ErrorHandler.handleError(error);
        });
    });
</script>

