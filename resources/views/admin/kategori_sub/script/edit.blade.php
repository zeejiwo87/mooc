<script defer>
    $('#form_edit').on('show.bs.modal', function(e) {
        const button = $(e.relatedTarget);
        const id = button.data("id");
        const detail = '{{ route('admin.kelas.kategori_sub.show', [':id']) }}';

        DataManager.fetchData(detail.replace(':id', id))
            .then(function(response) {
                if (response.success) {
                    fetchDataDropdown("{{ route('admin.api.kelas.kategori') }}", '#edit_id_kategori',
                        'kategori', 'nama', () => {
                            console.log(response.data)
                            $("#edit_id_kategori").val(response.data.id_kategori).trigger("change");
                        });
                    $('#edit_nama').val(response.data.nama);
                    $('#edit_deskripsi').val(response.data.deskripsi);
                    $('#edit_urutan').val(response.data.urutan);
                    if (response.data.aktif) {
                        $('#edit_aktif_ya').prop('checked', true);
                    } else {
                        $('#edit_aktif_tidak').prop('checked', true);
                    }

                } else {
                    Swal.fire('Warning', response.message, 'warning');
                }
            }).catch(function(error) {

                ErrorHandler.handleError(error);
            });

        $('#bt_submit_edit').off('submit').on('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Kamu yakin?',
                text: 'Apakah datanya benar dan apa yang anda inginkan?',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showCancelButton: true,
                cancelButtonColor: '#dd3333',
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal',
                focusCancel: true,
            }).then((result) => {
                if (result.value) {
                    DataManager.openLoading();
                    const formData = new FormData();
                    formData.append('id_kategori', $('#edit_id_kategori').val());
                    formData.append('nama', $('#edit_nama').val());
                    formData.append('deskripsi', $('#edit_deskripsi').val());
                    formData.append('urutan', $('#edit_urutan').val());
                    const aktif = $('input[name="edit_aktif"]:checked').val() ?? 0;
                    formData.append('aktif', aktif);

                    const update = '{{ route('admin.kelas.kategori_sub.update', [':id']) }}';
                    DataManager.formData(update.replace(':id', id), formData).then(response => {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Data berhasil diperbarui',
                                text: response.message || '',
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true
                            }).then(() => {
                                location.reload();
                            });

                            return;
                        }
                        if (!response.success && response.errors) {
                            const validationErrorFilter = new ValidationErrorFilter(
                                'edit_');
                            validationErrorFilter.filterValidationErrors(response);
                            Swal.fire('Peringatan',
                                'Isian Anda belum lengkap atau tidak valid.',
                                'warning');
                        }

                        if (!response.success && !response.errors) {
                            Swal.fire('Warning', response.message, 'warning');
                        }
                    }).catch(error => {
                        ErrorHandler.handleError(error);
                    });
                }
            })
        });
    }).on('hidden.bs.modal', function() {
        const $m = $(this);
        $m.find('form').trigger('reset');
        $m.find('select, textarea').val('').trigger('change');
        $m.find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
        $m.find('.invalid-feedback, .valid-feedback, .text-danger').remove();
    });
</script>
