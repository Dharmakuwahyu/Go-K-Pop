@extends('layout.member-login')

@section('title', 'Katalog Album — GO K-POP')

@section('member_content')
    <div class="container">
        <div class="page-header">
            <h1>Katalog Album</h1>
            <p>Pilih album favoritmu dan booking slot sekarang!</p>
        </div>

        <div class="album-grid">

            @forelse ($albums as $album)
                <div class="album-card">
                    <div class="album-img-wrap">
                        <button class="like-btn" data-album-id="1"><svg viewBox="0 0 24 24" fill="transparent" stroke="#cbd5e1"
                                stroke-width="2">
                                <path
                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                            </svg></button>
                        <img src="https://images.pexels.com/photos/1762537/pexels-photo-1762537.jpeg?auto=compress&cs=tinysrgb&w=600"
                            alt="{{ $album->title }}" loading="lazy">
                        <div class="album-img-overlay"></div>
                        <span class="album-slots-badge badge badge-solid-gold">{{ $album->slots_left }} Slots Left</span>
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
                            <span class="album-slots-txt">{{ $album->slots_left }}/{{ $album->total_slots }} slot</span>
                        </div>
                        <div class="slot-bar">
                            <div class="slot-fill" style="width:50%;background:#eab308"></div>
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
            <!-- NCT 127 -->
            <div class="album-card">
                <div class="album-img-wrap">
                    <button class="like-btn" data-album-id="1"><svg viewBox="0 0 24 24" fill="transparent" stroke="#cbd5e1"
                            stroke-width="2">
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
                    <div class="album-variants">
                        <span class="variant-tag">Photobook</span><span class="variant-tag">Digipack</span><span
                            class="variant-tag">Smini</span>
                    </div>
                    <div class="album-price-row">
                        <span class="album-price">Rp285.000</span>
                        <span class="album-slots-txt">15/30 slot</span>
                    </div>
                    <div class="slot-bar">
                        <div class="slot-fill" style="width:50%;background:#eab308"></div>
                    </div>
                    <button class="btn-book js-book-album" data-album-id="1">Book Slot</button>
                </div>
            </div>

            <!-- SEVENTEEN -->
            <div class="album-card">
                <div class="album-img-wrap">
                    <button class="like-btn" data-album-id="2"><svg viewBox="0 0 24 24" fill="transparent" stroke="#cbd5e1"
                            stroke-width="2">
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
                    <div class="album-variants">
                        <span class="variant-tag">Photobook</span><span class="variant-tag">Carat Ver.</span><span
                            class="variant-tag">KiT Ver.</span>
                    </div>
                    <div class="album-price-row">
                        <span class="album-price">Rp310.000</span>
                        <span class="album-slots-txt">8/50 slot</span>
                    </div>
                    <div class="slot-bar">
                        <div class="slot-fill" style="width:84%;background:#e11d48"></div>
                    </div>
                    <button class="btn-book js-book-album" data-album-id="2">Book Slot</button>
                </div>
            </div>

            <!-- aespa -->
            <div class="album-card">
                <div class="album-img-wrap">
                    <button class="like-btn liked" data-album-id="3"><svg viewBox="0 0 24 24" fill="#f472b6"
                            stroke="#f472b6" stroke-width="2">
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
                    <div class="album-variants">
                        <span class="variant-tag">Photobook</span><span class="variant-tag">Digipack</span><span
                            class="variant-tag">Smini</span>
                    </div>
                    <div class="album-price-row">
                        <span class="album-price">Rp250.000</span>
                        <span class="album-slots-txt">22/40 slot</span>
                    </div>
                    <div class="slot-bar">
                        <div class="slot-fill" style="width:45%;background:#22c55e"></div>
                    </div>
                    <button class="btn-book js-book-album" data-album-id="3">Book Slot</button>
                </div>
            </div>

            <!-- Stray Kids -->
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
                    <div class="album-variants">
                        <span class="variant-tag">Photobook A</span><span class="variant-tag">Photobook B</span><span
                            class="variant-tag">Digipack</span>
                    </div>
                    <div class="album-price-row">
                        <span class="album-price">Rp295.000</span>
                        <span class="album-slots-txt">3/35 slot</span>
                    </div>
                    <div class="slot-bar">
                        <div class="slot-fill" style="width:91%;background:#e11d48"></div>
                    </div>
                    <button class="btn-book js-book-album" data-album-id="4">Book Slot</button>
                </div>
            </div>

            <!-- NewJeans -->
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
                    <div class="album-variants">
                        <span class="variant-tag">Bag Ver.</span><span class="variant-tag">Weverse Ver.</span><span
                            class="variant-tag">KiT Ver.</span>
                    </div>
                    <div class="album-price-row">
                        <span class="album-price">Rp240.000</span>
                        <span class="album-slots-txt">30/45 slot</span>
                    </div>
                    <div class="slot-bar">
                        <div class="slot-fill" style="width:33%;background:#22c55e"></div>
                    </div>
                    <button class="btn-book js-book-album" data-album-id="5">Book Slot</button>
                </div>
            </div>

            <!-- ENHYPEN -->
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
                    <div class="album-variants">
                        <span class="variant-tag">Photobook A</span><span class="variant-tag">Photobook B</span><span
                            class="variant-tag">Digipack</span>
                    </div>
                    <div class="album-price-row">
                        <span class="album-price">Rp270.000</span>
                        <span class="album-slots-txt">12/30 slot</span>
                    </div>
                    <div class="slot-bar">
                        <div class="slot-fill" style="width:60%;background:#eab308"></div>
                    </div>
                    <button class="btn-book js-book-album" data-album-id="6">Book Slot</button>
                </div>
            </div>

        </div>
    </div>
@endsection


@section('member_content_custom')
    <!-- ORDER MODAL -->
    <div class="modal-overlay" id="order-modal">
        <div class="modal-box modal-wide">
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
@endsection
