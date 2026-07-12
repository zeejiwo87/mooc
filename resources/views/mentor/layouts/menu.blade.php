<style>
    :root {
        --admin-menu-bg: #0f172a;
        --admin-menu-bg-2: #111827;
        --admin-menu-surface-hover: #1e293b;
        --admin-menu-active: #034870;
        --admin-menu-text: #e5e7eb;
        --admin-menu-muted: #94a3b8;
        --admin-menu-border: rgba(255, 255, 255, .08);
        --admin-menu-icon-bg: rgba(0, 158, 247, .16);
    }

    #kt_aside.aside {
        background: linear-gradient(180deg, var(--admin-menu-bg), var(--admin-menu-bg-2)) !important;
        border-right: 1px solid var(--admin-menu-border) !important;
        box-shadow: 8px 0 24px rgba(15, 23, 42, .35) !important;
    }

    #kt_aside_logo {
        min-height: 72px;
        padding: 14px 18px !important;
        background: transparent !important;
        border-bottom: 1px solid var(--admin-menu-border) !important;
    }

    #kt_aside_logo p {
        width: 100%;
        margin: 0 !important;
        padding: 12px 14px !important;
        color: #ffffff !important;
        background: rgba(255, 255, 255, .06);
        border: 1px solid var(--admin-menu-border);
        border-radius: 12px;
        font-weight: 800 !important;
        line-height: 1.35;
        text-align: center;
    }

    #kt_aside .aside-menu {
        background: transparent !important;
    }

    .mentor-sidebar-simple {
        padding: 0 14px 18px;
    }

    .mentor-simple-menu.menu {
        width: 100%;
    }

    .mentor-simple-menu .menu-item {
        margin: 0;
    }

    .mentor-simple-menu .menu-link {
        min-height: 46px;
        margin: 4px 0;
        padding: 10px 12px !important;
        border-radius: 12px;
        color: var(--admin-menu-text) !important;
        background: transparent !important;
        border: 1px solid transparent !important;
        box-shadow: none !important;
        transition: background .18s ease, border-color .18s ease, color .18s ease;
    }

    .mentor-simple-menu .menu-link:hover {
        color: #ffffff !important;
        background: var(--admin-menu-surface-hover) !important;
        border-color: var(--admin-menu-border) !important;
    }

    .mentor-simple-menu .menu-link.active,
    .mentor-simple-menu .menu-item.here > .menu-link,
    .mentor-simple-menu .menu-item.show > .menu-link {
        color: #ffffff !important;
        background: var(--admin-menu-active) !important;
        border-color: rgba(255, 255, 255, .16) !important;
        box-shadow: 0 10px 24px rgba(0, 158, 247, .22) !important;
    }

    .mentor-simple-menu .menu-title {
        display: inline-flex;
        align-items: center;
        gap: .65rem;
        color: inherit !important;
        font-size: 13px;
        font-weight: 800;
        line-height: 1.2;
    }

    .mentor-simple-menu .menu-title i {
        width: 28px;
        min-width: 28px;
        height: 28px;
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: var(--admin-menu-icon-bg);
        color: #38bdf8 !important;
        font-size: 1.15rem !important;
        line-height: 1 !important;
        opacity: 1 !important;
    }

    .mentor-simple-menu .menu-link:hover .menu-title i {
        background: rgba(255, 255, 255, .10);
        color: #ffffff !important;
    }

    .mentor-simple-menu .menu-link.active .menu-title i,
    .mentor-simple-menu .menu-item.here > .menu-link .menu-title i,
    .mentor-simple-menu .menu-item.show > .menu-link .menu-title i {
        background: rgba(255, 255, 255, .20);
        color: #ffffff !important;
    }

    .hover-scroll-overlay-y::-webkit-scrollbar {
        width: 6px;
    }

    .hover-scroll-overlay-y::-webkit-scrollbar-thumb {
        border-radius: 999px;
        background: rgba(0, 158, 247, .48);
    }

    .hover-scroll-overlay-y::-webkit-scrollbar-track {
        background: transparent;
    }

    @media (max-width: 991.98px) {
        #kt_aside.aside {
            width: 280px !important;
            max-width: 86vw;
        }

        .mentor-sidebar-simple {
            padding: 0 12px 16px;
        }

        .mentor-simple-menu .menu-link {
            min-height: 46px;
        }
    }

    @media (max-width: 575.98px) {
        #kt_aside_logo {
            min-height: 66px;
            padding: 12px !important;
        }

        #kt_aside_logo p {
            font-size: 13px !important;
        }

        .mentor-simple-menu .menu-title {
            font-size: 12px;
        }

        .mentor-simple-menu .menu-title i {
            width: 26px;
            min-width: 26px;
            height: 26px;
            font-size: 1.05rem !important;
        }

        .mentor-simple-menu .menu-link {
            padding: 9px 10px !important;
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

    <div class="mentor-sidebar-simple">
        <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 mentor-simple-menu"
             id="kt_aside_menu"
             data-kt-menu="true">

            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('index') ? 'active' : '' }}"
                   href="{{ route('index') }}">
                    <span class="menu-title">
                        <i class="bi bi-grid-fill fs-3 me-2"></i>
                        Dashboard
                    </span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('mentor.kelas.tag.*') ? 'active' : '' }}"
                   href="{{ route('mentor.kelas.tag.index') }}">
                    <span class="menu-title">
                        <i class="bi bi-tags-fill fs-3 me-2"></i>
                        Tag
                    </span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('mentor.kelas.kategori.*') ? 'active' : '' }}"
                   href="{{ route('mentor.kelas.kategori.index') }}">
                    <span class="menu-title">
                        <i class="bi bi-folder-fill fs-3 me-2"></i>
                        Kategori
                    </span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('mentor.kelas.kategori_sub.*') ? 'active' : '' }}"
                   href="{{ route('mentor.kelas.kategori_sub.index') }}">
                    <span class="menu-title">
                        <i class="bi bi-diagram-3-fill fs-3 me-2"></i>
                        Kategori Sub
                    </span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('mentor.kelas.kelas.*') ? 'active' : '' }}"
                   href="{{ route('mentor.kelas.kelas.index') }}">
                    <span class="menu-title">
                        <i class="bi bi-easel-fill fs-3 me-2"></i>
                        Kelas
                    </span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('mentor.kelas.pendaftaran.*') ? 'active' : '' }}"
                   href="{{ route('mentor.kelas.pendaftaran.index') }}">
                    <span class="menu-title">
                        <i class="bi bi-person-plus-fill fs-3 me-2"></i>
                        Pendaftaran
                    </span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('mentor.profile') ? 'active' : '' }}"
                   href="{{ route('mentor.profile') }}">
                    <span class="menu-title">
                        <i class="bi bi-person-circle fs-3 me-2"></i>
                        Profile
                    </span>
                </a>
            </div>

        </div>
    </div>
</div>
