<script defer>
    function load_mentor_table() {
        $.fn.dataTable.ext.errMode = 'none';

        if ($.fn.DataTable.isDataTable('#mentor_table')) {
            $('#mentor_table').DataTable().clear().destroy();
        }

        const table = $('#mentor_table').DataTable({
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
                url: '{{ route('mentor.kelas.mentor.list', ['id' => $id]) }}',
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
                    data: 'mentor_nama',
                    name: 'mentor_nama'
                },
                {
                    data: 'peran',
                    name: 'peran',
                    render: function(data) {
                        return data || 'Asisten Mentor';
                    }
                },
            ],
            language: {
                emptyTable: 'Belum ada asisten mentor pada kelas ini.',
                zeroRecords: 'Asisten mentor tidak ditemukan.',
                processing: 'Memuat data...',
                search: 'Cari:',
                lengthMenu: 'Tampilkan _MENU_ entri',
                info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
                infoEmpty: 'Menampilkan 0 sampai 0 dari 0 entri',
                infoFiltered: '(difilter dari _MAX_ total entri)',
                paginate: {
                    first: 'Awal',
                    last: 'Akhir',
                    next: 'Selanjutnya',
                    previous: 'Sebelumnya'
                }
            },
            drawCallback: function() {
                removeMentorActionMutationButtons();
            }
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

        $('#mentor_table_filter input').unbind().on('input', function() {
            performOptimizedSearch($(this).val());
        });
    }

    load_mentor_table();
</script>