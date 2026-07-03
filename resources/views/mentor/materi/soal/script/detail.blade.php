<script defer>
    $('#form_detail').on('show.bs.modal', function (e) {
        $(this).attr('aria-hidden', 'false');
        const button = $(e.relatedTarget);
        const id = button.data("id");
        const detail = '{{ route('mentor.materi.soal.show', [':id']) }}';
        DataManager.fetchData(detail.replace(':id', id))
            .then(function (response) {
                if (response.success) {
                    const data = response.data;
                    $('#detail_teks_soal').text(data.teks_soal ?? '');
                    $('#detail_nilai').text(data.nilai ?? '-');
                    $('#detail_penjelasan').text(data.penjelasan ?? '-');

                    if (data.gambar_soal) {
                        const url = "{{ route('view-file', ['dokumen', ':file']) }}".replace(':file', data.gambar_soal);
                        $('#detail_gambar').html('<img src=\"' + url + '\" alt=\"Gambar Soal\" class=\"img-fluid rounded border\" />');
                    } else {
                        $('#detail_gambar').text('-');
                    }
                } else {
                    Swal.fire('Peringatan', response.message, 'warning');
                }
            }).catch(function (error) {
            ErrorHandler.handleError(error);
        });
    });
</script>
