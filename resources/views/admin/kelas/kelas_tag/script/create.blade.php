<script defer>
    $('#form_create').on('show.bs.modal', function() {
        fetchDataDropdown("{{ route('admin.api.kelas.tag') }}", '#create_id_tag', 'tag', 'nama');

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
                    formData.append('id_kelas', $('#create_id_kelas').val());
                    formData.append('id_tag', $('#create_id_tag').val());

                    const action = "{{ route('admin.kelas.kelas_tag.store') }}";

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
                            Swal.fire({
                                icon: 'warning',
                                title: 'Validasi bermasalah',
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true
                            });
                        }
                        if (!response.success && !response.errors) {
                            Swal.fire({
                                icon: 'warning',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true
                            });
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
        $m.find('select').val('').trigger('change');
        $m.find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
        $m.find('.invalid-feedback, .valid-feedback, .text-danger').remove();
    });
</script>
