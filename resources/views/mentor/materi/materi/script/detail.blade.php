<script defer>
    $('#form_detail').on('show.bs.modal', function (e) {
        $(this).attr('aria-hidden', 'false');
        const button = $(e.relatedTarget);
        const id = button.data("id");
        const detail = '{{ route('mentor.materi.materi.show', [':id']) }}';
        DataManager.fetchData(detail.replace(':id', id))
            .then(function (response) {
                if (response.success) {
                    const data = response.data;
                    $('#detail_kelas').text(data.kelas_judul ?? '');
                    $('#detail_bagian').text(data.bagian_kelas_judul ?? '');
                    $('#detail_tipe').text(data.tipe ?? '');
                    $('#detail_judul').text(data.judul ?? '');
                    $('#detail_urutan').text(data.urutan ?? '');
                    $('#detail_durasi_detik').text(data.durasi_detik ?? '-');
                    $('#detail_preview').text(data.preview ? 'Ya' : 'Tidak');

                    const sanitize = (html) => {
                        const wrapper = document.createElement('div');
                        wrapper.innerHTML = html || '';
                        wrapper.querySelectorAll('script').forEach(el => el.remove());
                        return wrapper.innerHTML;
                    };

                    const renderKonten = () => {
                        if (data.tipe === 'text') {
                            const safe = sanitize(data.content ?? '');
                            return safe
                                ? `<div class="p-3 rounded border bg-light content-rich">${safe}</div>`
                                : '<span class="text-muted">-</span>';
                        }

                        if (data.tipe === 'video') {
                            const url = data.url_video ?? '';
                            if (!url) return '<span class="text-muted">-</span>';
                            const isEmbed = /youtube\.com|youtu\.be|vimeo\.com/i.test(url);
                            if (isEmbed) {
                                return `<div class="ratio ratio-16x9 mb-2"><iframe src="${url}" allowfullscreen></iframe></div>
                                        <a href="${url}" target="_blank" rel="noopener" class="text-primary text-decoration-underline">Buka video</a>`;
                            }
                            return `<a href="${url}" target="_blank" rel="noopener" class="text-primary text-decoration-underline">${url}</a>`;
                        }

                        if (data.tipe === 'file') {
                            const url = data.url_lampiran ?? '';
                            return url
                                ? `<a href="${url}" target="_blank" rel="noopener" class="text-primary text-decoration-underline">${url}</a>`
                                : '<span class="text-muted">-</span>';
                        }

                        return '<span class="text-muted">-</span>';
                    };

                    $('#detail_konten').html(renderKonten());
                } else {
                    Swal.fire('Peringatan', response.message, 'warning');
                }
            }).catch(function (error) {
            ErrorHandler.handleError(error);
        });
    });
</script>
