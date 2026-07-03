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
                    action: typeof newexportaction !== 'undefined' ? newexportaction : undefined,
                    className: 'btn btn-sm btn-dark rounded-2',
                    text: '<i class="bi bi-file-earmark-excel me-1"></i> Export Excel'
                }
            ],
            processing: true,
            serverSide: true,
            responsive: true,
            searchHighlight: true,
            ajax: {
                url: '{{ route('admin.kelas.mentor.list', ['id' => $id]) }}',
                type: 'GET',
                cache: false,
                error: function(xhr) {
                    let message = 'Gagal memuat data asisten mentor.';

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: message,
                        confirmButtonColor: '#3085d6',
                    });
                }
            },
            ordering: false,
            columns: [
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },
                {
                    data: 'mentor_nama',
                    name: 'mentor_nama',
                    defaultContent: '-',
                    render: function(data, type, row) {
                        const nama = data || '-';
                        const email = row.mentor_email || '';

                        if (email) {
                            return `
                                <div class="d-flex flex-column">
                                    <span class="fw-bold text-gray-800">${nama}</span>
                                    <span class="text-muted fs-8">${email}</span>
                                </div>
                            `;
                        }

                        return `<span class="fw-bold text-gray-800">${nama}</span>`;
                    }
                },
                {
                    data: 'peran',
                    name: 'peran',
                    defaultContent: 'Asisten Mentor',
                    render: function(data) {
                        return `
                            <span class="badge badge-light-primary fw-bold">
                                ${data || 'Asisten Mentor'}
                            </span>
                        `;
                    }
                },
            ],
            language: {
                emptyTable: 'Belum ada asisten mentor pada kelas ini.',
                zeroRecords: 'Asisten mentor tidak ditemukan.',
                processing: 'Memuat data...',
                search: 'Cari:',
                lengthMenu: 'Tampilkan _MENU_ data',
                info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                infoEmpty: 'Menampilkan 0 data',
                infoFiltered: '(difilter dari _MAX_ total data)',
                paginate: {
                    first: 'Awal',
                    last: 'Akhir',
                    next: 'Selanjutnya',
                    previous: 'Sebelumnya'
                }
            },
            drawCallback: function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
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
        }, 700);

        $('#mentor_table_filter input')
            .off('input')
            .on('input', function() {
                performOptimizedSearch($(this).val());
            });
    }

    $(document).ready(function() {
        load_mentor_table();
    });
</script>