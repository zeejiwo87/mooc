<script defer>
    $('#form_detail').on('show.bs.modal', function (e) {
        $(this).attr('aria-hidden', 'false');
        const button = $(e.relatedTarget);
        const id = button.data("id");
        const detail = '{{ route('admin.kelas.kelas.show', [':id']) }}';
        DataManager.fetchData(detail.replace(':id', id))
            .then(function (response) {
                if (response.success) {
                    const data = response.data;
                    $('#detail_judul').text(data.judul);
                    $('#detail_slug').text(data.slug);
                    $('#detail_kategori_nama').text(data.kategori_nama);
                    $('#detail_kategori_sub_nama').text(data.kategori_sub_nama);
                    $('#detail_pemilik').text(data.pemilik);
                    $('#detail_tingkat').text(data.tingkat);
                    $('#detail_bahasa').text(data.bahasa);
                    $('#detail_status').text(data.status);
                    $('#detail_nilai_lulus').text(data.nilai_lulus);
                    $('#detail_deskripsi_singkat').text(data.deskripsi_singkat);
                    $('#detail_deskripsi_lengkap').html(data.deskripsi_lengkap);

                    if (data.video_intro_url) {
                        $('#detail_video_intro_url').attr('href', data.video_intro_url).text(data.video_intro_url);
                    } else {
                        $('#detail_video_intro_url').text('-').removeAttr('href');
                    }

                    if (data.banner) {
                        const bannerUrl = '{{ route('view-file', [':folder', ':filename']) }}'
                            .replace(':folder', 'banner')
                            .replace(':filename', data.banner);
                        $('#detail_banner_preview').attr('src', bannerUrl);
                    } else {
                        $('#detail_banner_preview').attr('src', '');
                    }

                    if (data.sertifikat) {
                        const sertifikatUrl = '{{ route('view-file', [':folder', ':filename']) }}'
                            .replace(':folder', 'sertifikat')
                            .replace(':filename', data.sertifikat);
                        $('#detail_sertifikat_link')
                            .attr('href', sertifikatUrl)
                            .removeClass('d-none');
                        $('#detail_sertifikat_name')
                            .text(data.sertifikat)
                            .removeClass('d-none');
                        $('#detail_sertifikat_none').addClass('d-none');
                    } else {
                        $('#detail_sertifikat_link')
                            .attr('href', '#')
                            .addClass('d-none');
                        $('#detail_sertifikat_name')
                            .text('')
                            .addClass('d-none');
                        $('#detail_sertifikat_none').removeClass('d-none');
                    }
                } else {
                    Swal.fire('Peringatan', response.message, 'warning');
                }
            }).catch(function (error) {
            ErrorHandler.handleError(error);
        });
    });
</script>
