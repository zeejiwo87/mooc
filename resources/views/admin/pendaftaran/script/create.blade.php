<script defer>
    $('#form_create').on('show.bs.modal', function (e) {
        fetchDataDropdown("{{ route('admin.api.pendaftaran.pengguna') }}", '#id_pengguna', 'pengguna', 'nama');
        fetchDataDropdown("{{ route('admin.api.pendaftaran.kelas') }}", '#id_kelas', 'kelas', 'judul');
        $("#terdaftar_pada").flatpickr({
            enableTime: true,
            dateFormat: 'Y-m-d H:i:S',
            altInput: true,
            altFormat: 'd/m/Y H:i',
            time_24hr: true,
            allowInput: false
        });
        $('#bt_submit_create').off('submit').on('submit', function (e) {
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
                    formData.append('id_pengguna', $('#id_pengguna').val());
                    formData.append('id_kelas', $('#id_kelas').val());
                    formData.append('terdaftar_pada', $('#terdaftar_pada').val());
                    formData.append('status', $('#status').val());
                    formData.append('selesai_pada', $('#selesai_pada').val());
                    formData.append('terakhir_akses', $('#terakhir_akses').val());

                    const action = "{{ route('admin.kelas.pendaftaran.store') }}";
                    DataManager.formData(action, formData).then(response => {
                        if (response.success) {
                            Swal.fire('Success', response.message, 'success');
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        }
                        if (!response.success && response.errors) {
                            const validationErrorFilter = new ValidationErrorFilter();
                            validationErrorFilter.filterValidationErrors(response);
                            Swal.fire('Warning', 'validasi bermasalah', 'warning');
                        }

                        if (!response.success && !response.errors) {
                            Swal.fire('Peringatan', response.message, 'warning');
                        }

                    }).catch(error => {
                        ErrorHandler.handleError(error);
                    });
                }
            })
        });
    }).on('hidden.bs.modal', function () {
        const $m = $(this);
        $m.find('form').trigger('reset');
        $m.find('select, textarea').val('').trigger('change');
        $m.find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
        $m.find('.invalid-feedback, .valid-feedback, .text-danger').remove();
    });
</script>
