<script defer>
    let quillEdit;

    $('#form_edit').on('show.bs.modal', function(e) {
        const button = $(e.relatedTarget);
        const id = button.data("id");
        const detail = '{{ route('admin.kelas.kelas.show', [':id']) }}';
        $('#edit_id_kategori').on('change', function() {
            const id_kategori = $(this).val();
            $('#edit_id_kategori_sub').empty().append('<option></option>').prop('disabled', true);
            if (id_kategori) {
                fetchDataDropdown("{{ route('admin.api.kelas.kategori_sub', [':id']) }}".replace(':id',
                    id_kategori), '#edit_id_kategori_sub', 'kategori_sub', 'nama', () => {
                    $('#edit_id_kategori_sub').prop('disabled', false);
                });
            }
        });
        if (window.Quill) {
            if (quillEdit) {
                quillEdit = null;
            }
            quillEdit = new Quill('#edit_deskripsi_lengkap_editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{
                            header: [1, 2, 3, false]
                        }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{
                            list: 'ordered'
                        }, {
                            list: 'bullet'
                        }],
                        [{
                            script: 'sub'
                        }, {
                            script: 'super'
                        }],
                        [{
                            align: []
                        }],
                        ['link'],
                        [{
                            color: []
                        }, {
                            background: []
                        }],
                        ['clean']
                    ]
                }
            });
        }

        DataManager.fetchData(detail.replace(':id', id))
            .then(function(response) {
                if (response.success) {
                    const data = response.data;
                    $('#edit_judul').val(data.judul);
                    $('#edit_deskripsi_singkat').val(data.deskripsi_singkat);
                    $('#edit_deskripsi_lengkap').val(data.deskripsi_lengkap);
                    if (window.Quill && quillEdit) {
                        quillEdit.root.innerHTML = data.deskripsi_lengkap || '';
                    }
                    $('#edit_video_intro_url').val(data.video_intro_url);
                    $('#edit_tingkat').val(data.tingkat);
                    $('#edit_bahasa').val(data.bahasa);
                    $('#edit_nilai_lulus').val(data.nilai_lulus);
                    $('#edit_status').val(data.status);
                    fetchDataDropdown("{{ route('admin.api.kelas.kategori') }}", '#edit_id_kategori',
                        'kategori', 'nama', () => {
                            $("#edit_id_kategori").val(data.id_kategori).trigger("change");
                            fetchDataDropdown("{{ route('admin.api.kelas.kategori_sub', [':id']) }}"
                                .replace(':id', data.id_kategori), '#edit_id_kategori_sub',
                                'kategori_sub', 'nama', () => {
                                    $("#edit_id_kategori_sub").val(data.id_kategori_sub).trigger(
                                        "change");
                                });
                        });

                    fetchDataDropdown("{{ route('admin.api.kelas.mentor') }}", '#edit_id_pemilik', 'mentor',
                        'nama', () => {
                            $("#edit_id_pemilik").val(data.id_pemilik).trigger("change");
                        });

                    if (data.banner) {
                        const bannerUrl = '{{ route('view-file', [':folder', ':filename']) }}'
                            .replace(':folder', 'banner')
                            .replace(':filename', data.banner);
                        $('#edit_banner_preview').css('background-image', `url('${bannerUrl}')`);
                        $('#edit_banner_preview').css('background-size', 'cover');
                        $('#edit_banner_preview').css('background-position', 'center');
                    } else {
                        $('#edit_banner_preview').css('background-image', '');
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
                    formData.append('id_kategori_sub', $('#edit_id_kategori_sub').val());
                    formData.append('id_pemilik', $('#edit_id_pemilik').val());
                    formData.append('judul', $('#edit_judul').val());
                    formData.append('deskripsi_singkat', $('#edit_deskripsi_singkat').val());
                    if (window.Quill && quillEdit) {
                        $('#edit_deskripsi_lengkap').val(quillEdit.root.innerHTML);
                    }
                    formData.append('deskripsi_lengkap', $('#edit_deskripsi_lengkap').val());
                    formData.append('video_intro_url', $('#edit_video_intro_url').val());
                    formData.append('tingkat', $('#edit_tingkat').val());
                    formData.append('bahasa', $('#edit_bahasa').val());
                    formData.append('nilai_lulus', $('#edit_nilai_lulus').val());
                    formData.append('status', $('#edit_status').val());

                    const bannerInput = $('#edit_banner')[0];
                    if (bannerInput.files[0]) {
                        formData.append('banner', bannerInput.files[0]);
                    }

                    const sertifikatInput = $('#edit_sertifikat')[0];
                    if (sertifikatInput && sertifikatInput.files[0]) {
                        formData.append('sertifikat', sertifikatInput.files[0]);
                    }
                    const update = '{{ route('admin.kelas.kelas.update', [':id']) }}';
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
        $m.find('select, textarea').val('').trigger('change');
        $m.find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
        $m.find('.invalid-feedback, .valid-feedback, .text-danger').remove();
    });
</script>
