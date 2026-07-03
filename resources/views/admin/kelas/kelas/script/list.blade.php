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
                url: '{{ route('admin.kelas.kelas.list') }}',
                cache: false,
                data: function (d) {
                    d.id_kategori = $('#filter_id_kategori').val();
                    d.tingkat = $('#filter_tingkat').val();
                    d.bahasa = $('#filter_bahasa').val();
                    d.status = $('#filter_status').val();
                },
            },
            order: [
                [2, 'asc']
            ],
            ordering: false,
            columns: [{
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'judul',
                    name: 'judul'
                },
                {
                    data: 'kategori_nama',
                    name: 'kategori_nama'
                },
                {
                    data: 'kategori_sub_nama',
                    name: 'kategori_sub_nama'
                },
                {
                    data: 'pemilik',
                    name: 'pemilik'
                },
                {
                    data: 'tingkat',
                    name: 'tingkat',
                    render: function(data) {
                        switch (data) {
                            case 'pemula':
                                return 'Pemula';
                            case 'menengah':
                                return 'Menengah';
                            case 'lanjutan':
                                return 'Lanjutan';
                            default:
                                return data ?? '';
                        }
                    }
                },
                {
                    data: 'bahasa',
                    name: 'bahasa',
                    render: function(data) {
                        switch (data) {
                            case 'ID':
                                return 'Indonesia';
                            case 'EN':
                                return 'Inggris';
                            case 'AR':
                                return 'Arab';
                            default:
                                return data ?? '';
                        }
                    }
                },
                {
                    data: 'sertifikat',
                    name: 'sertifikat',
                    orderable: false,
                    searchable: false,
                    render: function (data) {
                        if (data) {
                            return '<span class="badge badge-light-success">Ada</span>';
                        }
                        return '<span class="badge badge-light-secondary">Tidak Ada</span>';
                    }
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data) {
                        switch (data) {
                            case 'draft':
                                return 'Draft';
                            case 'terbit':
                                return 'Terbit';
                            case 'arsip':
                                return 'Arsip';
                            default:
                                return data ?? '';
                        }
                    }
                },
            ],
        });

        fetchDataDropdown("{{ route('admin.api.kelas.kategori') }}", '#filter_id_kategori', 'kategori', 'nama', function () {
            $('#filter_id_kategori').on('change', function () {
                table.ajax.reload();
            });
        });

        $('#filter_tingkat, #filter_bahasa, #filter_status').on('change', function () {
            table.ajax.reload();
        });

        $('#btn_reset_filter_kelas').on('click', function () {
            $('#filter_id_kategori').val(null).trigger('change');
            $('#filter_tingkat').val('').trigger('change');
            $('#filter_bahasa').val('').trigger('change');
            $('#filter_status').val('').trigger('change');
            table.ajax.reload();
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
