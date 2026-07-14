@extends('layout.admin')

@section('title', 'Beranda Admin — GO K-POP')

@section('breadcrumb', 'Beranda')

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
            <div class="admin-stat-value">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</div>
        </div>
        <div class="admin-stat stat-emerald">
            <div class="admin-stat-header">
                <span class="admin-stat-label">Total Pengguna</span>
                <div class="admin-stat-icon"><svg width="20" height="20" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg></div>
            </div>
            <div class="admin-stat-value">{{ $totalUsers }}</div>
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
            <div class="admin-stat-value">{{ $quotaPercentage }}%</div>
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
            <div class="admin-stat-value">{{ $totalOrders }}</div>
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
                🔥 Trending: {{ $trendingAlbum?->group_name ?? 'Belum ada album trending' }}
            </div>
        </div>
        <div class="campaign-grid">
            @foreach ($albums as $album)
                <div class="campaign-card">
                    <div class="campaign-card-top">

                        {{-- Cover album --}}
                        <img class="campaign-card-img" src="{{ $album->image_url }}" alt="{{ $album->title }}">

                        <div>

                            {{-- Nama grup --}}
                            <p class="campaign-group">
                                {{ $album->group_name }}
                            </p>

                            {{-- Judul album --}}
                            <p class="campaign-title">
                                {{ $album->title }}
                            </p>

                            {{-- Jumlah pesanan --}}
                            <p class="campaign-orders">
                                {{ $album->orders_count }} pesanan masuk
                            </p>

                        </div>
                    </div>

                    {{-- Progress kuota --}}
                    <div class="progress-label">
                        <span>Sisa Kuota</span>
                        <span>{{ $album->slots_left }} / {{ $album->total_slots }}</span>
                    </div>

                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $album->progress }}%; background: {{ $album->progressColor }};">
                        </div>
                    </div>

                    <div class="progress-footer">
                        <span>{{ $album->progress }}% tercapai</span>
                        <span>Rp{{ number_format($album->price, 0, ',', '.') }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
