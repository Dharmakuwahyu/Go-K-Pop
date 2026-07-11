@extends('layout.admin')

@section('title', 'Data Pesanan — GO K-POP Admin')

@section('admin_content')
    <h1 class="admin-panel-title">Data Pesanan</h1>
    <p class="admin-panel-sub">Pusat kontrol seluruh database pesanan masuk</p>

    <!-- Stat mini cards -->
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1.5rem">
        <div class="admin-card" style="padding:1.25rem;margin-bottom:0">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.5rem">
                <span style="font-size:.75rem;color:var(--slate-400)">Total Pesanan Masuk</span>
                <div
                    style="width:36px;height:36px;border-radius:10px;background:rgba(225,29,72,.1);border:1px solid rgba(225,29,72,.2);display:flex;align-items:center;justify-content:center">
                    <svg width="16" height="16" fill="none" stroke="var(--accent-400)" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path
                            d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                    </svg>
                </div>
            </div>
            <div style="font-size:2rem;font-weight:800;color:#fff" id="stat-total">{{ $totalOrders }}</div>
        </div>
        <div class="admin-card" style="padding:1.25rem;margin-bottom:0">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.5rem">
                <span style="font-size:.75rem;color:var(--slate-400)">Menunggu Pembayaran</span>
                <div
                    style="width:36px;height:36px;border-radius:10px;background:rgba(234,179,8,.1);border:1px solid rgba(234,179,8,.2);display:flex;align-items:center;justify-content:center">
                    <svg width="16" height="16" fill="none" stroke="var(--gold-400)" stroke-width="2"
                        viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>
                </div>
            </div>
            <div style="font-size:2rem;font-weight:800;color:#fff" id="stat-pending">{{ $pendingOrders }}</div>
        </div>
        <div class="admin-card" style="padding:1.25rem;margin-bottom:0">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.5rem">
                <span style="font-size:.75rem;color:var(--slate-400)">Pesanan Lunas</span>
                <div
                    style="width:36px;height:36px;border-radius:10px;background:rgba(52,211,153,.1);border:1px solid rgba(52,211,153,.2);display:flex;align-items:center;justify-content:center">
                    <svg width="16" height="16" fill="none" stroke="var(--emerald-400)" stroke-width="2"
                        viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                </div>
            </div>
            <div style="font-size:2rem;font-weight:800;color:#fff" id="stat-lunas">{{ $paidOrders }}</div>
        </div>
    </div>

    <!-- Filter bar -->
    <div class="admin-card" style="padding:1rem;margin-bottom:1.5rem">
        <div class="filter-bar">
            <div class="search-wrap" style="flex:2;min-width:240px">
                <svg class="search-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                </svg>
                <input type="text" class="search-input" id="order-search"
                    placeholder="Cari nama pembeli atau ID pesanan..." />
            </div>
            <div class="select-wrap">
                <select class="filter-select" id="filter-album" style="min-width:160px">
                    <option value="all">Semua Album</option>
                    @foreach ($albums as $album)
                        <option value="{{ $album->group_name }} - {{ $album->title }}">
                            {{ $album->group_name }} - {{ $album->title }}
                        </option>
                    @endforeach
                </select>
                <svg class="select-arrow" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="6 9 12 15 18 9" />
                </svg>
            </div>
            <div class="select-wrap">
                <select class="filter-select" id="filter-status" style="min-width:160px">
                    <option value="all">Semua Status</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status['value'] }}">
                            {{ $status['label'] }}
                        </option>
                    @endforeach
                </select>
                <svg class="select-arrow" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="6 9 12 15 18 9" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="admin-card" style="padding:0;overflow:hidden">
        <div class="admin-table-wrap">
            <table class="admin-table" id="orders-table">
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Pembeli</th>
                        <th>Album / Varian</th>
                        <th>Prio PC</th>
                        <th class="text-right">Total Estimasi</th>
                        <th class="text-right">Sudah Dibayar</th>
                        <th class="text-right">Kekurangan Tahap Ini</th>
                        <th class="text-right">Sisa Harga Album</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="orders-tbody">
                    @forelse ($orders as $order)
                        <tr data-album="{{ $order->album->group_name }} - {{ $order->album->title }}"
                            data-status="{{ $order->status }}" data-buyer="{{ strtolower($order->buyer_name) }}"
                            data-id="{{ strtolower($order->order_code) }}">

                            {{-- ID Pesanan --}}
                            <td class="mono">
                                {{ $order->order_code }}
                            </td>

                            {{-- Pembeli --}}
                            <td>
                                <div class="td-buyer-name">
                                    {{ $order->buyer_name }}
                                </div>
                                <div class="td-buyer-city">
                                    {{ $order->buyer_city }}
                                </div>
                            </td>

                            {{-- Album / Varian --}}
                            <td>
                                <div class="td-album">
                                    {{ $order->album->group_name }} - {{ $order->album->title }}
                                </div>

                                <div class="td-album-sub">
                                    {{ $order->variant->name }} × {{ $order->qty }}
                                </div>
                            </td>

                            {{-- Prioritas --}}
                            <td>
                                <div class="td-prio">
                                    @foreach ($order->priorities->sortBy('priority') as $priority)
                                        <span>{{ $priority->priority }}. {{ $priority->member_name }}</span>
                                    @endforeach
                                </div>
                            </td>

                            {{-- Total Estimasi --}}
                            <td class="text-right" style="color:#fff">
                                Rp{{ number_format($order->total_price, 0, ',', '.') }}
                            </td>

                            {{-- Sudah Dibayar --}}
                            <td class="text-right td-paid">
                                Rp{{ number_format($order->paid_amount, 0, ',', '.') }}
                            </td>

                            {{-- Kekurangan Tahap Ini --}}
                            <td class="text-right td-due">
                                Rp{{ number_format($order->current_payment_amount, 0, ',', '.') }}
                            </td>

                            {{-- Sisa Harga --}}
                            <td class="text-right td-remaining">
                                Rp{{ number_format($order->remaining_price, 0, ',', '.') }}
                            </td>

                            {{-- Status --}}
                            <td>
                                <span class="badge badge-{{ $order->status_color }}">
                                    {{ $order->status_label }}
                                </span>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="text-align:center;padding:2rem">
                                Belum ada data pesanan.
                            </td>
                        </tr>
                    @endforelse
                    {{-- <tr data-album="NCT 127 - ISTJ" data-status="pending_dp1" data-buyer="rina aulia" data-id="ord-001">
                        <td class="mono">ORD-001</td>
                        <td>
                            <div class="td-buyer-name">Rina Aulia</div>
                            <div class="td-buyer-city">Jakarta</div>
                        </td>
                        <td>
                            <div class="td-album">NCT 127 - ISTJ</div>
                            <div class="td-album-sub">Photobook × 2</div>
                        </td>
                        <td>
                            <div class="td-prio"><span>1. Jaehyun</span><span>2. Mark</span><span>3. Taeyong</span></div>
                        </td>
                        <td class="text-right" style="color:#fff">Rp350.000</td>
                        <td class="text-right td-paid">Rp0</td>
                        <td class="text-right td-due">Rp50.000</td>
                        <td class="text-right td-remaining">Rp350.000</td>
                        <td><span class="badge badge-yellow">Menunggu DP 1</span></td>
                    </tr>
                    <tr data-album="NCT 127 - ISTJ" data-status="pending_dp1" data-buyer="rina aulia"
                        data-id="ord-001-b">
                        <td class="mono">ORD-001-B</td>
                        <td>
                            <div class="td-buyer-name">Rina Aulia</div>
                            <div class="td-buyer-city">Jakarta</div>
                        </td>
                        <td>
                            <div class="td-album">NCT 127 - ISTJ</div>
                            <div class="td-album-sub">Photobook × 2</div>
                        </td>
                        <td>
                            <div class="td-prio"><span>1. Jaehyun</span><span>2. Mark</span><span>3. Taeyong</span></div>
                        </td>
                        <td class="text-right" style="color:#fff">Rp350.000</td>
                        <td class="text-right td-paid">Rp0</td>
                        <td class="text-right td-due">Rp50.000</td>
                        <td class="text-right td-remaining">Rp350.000</td>
                        <td><span class="badge badge-yellow">Menunggu DP 1</span></td>
                    </tr>
                    <tr data-album="NCT 127 - ISTJ" data-status="pending_dp1" data-buyer="rina aulia"
                        data-id="ord-001-c">
                        <td class="mono">ORD-001-C</td>
                        <td>
                            <div class="td-buyer-name">Rina Aulia</div>
                            <div class="td-buyer-city">Jakarta</div>
                        </td>
                        <td>
                            <div class="td-album">NCT 127 - ISTJ</div>
                            <div class="td-album-sub">Photobook × 2</div>
                        </td>
                        <td>
                            <div class="td-prio"><span>1. Jaehyun</span><span>2. Mark</span><span>3. Taeyong</span></div>
                        </td>
                        <td class="text-right" style="color:#fff">Rp350.000</td>
                        <td class="text-right td-paid">Rp0</td>
                        <td class="text-right td-due">Rp50.000</td>
                        <td class="text-right td-remaining">Rp350.000</td>
                        <td><span class="badge badge-yellow">Menunggu DP 1</span></td>
                    </tr>
                    <tr data-album="SEVENTEEN - FML" data-status="pending_dp2" data-buyer="dinda putri"
                        data-id="ord-002">
                        <td class="mono">ORD-002</td>
                        <td>
                            <div class="td-buyer-name">Dinda Putri</div>
                            <div class="td-buyer-city">Bandung</div>
                        </td>
                        <td>
                            <div class="td-album">SEVENTEEN - FML</div>
                            <div class="td-album-sub">Carat Ver. × 1</div>
                        </td>
                        <td>
                            <div class="td-prio"><span>1. Mingyu</span><span>2. Wonwoo</span><span>3. Hoshi</span></div>
                        </td>
                        <td class="text-right" style="color:#fff">Rp350.000</td>
                        <td class="text-right td-paid">Rp50.000</td>
                        <td class="text-right td-due">Rp100.000</td>
                        <td class="text-right td-remaining">Rp300.000</td>
                        <td><span class="badge badge-yellow">Menunggu DP 2</span></td>
                    </tr>
                    <tr data-album="aespa - MY WORLD" data-status="dp2_confirmed" data-buyer="maya sari"
                        data-id="ord-003">
                        <td class="mono">ORD-003</td>
                        <td>
                            <div class="td-buyer-name">Maya Sari</div>
                            <div class="td-buyer-city">Surabaya</div>
                        </td>
                        <td>
                            <div class="td-album">aespa - MY WORLD</div>
                            <div class="td-album-sub">Smini × 1</div>
                        </td>
                        <td>
                            <div class="td-prio"><span>1. Winter</span><span>2. Karina</span><span>3. Ningning</span></div>
                        </td>
                        <td class="text-right" style="color:#fff">Rp350.000</td>
                        <td class="text-right td-paid">Rp150.000</td>
                        <td class="text-right td-due" style="color:var(--neon-400)">Rp0</td>
                        <td class="text-right td-remaining">Rp200.000</td>
                        <td><span class="badge badge-blue">DP 2 Lunas</span></td>
                    </tr>
                    <tr data-album="Stray Kids - 5-STAR" data-status="pending_pelunasan" data-buyer="sari dewi"
                        data-id="ord-004">
                        <td class="mono">ORD-004</td>
                        <td>
                            <div class="td-buyer-name">Sari Dewi</div>
                            <div class="td-buyer-city">Yogyakarta</div>
                        </td>
                        <td>
                            <div class="td-album">Stray Kids - 5-STAR</div>
                            <div class="td-album-sub">Photobook A × 1</div>
                        </td>
                        <td>
                            <div class="td-prio"><span>1. Felix</span><span>2. Hyunjin</span><span>3. Han</span></div>
                        </td>
                        <td class="text-right" style="color:#fff">Rp350.000</td>
                        <td class="text-right td-paid">Rp150.000</td>
                        <td class="text-right td-due">Rp200.000</td>
                        <td class="text-right td-remaining">Rp200.000</td>
                        <td><span class="badge badge-yellow">Menunggu Pelunasan</span></td>
                    </tr>
                    <tr data-album="NewJeans - Get Up" data-status="lunas" data-buyer="siti rahma" data-id="ord-005">
                        <td class="mono">ORD-005</td>
                        <td>
                            <div class="td-buyer-name">Siti Rahma</div>
                            <div class="td-buyer-city">Jakarta</div>
                        </td>
                        <td>
                            <div class="td-album">NewJeans - Get Up</div>
                            <div class="td-album-sub">Bag Ver. × 1</div>
                        </td>
                        <td>
                            <div class="td-prio"><span>1. Minji</span><span>2. Hanni</span><span>3. Danielle</span></div>
                        </td>
                        <td class="text-right" style="color:#fff">Rp350.000</td>
                        <td class="text-right td-paid">Rp350.000</td>
                        <td class="text-right" style="color:var(--neon-400)">Rp0</td>
                        <td class="text-right" style="color:var(--neon-400)">Rp0</td>
                        <td><span class="badge badge-green">Siap Kirim / Dikirim</span></td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
        <!-- Empty state -->
        <div id="orders-empty" class="hidden" style="padding:3rem;text-align:center;color:var(--slate-500)">
            Tidak ada pesanan yang cocok dengan filter.
        </div>
    </div>
@endsection

@section('js_custom')
    <script src="{{ asset('asset/js/admin-orders.js') }}"></script>
@endsection
