<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Default')</title>
    <link rel="stylesheet" href="{{ asset('asset/css/global.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset/css/admin.css') }}" />

    @yield('css_custom', '')

</head>

<body class="admin-body">

    <div class="admin-wrap">

        <!-- SIDEBAR -->
        <aside class="admin-sidebar" id="admin-sidebar">
            <div class="sidebar-header">
                <button class="sidebar-toggle" id="sidebar-toggle">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
                <div class="sidebar-brand">
                    <div class="sidebar-brand-icon"><svg width="16" height="16" fill="none" stroke="#fff"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 18V5l12-2v13" />
                            <circle cx="6" cy="18" r="3" />
                            <circle cx="18" cy="16" r="3" />
                        </svg></div>
                    <span class="sidebar-brand-text">GO <span class="k">K-POP</span> <span
                            class="sub">Admin</span></span>
                </div>
            </div>
            <nav class="sidebar-nav">
                <button class="sidebar-item active" onclick="location.href='{{ route('admin.dashboard') }}'">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="7" height="7" />
                        <rect x="14" y="3" width="7" height="7" />
                        <rect x="3" y="14" width="7" height="7" />
                        <rect x="14" y="14" width="7" height="7" />
                    </svg>
                    <span class="sidebar-label">Beranda</span>
                </button>
                <button class="sidebar-item" onclick="location.href='{{ route('admin.campaign') }}'">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path
                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.36 11a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.11 0h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                    </svg>
                    <span class="sidebar-label">Campaign</span>
                </button>
                <button class="sidebar-item" onclick="location.href='{{ route('admin.payment') }}'">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="1" y="4" width="22" height="16" rx="2" />
                        <line x1="1" y1="10" x2="23" y2="10" />
                    </svg>
                    <span class="sidebar-label">Pembayaran</span>
                </button>
                <button class="sidebar-item" onclick="location.href='{{ route('admin.order') }}'">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="8" y1="6" x2="21" y2="6" />
                        <line x1="8" y1="12" x2="21" y2="12" />
                        <line x1="8" y1="18" x2="21" y2="18" />
                        <line x1="3" y1="6" x2="3.01" y2="6" />
                        <line x1="3" y1="12" x2="3.01" y2="12" />
                        <line x1="3" y1="18" x2="3.01" y2="18" />
                    </svg>
                    <span class="sidebar-label">Pesanan</span>
                </button>
                <button class="sidebar-item" onclick="location.href='{{ route('admin.sorting') }}'">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="16 3 21 8 8 21" />
                        <line x1="21" y1="3" x2="15" y2="9" />
                        <path d="M6 13H2v5h4" />
                        <path d="M22 13h-4v8h4" />
                    </svg>
                    <span class="sidebar-label">Sorting PC</span>
                </button>
                <button class="sidebar-item" onclick="location.href='{{ route('admin.shipment') }}'">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="1" y="3" width="15" height="13" />
                        <polygon points="16 8 20 8 23 11 23 16 16 16 16 8" />
                        <circle cx="5.5" cy="18.5" r="2.5" />
                        <circle cx="18.5" cy="18.5" r="2.5" />
                    </svg>
                    <span class="sidebar-label">Pengiriman</span>
                </button>
                <button class="sidebar-item" onclick="location.href='{{ route('admin.setting') }}'">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="3" />
                        <path
                            d="M19.07 4.93l-1.41 1.41M6.34 17.66l-1.41 1.41M2 12h2M20 12h2M6.34 6.34L4.93 4.93M19.07 19.07l-1.41-1.41M12 2v2M12 20v2" />
                    </svg>
                    <span class="sidebar-label">Pengaturan</span>
                </button>
            </nav>
            <div class="sidebar-footer">
                <div class="sidebar-admin-badge">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                    </svg>
                    <span>Admin</span>
                </div>
                <button class="sidebar-item" onclick="location.href='../../index.html'">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" y1="12" x2="9" y2="12" />
                    </svg>
                    <span class="sidebar-label">Keluar</span>
                </button>
            </div>
        </aside>

        <!-- MAIN -->
        <div class="admin-main" id="admin-main">

            <!-- Topbar -->
            <div class="admin-topbar">
                <div class="breadcrumb">
                    <span style="color:var(--slate-500)">Admin</span>
                    <span class="breadcrumb-sep">›</span>
                    <span class="breadcrumb-current">Beranda</span>
                </div>
                <div class="topbar-right">
                    <div class="online-badge"><span class="online-dot"></span>Online</div>
                    <div class="admin-user-badge">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        Admin
                    </div>
                    <button class="btn-topbar-logout" onclick="location.href='../../index.html'">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                            <polyline points="16 17 21 12 16 7" />
                            <line x1="21" y1="12" x2="9" y2="12" />
                        </svg>
                        Keluar
                    </button>
                </div>
            </div>

            <!-- Content -->
            <div class="admin-content">

                @yield('admin_content')

            </div><!-- /admin-content -->
        </div><!-- /admin-main -->
    </div><!-- /admin-wrap -->

    @yield('admin_content_custom')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('asset/js/global.js') }}"></script>

    @yield('js_custom', '')

    
</body>

</html>
