<script defer>
    $('#form_edit').on('show.bs.modal', function(e) {
        const button = $(e.relatedTarget);
        const id = button.data("id");
        const detail = '{{ route('admin.materi.kuis.show', [':id']) }}';

        DataManager.fetchData(detail.replace(':id', id))
            .then(function(response) {
                if (response.success) {
                    const data = response.data;
                    $('#edit_id_kuis').val(data.id_kuis);
                    $('#edit_judul').val(data.judul);
                    $('#edit_deskripsi').val(data.deskripsi ?? '');
                    $('#edit_instruksi').val(data.instruksi ?? '');
                    $('#edit_tipe').val(data.tipe).trigger('change');
                    $('#edit_durasi_menit').val(data.durasi_menit);
                    $('#edit_nilai_lulus').val(data.nilai_lulus);
                    $('#edit_tampilkan_jawaban_benar').prop('checked', !!data.tampilkan_jawaban_benar);
                    $('#edit_acak_soal').prop('checked', !!data.acak_soal);
                    $('#edit_acak_jawaban').prop('checked', !!data.acak_jawaban);
                    $('#edit_aktif').prop('checked', !!data.aktif);
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
                    formData.append('id_materi', $('#edit_id_materi').val());
                    formData.append('judul', $('#edit_judul').val());
                    formData.append('deskripsi', $('#edit_deskripsi').val());
                    formData.append('instruksi', $('#edit_instruksi').val());
                    formData.append('tipe', $('#edit_tipe').val());
                    formData.append('durasi_menit', $('#edit_durasi_menit').val());
                    formData.append('nilai_lulus', $('#edit_nilai_lulus').val());
                    formData.append('tampilkan_jawaban_benar', $(
                        '#edit_tampilkan_jawaban_benar').is(':checked') ? 1 : 0);
                    formData.append('acak_soal', $('#edit_acak_soal').is(':checked') ? 1 : 0);
                    formData.append('acak_jawaban', $('#edit_acak_jawaban').is(':checked') ? 1 :
                        0);
                    formData.append('aktif', $('#edit_aktif').is(':checked') ? 1 : 0);

                    const update = '{{ route('admin.materi.kuis.update', [':id']) }}';
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
    });
</script>
