<script defer>
    $('#form_edit').on('show.bs.modal', function(e) {
        const $modal = $(this);
        const $form = $('#bt_submit_edit');
        const $mentorSelect = $('#edit_id_mentor');

        const button = $(e.relatedTarget);
        const id = button.data('id');

        const detail = '{{ route('admin.kelas.mentor.show', [':id']) }}';
        const update = '{{ route('admin.kelas.mentor.update', [':id']) }}';

        $form.trigger('reset');
        $mentorSelect.val('').trigger('change');
        $modal.find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
        $modal.find('.invalid-feedback').html('');

        $('#edit_peran').val('Asisten Mentor');

        fetchDataDropdown(
            "{{ route('admin.api.kelas.mentor') }}",
            '#edit_id_mentor',
            'mentor',
            'nama'
        );

        DataManager.fetchData(detail.replace(':id', id))
            .then(function(response) {
                if (response.success) {
                    const data = response.data;

                    $('#edit_id_kelas').val(data.id_kelas);
                    $('#edit_peran').val('Asisten Mentor');

                    const mentorName = data.mentor_nama || data.nama || 'Mentor terpilih';

                    if (data.id_mentor) {
                        const option = new Option(mentorName, data.id_mentor, true, true);
                        $('#edit_id_mentor').append(option).trigger('change');
                    }

                    return;
                }

                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: response.message || 'Data asisten mentor tidak ditemukan.',
                    confirmButtonColor: '#3085d6',
                });

                $('#form_edit').modal('hide');
            })
            .catch(function(error) {
                ErrorHandler.handleError(error);
                $('#form_edit').modal('hide');
            });

        $form.off('submit').on('submit', function(e) {
            e.preventDefault();

            const idKelas = $('#edit_id_kelas').val();
            const idMentor = $('#edit_id_mentor').val();

            if (!idMentor) {
                $('#edit_id_mentor').addClass('is-invalid');
                $('#edit_id_mentor').closest('.mb-4').find('.invalid-feedback').html('Asisten Mentor wajib dipilih.');

                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Silakan pilih asisten mentor terlebih dahulu.',
                    confirmButtonColor: '#3085d6',
                });

                return;
            }

            Swal.fire({
                title: 'Kamu yakin?',
                text: 'Data asisten mentor akan diperbarui.',
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
                formData.append('id_kelas', idKelas);
                formData.append('id_mentor', idMentor);
                formData.append('peran', 'Asisten Mentor');

                DataManager.formData(update.replace(':id', id), formData).then(response => {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Asisten mentor berhasil diperbarui',
                            text: response.message || '',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true
                        }).then(() => {
                            $('#form_edit').modal('hide');

                            if ($.fn.DataTable.isDataTable('#mentor_table')) {
                                $('#mentor_table').DataTable().ajax.reload(null, false);
                            } else {
                                location.reload();
                            }
                        });

                        return;
                    }

                    if (!response.success && response.errors) {
                        const validationErrorFilter = new ValidationErrorFilter('edit_');
                        validationErrorFilter.filterValidationErrors(response);

                        Swal.fire({
                            icon: 'warning',
                            title: 'Validasi bermasalah',
                            text: 'Periksa kembali data asisten mentor.',
                            confirmButtonColor: '#3085d6',
                        });

                        return;
                    }

                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: response.message || 'Asisten mentor gagal diperbarui.',
                        confirmButtonColor: '#3085d6',
                    });
                }).catch(error => {
                    ErrorHandler.handleError(error);
                });
            });
        });
    }).on('hidden.bs.modal', function() {
        const $modal = $(this);

        $modal.find('form').trigger('reset');
        $modal.find('select').val('').trigger('change');
        $modal.find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
        $modal.find('.invalid-feedback').html('');
        $('#edit_peran').val('Asisten Mentor');
    });
</script>