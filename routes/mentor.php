<?php

use App\Http\Controllers\Mentor\Kelas\KategoriController;
use App\Http\Controllers\Mentor\Kelas\KategoriSubController;
use App\Http\Controllers\Mentor\Kelas\KelasController;
use App\Http\Controllers\Mentor\Kelas\KelasMentorController;
use App\Http\Controllers\Mentor\Kelas\KelasPersyaratanController;
use App\Http\Controllers\Mentor\Kelas\KelasTagController as KelasPivotTagController;
use App\Http\Controllers\Mentor\Kelas\KelasTargetPesertaController;
use App\Http\Controllers\Mentor\Kelas\KelasTujuanPembelajaranController;
use App\Http\Controllers\Mentor\Kelas\KelasUsulanPesertaController;
use App\Http\Controllers\Mentor\Kelas\TagController;
use App\Http\Controllers\Mentor\Materi\BagianKelasController as MateriBagianKelasController;
use App\Http\Controllers\Mentor\Materi\KuisController as MateriKuisController;
use App\Http\Controllers\Mentor\Materi\MateriController as MateriMateriController;
use App\Http\Controllers\Mentor\Materi\SoalController as MateriSoalController;
use App\Http\Controllers\Mentor\Materi\SoalJawabanController as MateriSoalJawabanController;
use App\Http\Controllers\Mentor\Pendaftaran\PendaftaranController;
use App\Http\Controllers\Mentor\Pendaftaran\ProgresKelasController;
use App\Http\Controllers\Mentor\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('auth/profile', [ProfileController::class, 'index'])
->name('profile');
Route::post('auth/profile', [ProfileController::class, 'update'])
->name('profile');
Route::prefix('kelas')->group(function () {
    Route::prefix('kelas')->group(function () {
        Route::get('/', [KelasController::class, 'index'])
            ->name('kelas.kelas.index');
        Route::get('/kelas/{id}', [KelasController::class, 'histori'])
            ->name('kelas.kelas.histori');
        Route::get('/kelas/{id}/builder/export', [KelasController::class, 'exportBuilder'])
            ->name('kelas.kelas.builder.export');
        Route::get('data', [KelasController::class, 'list'])
            ->name('kelas.kelas.list');
        Route::get('show/{id}', [KelasController::class, 'show'])
            ->name('kelas.kelas.show');
        Route::post('/store', [KelasController::class, 'store'])
            ->name('kelas.kelas.store');
        Route::post('update/{id}', [KelasController::class, 'update'])
            ->name('kelas.kelas.update');
    });
    Route::prefix('kelas_tag')->group(function () {
        Route::get('/{id}', [KelasPivotTagController::class, 'index'])
            ->name('kelas.kelas_tag.index');
        Route::get('data/{id}', [KelasPivotTagController::class, 'list'])
            ->name('kelas.kelas_tag.list');
        Route::get('show/{id}', [KelasPivotTagController::class, 'show'])
            ->name('kelas.kelas_tag.show');
        Route::post('/store', [KelasPivotTagController::class, 'store'])
            ->name('kelas.kelas_tag.store');
        Route::post('update/{id}', [KelasPivotTagController::class, 'update'])
            ->name('kelas.kelas_tag.update');
        Route::post('delete/{id}', [KelasPivotTagController::class, 'delete'])
            ->name('kelas.kelas_tag.delete');
    });

    Route::prefix('mentor')->group(function () {
        Route::get('/{id}', [KelasMentorController::class, 'index'])
            ->name('kelas.mentor.index');
        Route::get('data/{id}', [KelasMentorController::class, 'list'])
            ->name('kelas.mentor.list');
        Route::get('show/{id}', [KelasMentorController::class, 'show'])
            ->name('kelas.mentor.show');
        Route::post('/store', [KelasMentorController::class, 'store'])
            ->name('kelas.mentor.store');
        Route::post('update/{id}', [KelasMentorController::class, 'update'])
            ->name('kelas.mentor.update');
        Route::post('delete/{id}', [KelasMentorController::class, 'delete'])
            ->name('kelas.mentor.delete');
    });

    Route::prefix('persyaratan')->group(function () {
        Route::get('/{id}', [KelasPersyaratanController::class, 'index'])
            ->name('kelas.persyaratan.index');
        Route::get('data/{id}', [KelasPersyaratanController::class, 'list'])
            ->name('kelas.persyaratan.list');
        Route::get('show/{id}', [KelasPersyaratanController::class, 'show'])
            ->name('kelas.persyaratan.show');
        Route::post('/store', [KelasPersyaratanController::class, 'store'])
            ->name('kelas.persyaratan.store');
        Route::post('update/{id}', [KelasPersyaratanController::class, 'update'])
            ->name('kelas.persyaratan.update');
        Route::post('delete/{id}', [KelasPersyaratanController::class, 'delete'])
            ->name('kelas.persyaratan.delete');
    });

    Route::prefix('target_peserta')->group(function () {
        Route::get('/{id}', [KelasTargetPesertaController::class, 'index'])
            ->name('kelas.target_peserta.index');
        Route::get('data/{id}', [KelasTargetPesertaController::class, 'list'])
            ->name('kelas.target_peserta.list');
        Route::get('show/{id}', [KelasTargetPesertaController::class, 'show'])
            ->name('kelas.target_peserta.show');
        Route::post('/store', [KelasTargetPesertaController::class, 'store'])
            ->name('kelas.target_peserta.store');
        Route::post('update/{id}', [KelasTargetPesertaController::class, 'update'])
            ->name('kelas.target_peserta.update');
        Route::post('delete/{id}', [KelasTargetPesertaController::class, 'delete'])
            ->name('kelas.target_peserta.delete');
    });

    Route::prefix('tujuan_pembelajaran')->group(function () {
        Route::get('/{id}', [KelasTujuanPembelajaranController::class, 'index'])
            ->name('kelas.tujuan_pembelajaran.index');
        Route::get('data/{id}', [KelasTujuanPembelajaranController::class, 'list'])
            ->name('kelas.tujuan_pembelajaran.list');
        Route::get('show/{id}', [KelasTujuanPembelajaranController::class, 'show'])
            ->name('kelas.tujuan_pembelajaran.show');
        Route::post('/store', [KelasTujuanPembelajaranController::class, 'store'])
            ->name('kelas.tujuan_pembelajaran.store');
        Route::post('update/{id}', [KelasTujuanPembelajaranController::class, 'update'])
            ->name('kelas.tujuan_pembelajaran.update');
        Route::post('delete/{id}', [KelasTujuanPembelajaranController::class, 'delete'])
            ->name('kelas.tujuan_pembelajaran.delete');
    });

    Route::prefix('usulan_peserta')->group(function () {
        Route::get('/{id}', [KelasUsulanPesertaController::class, 'index'])
            ->name('kelas.usulan_peserta.index');
        Route::get('data/{id}', [KelasUsulanPesertaController::class, 'list'])
            ->name('kelas.usulan_peserta.list');
    });

    Route::prefix('tag')->group(function () {
        Route::get('/', [TagController::class, 'index'])
            ->name('kelas.tag.index');
        Route::get('data', [TagController::class, 'list'])
            ->name('kelas.tag.list');
        Route::get('show/{id}', [TagController::class, 'show'])
            ->name('kelas.tag.show');
    });

    Route::prefix('kategori')->group(function () {
        Route::get('/', [KategoriController::class, 'index'])
            ->name('kelas.kategori.index');
        Route::get('data', [KategoriController::class, 'list'])
            ->name('kelas.kategori.list');
        Route::get('show/{id}', [KategoriController::class, 'show'])
            ->name('kelas.kategori.show');
    });

    Route::prefix('kategori_sub')->group(function () {
        Route::get('/', [KategoriSubController::class, 'index'])
            ->name('kelas.kategori_sub.index');
        Route::get('data', [KategoriSubController::class, 'list'])
            ->name('kelas.kategori_sub.list');
        Route::get('show/{id}', [KategoriSubController::class, 'show'])
            ->name('kelas.kategori_sub.show');
    });

    Route::prefix('pendaftaran')->group(function () {
        Route::get('/', [PendaftaranController::class, 'index'])
            ->name('kelas.pendaftaran.index');
        Route::get('data', [PendaftaranController::class, 'list'])
            ->name('kelas.pendaftaran.list');
        Route::get('show/{id}', [PendaftaranController::class, 'show'])
            ->name('kelas.pendaftaran.show');
    });

    Route::prefix('progres-kelas')->group(function () {
        Route::get('/{id}', [ProgresKelasController::class, 'index'])
            ->name('kelas.progres_kelas.index');
        Route::post('sync/{id}', [ProgresKelasController::class, 'sync'])
            ->name('kelas.progres_kelas.sync');
        Route::post('sync/tuntas/{id}', [ProgresKelasController::class, 'syncTuntas'])
            ->name('kelas.progres_kelas.sync_tuntas');
        Route::get('sertifikat/{id}', [ProgresKelasController::class, 'sertifikat'])
            ->name('kelas.progres_kelas.sertifikat');
    });
});

