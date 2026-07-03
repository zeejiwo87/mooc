<script defer>
    $('#form_create').on('show.bs.modal', function() {
        const $modal = $(this);
        const $form = $('#bt_submit_create');
        const $mentorSelect = $('#create_id_mentor');

        $form.trigger('reset');
        $mentorSelect.val('').trigger('change');
        $modal.find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
        $modal.find('.invalid-feedback').html('');

        fetchDataDropdown(
            "{{ route('admin.api.kelas.mentor') }}",
            '#create_id_mentor',
            'mentor',
            'nama'
        );

        $('#create_peran').val('Asisten Mentor');

        $form.off('submit').on('submit', function(e) {
            e.preventDefault();

            const idKelas = $('#create_id_kelas').val();
            const idMentor = $('#create_id_mentor').val();

            if (!idMentor) {
                $('#create_id_mentor').addClass('is-invalid');
                $('#create_id_mentor').closest('.mb-4').find('.invalid-feedback').html('Asisten Mentor wajib dipilih.');

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
                text: 'Asisten mentor akan ditambahkan ke kelas ini. Maksimal hanya 2 asisten mentor per kelas.',
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

                const action = "{{ route('admin.kelas.mentor.store') }}";

                DataManager.formData(action, formData).then(response => {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Asisten mentor berhasil ditambahkan',
                            text: response.message || '',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true
                        }).then(() => {
                            $('#form_create').modal('hide');

                            if ($.fn.DataTable.isDataTable('#mentor_table')) {
                                $('#mentor_table').DataTable().ajax.reload(null, false);
                            } else {
                                location.reload();
                            }
                        });

                        return;
                    }

                    if (!response.success && response.errors) {
                        const validationErrorFilter = new ValidationErrorFilter();
                        validationErrorFilter.filterValidationErrors(response);

                        Swal.fire({
                            icon: 'warning',
                            title: 'Validasi bermasalah',
                            text: 'Periksa kembali data yang kamu pilih.',
                            confirmButtonColor: '#3085d6',
                        });

                        return;
                    }

                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: response.message || 'Asisten mentor gagal ditambahkan.',
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
        $('#create_peran').val('Asisten Mentor');
    });
</script>