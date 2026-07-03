<script defer>
    $('#form_edit').on('show.bs.modal', function(e) {
        const button = $(e.relatedTarget);
        const id = button.data("id");
        const detail = '{{ route('mentor.materi.soal.show', [':id']) }}';

        DataManager.fetchData(detail.replace(':id', id))
            .then(function(response) {
                if (response.success) {
                    const data = response.data;
                    $('#edit_id_soal').val(data.id_soal);
                    $('#edit_teks_soal').val(data.teks_soal ?? '');
                    $('#edit_nilai').val(data.nilai ?? '');
                    $('#edit_penjelasan').val(data.penjelasan ?? '');
                    if (data.gambar_soal) {
                        $('#edit_gambar_soal_info').text('Gambar saat ini: ' + data.gambar_soal);
                    } else {
                        $('#edit_gambar_soal_info').text('Belum ada gambar terkait.');
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
                    formData.append('id_kuis', $('#edit_id_kuis').val());
                    formData.append('teks_soal', $('#edit_teks_soal').val());
                    formData.append('nilai', $('#edit_nilai').val());
                    formData.append('penjelasan', $('#edit_penjelasan').val());

                    const fileInput = $('#edit_gambar_soal')[0];
                    if (fileInput.files[0]) {
                        formData.append('gambar_soal', fileInput.files[0]);
                    }

                    const update = '{{ route('mentor.materi.soal.update', [':id']) }}';
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
        $m.find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
        $m.find('.invalid-feedback, .valid-feedback, .text-danger').remove();
        $('#edit_gambar_soal_info').text('');
    });
</script>
