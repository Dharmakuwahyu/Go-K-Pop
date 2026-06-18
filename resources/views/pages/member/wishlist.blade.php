@extends('layout.member-login')

@section('title', 'Album Favorit — GO K-POP')

@section('member_content')
    <div class="container">

        <!-- Page header -->
        <div class="page-header" style="display:flex;align-items:center;gap:16px">
            <div
                style="width:52px;height:52px;border-radius:14px;background:rgba(244,114,182,.12);border:1px solid rgba(244,114,182,.25);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <svg width="26" height="26" fill="#f472b6" viewBox="0 0 24 24">
                    <path
                        d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                </svg>
            </div>
            <div>
                <h1>Album Favorit Saya</h1>
                <p>2 album dalam daftar favoritmu</p>
            </div>
        </div>

        <!-- Album grid — hanya album yang di-like (contoh: SEVENTEEN & aespa) -->
        <div class="album-grid">

            <!-- SEVENTEEN — liked -->
            <div class="album-card wishlist-card">
                <div class="album-img-wrap">
                    <button class="like-btn liked" data-album-id="2">
                        <svg viewBox="0 0 24 24" fill="#f472b6" stroke="#f472b6" stroke-width="2">
                            <path
                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                        </svg>
                    </button>
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
                    <button class="btn-book js-book-album" data-album-id="2">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
                            <line x1="3" y1="6" x2="21" y2="6" />
                            <path d="M16 10a4 4 0 0 1-8 0" />
                        </svg>
                        Pesan Sekarang
                    </button>

                </div>
            </div>

            <!-- aespa — liked -->
            <div class="album-card wishlist-card">
                <div class="album-img-wrap">
                    <button class="like-btn liked" data-album-id="3">
                        <svg viewBox="0 0 24 24" fill="#f472b6" stroke="#f472b6" stroke-width="2">
                            <path
                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                        </svg>
                    </button>
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
                    <button class="btn-book js-book-album" data-album-id="3">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
                            <line x1="3" y1="6" x2="21" y2="6" />
                            <path d="M16 10a4 4 0 0 1-8 0" />
                        </svg>
                        Pesan Sekarang
                    </button>

                </div>
            </div>

        </div>

        <!-- Empty state (hidden by default, tampil jika tidak ada favorit) -->
        <div class="wishlist-empty hidden" id="wishlist-empty">
            <div class="wishlist-empty-icon">
                <svg width="40" height="40" fill="rgba(244,114,182,.6)" viewBox="0 0 24 24">
                    <path
                        d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                </svg>
            </div>
            <h2>Belum ada album favorit</h2>
            <p>Yuk, jelajahi katalog dan tandai album impianmu dengan menekan tombol ❤</p>
            <a href="catalog.html" class="btn btn-accent" style="padding:12px 24px;border-radius:12px">Jelajah Katalog</a>
        </div>

    </div>
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
