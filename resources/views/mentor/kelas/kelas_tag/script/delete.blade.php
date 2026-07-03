<script defer>
    function deleteConfirmation(id) {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus data ini secara permanen?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            allowOutsideClick: false,
            allowEscapeKey: false,
            focusCancel: true
        }).then((result) => {
            if (result.isConfirmed) {
                DataManager.openLoading();

                const destroy = "{{ route('mentor.kelas.kelas_tag.delete', ':id') }}";

                DataManager.deleteData(destroy.replace(':id', id)).then(response => {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Data berhasil dihapus',
                            text: response.message || '',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true
                        }).then(() => {
                            location.reload();
                        });

                        return;
                    }

                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: response.message || 'Data gagal dihapus.',
                        confirmButtonText: 'Oke'
                    });
                }).catch(error => {
                    ErrorHandler.handleError(error);
                });
            }
        });
    }
</script>