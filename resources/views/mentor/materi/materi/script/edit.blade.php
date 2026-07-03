<script defer>
    let quillMateriEdit;

    function toggleEditTipeFields() {
        const tipe = $('#edit_tipe').val();
        $('.tipe-field-edit').addClass('d-none');

        if (tipe === 'text') {
            $('.tipe-field-edit.tipe-text').removeClass('d-none');
        } else if (tipe === 'video') {
            $('.tipe-field-edit.tipe-video').removeClass('d-none');
        } else if (tipe === 'file') {
            $('.tipe-field-edit.tipe-file').removeClass('d-none');
        }
    }

    $('#edit_tipe').on('change', toggleEditTipeFields);

    const initQuillEdit = () => {
        if (window.Quill && !quillMateriEdit) {
            quillMateriEdit = new Quill('#edit_content_editor', {
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
    };

    $('#form_edit').on('show.bs.modal', function(e) {
        const button = $(e.relatedTarget);
        const id = button.data("id");
        const detail = '{{ route('mentor.materi.materi.show', [':id']) }}';

        initQuillEdit();

        DataManager.fetchData(detail.replace(':id', id))
            .then(function(response) {
                if (response.success) {
                    const data = response.data;
                    $('#edit_id_materi').val(data.id_materi);
                    $('#edit_judul').val(data.judul);
                    $('#edit_tipe').val(data.tipe).trigger('change');
                    if (window.Quill && quillMateriEdit) {
                        quillMateriEdit.root.innerHTML = data.content ?? '';
                    }
                    $('#edit_content').val(data.content ?? '');
                    $('#edit_url_video').val(data.url_video ?? '');
                    $('#edit_url_lampiran').val(data.url_lampiran ?? '');
                    $('#edit_urutan').val(data.urutan);
                    $('#edit_durasi_detik').val(data.durasi_detik);
                    $('#edit_preview').prop('checked', !!data.preview);
                    toggleEditTipeFields();
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
                    formData.append('id_bagian_kelas', $('#edit_id_bagian_kelas').val());
                    formData.append('judul', $('#edit_judul').val());
                    formData.append('tipe', $('#edit_tipe').val());
                    if (window.Quill && quillMateriEdit) {
                        $('#edit_content').val(quillMateriEdit.root.innerHTML);
                    }
                    formData.append('content', $('#edit_content').val());
                    formData.append('url_video', $('#edit_url_video').val());
                    formData.append('url_lampiran', $('#edit_url_lampiran').val());
                    formData.append('urutan', $('#edit_urutan').val());
                    formData.append('durasi_detik', $('#edit_durasi_detik').val());
                    formData.append('preview', $('#edit_preview').is(':checked') ? 1 : 0);

                    const update = '{{ route('mentor.materi.materi.update', [':id']) }}';
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
        $('.tipe-field-edit').addClass('d-none');
        if (window.Quill && quillMateriEdit) {
            quillMateriEdit.setContents([]);
        }
    });
</script>
