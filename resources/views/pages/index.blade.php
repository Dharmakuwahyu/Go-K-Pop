<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GO K-POP — Group Order K-Pop Terpercaya</title>
    <link rel="stylesheet" href="{{ asset('asset/css/global.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset/css/landing.css') }}" />
</head>

<body>

    <!-- ═══════ NAVBAR ═══════ -->
    <nav id="navbar">
        <div class="nav-inner">
            <a href="index.html" class="nav-logo">
                <div class="nav-logo-icon">
                    <svg width="20" height="20" fill="none" stroke="#fff" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M9 18V5l12-2v13" />
                        <circle cx="6" cy="18" r="3" />
                        <circle cx="18" cy="16" r="3" />
                    </svg>
                </div>
                <span class="nav-logo-text">GO <span>K-POP</span></span>
            </a>
            <div class="nav-links">
                <a href="index.html" class="nav-link active">Beranda</a>
                <a href="#about" class="nav-link">Tentang Kami</a>
            </div>
            <div class="nav-actions">
                <button class="btn btn-accent" id="btn-open-auth">Masuk / Daftar</button>
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
            <a href="index.html" class="nav-link active">Beranda</a>
            <a href="#about" class="nav-link">Tentang Kami</a>
            <button class="nav-link" id="mobile-btn-auth" style="text-align:left;color:var(--accent-400)">Masuk /
                Daftar</button>
        </div>
    </nav>

    <!-- ═══════ HERO CAROUSEL ═══════ -->
    <section id="carousel">
        <div id="carousel-track">
            <div class="carousel-slide active" data-idx="0">
                <div class="carousel-bg"
                    style="background-image:url('https://images.pexels.com/photos/1762537/pexels-photo-1762537.jpeg?auto=compress&cs=tinysrgb&w=1920')">
                </div>
                <div class="carousel-grad-lr"></div>
                <div class="carousel-grad-tb"></div>
                <div class="carousel-content">
                    <div>
                        <h2 class="carousel-title">DISKON 10% untuk Pre-Order Pertama!</h2>
                        <p class="carousel-sub">Daftar sekarang dan klaim vouchermu.</p>
                    </div>
                </div>
            </div>
            <div class="carousel-slide" data-idx="1">
                <div class="carousel-bg"
                    style="background-image:url('https://images.pexels.com/photos/1190297/pexels-photo-1190297.jpeg?auto=compress&cs=tinysrgb&w=1920')">
                </div>
                <div class="carousel-grad-lr"></div>
                <div class="carousel-grad-tb"></div>
                <div class="carousel-content">
                    <div>
                        <h2 class="carousel-title">OPEN PRE-ORDER: SEVENTEEN &amp; NewJeans!</h2>
                        <p class="carousel-sub">Jangan sampai kehabisan slot!</p>
                    </div>
                </div>
            </div>
            <div class="carousel-slide" data-idx="2">
                <div class="carousel-bg"
                    style="background-image:url('https://images.pexels.com/photos/1540137/pexels-photo-1540137.jpeg?auto=compress&cs=tinysrgb&w=1920')">
                </div>
                <div class="carousel-grad-lr"></div>
                <div class="carousel-grad-tb"></div>
                <div class="carousel-content">
                    <div>
                        <h2 class="carousel-title">Kargo Korea–Indo Tercepat &amp; Terpercaya!</h2>
                        <p class="carousel-sub">Estimasi tiba lebih akurat dengan tracking real-time.</p>
                    </div>
                </div>
            </div>
            <div class="carousel-slide" data-idx="3">
                <div class="carousel-bg"
                    style="background-image:url('https://images.pexels.com/photos/1644697/pexels-photo-1644697.jpeg?auto=compress&cs=tinysrgb&w=1920')">
                </div>
                <div class="carousel-grad-lr"></div>
                <div class="carousel-grad-tb"></div>
                <div class="carousel-content">
                    <div>
                        <h2 class="carousel-title">Sistem PC Sorting Termutakhir!</h2>
                        <p class="carousel-sub">Prioritas sorting berdasarkan timestamp transfer kamu.</p>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-arrow" id="carousel-prev">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <polyline points="15 18 9 12 15 6" />
            </svg>
        </button>
        <button class="carousel-arrow" id="carousel-next">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <polyline points="9 18 15 12 9 6" />
            </svg>
        </button>
        <div id="carousel-dots">
            <button class="carousel-dot active" data-idx="0"></button>
            <button class="carousel-dot" data-idx="1"></button>
            <button class="carousel-dot" data-idx="2"></button>
            <button class="carousel-dot" data-idx="3"></button>
        </div>
    </section>

    <!-- ═══════ HERO ═══════ -->
    <section id="hero">
        <div class="hero-bg-grad"></div>
        <div class="hero-blob hero-blob-1"></div>
        <div class="hero-blob hero-blob-2"></div>
        <div class="hero-content">
            <div class="hero-badge">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <polygon
                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                </svg>
                Group Order K-Pop Terpercaya #1
            </div>
            <h1 class="hero-title">Koleksi Album<br><span class="hero-title-accent">K-Pop Impianmu</span></h1>
            <p class="hero-desc">Bergabunglah di group order terpercaya dengan sistem sorting adil, cicilan ringan, dan
                pelacakan real-time dari Korea sampai rumahmu.</p>
            <button class="hero-cta" id="btn-scroll-catalog">
                Mulai Jelajah
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24">
                    <polyline points="6 9 12 15 18 9" />
                </svg>
            </button>
        </div>
        <div class="hero-bounce">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <polyline points="6 9 12 15 18 9" />
            </svg>
        </div>
    </section>

    <!-- ═══════ VALUE PROPS ═══════ -->
    <section id="value">
        <div class="container">
            <div class="value-grid">
                <div class="value-card">
                    <div class="value-icon" style="background:rgba(74,222,128,.1)">
                        <svg width="28" height="28" fill="none" stroke="#4ade80" stroke-width="2"
                            viewBox="0 0 24 24">
                            <polyline points="16 3 21 8 8 21" />
                            <line x1="21" y1="3" x2="15" y2="9" />
                            <path d="M6 13H2a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h3" />
                            <path d="M22 13h-4v8h4" />
                        </svg>
                    </div>
                    <h3>Sorting Adil</h3>
                    <p>Pembagian kartu foto (photocard) lewat sistem komputer yang adil berdasarkan waktu transfer.
                        Siapa cepat, dia dapat!</p>
                </div>
                <div class="value-card">
                    <div class="value-icon" style="background:rgba(225,29,72,.1)">
                        <svg width="28" height="28" fill="none" stroke="#f43f5e" stroke-width="2"
                            viewBox="0 0 24 24">
                            <rect x="1" y="4" width="22" height="16" rx="2" />
                            <line x1="1" y1="10" x2="23" y2="10" />
                        </svg>
                    </div>
                    <h3>Cicilan Ringan</h3>
                    <p>Bayar tenang dengan cicilan 3 kali: DP 1, DP 2, dan Pelunasan. Tidak perlu bayar sekaligus!</p>
                </div>
                <div class="value-card">
                    <div class="value-icon" style="background:rgba(250,204,21,.1)">
                        <svg width="28" height="28" fill="none" stroke="#facc15" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                    </div>
                    <h3>Lacak Aman</h3>
                    <p>Pantau posisi paket dari Korea sampai rumah langsung di website. Update real-time, tanpa pusing!
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════ KATALOG PUBLIK ═══════ -->
    <section id="catalog">
        <div class="container">
            <div class="section-header">
                <h2>Album Tersedia</h2>
                <p>Pilih album favoritmu dan booking slot sebelum kehabisan!</p>
            </div>
            <div class="album-grid">

                <!-- Album card: NCT 127 -->
                <div class="album-card">
                    <div class="album-img-wrap">
                        <button class="like-btn" data-album-id="1"><svg viewBox="0 0 24 24" fill="transparent"
                                stroke="#cbd5e1" stroke-width="2">
                                <path
                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                            </svg></button>
                        <img src="https://images.pexels.com/photos/1762537/pexels-photo-1762537.jpeg?auto=compress&cs=tinysrgb&w=600"
                            alt="ISTJ" loading="lazy">
                        <div class="album-img-overlay"></div>
                        <span class="album-slots-badge badge badge-solid-gold">15 Slots Left</span>
                    </div>
                    <div class="album-body">
                        <p class="album-group">NCT 127</p>
                        <h3 class="album-title">ISTJ - The 5th Album</h3>
                        <div class="album-price-row">
                            <span class="album-price">Rp285.000</span>
                            <span class="album-slots-txt">15/30 slot</span>
                        </div>
                        <div class="slot-bar">
                            <div class="slot-fill" style="width:50%;background:#eab308"></div>
                        </div>
                        <button class="btn-book" data-album-id="1">Book Slot</button>
                    </div>
                </div>

                <!-- Album card: SEVENTEEN -->
                <div class="album-card">
                    <div class="album-img-wrap">
                        <button class="like-btn" data-album-id="2"><svg viewBox="0 0 24 24" fill="transparent"
                                stroke="#cbd5e1" stroke-width="2">
                                <path
                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                            </svg></button>
                        <img src="https://images.pexels.com/photos/1190297/pexels-photo-1190297.jpeg?auto=compress&cs=tinysrgb&w=600"
                            alt="FML" loading="lazy">
                        <div class="album-img-overlay"></div>
                        <span class="album-slots-badge badge badge-solid-red">8 Slots Left</span>
                    </div>
                    <div class="album-body">
                        <p class="album-group">SEVENTEEN</p>
                        <h3 class="album-title">FML - 10th Mini Album</h3>
                        <div class="album-price-row">
                            <span class="album-price">Rp310.000</span>
                            <span class="album-slots-txt">8/50 slot</span>
                        </div>
                        <div class="slot-bar">
                            <div class="slot-fill" style="width:84%;background:#e11d48"></div>
                        </div>
                        <button class="btn-book" data-album-id="2">Book Slot</button>
                    </div>
                </div>

                <!-- Album card: aespa -->
                <div class="album-card">
                    <div class="album-img-wrap">
                        <button class="like-btn" data-album-id="3"><svg viewBox="0 0 24 24" fill="transparent"
                                stroke="#cbd5e1" stroke-width="2">
                                <path
                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                            </svg></button>
                        <img src="https://images.pexels.com/photos/1540137/pexels-photo-1540137.jpeg?auto=compress&cs=tinysrgb&w=600"
                            alt="MY WORLD" loading="lazy">
                        <div class="album-img-overlay"></div>
                        <span class="album-slots-badge badge badge-solid-neon">22 Slots Left</span>
                    </div>
                    <div class="album-body">
                        <p class="album-group">AESPA</p>
                        <h3 class="album-title">MY WORLD - 3rd Mini Album</h3>
                        <div class="album-price-row">
                            <span class="album-price">Rp250.000</span>
                            <span class="album-slots-txt">22/40 slot</span>
                        </div>
                        <div class="slot-bar">
                            <div class="slot-fill" style="width:45%;background:#22c55e"></div>
                        </div>
                        <button class="btn-book" data-album-id="3">Book Slot</button>
                    </div>
                </div>

                <!-- Album card: Stray Kids -->
                <div class="album-card">
                    <div class="album-img-wrap">
                        <button class="like-btn" data-album-id="4"><svg viewBox="0 0 24 24" fill="transparent"
                                stroke="#cbd5e1" stroke-width="2">
                                <path
                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                            </svg></button>
                        <img src="https://images.pexels.com/photos/1644697/pexels-photo-1644697.jpeg?auto=compress&cs=tinysrgb&w=600"
                            alt="5-STAR" loading="lazy">
                        <div class="album-img-overlay"></div>
                        <span class="album-slots-badge badge badge-solid-red">3 Slots Left</span>
                    </div>
                    <div class="album-body">
                        <p class="album-group">STRAY KIDS</p>
                        <h3 class="album-title">5-STAR - 3rd Album</h3>
                        <div class="album-price-row">
                            <span class="album-price">Rp295.000</span>
                            <span class="album-slots-txt">3/35 slot</span>
                        </div>
                        <div class="slot-bar">
                            <div class="slot-fill" style="width:91%;background:#e11d48"></div>
                        </div>
                        <button class="btn-book" data-album-id="4">Book Slot</button>
                    </div>
                </div>

                <!-- Album card: NewJeans -->
                <div class="album-card">
                    <div class="album-img-wrap">
                        <button class="like-btn" data-album-id="5"><svg viewBox="0 0 24 24" fill="transparent"
                                stroke="#cbd5e1" stroke-width="2">
                                <path
                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                            </svg></button>
                        <img src="https://images.pexels.com/photos/1670934/pexels-photo-1670934.jpeg?auto=compress&cs=tinysrgb&w=600"
                            alt="Get Up" loading="lazy">
                        <div class="album-img-overlay"></div>
                        <span class="album-slots-badge badge badge-solid-neon">30 Slots Left</span>
                    </div>
                    <div class="album-body">
                        <p class="album-group">NEWJEANS</p>
                        <h3 class="album-title">Get Up - 2nd EP</h3>
                        <div class="album-price-row">
                            <span class="album-price">Rp240.000</span>
                            <span class="album-slots-txt">30/45 slot</span>
                        </div>
                        <div class="slot-bar">
                            <div class="slot-fill" style="width:33%;background:#22c55e"></div>
                        </div>
                        <button class="btn-book" data-album-id="5">Book Slot</button>
                    </div>
                </div>

                <!-- Album card: ENHYPEN -->
                <div class="album-card">
                    <div class="album-img-wrap">
                        <button class="like-btn" data-album-id="6"><svg viewBox="0 0 24 24" fill="transparent"
                                stroke="#cbd5e1" stroke-width="2">
                                <path
                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                            </svg></button>
                        <img src="https://images.pexels.com/photos/1540137/pexels-photo-1540137.jpeg?auto=compress&cs=tinysrgb&w=600"
                            alt="DARK BLOOD" loading="lazy">
                        <div class="album-img-overlay"></div>
                        <span class="album-slots-badge badge badge-solid-gold">12 Slots Left</span>
                    </div>
                    <div class="album-body">
                        <p class="album-group">ENHYPEN</p>
                        <h3 class="album-title">DARK BLOOD - 4th Mini Album</h3>
                        <div class="album-price-row">
                            <span class="album-price">Rp270.000</span>
                            <span class="album-slots-txt">12/30 slot</span>
                        </div>
                        <div class="slot-bar">
                            <div class="slot-fill" style="width:60%;background:#eab308"></div>
                        </div>
                        <button class="btn-book" data-album-id="6">Book Slot</button>
                    </div>
                </div>

            </div><!-- /.album-grid -->
        </div>
    </section>

    <!-- ═══════ TENTANG KAMI ═══════ -->
    <section id="about">
        <div class="container">
            <div class="about-inner">
                <h2>Tentang Kami</h2>
                <p>GO K-POP adalah platform group order K-Pop terpercaya yang sudah melayani ribuan penggemar K-Pop di
                    seluruh Indonesia. Kami berkomitmen untuk memberikan pengalaman belanja yang aman, transparan, dan
                    adil bagi semua pembeli.</p>
                <div class="about-stats">
                    <div>
                        <div class="about-stat-num">2,500+</div>
                        <div class="about-stat-label">Album Terkirim</div>
                    </div>
                    <div>
                        <div class="about-stat-num">1,200+</div>
                        <div class="about-stat-label">Member Aktif</div>
                    </div>
                    <div>
                        <div class="about-stat-num">99.5%</div>
                        <div class="about-stat-label">Kepuasan</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════ FOOTER ═══════ -->
    <footer>
        <div class="footer-grid">
            <div>
                <a href="index.html" class="nav-logo" style="margin-bottom:1.25rem;display:inline-flex">
                    <div class="nav-logo-icon"><svg width="20" height="20" fill="none" stroke="#fff"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 18V5l12-2v13" />
                            <circle cx="6" cy="18" r="3" />
                            <circle cx="18" cy="16" r="3" />
                        </svg></div>
                    <span class="nav-logo-text">GO <span>K-POP</span></span>
                </a>
                <p style="font-size:.875rem;color:var(--slate-400);line-height:1.7;max-width:260px">Platform Group
                    Order K-Pop Terpercaya, Cepat, dan Transparan. Melayani ribuan penggemar K-Pop di seluruh Indonesia
                    dengan sistem sorting adil dan pelacakan real-time.</p>
            </div>
            <div>
                <h3 class="footer-h3">Navigasi</h3>
                <a href="index.html" class="footer-link">Beranda</a>
                <a href="#catalog" class="footer-link">Katalog Album</a>
                <a href="pages/member/dashboard.html" class="footer-link">Cek Pesanan</a>
                <a href="#" class="footer-link">Kebijakan Pengembalian</a>
            </div>
            <div>
                <h3 class="footer-h3">Pembayaran &amp; Pengiriman</h3>
                <p
                    style="font-size:.7rem;color:var(--slate-500);margin-bottom:8px;text-transform:uppercase;letter-spacing:.05em">
                    Pembayaran</p>
                <div style="margin-bottom:12px">
                    <span class="payment-icon" title="BCA">🏦</span><span class="payment-icon"
                        title="BRI">🏦</span><span class="payment-icon" title="Mandiri">🏦</span>
                    <span class="payment-icon" title="DANA">📱</span><span class="payment-icon"
                        title="GoPay">📱</span><span class="payment-icon" title="OVO">📱</span>
                </div>
                <p
                    style="font-size:.7rem;color:var(--slate-500);margin-bottom:8px;text-transform:uppercase;letter-spacing:.05em">
                    Pengiriman</p>
                <div>
                    <span class="payment-icon" title="J&T">📦</span><span class="payment-icon"
                        title="JNE">📦</span><span class="payment-icon" title="SiCepat">📦</span>
                </div>
            </div>
            <div>
                <h3 class="footer-h3">Kontak &amp; Media Sosial</h3>
                <p style="font-size:.875rem;color:var(--slate-400);margin-bottom:1rem">Hubungi kami melalui:</p>
                <div style="margin-bottom:1rem">
                    <a href="https://wa.me/6281234567890?text=Halo%20GO%20K-POP" target="_blank"
                        class="footer-social-btn" title="WhatsApp">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                        </svg>
                    </a>
                    <a href="https://instagram.com" target="_blank" class="footer-social-btn" title="Instagram">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <rect x="2" y="2" width="20" height="20" rx="5" />
                            <circle cx="12" cy="12" r="5" />
                            <circle cx="17.5" cy="6.5" r="1.5" fill="currentColor" stroke="none" />
                        </svg>
                    </a>
                    <a href="https://twitter.com" target="_blank" class="footer-social-btn" title="Twitter/X">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path
                                d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z" />
                        </svg>
                    </a>
                </div>
                <p style="font-size:.75rem;color:var(--slate-500);margin-bottom:4px">WhatsApp Admin</p>
                <a href="https://wa.me/6281234567890" target="_blank"
                    style="display:inline-flex;align-items:center;gap:8px;font-size:.875rem;color:var(--slate-300)">
                    <span
                        style="width:8px;height:8px;border-radius:50%;background:#22c55e;display:inline-block;animation:pulseGreen 2s infinite"></span>
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

    <!-- ═══════ WA BUTTON ═══════ -->
    <a href="https://wa.me/6281234567890?text=Halo%20GO%20K-POP%2C%20saya%20ingin%20bertanya..." target="_blank"
        id="wa-btn" rel="noopener noreferrer" aria-label="WhatsApp Admin">
        <span class="wa-pulse"></span>
        <svg viewBox="0 0 24 24">
            <path
                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.13 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
        </svg>
    </a>

    <!-- ═══════ AUTH MODAL ═══════ -->
    <div class="modal-overlay" id="auth-modal">
        <div class="modal-box" id="auth-box">
            <button class="modal-close" id="auth-close">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
            <div id="auth-modal-content">
                <form id="register-form" class="" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div style="text-align:center;margin-bottom:2rem">
                        <h2 class="modal-title">Buat Akun Baru</h2>
                        <p class="modal-sub">
                            Daftar untuk mulai booking slot album favorit
                        </p>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>

                        <div class="input-wrap">
                            <svg class="input-icon" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>

                            <input type="text" class="form-input" name="full_name"
                                placeholder="Masukkan nama lengkap" value="{{ old('full_name') }}">
                            @error('full_name')
                                <small class="text-danger" style="color:#ef4444">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>

                        <div class="input-wrap">
                            <svg class="input-icon" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                <polyline points="22,6 12,13 2,6" />
                            </svg>

                            <input type="email" class="form-input" name="email" placeholder="nama@email.com"
                                value="{{ old('email') }}">
                            @error('email')
                                <small class="text-danger" style="color:#ef4444">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Password</label>

                        <div class="input-wrap">
                            <svg class="input-icon" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <rect x="3" y="11" width="18" height="11" rx="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>

                            <input type="password" class="form-input" id="auth-pw" name="password"
                                placeholder="Minimal 8 karakter">
                            @error('password')
                                <small class="text-danger" style="color:#ef4444">{{ $message }}</small>
                            @enderror
                            <button type="button" class="input-eye" id="auth-pw-toggle">

                                <svg width="16" height="16" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24" id="auth-eye-icon">

                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-accent"
                        style="width:100%;padding:14px;border-radius:12px;font-size:.875rem;margin-top:4px"
                        id="auth-submit">

                        Daftar Sekarang
                    </button>

                    <p style="text-align:center;font-size:.875rem;color:#94a3b8;margin-top:1rem">
                        Sudah punya akun?

                        <a href="#" style="color:#f43f5e;font-weight:500" id="auth-switch">
                            Masuk di sini
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <!-- ═══════ ORDER MODAL ═══════ -->
    <div class="modal-overlay" id="order-modal">
        <div class="modal-box modal-wide" id="order-box">
            <button class="modal-close" id="order-close">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
            <div id="order-modal-content"></div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('asset/js/global.js') }}"></script>
    <script src="{{ asset('asset/js/landing.js') }}"></script>
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#auth-modal').addClass('open');
                $('#register-form').removeClass('hidden');
            });
        </script>
    @endif
    @if (session('success'))
        <script>
            $(document).ready(function() {
                GKP.showToast(
                    "{{ session('success') }}",
                    "success"
                );
            });
        </script>
    @endif

</body>

</html>
