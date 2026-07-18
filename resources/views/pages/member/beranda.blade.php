@extends('layout.member')

@section('title', 'Beranda — GO K-POP')

@section('css_custom')
    <link rel="stylesheet" href="{{ asset('asset/css/landing.css') }}" />
@endsection

@section('member_content')
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
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <polyline points="15 18 9 12 15 6" />
            </svg>
        </button>
        <button class="carousel-arrow" id="carousel-next">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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

                @forelse ($albums as $album)
                    @php
                        $isLiked = in_array($album->id, $wishlistAlbumIds);
                    @endphp
                    <div class="album-card">
                        <div class="album-img-wrap">
                            <button class="like-btn {{ $isLiked ? 'liked' : '' }}"
                                data-album-id="{{ $album->id }}"><svg viewBox="0 0 24 24"
                                    fill="{{ $isLiked ? '#f472b6' : 'transparent' }}"
                                    stroke="{{ $isLiked ? '#f472b6' : '#cbd5e1' }}" stroke-width="2">
                                    <path
                                        d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                                </svg></button>
                            <img src="https://images.pexels.com/photos/1762537/pexels-photo-1762537.jpeg?auto=compress&cs=tinysrgb&w=600"
                                alt="{{ $album->title }}" loading="lazy">
                            <div class="album-img-overlay"></div>
                            <span class="album-slots-badge badge badge-solid-gold">{{ $album->slots_left }} Sisa Kuota</span>
                        </div>
                        <div class="album-body">
                            <p class="album-group">{{ $album->group_name }}</p>
                            <h3 class="album-title">{{ $album->title }}</h3>
                            <div class="album-variants">
                                @foreach ($album->variants as $variant)
                                    <span class="variant-tag">{{ $variant->name }}</span>
                                @endforeach
                            </div>
                            <div class="album-price-row">
                                <span class="album-price">Rp{{ number_format($album->price) }}</span>
                                <span class="album-slots-txt">{{ $album->slots_left }}/{{ $album->total_slots }}
                                    Kuota</span>
                            </div>
                            <div class="slot-bar">
                                <div class="slot-fill"
                                    style="width:{{ $album->progress }}%; background: {{ $album->progressColor }}"></div>
                            </div>
                            <button class="btn-book js-book-album" data-album-id="{{ $album->id }}">Book Slot</button>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <h3>Katalog masih kosong</h3>
                        <p>Belum ada album yang tersedia saat ini.</p>
                    </div>
                @endforelse


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
@endsection

@section('member_content_custom')
    <!-- ORDER MODAL -->
    <div class="modal-overlay" id="order-modal">
        <div class="modal-box modal-wide">
            <button class="modal-close" id="order-close"><svg width="20" height="20" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg></button>
            <div id="order-modal-content"></div>
        </div>
    </div>
@endsection

@section('js_custom')
    <script src="{{ asset('asset/js/landing.js') }}"></script>
@endsection
