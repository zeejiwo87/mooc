@extends('mentor.layouts.index')

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
    <li class="breadcrumb-item text-dark">Soal</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card mb-5 mb-xl-10 overflow-hidden border-0 shadow-sm">
            <div class="card-body p-8">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h2 class="text-gray-900 fw-bold fs-2 mb-1">Bank Soal</h2>
                        <div class="text-muted fs-8">
                            Kelola seluruh soal untuk kuis ini, lengkap dengan nilai dan gambar.
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        @if(isset($kuis) && !empty($kuis->id_materi))
                            <a href="{{ route('mentor.materi.kuis.index', $kuis->id_materi) }}"
                               class="btn btn-danger btn-sm">
                                <i class="bi bi-arrow-left-short me-1"></i>
                                Kembali ke Kuis
                            </a>
                        @endif
                    </div>
                </div>

                <div class="d-flex flex-column flex-lg-row justify-content-between gap-6">
                    <div class="flex-grow-1">
                        <div class="d-flex flex-wrap justify-content-between align-items-start mb-3">
                            <div>
                                <div class="text-muted fw-semibold mb-1 fs-8">Kelas</div>
                                <h2 class="text-gray-900 text-hover-primary fw-bold fs-3 mb-1">
                                    {{ $kuis->kelas_judul ?? '-' }}
                                </h2>
                                <div class="text-muted fw-semibold mb-1 fs-8">Bagian &amp; Materi</div>
                                <div class="fw-bold fs-6 text-gray-900 mb-1">
                                    {{ $kuis->bagian_kelas_judul ?? '-' }} &mdash; {{ $kuis->materi_judul ?? '-' }}
                                </div>
                                <div class="text-muted fw-semibold mb-1 fs-8">Kuis</div>
                                <div class="fw-bold fs-6 text-gray-900">
                                    {{ $kuis->judul ?? '-' }}
                                </div>
                            </div>

                            <div class="d-flex flex-column align-items-lg-end align-items-start mt-3 mt-lg-0 text-end">
                                <span class="badge badge-light-primary mb-2">
                                    ID Kuis: {{ $kuis->id_kuis ?? '-' }}
                                </span>
                                <span class="text-muted fs-8">
                                    Kelola bank soal untuk kuis ini.
                                </span>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap align-items-center gap-3 mt-4">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-30px symbol-circle me-3 bg-light-primary">
                                    <span class="symbol-label fw-bold text-primary fs-8">1</span>
                                </div>
                                <div>
                                    <div class="fw-bold fs-7 text-gray-800">Rancang Kuis</div>
                                    <div class="text-muted fs-8">Pastikan pengaturan kuis sudah tepat.</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-30px symbol-circle me-3 bg-light-success">
                                    <span class="symbol-label fw-bold text-success fs-8">2</span>
                                </div>
                                <div>
                                    <div class="fw-bold fs-7 text-gray-800">Bangun Bank Soal</div>
                                    <div class="text-muted fs-8">Tambah soal dengan nilai dan gambar jika perlu.</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-30px symbol-circle me-3 bg-light-info">
                                    <span class="symbol-label fw-bold text-info fs-8">3</span>
                                </div>
                                <div>
                                    <div class="fw-bold fs-7 text-gray-800">Kelola Jawaban</div>
                                    <div class="text-muted fs-8">Kelola opsi jawaban dari menu aksi soal.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-header border-0 pt-6 pb-0 d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <h3 class="fw-bold text-gray-900 mb-1">Daftar Soal</h3>
                    <span class="text-muted fs-8">
                        Susun soal yang variatif dan seimbang berdasarkan tingkat kesulitan.
                    </span>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="badge badge-light fw-semibold fs-8">
                        Total Soal: <span id="soal_total" class="text-gray-900">0</span>
                    </div>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                            data-bs-target="#form_create">
                        Tambah Soal
                    </button>
                </div>
            </div>

            <div class="card-body p-8">
                <div
                    class="table-responsive mb-2  p-4 mx-0 border-hover-dark border-primary border-1  fs-sm-8 fs-lg-6 rounded-2 bg-white">
                    <table id="soal_table"
                           class="table table-sm align-middle table-row-bordered table-row-solid gs-0 gy-2">
                        <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0 fs-sm-8 fs-lg-6">
                            <th class="min-w-125px ps-5 text-nowrap">Aksi</th>
                            <th class="min-w-260px">Teks Soal</th>
                            <th class="min-w-80px">Nilai</th>
                            <th class="min-w-100px">Gambar</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-800 fw-bolder fs-sm-8 fs-lg-6">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('mentor.materi.soal.view.create')
    @include('mentor.materi.soal.view.edit')
    @include('mentor.materi.soal.view.detail')
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
    @include('mentor.materi.soal.script.list')
    @include('mentor.materi.soal.script.create')
    @include('mentor.materi.soal.script.edit')
    @include('mentor.materi.soal.script.detail')
    @include('mentor.materi.soal.script.delete')
@endsection
