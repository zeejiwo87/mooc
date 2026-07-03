<script defer>
    let quillCreate;

    $('#form_create').on('show.bs.modal', function() {
        if (window.Quill) {
            if (quillCreate) {
                quillCreate = null;
            }

            quillCreate = new Quill('#deskripsi_lengkap_editor', {
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

        fetchDataDropdown("{{ route('admin.api.kelas.kategori') }}", '#id_kategori', 'kategori', 'nama');
        fetchDataDropdown("{{ route('admin.api.kelas.mentor') }}", '#id_pemilik', 'mentor', 'nama');

        $('#id_kategori').on('change', function() {
            const id_kategori = $(this).val();
            $('#id_kategori_sub').empty().append('<option></option>').prop('disabled', true);

            if (id_kategori) {
                fetchDataDropdown("{{ route('admin.api.kelas.kategori_sub', [':id']) }}".replace(':id',
                    id_kategori), '#id_kategori_sub', 'kategori_sub', 'nama', () => {
                    $('#id_kategori_sub').prop('disabled', false);
                });
            }
        });

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
                    formData.append('id_kategori_sub', $('#id_kategori_sub').val());
                    formData.append('id_pemilik', $('#id_pemilik').val());
                    formData.append('judul', $('#judul').val());
                    formData.append('deskripsi_singkat', $('#deskripsi_singkat').val());
                    if (window.Quill && quillCreate) {
                        $('#deskripsi_lengkap').val(quillCreate.root.innerHTML);
                    }
                    formData.append('deskripsi_lengkap', $('#deskripsi_lengkap').val());
                    formData.append('video_intro_url', $('#video_intro_url').val());
                    formData.append('tingkat', $('#tingkat').val());
                    formData.append('bahasa', $('#bahasa').val());
                    formData.append('nilai_lulus', $('#nilai_lulus').val());
                    formData.append('status', $('#status').val());

                    const bannerInput = $('#banner')[0];
                    if (bannerInput.files[0]) {
                        formData.append('banner', bannerInput.files[0]);
                    }

                    const sertifikatInput = $('#sertifikat')[0];
                    if (sertifikatInput && sertifikatInput.files[0]) {
                        formData.append('sertifikat', sertifikatInput.files[0]);
                    }

                    const action = "{{ route('admin.kelas.kelas.store') }}";
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
        $m.find('select, textarea').val('').trigger('change');
        $m.find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
        $m.find('.invalid-feedback, .valid-feedback, .text-danger').remove();
    });
</script>
