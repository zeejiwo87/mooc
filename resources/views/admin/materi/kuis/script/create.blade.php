<script defer>
    $('#form_create').on('show.bs.modal', function() {
        $('#bt_submit_create').off('submit').on('submit', function(e) {
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
                    formData.append('id_materi', $('#create_id_materi').val());
                    formData.append('judul', $('#create_judul').val());
                    formData.append('deskripsi', $('#create_deskripsi').val());
                    formData.append('instruksi', $('#create_instruksi').val());
                    formData.append('tipe', $('#create_tipe').val());
                    formData.append('durasi_menit', $('#create_durasi_menit').val());
                    formData.append('nilai_lulus', $('#create_nilai_lulus').val());
                    formData.append('tampilkan_jawaban_benar', $(
                        '#create_tampilkan_jawaban_benar').is(':checked') ? 1 : 0);
                    formData.append('acak_soal', $('#create_acak_soal').is(':checked') ? 1 : 0);
                    formData.append('acak_jawaban', $('#create_acak_jawaban').is(':checked') ?
                        1 : 0);
                    formData.append('aktif', $('#create_aktif').is(':checked') ? 1 : 0);

                    const action = "{{ route('admin.materi.kuis.store') }}";
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
                                location.reload();
                            });

                            return;
                        }
                        if (!response.success && response.errors) {
                            const validationErrorFilter = new ValidationErrorFilter();
                            validationErrorFilter.filterValidationErrors(response);
                            Swal.fire('Warning', 'Validasi bermasalah', 'warning');
                        }

                        if (!response.success && !response.errors) {
                            Swal.fire('Peringatan', response.message, 'warning');
                        }

                    }).catch(error => {
                        ErrorHandler.handleError(error);
                    });
                }
            });
        });

    }).on('hidden.bs.modal', function() {
        const $m = $(this);
        $m.find('form').trigger('reset');
        $m.find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
        $m.find('.invalid-feedback, .valid-feedback, .text-danger').remove();
    });
</script>
