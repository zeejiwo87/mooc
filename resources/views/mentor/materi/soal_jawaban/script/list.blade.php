<script defer>
    function load_jawaban_table() {
        $.fn.dataTable.ext.errMode = 'none';

        if ($.fn.DataTable.isDataTable('#jawaban_table')) {
            $('#jawaban_table').DataTable().destroy();
        }

        const table = $('#jawaban_table').DataTable({
            dom: 'lBfrtip',
            stateSave: false,
            pageLength: 10,
            lengthMenu: [
                [10, 15, 20, 25],
                [10, 15, 20, 25]
            ],
            buttons: [
                {
                    extend: 'excel',
                        action: newexportaction,
                    className: 'btn btn-sm btn-dark rounded-2',
                },
            ],
            processing: true,
            serverSide: true,
            responsive: true,
            searchHighlight: true,
            ajax: {
                url: '{{ route('mentor.materi.jawaban.list', ['id' => $id]) }}',
                type: 'GET',
                cache: false,
                error: function (xhr) {
                    console.error(xhr.responseText);

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal memuat data jawaban',
                        text: 'Silakan cek kembali data soal atau relasi kelasnya.',
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            },
            order: [[1, 'asc']],
            ordering: false,
            columns: [
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'teks_jawaban',
                    name: 'teks_jawaban',
                    defaultContent: '-'
                },
                {
                    data: 'benar',
                    name: 'benar',
                    defaultContent: 'false',
                    render: function (data) {
                        return data == 1 || data === true || data === '1' || data === 'true'
                            ? 'true'
                            : 'false';
                    }
                },
            ],
        });

        table.on('draw', function () {
            const info = table.page.info();
            $('#jawaban_total').text(info.recordsTotal ?? 0);
        });

        const performOptimizedSearch = _.debounce(function (query) {
            if (query.length >= 3 || query.length === 0) {
                table.search(query).draw();
            }
        }, 700);

        $('#jawaban_table_filter input').off('input').on('input', function () {
            performOptimizedSearch($(this).val());
        });
    }

    $(document).ready(function () {
        load_jawaban_table();
    });
</script>