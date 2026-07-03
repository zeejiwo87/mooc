<script defer>
    $('#form_edit').on('show.bs.modal', function(e) {
        const button = $(e.relatedTarget);
        const id = button.data("id");
        const detail = '{{ route('admin.app.pengguna.show', [':id']) }}';

        DataManager.fetchData(detail.replace(':id', id))
            .then(function(response) {
                if (response.success) {
                    $('#edit_nama').val(response.data.nama);
                    $('#edit_email').val(response.data.email);
                    $('#edit_bio').val(response.data.bio);
                    $('#edit_telepon').val(response.data.telepon);
                    if (response.data.terverifikasi) {
                        $('#edit_terverifikasi_ya').prop('checked', true);
                    } else {
                        $('#edit_terverifikasi_tidak').prop('checked', true);
                    }

                    if (response.data.foto_profil) {
                        const photoUrl = '{{ route('view-file', [':folder', ':filename']) }}'
                            .replace(':folder', 'profil')
                            .replace(':filename', response.data.foto_profil);
                        $('#edit_image_preview').css('background-image', `url('${photoUrl}')`);
                        $('#edit_image_preview').css('background-size', 'cover');
                        $('#edit_image_preview').css('background-position', 'center');
                    } else {
                        $('#edit_image_preview').css('background-image', '');
                        $('#edit_image_preview').css('background-size', 'contain');
                        $('#edit_image_preview').css('background-position', 'center');
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
                    formData.append('nama', $('#edit_nama').val());
                    formData.append('email', $('#edit_email').val());
                    formData.append('bio', $('#edit_bio').val());
                    formData.append('telepon', $('#edit_telepon').val());
                    const terverifikasi = $('input[name="edit_terverifikasi"]:checked').val() ??
                        0;
                    formData.append('terverifikasi', terverifikasi);

                    const password = $('#edit_password').val();
                    if (password) {
                        formData.append('password', password);
                    }

                    const fileInput = $('#edit_foto_profil')[0];
                    if (fileInput.files[0]) {
                        formData.append('foto_profil', fileInput.files[0]);
                    }

                    const update = '{{ route('admin.app.pengguna.update', [':id']) }}';
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
