<script defer>
    $('#form_create').on('show.bs.modal', function () {
        $('#bt_submit_create').off('submit').on('submit', function (e) {
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
                formData.append('id_soal', $('#create_id_soal').val());
                formData.append('teks_jawaban', $('#create_teks_jawaban').val());
                formData.append('benar', $('#create_benar').is(':checked') ? 1 : 0);

                const action = "{{ route('mentor.materi.jawaban.store') }}";

                DataManager.formData(action, formData).then(response => {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Data berhasil ditambahkan',
                            text: response.message || '',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true
                        }).then(() => {
                            $('#form_create').modal('hide');
                            $('#bt_submit_create')[0].reset();
                            $('#jawaban_table').DataTable().ajax.reload(null, false);
                        });

                        return;
                    }

                    if (response.errors) {
                        const validationErrorFilter = new ValidationErrorFilter();
                        validationErrorFilter.filterValidationErrors(response);

                        Swal.fire({
                            icon: 'warning',
                            title: 'Validasi bermasalah',
                            text: 'Periksa kembali isian jawaban.',
                            showConfirmButton: false,
                            timer: 1500,
                        });

                        return;
                    }

                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: response.message || 'Data gagal disimpan.',
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