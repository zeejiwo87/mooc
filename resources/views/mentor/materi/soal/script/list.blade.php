<script defer>
    function load_soal_table() {
        $.fn.dataTable.ext.errMode = 'none';
        const table = $('#soal_table').DataTable({
            dom: 'lBfrtip',
            stateSave: true,
            stateDuration: -1,
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
                url: '{{ route('mentor.materi.soal.list', ['id' => $id]) }}',
                cache: false,
            },
            order: [
                [1, 'asc']
            ],
            ordering: false,
            columns: [
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'teks_soal',
                    name: 'teks_soal'
                },
                {
                    data: 'nilai',
                    name: 'nilai'
                },
                {
                    data: 'gambar_soal',
                    name: 'gambar_soal'
                },
            ],
        });

        table.on('draw', function () {
            try {
                const info = table.page.info();
                $('#soal_total').text(info.recordsTotal ?? 0);
            } catch (e) {
                console.error('Error updating soal total:', e);
            }
        });

        const performOptimizedSearch = _.debounce(function (query) {
            try {
                if (query.length >= 3 || query.length === 0) {
                    table.search(query).draw();
                }
            } catch (error) {
                console.error('Error during search:', error);
            }
        }, 1000);

        $('#soal_table_filter input').unbind().on('input', function () {
            performOptimizedSearch($(this).val());
        });
    }

    load_soal_table();
</script>