Route::prefix('materi')->group(function () {
    Route::prefix('bagian_kelas')->group(function () {
        Route::get('/{id}', [MateriBagianKelasController::class, 'index'])
            ->name('materi.bagian_kelas.index');
        Route::get('data/{id}', [MateriBagianKelasController::class, 'list'])
            ->name('materi.bagian_kelas.list');
        Route::get('show/{id}', [MateriBagianKelasController::class, 'show'])
            ->name('materi.bagian_kelas.show');
        Route::post('/store', [MateriBagianKelasController::class, 'store'])
            ->name('materi.bagian_kelas.store');
        Route::post('update/{id}', [MateriBagianKelasController::class, 'update'])
            ->name('materi.bagian_kelas.update');
        Route::post('delete/{id}', [MateriBagianKelasController::class, 'delete'])
            ->name('materi.bagian_kelas.delete');
    });

    Route::prefix('materi')->group(function () {
        Route::get('/{id}', [MateriMateriController::class, 'index'])
            ->name('materi.materi.index');
        Route::get('data/{id}', [MateriMateriController::class, 'list'])
            ->name('materi.materi.list');
        Route::get('show/{id}', [MateriMateriController::class, 'show'])
            ->name('materi.materi.show');
        Route::post('/store', [MateriMateriController::class, 'store'])
            ->name('materi.materi.store');
        Route::post('update/{id}', [MateriMateriController::class, 'update'])
            ->name('materi.materi.update');
        Route::post('delete/{id}', [MateriMateriController::class, 'delete'])
            ->name('materi.materi.delete');
    });

    Route::prefix('kuis')->group(function () {
        Route::get('/{id}', [MateriKuisController::class, 'index'])
            ->name('materi.kuis.index');
        Route::get('data/{id}', [MateriKuisController::class, 'list'])
            ->name('materi.kuis.list');
        Route::get('show/{id}', [MateriKuisController::class, 'show'])
            ->name('materi.kuis.show');
        Route::post('/store', [MateriKuisController::class, 'store'])
            ->name('materi.kuis.store');
        Route::post('update/{id}', [MateriKuisController::class, 'update'])
            ->name('materi.kuis.update');
        Route::post('delete/{id}', [MateriKuisController::class, 'delete'])
            ->name('materi.kuis.delete');
    });

    Route::prefix('soal')->group(function () {
        Route::get('/{id}', [MateriSoalController::class, 'index'])
            ->name('materi.soal.index');
        Route::get('data/{id}', [MateriSoalController::class, 'list'])
            ->name('materi.soal.list');
        Route::get('show/{id}', [MateriSoalController::class, 'show'])
            ->name('materi.soal.show');
        Route::post('/store', [MateriSoalController::class, 'store'])
            ->name('materi.soal.store');
        Route::post('update/{id}', [MateriSoalController::class, 'update'])
            ->name('materi.soal.update');
        Route::post('delete/{id}', [MateriSoalController::class, 'delete'])
            ->name('materi.soal.delete');
        Route::post('import/{id}', [MateriSoalController::class, 'import'])
            ->name('materi.soal.import');
    });

    Route::prefix('jawaban')->group(function () {
        Route::get('/{id}', [MateriSoalJawabanController::class, 'index'])
            ->name('materi.jawaban.index');
        Route::get('data/{id}', [MateriSoalJawabanController::class, 'list'])
            ->name('materi.jawaban.list');
        Route::get('show/{id}', [MateriSoalJawabanController::class, 'show'])
            ->name('materi.jawaban.show');
        Route::post('/store', [MateriSoalJawabanController::class, 'store'])
            ->name('materi.jawaban.store');
        Route::post('update/{id}', [MateriSoalJawabanController::class, 'update'])
            ->name('materi.jawaban.update');
        Route::post('delete/{id}', [MateriSoalJawabanController::class, 'delete'])
            ->name('materi.jawaban.delete');
    });
});

Route::prefix('api')->group(function () {
    Route::prefix('kelas')->group(function () {
        Route::get('tag', [TagController::class, 'api'])
            ->name('api.kelas.tag');
        Route::get('kategori', [KategoriController::class, 'api'])
            ->name('api.kelas.kategori');
        Route::get('kategori_sub/{id}', [KategoriSubController::class, 'api'])
            ->name('api.kelas.kategori_sub')
            ->whereNumber('id');
        Route::get('mentor', [KelasMentorController::class, 'api'])
            ->name('api.kelas.mentor');
    });
    Route::prefix('pendaftaran')->group(function () {
        Route::get('kelas', [KelasController::class, 'api'])
            ->name('api.pendaftaran.kelas');
    });
});
