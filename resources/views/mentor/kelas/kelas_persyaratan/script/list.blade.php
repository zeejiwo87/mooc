<script defer>
    function load_persyaratan_table() {
        $.fn.dataTable.ext.errMode = 'none';
        const table = $('#persyaratan_table').DataTable({
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
                url: '{{ route('mentor.kelas.persyaratan.list', ['id' => $id]) }}',
                cache: false,
            },
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
                    data: 'persyaratan',
                    name: 'persyaratan'
                },
            ],
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

        $('#persyaratan_table_filter input').unbind().on('input', function () {
            performOptimizedSearch($(this).val());
        });
    }

    load_persyaratan_table();
</script>

