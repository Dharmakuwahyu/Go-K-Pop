<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        @yield('title', 'Default')
    </title>
    <link rel="stylesheet" href="{{ asset('asset/css/global.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset/css/member.css') }}" />

    @yield('css_custom')

</head>

<body>

    <!-- NAVBAR -->
    <nav id="navbar">
        <div class="nav-inner">
            <a href="../../index.html" class="nav-logo">
                <div class="nav-logo-icon"><svg width="20" height="20" fill="none" stroke="#fff"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path d="M9 18V5l12-2v13" />
                        <circle cx="6" cy="18" r="3" />
                        <circle cx="18" cy="16" r="3" />
                    </svg></div>
                <span class="nav-logo-text">GO <span>K-POP</span></span>
            </a>
            <div class="nav-links">
                <a href="../../index.html" class="nav-link">Beranda</a>
                <a href="{{ route('member.catalog') }}" class="nav-link">Katalog</a>
                <a href="{{ route('member.pesanan') }}" class="nav-link">Pesanan Saya</a>
                <a href="{{ route('member.wishlist') }}" class="nav-link">Album Favorit</a>
                <a href="{{ route('member.profile') }}" class="nav-link active">Akun Saya</a>
            </div>
            <div class="nav-actions">
                <div class="nav-role-badge member-badge">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                    Member
                </div>
                <a href="../../index.html" class="btn-nav-logout">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" y1="12" x2="9" y2="12" />
                    </svg>
                    Keluar
                </a>
            </div>
            <button class="hamburger" id="hamburger">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <line x1="3" y1="6" x2="21" y2="6" />
                    <line x1="3" y1="12" x2="21" y2="12" />
                    <line x1="3" y1="18" x2="21" y2="18" />
                </svg>
            </button>
        </div>
        <div class="mobile-nav" id="mobile-nav">
            <a href="../../index.html" class="nav-link">Beranda</a>
            <a href="catalog.html" class="nav-link">Katalog</a>
            <a href="dashboard.html" class="nav-link">Pesanan Saya</a>
            <a href="wishlist.html" class="nav-link">Album Favorit</a>
            <a href="profile.html" class="nav-link active">Akun Saya</a>
            <a href="../../index.html" class="nav-link" style="color:var(--accent-400)">Keluar</a>
        </div>
    </nav>

    <main class="page-wrap">
        @yield('member_content')
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="footer-grid">
            <div>
                <a href="../../index.html" class="nav-logo" style="margin-bottom:1.25rem;display:inline-flex">
                    <div class="nav-logo-icon"><svg width="20" height="20" fill="none" stroke="#fff"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 18V5l12-2v13" />
                            <circle cx="6" cy="18" r="3" />
                            <circle cx="18" cy="16" r="3" />
                        </svg></div>
                    <span class="nav-logo-text">GO <span>K-POP</span></span>
                </a>
                <p style="font-size:.875rem;color:var(--slate-400);line-height:1.7;max-width:260px">Platform Group
                    Order K-Pop Terpercaya, Cepat, dan Transparan.</p>
            </div>
            <div>
                <h3 class="footer-h3">Navigasi</h3>
                <a href="../../index.html" class="footer-link">Beranda</a>
                <a href="catalog.html" class="footer-link">Katalog Album</a>
                <a href="dashboard.html" class="footer-link">Cek Pesanan</a>
                <a href="#" class="footer-link">Kebijakan Pengembalian</a>
            </div>
            <div>
                <h3 class="footer-h3">Pembayaran &amp; Pengiriman</h3>
                <p
                    style="font-size:.7rem;color:var(--slate-500);margin-bottom:8px;text-transform:uppercase;letter-spacing:.05em">
                    Pembayaran</p>
                <div style="margin-bottom:12px"><span class="payment-icon">🏦</span><span
                        class="payment-icon">🏦</span><span class="payment-icon">🏦</span><span
                        class="payment-icon">📱</span><span class="payment-icon">📱</span><span
                        class="payment-icon">📱</span></div>
                <p
                    style="font-size:.7rem;color:var(--slate-500);margin-bottom:8px;text-transform:uppercase;letter-spacing:.05em">
                    Pengiriman</p>
                <div><span class="payment-icon">📦</span><span class="payment-icon">📦</span><span
                        class="payment-icon">📦</span></div>
            </div>
            <div>
                <h3 class="footer-h3">Kontak &amp; Media Sosial</h3>
                <p style="font-size:.875rem;color:var(--slate-400);margin-bottom:1rem">Hubungi kami melalui:</p>
                <div style="margin-bottom:1rem">
                    <a href="https://wa.me/6281234567890" target="_blank" class="footer-social-btn"><svg
                            width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                        </svg></a>
                    <a href="https://instagram.com" target="_blank" class="footer-social-btn"><svg width="18"
                            height="18" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <rect x="2" y="2" width="20" height="20" rx="5" />
                            <circle cx="12" cy="12" r="5" />
                            <circle cx="17.5" cy="6.5" r="1.5" fill="currentColor" stroke="none" />
                        </svg></a>
                </div>
                <p style="font-size:.75rem;color:var(--slate-500);margin-bottom:4px">WhatsApp Admin</p>
                <a href="https://wa.me/6281234567890" target="_blank"
                    style="display:inline-flex;align-items:center;gap:8px;font-size:.875rem;color:var(--slate-300)">
                    <span
                        style="width:8px;height:8px;border-radius:50%;background:#22c55e;display:inline-block"></span>
                    081234567890
                </a>
            </div>
        </div>
        <div class="footer-bottom">
            <p class="footer-copy">© 2026 K-Pop GO Management System. All Rights Reserved.</p>
            <p style="font-size:.875rem;color:var(--slate-600)">Powered by <span
                    style="color:var(--slate-500)">Fandom</span></p>
        </div>
    </footer>

    <a href="https://wa.me/6281234567890?text=Halo%20GO%20K-POP" target="_blank" id="wa-btn"
        rel="noopener noreferrer" aria-label="WhatsApp">
        <span class="wa-pulse"></span>
        <svg viewBox="0 0 24 24">
            <path
                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.13 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
        </svg>
    </a>

    @yield('member_content_custom')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('asset/js/global.js') }}"></script>

    @yield('js_custom')


</body>

</html>
