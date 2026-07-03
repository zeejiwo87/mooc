@extends('mentor.layouts.index')

@section('css')
    <style>
        .neo-profile-page {
            padding-bottom: 32px;
        }

        .neo-profile-card {
            overflow: hidden;
            border: 0 !important;
            border-radius: 30px;
            background: #f4f7fb;
            box-shadow:
                10px 10px 24px rgba(148, 163, 184, 0.28),
                -10px -10px 24px rgba(255, 255, 255, 0.95);
        }

        .neo-profile-card .card-body {
            padding: 30px !important;
        }

        .neo-profile-card .card-footer {
            border-top: 1px solid rgba(148, 163, 184, 0.16);
            background: transparent;
            padding: 22px 30px !important;
        }

        .neo-section-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 28px;
            padding-bottom: 18px;
            border-bottom: 1px solid rgba(148, 163, 184, 0.16);
            color: #111827;
            font-size: 19px;
            font-weight: 900;
            letter-spacing: -0.02em;
        }

        .neo-section-icon {
            width: 48px;
            height: 48px;
            min-width: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
            color: #009ef7;
            background: #f4f7fb;
            box-shadow:
                inset 5px 5px 10px rgba(148, 163, 184, 0.25),
                inset -5px -5px 10px rgba(255, 255, 255, 0.95);
        }

        .neo-form-group {
            margin-bottom: 22px;
        }

        .neo-form-label {
            margin-bottom: 9px;
            color: #374151;
            font-size: 13px;
            font-weight: 900;
        }

        .neo-form-label.required::after {
            content: " *";
            color: #ef4444;
            font-weight: 900;
        }

        .neo-profile-card .form-control,
        .neo-profile-card textarea {
            border: 0 !important;
            border-radius: 17px !important;
            padding: 13px 16px !important;
            color: #111827 !important;
            background: #f4f7fb !important;
            box-shadow:
                inset 5px 5px 10px rgba(148, 163, 184, 0.22),
                inset -5px -5px 10px rgba(255, 255, 255, 0.94) !important;
            font-size: 13px !important;
            font-weight: 700 !important;
            outline: none !important;
        }

        .neo-profile-card .form-control {
            min-height: 46px;
        }

        .neo-profile-card textarea {
            resize: vertical;
            min-height: 160px;
            line-height: 1.7;
        }

        .neo-profile-card .form-control::placeholder,
        .neo-profile-card textarea::placeholder {
            color: #9ca3af;
            font-weight: 600;
        }

        .neo-profile-card .form-control:focus,
        .neo-profile-card textarea:focus {
            box-shadow:
                inset 5px 5px 10px rgba(148, 163, 184, 0.26),
                inset -5px -5px 10px rgba(255, 255, 255, 0.98),
                0 0 0 3px rgba(0, 158, 247, 0.11) !important;
        }

        .neo-profile-card .form-control.is-invalid,
        .neo-profile-card textarea.is-invalid {
            box-shadow:
                inset 5px 5px 10px rgba(148, 163, 184, 0.22),
                inset -5px -5px 10px rgba(255, 255, 255, 0.94),
                0 0 0 3px rgba(239, 68, 68, 0.13) !important;
        }

        .neo-profile-card .invalid-feedback {
            margin-top: 8px;
            font-size: 12px;
            font-weight: 700;
        }

        .neo-btn-light {
            border: 0 !important;
            border-radius: 16px !important;
            padding: 11px 18px !important;
            color: #374151 !important;
            background: #f4f7fb !important;
            box-shadow:
                6px 6px 14px rgba(148, 163, 184, 0.24),
                -6px -6px 14px rgba(255, 255, 255, 0.94) !important;
            font-size: 13px !important;
            font-weight: 900 !important;
            transition:
                transform 0.16s ease,
                box-shadow 0.16s ease,
                color 0.16s ease !important;
        }

        .neo-btn-light:hover {
            transform: translateY(-1px);
            color: #111827 !important;
            background: #f4f7fb !important;
            box-shadow:
                8px 8px 18px rgba(148, 163, 184, 0.30),
                -8px -8px 18px rgba(255, 255, 255, 1) !important;
        }

        .neo-btn-primary {
            border: 0 !important;
            border-radius: 16px !important;
            padding: 11px 18px !important;
            color: #ffffff !important;
            background: #009ef7 !important;
            box-shadow:
                6px 6px 14px rgba(0, 158, 247, 0.24),
                -6px -6px 14px rgba(255, 255, 255, 0.95) !important;
            font-size: 13px !important;
            font-weight: 900 !important;
            transition:
                transform 0.16s ease,
                box-shadow 0.16s ease,
                background 0.16s ease !important;
        }

        .neo-btn-primary:hover {
            transform: translateY(-1px);
            color: #ffffff !important;
            background: #008ee0 !important;
            box-shadow:
                8px 8px 18px rgba(0, 158, 247, 0.30),
                -8px -8px 18px rgba(255, 255, 255, 1) !important;
        }

        @media (max-width: 991.98px) {
            .neo-profile-card {
                border-radius: 26px;
            }

            .neo-profile-card .card-body {
                padding: 24px !important;
            }

            .neo-profile-card .card-footer {
                padding: 20px 24px !important;
            }
        }

        @media (max-width: 575.98px) {
            .neo-profile-card {
                border-radius: 24px;
            }

            .neo-profile-card .card-body {
                padding: 20px !important;
            }

            .neo-profile-card .card-footer {
                padding: 18px 20px !important;
                flex-direction: column;
            }

            .neo-profile-card .card-footer .btn {
                width: 100%;
            }

            .neo-section-title {
                align-items: flex-start;
                font-size: 17px;
            }

            .neo-section-icon {
                width: 44px;
                height: 44px;
                min-width: 44px;
                border-radius: 16px;
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