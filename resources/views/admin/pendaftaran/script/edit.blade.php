<script defer>
    $('#form_edit').on('show.bs.modal', function (e) {
        const button = $(e.relatedTarget);
        const id = button.data("id");
        const detail = '{{ route('admin.kelas.pendaftaran.show', [':id']) }}';
        let edit_terdaftar_pada = $("#edit_terdaftar_pada").flatpickr({
            enableTime: true,
            dateFormat: 'Y-m-d H:i:S',
            altInput: true,
            altFormat: 'd/m/Y H:i',
            time_24hr: true,
            allowInput: false
        });
        DataManager.fetchData(detail.replace(':id', id))
            .then(function (response) {
                if (response.success) {
                    fetchDataDropdown("{{ route('admin.api.pendaftaran.pengguna') }}", '#edit_id_pengguna', 'pengguna', 'nama', () => {
                        $('#edit_id_pengguna').val(response.data.id_pengguna).trigger('change');
                    });
                    fetchDataDropdown("{{ route('admin.api.pendaftaran.kelas') }}", '#edit_id_kelas', 'kelas', 'judul', () => {
                        $('#edit_id_kelas').val(response.data.id_kelas).trigger('change');
                    });
                    edit_terdaftar_pada.setDate(response.data.terdaftar_pada);
                    $('#edit_status').val(response.data.status).trigger('change');
                    $('#edit_selesai_pada').val(response.data.selesai_pada);
                    $('#edit_terakhir_akses').val(response.data.terakhir_akses);
                } else {
                    Swal.fire('Warning', response.message, 'warning');
                }
            }).catch(function (error) {
            ErrorHandler.handleError(error);
        });

        $('#bt_submit_edit').off('submit').on('submit', function (e) {
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
                    formData.append('id_pengguna', $('#edit_id_pengguna').val());
                    formData.append('id_kelas', $('#edit_id_kelas').val());
                    formData.append('terdaftar_pada', $('#edit_terdaftar_pada').val());
                    formData.append('status', $('#edit_status').val());
                    formData.append('selesai_pada', $('#edit_selesai_pada').val());
                    formData.append('terakhir_akses', $('#edit_terakhir_akses').val());

                    const update = '{{ route('admin.kelas.pendaftaran.update', [':id']) }}';
                    DataManager.formData(update.replace(':id', id), formData).then(response => {
                        if (response.success) {
                            Swal.fire('Success', response.message, 'success');
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        }
                        if (!response.success && response.errors) {
                            const validationErrorFilter = new ValidationErrorFilter('edit_');
                            validationErrorFilter.filterValidationErrors(response);
                            Swal.fire('Peringatan', 'Isian Anda belum lengkap atau tidak valid.', 'warning');
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
    }).on('hidden.bs.modal', function () {
        const $m = $(this);
        $m.find('form').trigger('reset');
        $m.find('select, textarea').val('').trigger('change');
        $m.find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
        $m.find('.invalid-feedback, .valid-feedback, .text-danger').remove();
    });
</script>
