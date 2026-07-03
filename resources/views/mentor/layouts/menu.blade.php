<style>
    :root {
        --neo-dark-bg: #111827;
        --neo-dark-surface: #151f32;
        --neo-dark-surface-soft: #1b2740;
        --neo-dark-border: rgba(255, 255, 255, 0.06);
        --neo-dark-text: #e5e7eb;
        --neo-dark-muted: #9ca3af;
        --neo-dark-primary: #009ef7;
        --neo-dark-primary-2: #3b82f6;
        --neo-dark-shadow-dark: rgba(0, 0, 0, 0.45);
        --neo-dark-shadow-light: rgba(255, 255, 255, 0.055);
        --neo-dark-inset-dark: rgba(0, 0, 0, 0.42);
        --neo-dark-inset-light: rgba(255, 255, 255, 0.05);
    }

    #kt_aside.aside {
        background:
            radial-gradient(circle at top left, rgba(0, 158, 247, 0.12), transparent 34%),
            radial-gradient(circle at bottom right, rgba(59, 130, 246, 0.08), transparent 32%),
            linear-gradient(145deg, #121a2b, #0d1320) !important;
        border-right: 1px solid var(--neo-dark-border);
        box-shadow:
            14px 0 35px rgba(0, 0, 0, 0.28),
            inset -1px 0 0 rgba(255, 255, 255, 0.04) !important;
    }

    #kt_aside_logo {
        min-height: 74px;
        padding: 14px 16px !important;
        background: transparent !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.055) !important;
    }

    #kt_aside_logo p {
        width: 100%;
        margin: 0 !important;
        padding: 14px 16px !important;
        color: var(--neo-dark-text) !important;
        line-height: 1.25;
        text-align: center;
        border-radius: 20px;
        background: linear-gradient(145deg, #172238, #101827);
        box-shadow:
            7px 7px 16px var(--neo-dark-shadow-dark),
            -7px -7px 16px var(--neo-dark-shadow-light),
            inset 1px 1px 0 rgba(255, 255, 255, 0.035);
    }

    #kt_aside .aside-menu {
        background: transparent !important;
    }

    .neo-mentor-sidebar-wrapper {
        padding: 0 14px 18px;
    }

    .neo-mentor-sidebar-card {
        position: relative;
        overflow: hidden;
        border-radius: 26px;
        padding: 14px;
        background: linear-gradient(145deg, #151f32, #0f1726);
        box-shadow:
            inset 5px 5px 13px var(--neo-dark-inset-dark),
            inset -5px -5px 13px var(--neo-dark-inset-light),
            8px 8px 20px rgba(0, 0, 0, 0.20);
    }

    .neo-mentor-sidebar-card::before {
        content: "";
        position: absolute;
        width: 150px;
        height: 150px;
        right: -78px;
        top: -78px;
        border-radius: 50%;
        background: rgba(0, 158, 247, 0.11);
        pointer-events: none;
    }

    .neo-mentor-sidebar-card::after {
        content: "";
        position: absolute;
        width: 120px;
        height: 120px;
        left: -70px;
        bottom: -70px;
        border-radius: 50%;
        background: rgba(59, 130, 246, 0.075);
        pointer-events: none;
    }

    .neo-mentor-menu.menu {
        position: relative;
        z-index: 1;
    }

    .neo-mentor-menu .menu-item {
        margin: 0;
    }

    .neo-menu-section-label {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 14px 4px 8px;
        color: var(--neo-dark-muted);
        font-size: 10px;
        font-weight: 900;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .neo-menu-section-label:first-child {
        margin-top: 2px;
    }

    .neo-menu-section-label::after {
        content: "";
        height: 1px;
        flex: 1;
        background: rgba(255, 255, 255, 0.07);
    }

    .neo-mentor-menu .menu-link {
        position: relative;
        min-height: 48px;
        margin: 7px 0;
        padding: 11px 13px !important;
        border-radius: 17px;
        color: var(--neo-dark-text) !important;
        background: transparent;
        border: 1px solid transparent;
        transition:
            transform 0.18s ease,
            box-shadow 0.18s ease,
            background 0.18s ease,
            border-color 0.18s ease,
            color 0.18s ease;
    }

    .neo-mentor-menu .menu-link:hover {
        transform: translateY(-1px);
        color: #ffffff !important;
        background: linear-gradient(145deg, #18243a, #111a2b);
        border-color: rgba(255, 255, 255, 0.055);
        box-shadow:
            6px 6px 14px var(--neo-dark-shadow-dark),
            -6px -6px 14px var(--neo-dark-shadow-light);
    }

    .neo-mentor-menu .menu-link.active,
    .neo-mentor-menu .menu-item.here > .menu-link,
    .neo-mentor-menu .menu-item.show > .menu-link {
        color: #ffffff !important;
        background: linear-gradient(135deg, var(--neo-dark-primary), var(--neo-dark-primary-2)) !important;
        border-color: rgba(255, 255, 255, 0.10);
        box-shadow:
            8px 8px 18px rgba(0, 0, 0, 0.38),
            -5px -5px 14px rgba(255, 255, 255, 0.055),
            inset 1px 1px 0 rgba(255, 255, 255, 0.18);
    }

    .neo-mentor-menu .menu-title {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: inherit !important;
        font-size: 13px;
        font-weight: 800;
        letter-spacing: 0.01em;
    }

    .neo-menu-icon {
        width: 34px;
        height: 34px;
        min-width: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        color: var(--neo-dark-primary);
        background: linear-gradient(145deg, #18243a, #101827);
        box-shadow:
            4px 4px 10px rgba(0, 0, 0, 0.38),
            -4px -4px 10px rgba(255, 255, 255, 0.045),
            inset 1px 1px 0 rgba(255, 255, 255, 0.035);
        transition: 0.18s ease;
    }

    .neo-mentor-menu .menu-link:hover .neo-menu-icon {
        color: #ffffff;
        background: linear-gradient(145deg, #1d2b46, #121b2d);
    }

    .neo-mentor-menu .menu-link.active .neo-menu-icon,
    .neo-mentor-menu .menu-item.here > .menu-link .neo-menu-icon,
    .neo-mentor-menu .menu-item.show > .menu-link .neo-menu-icon {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.17);
        box-shadow:
            inset 2px 2px 5px rgba(0, 0, 0, 0.18),
            inset -2px -2px 5px rgba(255, 255, 255, 0.14);
    }

    .hover-scroll-overlay-y::-webkit-scrollbar {
        width: 6px;
    }

    .hover-scroll-overlay-y::-webkit-scrollbar-thumb {
        border-radius: 999px;
        background: rgba(0, 158, 247, 0.38);
    }

    .hover-scroll-overlay-y::-webkit-scrollbar-track {
        background: transparent;
    }

    @media (max-width: 991.98px) {
        #kt_aside.aside {
            width: 280px !important;
            max-width: 86vw;
            border-radius: 0 28px 28px 0;
        }

        .neo-mentor-sidebar-wrapper {
            padding: 0 12px 16px;
        }

        .neo-mentor-sidebar-card {
            border-radius: 24px;
        }

        .neo-mentor-menu .menu-link {
            min-height: 50px;
        }
    }

    @media (max-width: 575.98px) {
        #kt_aside_logo {
            min-height: 68px;
            padding: 12px !important;
        }

        #kt_aside_logo p {
            font-size: 13px !important;
            border-radius: 18px;
            padding: 12px !important;
        }

        .neo-mentor-menu .menu-title {
            font-size: 12px;
        }

        .neo-menu-icon {
            width: 32px;
            height: 32px;
            min-width: 32px;
            border-radius: 12px;
        }

        .neo-mentor-menu .menu-link {
            padding: 10px 11px !important;
            border-radius: 16px;
        }
    }
</style>

<div class="hover-scroll-overlay-y my-5 my-lg-5"
     id="kt_aside_menu_wrapper"
     data-kt-scroll="true"
     data-kt-scroll-activate="{default: false, lg: true}"
     data-kt-scroll-height="auto"
     data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
     data-kt-scroll-wrappers="#kt_aside_menu"
     data-kt-scroll-offset="0">

    <div class="neo-mentor-sidebar-wrapper">
        <div class="neo-mentor-sidebar-card">

            <div class="menu menu-column neo-mentor-menu"
                 id="kt_aside_menu"
                 data-kt-menu="true">

                <div class="neo-menu-section-label">
                    <span>Utama</span>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('index') ? 'active' : '' }}"
                       href="{{ route('index') }}">
                        <span class="menu-title">
                            <span class="neo-menu-icon">
                                <i class="bi bi-grid-fill fs-4"></i>
                            </span>
                            Dashboard
                        </span>
                    </a>
                </div>

                <div class="neo-menu-section-label">
                    <span>Master Kelas</span>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('mentor.kelas.tag.*') ? 'active' : '' }}"
                       href="{{ route('mentor.kelas.tag.index') }}">
                        <span class="menu-title">
                            <span class="neo-menu-icon">
                                <i class="bi bi-tags-fill fs-4"></i>
                            </span>
                            Tag
                        </span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('mentor.kelas.kategori.*') ? 'active' : '' }}"
                       href="{{ route('mentor.kelas.kategori.index') }}">
                        <span class="menu-title">
                            <span class="neo-menu-icon">
                                <i class="bi bi-folder-fill fs-4"></i>
                            </span>
                            Kategori
                        </span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('mentor.kelas.kategori_sub.*') ? 'active' : '' }}"
                       href="{{ route('mentor.kelas.kategori_sub.index') }}">
                        <span class="menu-title">
                            <span class="neo-menu-icon">
                                <i class="bi bi-diagram-3-fill fs-4"></i>
                            </span>
                            Kategori Sub
                        </span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('mentor.kelas.kelas.*') ? 'active' : '' }}"
                       href="{{ route('mentor.kelas.kelas.index') }}">
                        <span class="menu-title">
                            <span class="neo-menu-icon">
                                <i class="bi bi-easel-fill fs-4"></i>
                            </span>
                            Kelas
                        </span>
                    </a>
                </div>

                <div class="neo-menu-section-label">
                    <span>Aktivitas</span>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('mentor.kelas.pendaftaran.*') ? 'active' : '' }}"
                       href="{{ route('mentor.kelas.pendaftaran.index') }}">
                        <span class="menu-title">
                            <span class="neo-menu-icon">
                                <i class="bi bi-person-plus-fill fs-4"></i>
                            </span>
                            Pendaftaran
                        </span>
                    </a>
                </div>

                <div class="neo-menu-section-label">
                    <span>Akun</span>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('mentor.profile') ? 'active' : '' }}"
                       href="{{ route('mentor.profile') }}">
                        <span class="menu-title">
                            <span class="neo-menu-icon">
                                <i class="bi bi-person-circle fs-4"></i>
                            </span>
                            Profile
                        </span>
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>