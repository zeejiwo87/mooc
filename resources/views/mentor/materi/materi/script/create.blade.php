<script defer>
    let quillMateriCreate;

    function toggleCreateTipeFields() {
        const tipe = $('#create_tipe').val();
        $('.tipe-field').addClass('d-none');

        if (tipe === 'text') {
            $('.tipe-text').removeClass('d-none');
        } else if (tipe === 'video') {
            $('.tipe-video').removeClass('d-none');
        } else if (tipe === 'file') {
            $('.tipe-file').removeClass('d-none');
        }
    }

    $('#create_tipe').on('change', toggleCreateTipeFields);

    const initQuillCreate = () => {
        if (window.Quill && !quillMateriCreate) {
            quillMateriCreate = new Quill('#create_content_editor', {
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

    $('#form_create').on('show.bs.modal', function() {
        toggleCreateTipeFields();
        initQuillCreate();

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
                    formData.append('id_bagian_kelas', $('#create_id_bagian_kelas').val());
                    formData.append('judul', $('#create_judul').val());
                    formData.append('tipe', $('#create_tipe').val());
                    if (window.Quill && quillMateriCreate) {
                        $('#create_content').val(quillMateriCreate.root.innerHTML);
                    }
                    formData.append('content', $('#create_content').val());
                    formData.append('url_video', $('#create_url_video').val());
                    formData.append('url_lampiran', $('#create_url_lampiran').val());
                    formData.append('urutan', $('#create_urutan').val());
                    formData.append('durasi_detik', $('#create_durasi_detik').val());
                    formData.append('preview', $('#create_preview').is(':checked') ? 1 : 0);

                    const action = "{{ route('mentor.materi.materi.store') }}";
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
        $('.tipe-field').addClass('d-none');
        if (window.Quill && quillMateriCreate) {
            quillMateriCreate.setContents([]);
        }
    });
</script>
