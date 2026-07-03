<script defer>
    function load_materi_table() {
        $.fn.dataTable.ext.errMode = 'none';
        const table = $('#materi_table').DataTable({
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
                url: '{{ route('mentor.materi.materi.list', ['id' => $id]) }}',
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
                    data: 'urutan',
                    name: 'urutan'
                },
                {
                    data: 'judul',
                    name: 'judul'
                },
                {
                    data: 'tipe',
                    name: 'tipe'
                },
                {
                    data: 'durasi_detik',
                    name: 'durasi_detik'
                },
                {
                    data: 'preview',
                    name: 'preview'
                },
            ],
        });

        table.on('draw', function () {
            try {
                const info = table.page.info();
                $('#materi_total').text(info.recordsTotal ?? 0);
            } catch (e) {
                console.error('Error updating materi total:', e);
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

        $('#materi_table_filter input').unbind().on('input', function () {
            performOptimizedSearch($(this).val());
        });
    }

    load_materi_table();
</script>
