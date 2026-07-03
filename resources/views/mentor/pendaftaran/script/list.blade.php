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
                action: newexportaction,
                className: 'btn btn-sm btn-dark rounded-2',
            },
            ],
            processing: true,
            serverSide: true,
            responsive: true,
            searchHighlight: true,
            ajax: {
                url: '{{ route('mentor.kelas.pendaftaran.list') }}',
                cache: false,
                data: function (d) {
                    d.id_kelas = $('#filter_id_kelas').val();
                    d.status = $('#filter_status').val();
                },
            },
            order: [[3, 'desc']],
            ordering: false,
            columns: [
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                { data: 'pengguna_nama', name: 'pengguna_nama' },
                { data: 'kelas_judul', name: 'kelas_judul' },
                { data: 'terdaftar_pada', name: 'terdaftar_pada' },
                { data: 'persentase_progres', name: 'persentase_progres' },
                { data: 'status', name: 'status' },
                { data: 'selesai_pada', name: 'selesai_pada' },
                { data: 'terakhir_akses', name: 'terakhir_akses' },
            ],
        });

        fetchDataDropdown("{{ route('mentor.api.pendaftaran.kelas') }}", '#filter_id_kelas', 'kelas', 'judul', function () {
            $('#filter_id_kelas').on('change', function () {
                table.ajax.reload();
            });
        });

        $('#filter_status').on('change', function () {
            table.ajax.reload();
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

        $('#example_filter input').unbind().on('input', function () {
            performOptimizedSearch($(this).val());
        });
    }

    load_data();
</script>
