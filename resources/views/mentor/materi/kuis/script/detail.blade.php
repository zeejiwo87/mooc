<script defer>
    $('#form_detail').on('show.bs.modal', function (e) {
        $(this).attr('aria-hidden', 'false');
        const button = $(e.relatedTarget);
        const id = button.data("id");
        const detail = '{{ route('mentor.materi.kuis.show', [':id']) }}';
        DataManager.fetchData(detail.replace(':id', id))
            .then(function (response) {
                if (response.success) {
                    const data = response.data;
                    $('#detail_kelas').text(data.kelas_judul ?? '');
                    $('#detail_bagian').text(data.bagian_kelas_judul ?? '');
                    $('#detail_materi').text(data.materi_judul ?? '');
                    $('#detail_tipe').text(data.tipe ?? '');
                    $('#detail_judul').text(data.judul ?? '');
                    $('#detail_deskripsi').text(data.deskripsi ?? '-');
                    $('#detail_instruksi').text(data.instruksi ?? '-');
                    $('#detail_durasi_menit').text(data.durasi_menit ?? '-');
                    $('#detail_nilai_lulus').text(data.nilai_lulus ?? '-');

                    const pengaturan = [];
                    pengaturan.push('Tampilkan jawaban benar: ' + (data.tampilkan_jawaban_benar ? 'Ya' : 'Tidak'));
                    pengaturan.push('Acak soal: ' + (data.acak_soal ? 'Ya' : 'Tidak'));
                    pengaturan.push('Acak jawaban: ' + (data.acak_jawaban ? 'Ya' : 'Tidak'));
                    pengaturan.push('Aktif: ' + (data.aktif ? 'Ya' : 'Tidak'));
                    $('#detail_pengaturan').html(pengaturan.join('<br>'));
                } else {
                    Swal.fire('Peringatan', response.message, 'warning');
                }
            }).catch(function (error) {
            ErrorHandler.handleError(error);
        });
    });
</script>

