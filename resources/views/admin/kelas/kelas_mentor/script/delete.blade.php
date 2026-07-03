<script defer>
    function deleteConfirmation(id) {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus asisten mentor ini dari kelas?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal',
            allowOutsideClick: false,
            allowEscapeKey: false,
            focusCancel: true,
        }).then((result) => {
            if (!result.isConfirmed) {
                return;
            }

            DataManager.openLoading();

            const destroy = "{{ route('admin.kelas.mentor.delete', ':id') }}";

            DataManager.deleteData(destroy.replace(':id', id)).then(response => {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Asisten mentor berhasil dihapus',
                        text: response.message || '',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true
                    }).then(() => {
                        if ($.fn.DataTable.isDataTable('#mentor_table')) {
                            $('#mentor_table').DataTable().ajax.reload(null, false);
                        } else {
                            location.reload();
                        }
                    });

                    return;
                }

                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: response.message || 'Asisten mentor gagal dihapus.',
                    confirmButtonColor: '#3085d6',
                });
            }).catch(error => {
                ErrorHandler.handleError(error);
            });
        });
    }
</script>