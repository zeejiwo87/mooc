<script defer>
    function load_data() {
        $.fn.dataTable.ext.errMode = 'none';
        const table = $('#example').DataTable({
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
                    text: 'Excel',
                        action: newexportaction,
                    className: 'btn btn-sm btn-dark rounded-2',
                },
            ],
            processing: true,
            serverSide: true,
            responsive: true,
            searchHighlight: true,
            ajax: {
                url: '{{ route('admin.app.pengguna.list') }}',
                cache: false,
            },
            order: [],
            ordering: false,
            columns: [{
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'telepon',
                    name: 'telepon'
                },
                {
                    data: 'terverifikasi',
                    name: 'terverifikasi',
                    render: function(data) {
                        return data ? 'Ya' : 'Tidak';
                    }
                },
                {
                    data: 'total_kelas_selesai',
                    name: 'total_kelas_selesai'
                },
                {
                    data: 'total_poin',
                    name: 'total_poin'
                },
            ],
        });

        const performOptimizedSearch = _.debounce(function(query) {
            try {
                if (query.length >= 3 || query.length === 0) {
                    table.search(query).draw();
                }
            } catch (error) {
                console.error('Error during search:', error);
            }
        }, 1000);

        $('#example_filter input').unbind().on('input', function() {
            performOptimizedSearch($(this).val());
        });
    }

    load_data();
</script>
