@extends('admin.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/buttons.dataTables.min.css') }}">
@endsection

@section('list')
    <li class="breadcrumb-item text-muted">Kelas</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">Data Kelas</li>
@endsection

@section('content')
    <div class="container-fluid">
        @php
            $bannerUrl = $kelas->banner
                ? route('view-file', ['banner', $kelas->banner])
                : asset('assets/media/logos/banner-default.jpg');

        @endphp

        <div class="card mb-5 mb-xl-10 overflow-hidden border-0 shadow-sm">
            <div class="position-relative">
                <div class="w-100"
                    style="height: 220px; background-image: url('{{ $bannerUrl }}'); background-size: cover; background-position: center;">
                </div>
            </div>

            <div class="card-body pt-10 pb-6 px-8">
                <div class="d-flex flex-column flex-lg-row justify-content-between gap-6">
                    <div class="flex-grow-1" >
                        <div class="d-flex flex-wrap justify-content-between align-items-start mb-3">
                            <div>
                                <h2 class="text-gray-900 text-hover-primary fw-bold fs-2 mb-1">
                                    {{ $kelas->judul ?? 'Judul tidak tersedia' }}
                                </h2>
                                <div class="text-muted fw-semibold mb-2">
                                    Oleh:
                                    <span class="text-gray-800">
                                        {{ $kelas->pemilik ?? 'Pemilik tidak tersedia' }}
                                    </span>
                                </div>
                            </div>

                            @php
                                $avgRating = $kelas->rating ?? 0;
                                $fullStars = floor($avgRating);
                                $hasHalfStar = $avgRating - $fullStars >= 0.5;

                                if ($avgRating >= 4.5) {
                                    $ratingLabel = 'Sangat Baik';
                                } elseif ($avgRating >= 3.5) {
                                    $ratingLabel = 'Baik';
                                } elseif ($avgRating > 0) {
                                    $ratingLabel = 'Cukup';
                                } else {
                                    $ratingLabel = 'Belum ada rating';
                                }
                            @endphp

                            <div class="d-flex flex-column align-items-lg-end align-items-start mt-3 mt-lg-0">
                                <div class="d-flex align-items-center mb-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $fullStars)
                                            <i class="bi bi-star-fill text-warning fs-5 me-1"></i>
                                        @elseif ($hasHalfStar && $i === $fullStars + 1)
                                            <i class="bi bi-star-half text-warning fs-5 me-1"></i>
                                        @else
                                            <i class="bi bi-star text-muted fs-5 me-1"></i>
                                        @endif
                                    @endfor

                                    <span class="fw-bold fs-5 ms-2">
                                        {{ number_format($avgRating, 1) }}
                                    </span>
                                </div>
                                <div class="d-flex flex-wrap align-items-center">
                                    <span class="badge badge-light-success me-2 mb-1">
                                        {{ $ratingLabel }}
                                    </span>
                                    <span class="text-muted fs-8 mb-1">
                                        ({{ $kelas->total_review ?? 0 }} ulasan)
                                    </span>
                                </div>
                            </div>
                        </div>

                        @if (!empty($kelas->deskripsi_singkat))
                            <p class="text-gray-700 fs-7 mb-4">
                                {{ $kelas->deskripsi_singkat }}
                            </p>
                        @endif

                        <div class="d-flex flex-wrap gap-6">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="bi bi-journal-text fs-2 text-gray-500"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-6">
                                        {{ $kelas->jumlah_materi ?? 0 }}
                                    </div>
                                    <div class="text-muted fs-8">Jumlah Materi</div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="bi bi-clock-history fs-2 text-gray-500"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-6">
                                        {{ $kelas->total_durasi_menit ?? 0 }} menit
                                    </div>
                                    <div class="text-muted fs-8">Durasi Total</div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="bi bi-people fs-2 text-gray-500"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-6">
                                        {{ $kelas->total_pendaftaran ?? 0 }}
                                    </div>
                                    <div class="text-muted fs-8">Total Pendaftar</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-header border-0 pb-0">
                <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6">
                    <li class="nav-item">
                        <a class="nav-link text-active-primary ms-0 me-8 py-5 text-nowrap {{ request()->routeIs('admin.kelas.kelas.histori') ? 'active' : '' }}"
                            href="{{ route('admin.kelas.kelas.histori', ['id' => $id]) }}">
                            Beranda
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-active-primary ms-0 me-8 py-5 text-nowrap {{ request()->routeIs('admin.kelas.mentor.*') ? 'active' : '' }}"
                            href="{{ route('admin.kelas.mentor.index', ['id' => $id]) }}">
                            Mentor
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-active-primary ms-0 me-8 py-5 text-nowrap {{ request()->routeIs('admin.kelas.persyaratan.*') ? 'active' : '' }}"
                            href="{{ route('admin.kelas.persyaratan.index', ['id' => $id]) }}">
                            Persyaratan
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-active-primary ms-0 me-8 py-5 text-nowrap {{ request()->routeIs('admin.kelas.tujuan_pembelajaran.*') ? 'active' : '' }}"
                            href="{{ route('admin.kelas.tujuan_pembelajaran.index', ['id' => $id]) }}">
                            Tujuan Pembelajaran
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-active-primary ms-0 me-8 py-5 text-nowrap {{ request()->routeIs('admin.kelas.target_peserta.*') ? 'active' : '' }}"
                            href="{{ route('admin.kelas.target_peserta.index', ['id' => $id]) }}">
                            Target Peserta
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-active-primary ms-0 me-8 py-5 text-nowrap {{ request()->routeIs('admin.kelas.kelas_tag.*') ? 'active' : '' }}"
                            href="{{ route('admin.kelas.kelas_tag.index', ['id' => $id]) }}">
                            Tag
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-active-primary ms-0 me-8 py-5 text-nowrap {{ request()->routeIs('admin.kelas.usulan_peserta.*') ? 'active' : '' }}"
                            href="{{ route('admin.kelas.usulan_peserta.index', ['id' => $id]) }}">
                            Ulasan Peserta
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-active-primary ms-0 me-8 py-5 text-nowrap {{ request()->routeIs('admin.materi.bagian_kelas.*') ? 'active' : '' }}"
                            href="{{ route('admin.materi.bagian_kelas.index', ['id' => $id]) }}">
                            Bagian Kelas
                        </a>
                    </li>
                </ul>
            </div>

            <div class="card-body p-8">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h3 class="fw-bold text-gray-900 mb-0">Bagian Kelas</h3>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#form_create">
                        Tambah Bagian
                    </button>
                </div>

                <div
                    class="table-responsive mb-8  p-4 mx-0 border-hover-dark border-primary border-1 fs-sm-8 fs-lg-6 rounded-2">
                    <table id="bagian_kelas_table"
                        class="table table-sm align-middle table-row-bordered table-row-solid gs-0 gy-2">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0 fs-sm-8 fs-lg-6">
                                <th class="min-w-125px ps-5 text-nowrap">Aksi</th>
                                <th class="min-w-25px">Urutan</th>
                                <th class="min-w-250px">Judul Bagian</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 fw-bolder fs-sm-8 fs-lg-6">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admin.kelas.bagian_kelas.view.create')
    @include('admin.kelas.bagian_kelas.view.edit')
    @include('admin.kelas.bagian_kelas.view.detail')
@endsection

@section('javascript')
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/lodash.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.colReorder.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/print.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.js') }}"></script>
    <script>
        function fetchDataDropdown(url, id, placeholder, name, callback) {
            DataManager.executeOperations(url, "admin_" + url, 60).then(response => {
                $(id).empty().append('<option></option>');
                if (response.success) {
                    response.data.forEach(item => {
                        $(id).append(`<option value="${item['id_' + placeholder]}">${item[name]}</option>`);
                    });
                    $(id).select2();
                    if (callback) {
                        callback();
                    }
                } else if (!response.errors) {
                    Swal.fire('Warning', response.message, 'warning');
                }
            }).catch(error => {
                ErrorHandler.handleError(error);
            });
        }
    </script>
    @include('admin.kelas.bagian_kelas.script.list')
    @include('admin.kelas.bagian_kelas.script.create')
    @include('admin.kelas.bagian_kelas.script.edit')
    @include('admin.kelas.bagian_kelas.script.detail')
    @include('admin.kelas.bagian_kelas.script.delete')
@endsection
