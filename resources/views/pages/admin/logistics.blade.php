@extends('layout.admin')

@section('title', 'Pengiriman — GO K-POP Admin')

@section('admin_content')
    <h1 class="admin-panel-title">Pengiriman &amp; Resi</h1>
    <p class="admin-panel-sub">Update status kargo dan input nomor resi domestik</p>

    <!-- Update Kargo Massal -->
    <div class="logistics-section">
        <h2>Update Status Kargo (Massal)</h2>
        <div style="display:flex;gap:12px;flex-wrap:wrap">
            <div class="select-wrap" style="flex:1;min-width:200px">
                <select class="form-select" id="cargo-status-select">
                    <option value="">Pilih status kargo</option>
                    <option value="korea">Di Gudang Korea</option>
                    <option value="otw">Perjalanan Laut OTW Indo</option>
                    <option value="tiba">Tiba di Indonesia</option>
                </select>
                <svg class="select-arrow" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="6 9 12 15 18 9" />
                </svg>
            </div>
            <button class="btn btn-accent" style="padding:12px 24px;border-radius:12px;white-space:nowrap"
                id="btn-update-cargo">
                Update Status
            </button>
        </div>
    </div>

    <!-- Input Resi Domestik -->
    <div class="logistics-section">
        <h2>Input Nomor Resi Domestik</h2>
        <div style="display:flex;flex-direction:column;gap:10px">
            <div class="select-wrap">
                <select class="form-select" id="resi-order-select">
                    <option value="">Pilih pesanan</option>
                    <option value="ORD-005">ORD-005 - Siti Rahma - NewJeans - Get Up (Jakarta) | J&amp;T</option>
                    <option value="ORD-004">ORD-004 - Sari Dewi - Stray Kids - 5-STAR (Yogyakarta) | J&amp;T</option>
                </select>
                <svg class="select-arrow" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="6 9 12 15 18 9" />
                </svg>
            </div>
            <input type="text" class="form-input no-icon" id="resi-input"
                placeholder="Masukkan nomor resi (contoh: JNT1234567890)" />
            <button class="btn btn-neon" style="width:100%;padding:14px;border-radius:12px" id="btn-submit-resi">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <line x1="22" y1="2" x2="11" y2="13" />
                    <polygon points="22 2 15 22 11 13 2 9 22 2" />
                </svg>
                Update Status &amp; Kirim Resi
            </button>
        </div>
    </div>

    <!-- Daftar Pesanan Siap Kirim -->
    <div class="logistics-section">
        <h2 style="display:flex;align-items:center;gap:8px">
            <svg width="20" height="20" fill="none" stroke="var(--neon-400)" stroke-width="2" viewBox="0 0 24 24">
                <rect x="1" y="3" width="15" height="13" />
                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8" />
                <circle cx="5.5" cy="18.5" r="2.5" />
                <circle cx="18.5" cy="18.5" r="2.5" />
            </svg>
            Daftar Pesanan Siap Kirim
        </h2>
        <div id="ready-to-ship-list">
            <div class="logistics-order-item">
                <div>
                    <div class="logistics-order-name">ORD-005 - Siti Rahma</div>
                    <div class="logistics-order-sub">NewJeans - Get Up | J&amp;T (Jakarta)</div>
                </div>
                <span class="resi-badge">Resi: JNT1234567890</span>
            </div>
            <div class="logistics-order-item">
                <div>
                    <div class="logistics-order-name">ORD-004 - Sari Dewi</div>
                    <div class="logistics-order-sub">Stray Kids - 5-STAR | J&amp;T (Yogyakarta)</div>
                </div>
                <span class="badge badge-yellow" style="font-size:.75rem;padding:5px 12px">Belum ada resi</span>
            </div>
        </div>
    </div>
@endsection

@section('js_custom')
    <script src="{{ asset('asset/js/admin-logistics.js') }}"></script>
@endsection
