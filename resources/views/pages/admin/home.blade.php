@extends('layout.admin')

@section('title', 'Beranda Admin — GO K-POP')

@section('admin_content')
    <!-- Hero banner -->
    <div class="admin-hero-banner">
        <div class="admin-hero-badge">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" />
            </svg>
            Beranda Admin · Ringkasan Performa
        </div>
        <h1 class="admin-hero-title">Selamat Datang Kembali, <span>Admin</span></h1>
        <p class="admin-hero-sub">Pantau seluruh aktivitas Group Order, kuota terpenuhi, dan performa platform secara
            real-time.</p>
    </div>

    <!-- Stat cards -->
    <div class="admin-stat-grid">
        <div class="admin-stat stat-accent">
            <div class="admin-stat-header">
                <span class="admin-stat-label">Total Omset</span>
                <div class="admin-stat-icon"><svg width="20" height="20" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18" />
                        <polyline points="17 6 23 6 23 12" />
                    </svg></div>
            </div>
            <div class="admin-stat-value">Rp700.000</div>
        </div>
        <div class="admin-stat stat-emerald">
            <div class="admin-stat-header">
                <span class="admin-stat-label">Pengguna Aktif</span>
                <div class="admin-stat-icon"><svg width="20" height="20" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg></div>
            </div>
            <div class="admin-stat-value">5</div>
        </div>
        <div class="admin-stat stat-gold">
            <div class="admin-stat-header">
                <span class="admin-stat-label">Kuota Terpenuhi</span>
                <div class="admin-stat-icon"><svg width="20" height="20" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg></div>
            </div>
            <div class="admin-stat-value">61%</div>
        </div>
        <div class="admin-stat stat-sky">
            <div class="admin-stat-header">
                <span class="admin-stat-label">Total Pesanan</span>
                <div class="admin-stat-icon"><svg width="20" height="20" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path
                            d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                    </svg></div>
            </div>
            <div class="admin-stat-value">7</div>
        </div>
    </div>

    <!-- Perkembangan Group Order -->
    <div class="admin-card">
        <div
            style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:12px">
            <h3 style="font-size:1rem;font-weight:700;color:#fff;display:flex;align-items:center;gap:8px">
                <svg width="18" height="18" fill="none" stroke="var(--accent-400)" stroke-width="2"
                    viewBox="0 0 24 24">
                    <line x1="18" y1="20" x2="18" y2="10" />
                    <line x1="12" y1="20" x2="12" y2="4" />
                    <line x1="6" y1="20" x2="6" y2="14" />
                </svg>
                Perkembangan Group Order
            </h3>
            <div
                style="display:flex;align-items:center;gap:6px;padding:5px 12px;border-radius:999px;background:rgba(234,179,8,.1);border:1px solid rgba(234,179,8,.2);font-size:.75rem;color:var(--gold-400)">
                🔥 Trending: Stray Kids
            </div>
        </div>
        <div class="campaign-grid">
            <!-- Stray Kids -->
            <div class="campaign-card">
                <div class="campaign-card-top">
                    <img class="campaign-card-img"
                        src="https://images.pexels.com/photos/1644697/pexels-photo-1644697.jpeg?auto=compress&cs=tinysrgb&w=200"
                        alt="5-STAR">
                    <div>
                        <p class="campaign-group">Stray Kids</p>
                        <p class="campaign-title">5-STAR - 3rd Album</p>
                        <p class="campaign-orders">1 pesanan masuk</p>
                    </div>
                </div>
                <div class="progress-label"><span>Kuota Terisi</span><span>32 / 35</span></div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width:91%;background:#e11d48"></div>
                </div>
                <div class="progress-footer"><span>91% tercapai</span><span>Rp295.000</span></div>
            </div>
            <!-- SEVENTEEN -->
            <div class="campaign-card">
                <div class="campaign-card-top">
                    <img class="campaign-card-img"
                        src="https://images.pexels.com/photos/1190297/pexels-photo-1190297.jpeg?auto=compress&cs=tinysrgb&w=200"
                        alt="FML">
                    <div>
                        <p class="campaign-group">SEVENTEEN</p>
                        <p class="campaign-title">FML - 10th Mini Album</p>
                        <p class="campaign-orders">1 pesanan masuk</p>
                    </div>
                </div>
                <div class="progress-label"><span>Kuota Terisi</span><span>42 / 50</span></div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width:84%;background:#eab308"></div>
                </div>
                <div class="progress-footer"><span>84% tercapai</span><span>Rp310.000</span></div>
            </div>
            <!-- ENHYPEN -->
            <div class="campaign-card">
                <div class="campaign-card-top">
                    <img class="campaign-card-img"
                        src="https://images.pexels.com/photos/1540137/pexels-photo-1540137.jpeg?auto=compress&cs=tinysrgb&w=200"
                        alt="DARK BLOOD">
                    <div>
                        <p class="campaign-group">ENHYPEN</p>
                        <p class="campaign-title">DARK BLOOD - 4th Mini...</p>
                        <p class="campaign-orders">0 pesanan masuk</p>
                    </div>
                </div>
                <div class="progress-label"><span>Kuota Terisi</span><span>18 / 30</span></div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width:60%;background:#e11d48"></div>
                </div>
                <div class="progress-footer"><span>60% tercapai</span><span>Rp270.000</span></div>
            </div>
            <!-- NCT 127 -->
            <div class="campaign-card">
                <div class="campaign-card-top">
                    <img class="campaign-card-img"
                        src="https://images.pexels.com/photos/1762537/pexels-photo-1762537.jpeg?auto=compress&cs=tinysrgb&w=200"
                        alt="ISTJ">
                    <div>
                        <p class="campaign-group">NCT 127</p>
                        <p class="campaign-title">ISTJ - The 5th Album</p>
                        <p class="campaign-orders">3 pesanan masuk</p>
                    </div>
                </div>
                <div class="progress-label"><span>Kuota Terisi</span><span>15 / 30</span></div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width:50%;background:#eab308"></div>
                </div>
                <div class="progress-footer"><span>50% tercapai</span><span>Rp285.000</span></div>
            </div>
            <!-- aespa -->
            <div class="campaign-card">
                <div class="campaign-card-top">
                    <img class="campaign-card-img"
                        src="https://images.pexels.com/photos/1540137/pexels-photo-1540137.jpeg?auto=compress&cs=tinysrgb&w=200"
                        alt="MY WORLD">
                    <div>
                        <p class="campaign-group">aespa</p>
                        <p class="campaign-title">MY WORLD - 3rd Mini...</p>
                        <p class="campaign-orders">1 pesanan masuk</p>
                    </div>
                </div>
                <div class="progress-label"><span>Kuota Terisi</span><span>18 / 40</span></div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width:45%;background:#22c55e"></div>
                </div>
                <div class="progress-footer"><span>45% tercapai</span><span>Rp250.000</span></div>
            </div>
            <!-- NewJeans -->
            <div class="campaign-card">
                <div class="campaign-card-top">
                    <img class="campaign-card-img"
                        src="https://images.pexels.com/photos/1670934/pexels-photo-1670934.jpeg?auto=compress&cs=tinysrgb&w=200"
                        alt="Get Up">
                    <div>
                        <p class="campaign-group">NewJeans</p>
                        <p class="campaign-title">Get Up - 2nd EP</p>
                        <p class="campaign-orders">1 pesanan masuk</p>
                    </div>
                </div>
                <div class="progress-label"><span>Kuota Terisi</span><span>15 / 45</span></div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width:33%;background:#22c55e"></div>
                </div>
                <div class="progress-footer"><span>33% tercapai</span><span>Rp240.000</span></div>
            </div>
        </div>
    </div>
@endsection
