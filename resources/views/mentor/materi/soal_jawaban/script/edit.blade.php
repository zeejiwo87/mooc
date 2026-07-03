<script defer>
    $('#form_edit').on('show.bs.modal', function (e) {
        const button = $(e.relatedTarget);
        const id = button.data('id');
        const detail = '{{ route('mentor.materi.jawaban.show', [':id']) }}';

        $('#edit_id_jawaban').val(id);

        DataManager.fetchData(detail.replace(':id', id))
            .then(function (response) {
                if (response.success) {
                    const data = response.data;

                    $('#edit_id_jawaban').val(data.id_soal_jawaban);
                    $('#edit_id_soal').val(data.id_soal);
                    $('#edit_teks_jawaban').val(data.teks_jawaban ?? '');
                    $('#edit_benar').prop('checked', data.benar == 1 || data.benar === true);
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: response.message || 'Data tidak ditemukan.',
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            }).catch(function (error) {
                ErrorHandler.handleError(error);
            });

        $('#bt_submit_edit').off('submit').on('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Kamu yakin?',
                text: 'Apakah datanya sudah benar?',
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
                if (!result.isConfirmed) {
                    return;
                }

                DataManager.openLoading();

                const formData = new FormData();
                formData.append('id_soal', $('#edit_id_soal').val());
                formData.append('teks_jawaban', $('#edit_teks_jawaban').val());
                formData.append('benar', $('#edit_benar').is(':checked') ? 1 : 0);

                const update = '{{ route('mentor.materi.jawaban.update', [':id']) }}';
                const idJawaban = $('#edit_id_jawaban').val() || id;

                DataManager.formData(update.replace(':id', idJawaban), formData).then(response => {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Data berhasil diperbarui',
                            text: response.message || '',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true
                        }).then(() => {
                            $('#form_edit').modal('hide');
                            $('#jawaban_table').DataTable().ajax.reload(null, false);
                        });

                        return;
                    }

                    if (response.errors) {
                        const validationErrorFilter = new ValidationErrorFilter('edit_');
                        validationErrorFilter.filterValidationErrors(response);

                        Swal.fire({
                            icon: 'warning',
                            title: 'Isian belum valid',
                            text: 'Periksa kembali jawaban yang Anda isi.',
                            showConfirmButton: false,
                            timer: 1500,
                        });

                        return;
                    }

                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: response.message || 'Data gagal diperbarui.',
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }).catch(error => {
                    ErrorHandler.handleError(error);
                });
            });
        });
    }).on('hidden.bs.modal', function () {
        const $m = $(this);
        $m.find('form').trigger('reset');
        $m.find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
        $m.find('.invalid-feedback, .valid-feedback, .text-danger').remove();
    });
</script>