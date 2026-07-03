<?php

use App\Http\Controllers\Content\AuthController;
use App\Http\Controllers\Content\KelasController;
use App\Http\Controllers\Content\KursusController;
use App\Http\Controllers\Content\PortalController;
use App\Http\Controllers\Content\ProfilController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortalController::class, 'index'])->name('index');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'logindb'])->name('logindb');
Route::get('/daftar', [AuthController::class, 'daftar'])->name('daftar');
Route::post('/daftar', [AuthController::class, 'daftardb'])->name('daftardb');
Route::get('/email/verify', [AuthController::class, 'verification_notice'])->name('verification.notice');
Route::post('/email/verification-notification', [AuthController::class, 'sendVerificationEmail'])->name('verification.send');
Route::get('/email/verify/{id}', [AuthController::class, 'verifyEmail'])->name('verification.verify');
Route::get('/password/forgot', [AuthController::class, 'lupa_password'])->name('lupa_password');
Route::post('/password/email', [AuthController::class, 'lupa_password_db'])->name('lupa_password_db');
Route::get('/password/reset/{id}', [AuthController::class, 'reset_password'])->name('reset_password');
Route::post('/password/reset/{id}', [AuthController::class, 'reset_password_db'])->name('reset_password_db');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('kursus')->group(function () {
    Route::get('/', [KursusController::class, 'index'])->name('kursus.index');
    Route::get('/filter', [KursusController::class, 'filter'])->name('kursus.filter');
    Route::get('/{slug}', [KursusController::class, 'detail'])->name('kursus.detail');
    Route::get('/{kelas:slug}/enroll', [KursusController::class, 'enroll'])->name('kursus.enroll')->middleware('auth:pengguna');
    Route::post('/{kelas:slug}/enroll', [KursusController::class, 'enrollProcess'])->name('kursus.enroll-process')->middleware('auth:pengguna');
});

Route::prefix('pengguna')->middleware('auth:pengguna')->group(function () {
    Route::get('/profil', [ProfilController::class, 'profil'])->name('pengguna.profil');
    Route::post('/profil/biodata', [ProfilController::class, 'updateBiodata'])->name('pengguna.profil.biodata');
    Route::post('/profil/password', [ProfilController::class, 'updatePassword'])->name('pengguna.profil.password');
    Route::post('/profil/foto', [ProfilController::class, 'updateFoto'])->name('pengguna.profil.foto');

    Route::get('/kelas-saya', [KelasController::class, 'kelasSaya'])->name('pengguna.kelas_saya');
    Route::post('/kelas-saya/rating/{token}', [KelasController::class, 'simpanRating'])->name('pengguna.kelas_saya.rating');
    Route::get('/kelas-saya/sertifikat/{token}', [KelasController::class, 'sertifikat'])->name('pengguna.sertifikat');
    Route::get('/kelas-saya/sertifikat/{token}/download', [KelasController::class, 'downloadSertifikat'])->name('pengguna.sertifikat.download');

    Route::get('/kelas-saya/play/{token}', [KelasController::class, 'coursePlaying'])->name('pengguna.course_playing');
    Route::get('/kelas-saya/menu/{token}', [KelasController::class, 'mulaiBelajar'])->name('pengguna.mulai_belajar');
    Route::get('/kelas-saya/menu/{token}/{progress_token}', [KelasController::class, 'materiBelajar'])->name('pengguna.materi_belajar');
    Route::post('/kelas-saya/menu/{token}/{progress_token}', [KelasController::class, 'updateProgres'])->name('pengguna.progres_kelas.update');

    Route::post('/kelas-saya/menu/{token}/{progress_token}/kuis/mulai', [KelasController::class, 'mulaiKuis'])->name('pengguna.kuis.mulai');
    Route::post('/kelas-saya/menu/{token}/{progress_token}/kuis', [KelasController::class, 'submitJawabanKuis'])->name('pengguna.kuis.submit');
});

Route::post('log-error', [PortalController::class, 'error'])->name('log-error');

Route::get('sertifikat/verifikasi/{id}', [PortalController::class, 'sertifikat_verifikasi'])->name('sertifikat.verifikasi');
Route::get('{folder}/{filename}', [FileController::class, 'viewFile'])->name('view-file');