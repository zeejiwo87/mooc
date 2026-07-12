@extends('mentor.layouts.index')

@section('css')
    <style>
        /* =========================================================
           PROFILE MENTOR - SIMPLE & KONSISTEN
           Visual only: tidak mengubah form, name, id, route, atau JS
        ========================================================= */

        .neo-profile-page {
            width: 100%;
            padding: 0 24px 28px;
        }

        .neo-profile-page form {
            max-width: 980px;
            margin: 0 auto;
        }

        .neo-profile-card {
            overflow: hidden;
            border: 1px solid #eef2f7 !important;
            border-radius: 12px !important;
            background: #ffffff !important;
            box-shadow: 0 6px 18px rgba(15, 23, 42, .06) !important;
        }

        .neo-profile-card .card-body {
            padding: 22px !important;
            background: #ffffff !important;
        }

        .neo-profile-card .card-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            padding: 16px 22px 18px !important;
            background: #ffffff !important;
            border-top: 1px solid #eef2f7 !important;
        }

        .neo-section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0 0 20px;
            padding-bottom: 14px;
            color: #111827;
            border-bottom: 1px solid #eef2f7;
            font-size: 18px;
            line-height: 1.3;
            font-weight: 800;
        }

        .neo-section-icon {
            width: 40px;
            height: 40px;
            min-width: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #074366;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: none;
        }

        .neo-form-group {
            margin-bottom: 16px;
        }

        .neo-form-label {
            display: block;
            margin-bottom: 7px;
            color: #111827;
            font-size: 13px;
            font-weight: 800;
        }

        .neo-form-label.required::after {
            content: " *";
            color: #ef4444;
            font-weight: 900;
        }

        .neo-profile-card .form-control,
        .neo-profile-card textarea {
            width: 100%;
            color: #111827 !important;
            background: #ffffff !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            outline: none !important;
            transition: border-color .18s ease, box-shadow .18s ease;
        }

        .neo-profile-card .form-control {
            min-height: 42px;
            padding: 9px 12px !important;
        }

        .neo-profile-card textarea {
            min-height: 150px;
            padding: 10px 12px !important;
            line-height: 1.65;
            resize: vertical;
        }

        .neo-profile-card .form-control::placeholder,
        .neo-profile-card textarea::placeholder {
            color: #94a3b8;
            font-weight: 500;
        }

        .neo-profile-card .form-control:focus,
        .neo-profile-card textarea:focus {
            border-color: #074366 !important;
            box-shadow: 0 0 0 .2rem rgba(7, 67, 102, .10) !important;
        }

        .neo-profile-card .form-control.is-invalid,
        .neo-profile-card textarea.is-invalid {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 .2rem rgba(239, 68, 68, .10) !important;
        }

        .neo-profile-card .invalid-feedback {
            margin-top: 7px;
            font-size: 12px;
            font-weight: 600;
        }

        .neo-profile-card .btn,
        .neo-btn-light,
        .neo-btn-primary {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 9px 15px !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            font-size: 13px !important;
            line-height: 1;
            font-weight: 800 !important;
            text-decoration: none !important;
            transition: background .18s ease, border-color .18s ease, color .18s ease;
        }

        .neo-btn-light,
        .neo-profile-card .btn-light {
            color: #ffffff !important;
            background: #ef4444 !important;
            border: 1px solid #ef4444 !important;
        }

        .neo-btn-light:hover,
        .neo-profile-card .btn-light:hover {
            color: #ffffff !important;
            background: #dc2626 !important;
            border-color: #dc2626 !important;
            transform: none !important;
        }

        .neo-btn-primary,
        .neo-profile-card .btn-primary {
            color: #ffffff !important;
            background: #074366 !important;
            border: 1px solid #074366 !important;
        }

        .neo-btn-primary:hover,
        .neo-profile-card .btn-primary:hover {
            color: #ffffff !important;
            background: #052f49 !important;
            border-color: #052f49 !important;
            transform: none !important;
        }

        @media (max-width: 991.98px) {
            .neo-profile-page {
                padding: 0 18px 24px;
            }

            .neo-profile-card .card-body {
                padding: 20px !important;
            }

            .neo-profile-card .card-footer {
                padding: 15px 20px 18px !important;
            }
        }

        @media (max-width: 575.98px) {
            .neo-profile-page {
                padding: 0 14px 22px;
            }

            .neo-profile-card .card-body {
                padding: 16px !important;
            }

            .neo-profile-card .card-footer {
                flex-direction: column-reverse;
                align-items: stretch;
                padding: 14px 16px 16px !important;
            }

            .neo-profile-card .card-footer .btn {
                width: 100%;
            }

            .neo-section-title {
                align-items: flex-start;
                font-size: 16px;
            }

            .neo-section-icon {
                width: 36px;
                height: 36px;
                min-width: 36px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid neo-profile-page">
        <form method="post" id="form_profile" enctype="multipart/form-data">
            @csrf

            <div class="card neo-profile-card">
                <div class="card-body">
                    <div class="row g-5">
                        <div class="col-lg-8">
                            <div class="mb-0">
                                <h5 class="neo-section-title">
                                    <span class="neo-section-icon">
                                        <i class="bi bi-person-badge-fill fs-4"></i>
                                    </span>
                                    <span>Informasi Profile</span>
                                </h5>

                                <div class="neo-form-group">
                                    <label class="form-label neo-form-label required">
                                        Nama Lengkap
                                    </label>

                                    <input type="text"
                                           id="nama"
                                           name="nama"
                                           class="form-control form-control-sm"
                                           maxlength="255"
                                           placeholder="Masukkan nama lengkap"
                                           required
                                           value="{{ $mentor->nama }}">

                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="neo-form-group">
                                    <label class="form-label neo-form-label required">
                                        Email
                                    </label>

                                    <input type="email"
                                           id="email"
                                           name="email"
                                           class="form-control form-control-sm"
                                           maxlength="255"
                                           placeholder="contoh@email.com"
                                           required
                                           value="{{ $mentor->email }}">

                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="neo-form-group">
                                    <label class="form-label neo-form-label">
                                        Spesialisasi
                                    </label>

                                    <input type="text"
                                           id="spesialisasi"
                                           name="spesialisasi"
                                           class="form-control form-control-sm"
                                           maxlength="255"
                                           placeholder="Contoh: UI/UX Design, Hukum Islam, Data Science"
                                           value="{{ $mentor->spesialisasi }}">

                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="neo-form-group mb-0">
                                    <label class="form-label neo-form-label">
                                        Bio
                                    </label>

                                    <textarea id="bio"
                                              name="bio"
                                              class="form-control form-control-sm"
                                              rows="7"
                                              maxlength="1000"
                                              placeholder="Ceritakan profil singkat mentor, pengalaman, dan bidang keahlian">{{ $mentor->bio }}</textarea>

                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end gap-3 py-5">
                    <button type="reset" class="btn btn-light btn-sm neo-btn-light">
                        Reset
                    </button>

                    <button type="submit" class="btn btn-primary btn-sm neo-btn-primary">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('javascript')
    <script>
        @if(session()->has('success'))
            Swal.fire('Success', "{{ session()->get('success') }}", 'success');
        @endif
    </script>
@endsection