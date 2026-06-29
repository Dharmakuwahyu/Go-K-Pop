@extends('layout.member')

@section('title', 'Pesanan Saya — GO K-POP')

@section('member_content')
    <div class="container" style="max-width:896px">
        <div class="page-header">
            <h1>Pesanan Saya</h1>
            <p>Lacak status pesanan, upload bukti bayar, dan pantau pengiriman</p>
        </div>

        @foreach ($orders as $order)
            <div class="order-card">
                <div class="order-card-header">
                    <div>
                        <div class="order-meta-id">{{ $order->order_code }} . {{ $order->formatted_created_at }}</div>
                        <div class="order-meta-title">{{ $order->album->group_name }} - {{ $order->album->title }}</div>
                        <div class="order-meta-sub">Varian: {{ $order->variant->name }} | Qty: {{ $order->qty }}</div>
                        <div class="order-meta-prio">
                            @foreach ($order->priorities as $priority)
                                <span class="prio-tag">Prio {{ $priority->priority }}: {{ $priority->member_name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        {{-- <div class="order-total-label">Total Estimasi</div>
                        <div class="order-total-val">Rp{{ number_format($order->total_price) }}</div> --}}
                        <span class="badge badge-{{ $order->status_color }}" style="margin-top:6px;display:inline-flex">
                            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                            {{ $order->status_label }}
                        </span>
                    </div>
                </div>
                <div class="order-card-body">
                    <!-- Cargo -->
                    <p style="font-size:.875rem;font-weight:600;color:var(--slate-300);margin-bottom:10px">Status Kargo</p>
                    <div class="cargo-tracker" style="margin-bottom:1.5rem">
                        <div class="cargo-step">
                            <div class="cargo-dot"><svg width="12" height="12" fill="none" stroke="#64748b"
                                    stroke-width="2.5" viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12" />
                                </svg></div>
                            <div class="cargo-label">Di Korea</div>
                        </div>
                        <div class="cargo-line"></div>
                        <div class="cargo-step">
                            <div class="cargo-dot"><svg width="12" height="12" fill="none" stroke="#64748b"
                                    stroke-width="2.5" viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12" />
                                </svg></div>
                            <div class="cargo-label">OTW Indo</div>
                        </div>
                        <div class="cargo-line"></div>
                        <div class="cargo-step">
                            <div class="cargo-dot"><svg width="12" height="12" fill="none" stroke="#64748b"
                                    stroke-width="2.5" viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12" />
                                </svg></div>
                            <div class="cargo-label">Tiba Indo</div>
                        </div>
                        <div class="cargo-line"></div>
                        <div class="cargo-step">
                            <div class="cargo-dot"><svg width="12" height="12" fill="none" stroke="#64748b"
                                    stroke-width="2.5" viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12" />
                                </svg></div>
                            <div class="cargo-label">Dikirim</div>
                        </div>
                    </div>
                    <!-- Rincian -->
                    <p style="font-size:.875rem;font-weight:600;color:var(--slate-300);margin-bottom:10px">Rincian Biaya</p>
                    <div class="fin-grid">
                        <span class="fin-label">Total Estimasi Album</span><span
                            class="fin-val">Rp{{ number_format($order->total_price) }}</span>
                        <span class="fin-label">Sudah Dibayar</span><span 
                            class="fin-val neon">Rp{{ number_format($order->paid_amount) }}</span>
                        <span class="fin-label">Kekurangan Tahap Ini</span><span
                            class="fin-val accent">Rp{{ number_format($order->current_payment_amount) }}</span>
                        <span class="fin-label">Sisa Harga Album</span><span
                            class="fin-val">Rp{{ number_format($order->remaining_price) }}</span>
                    </div>
                    <!-- Bank -->
                    <div class="bank-info-box">
                        @if ($order->action_label !== '-')
                            <div class="bank-info-row">
                                <div>
                                    <div class="bank-name">BRI</div>
                                    <div class="bank-number">1234567890</div>
                                    <div class="bank-holder">PT. GO K-POP Indonesia</div>
                                </div>
                                <button class="btn-copy" data-copy="1234567890">Salin</button>
                            </div>
                        @endif
                        <div class="bank-total-row">
                            @if ($order->action_label !== '-')
                                <span>{{ $order->action_label }}</span>
                                <span>Rp{{ number_format($order->current_payment_amount) }}</span>
                            @endif
                        </div>
                    </div>
                    @if ($order->action_label !== '-')
                        <!-- Upload -->
                        <p style="font-size:.875rem;font-weight:600;color:var(--slate-300);margin-bottom:10px">Upload Bukti
                            Transfer</p>
                        <div class="upload-area" id="upload-area-{{ $order->id }}" data-order="{{ $order->id }}">
                            <svg class="upload-area-icon" width="32" height="32" fill="none"
                                stroke="var(--slate-500)" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 8px">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <polyline points="17 8 12 3 7 8" />
                                <line x1="12" y1="3" x2="12" y2="15" />
                            </svg>
                            <p>Drag &amp; drop atau klik untuk pilih file</p>
                            <small>JPG, PNG maks. 5MB</small>
                            <input type="file" class="upload-input hidden" accept="image/*" />
                        </div>
                        <button class="btn btn-accent btn-upload-payment" data-order-id="{{ $order->id }}"
                            style="width:100%;margin-top:12px;padding:12px;border-radius:12px">Kirim Bukti
                            Pembayaran</button>
                    @endif
                </div>
            </div>
        @endforeach


        <!-- ══════════════════════════════════════════
                                     ORD-001 — FASE 1: Menunggu DP 1
                                ═══════════════════════════════════════════ -->
        <div class="order-card">
            <div class="order-card-header">
                <div>
                    <div class="order-meta-id">ORD-001 · 15 Januari 2024 pukul 10.30 WIB</div>
                    <div class="order-meta-title">NCT 127 - ISTJ</div>
                    <div class="order-meta-sub">Varian: Photobook | Qty: 2</div>
                    <div class="order-meta-prio">
                        <span class="prio-tag">Prio 1: Jaehyun</span>
                        <span class="prio-tag">Prio 2: Mark</span>
                        <span class="prio-tag">Prio 3: Taeyong</span>
                    </div>
                </div>
                <div>
                    <div class="order-total-label">Total Estimasi</div>
                    <div class="order-total-val">Rp350.000</div>
                    <span class="badge badge-yellow" style="margin-top:6px;display:inline-flex">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" />
                        </svg>
                        Menunggu DP 1
                    </span>
                </div>
            </div>
            <div class="order-card-body">
                <!-- Cargo -->
                <p style="font-size:.875rem;font-weight:600;color:var(--slate-300);margin-bottom:10px">Status Kargo</p>
                <div class="cargo-tracker" style="margin-bottom:1.5rem">
                    <div class="cargo-step">
                        <div class="cargo-dot"><svg width="12" height="12" fill="none" stroke="#64748b"
                                stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg></div>
                        <div class="cargo-label">Di Korea</div>
                    </div>
                    <div class="cargo-line"></div>
                    <div class="cargo-step">
                        <div class="cargo-dot"><svg width="12" height="12" fill="none" stroke="#64748b"
                                stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg></div>
                        <div class="cargo-label">OTW Indo</div>
                    </div>
                    <div class="cargo-line"></div>
                    <div class="cargo-step">
                        <div class="cargo-dot"><svg width="12" height="12" fill="none" stroke="#64748b"
                                stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg></div>
                        <div class="cargo-label">Tiba Indo</div>
                    </div>
                    <div class="cargo-line"></div>
                    <div class="cargo-step">
                        <div class="cargo-dot"><svg width="12" height="12" fill="none" stroke="#64748b"
                                stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg></div>
                        <div class="cargo-label">Dikirim</div>
                    </div>
                </div>
                <!-- Rincian -->
                <p style="font-size:.875rem;font-weight:600;color:var(--slate-300);margin-bottom:10px">Rincian Biaya</p>
                <div class="fin-grid">
                    <span class="fin-label">Total Estimasi Album</span><span class="fin-val">Rp350.000</span>
                    <span class="fin-label">Kekurangan Tahap Ini</span><span class="fin-val accent">Rp122.500</span>
                    <span class="fin-label">Sisa Harga Album</span><span class="fin-val">Rp227.500</span>
                </div>
                <!-- Bank -->
                <div class="bank-info-box">
                    <div class="bank-info-row">
                        <div>
                            <div class="bank-name">BRI</div>
                            <div class="bank-number">1234567890</div>
                            <div class="bank-holder">PT. GO K-POP Indonesia</div>
                        </div>
                        <button class="btn-copy" data-copy="1234567890">Salin</button>
                    </div>
                    <div class="bank-total-row">
                        <span>Bayar Sekarang (DP 1)</span>
                        <span>Rp122.500</span>
                    </div>
                </div>
                <!-- Upload -->
                <p style="font-size:.875rem;font-weight:600;color:var(--slate-300);margin-bottom:10px">Upload Bukti
                    Transfer
                    - DP 1</p>
                <div class="upload-area" id="upload-area-ord1" data-order="ord1">
                    <svg class="upload-area-icon" width="32" height="32" fill="none"
                        stroke="var(--slate-500)" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 8px">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <polyline points="17 8 12 3 7 8" />
                        <line x1="12" y1="3" x2="12" y2="15" />
                    </svg>
                    <p>Drag &amp; drop atau klik untuk pilih file</p>
                    <small>JPG, PNG maks. 5MB</small>
                    <input type="file" class="upload-input hidden" accept="image/*" />
                </div>
                <button class="btn btn-accent" style="width:100%;margin-top:12px;padding:12px;border-radius:12px">Kirim DP
                    1</button>
            </div>
        </div>

        <!-- ══════════════════════════════════════════
                                     ORD-001-B — FASE 1: Sudah Upload, Menunggu Verifikasi
                                ═══════════════════════════════════════════ -->
        <div class="order-card">
            <div class="order-card-header">
                <div>
                    <div class="order-meta-id">ORD-001-B · 15 Januari 2024 pukul 10.30 WIB</div>
                    <div class="order-meta-title">NCT 127 - ISTJ</div>
                    <div class="order-meta-sub">Varian: Photobook | Qty: 2</div>
                    <div class="order-meta-prio">
                        <span class="prio-tag">Prio 1: Jaehyun</span>
                        <span class="prio-tag">Prio 2: Mark</span>
                        <span class="prio-tag">Prio 3: Taeyong</span>
                    </div>
                </div>
                <div>
                    <div class="order-total-label">Total Estimasi</div>
                    <div class="order-total-val">Rp350.000</div>
                    <span class="badge badge-yellow" style="margin-top:6px;display:inline-flex">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" />
                        </svg>
                        Menunggu DP 1
                    </span>
                </div>
            </div>
            <div class="order-card-body">
                <div class="fin-grid" style="margin-bottom:1.25rem">
                    <span class="fin-label">Total Estimasi Album</span><span class="fin-val">Rp350.000</span>
                    <span class="fin-label">Kekurangan Tahap Ini</span><span class="fin-val accent">Rp122.500</span>
                </div>
                <!-- Waiting verification -->
                <div
                    style="display:flex;align-items:flex-start;gap:12px;padding:1rem;border-radius:12px;background:rgba(250,204,21,.08);border:1px solid rgba(250,204,21,.25)">
                    <svg width="20" height="20" fill="none" stroke="#facc15" stroke-width="2"
                        viewBox="0 0 24 24" style="flex-shrink:0;margin-top:2px;animation:pulseGreen 2s infinite">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>
                    <p style="font-size:.875rem;color:#facc15;line-height:1.6">⏳ Bukti transfer telah berhasil diunggah.
                        Menunggu proses verifikasi dan konfirmasi oleh Admin. Silakan cek berkala.</p>
                </div>
            </div>
        </div>

        <!-- ══════════════════════════════════════════
                                     ORD-001-C — FASE 1: Pembayaran Ditolak
                                ═══════════════════════════════════════════ -->
        <div class="order-card">
            <div class="order-card-header">
                <div>
                    <div class="order-meta-id">ORD-001-C · 15 Januari 2024 pukul 10.30 WIB</div>
                    <div class="order-meta-title">NCT 127 - ISTJ</div>
                    <div class="order-meta-sub">Varian: Photobook | Qty: 2</div>
                    <div class="order-meta-prio">
                        <span class="prio-tag">Prio 1: Jaehyun</span>
                        <span class="prio-tag">Prio 2: Mark</span>
                        <span class="prio-tag">Prio 3: Taeyong</span>
                    </div>
                </div>
                <div>
                    <div class="order-total-label">Total Estimasi</div>
                    <div class="order-total-val">Rp350.000</div>
                    <span class="badge badge-accent" style="margin-top:6px;display:inline-flex">Menunggu DP 1</span>
                </div>
            </div>
            <div class="order-card-body">
                <div class="fin-grid" style="margin-bottom:1.25rem">
                    <span class="fin-label">Total Estimasi Album</span><span class="fin-val">Rp350.000</span>
                    <span class="fin-label">Kekurangan Tahap Ini</span><span class="fin-val accent">Rp122.500</span>
                </div>
                <!-- Rejection notice -->
                <div class="rejection-box">
                    <svg width="20" height="20" fill="none" stroke="var(--accent-300)" stroke-width="2"
                        viewBox="0 0 24 24" style="flex-shrink:0;margin-top:2px">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="15" y1="9" x2="9" y2="15" />
                        <line x1="9" y1="9" x2="15" y2="15" />
                    </svg>
                    <p><strong>❌ Pembayaran Ditolak!</strong> Alasan Admin: Bukti transfer tidak jelas/terpotong. Mohon
                        unggah ulang foto resi yang menampilkan mutasi rekening secara penuh.</p>
                </div>
                <div class="bank-info-box">
                    <div class="bank-info-row">
                        <div>
                            <div class="bank-name">BRI</div>
                            <div class="bank-number">1234567890</div>
                            <div class="bank-holder">PT. GO K-POP Indonesia</div>
                        </div>
                        <button class="btn-copy" data-copy="1234567890">Salin</button>
                    </div>
                    <div class="bank-total-row"><span>Bayar Sekarang (DP 1)</span><span>Rp122.500</span></div>
                </div>
                <div class="upload-area" id="upload-area-ord1c" data-order="ord1c">
                    <svg width="32" height="32" fill="none" stroke="var(--slate-500)" stroke-width="1.5"
                        viewBox="0 0 24 24" style="margin:0 auto 8px">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <polyline points="17 8 12 3 7 8" />
                        <line x1="12" y1="3" x2="12" y2="15" />
                    </svg>
                    <p>Drag &amp; drop atau klik untuk pilih file</p>
                    <small>JPG, PNG maks. 5MB</small>
                    <input type="file" class="upload-input hidden" accept="image/*" />
                </div>
                <button class="btn btn-accent" style="width:100%;margin-top:12px;padding:12px;border-radius:12px">Kirim
                    Ulang Bukti Transfer</button>
            </div>
        </div>

        <!-- ══════════════════════════════════════════
                                     ORD-002 — FASE 2: Menunggu DP 2
                                ═══════════════════════════════════════════ -->
        <div class="order-card">
            <div class="order-card-header">
                <div>
                    <div class="order-meta-id">ORD-002 · 16 Januari 2024 pukul 08.15 WIB</div>
                    <div class="order-meta-title">SEVENTEEN - FML</div>
                    <div class="order-meta-sub">Varian: Carat Ver. | Qty: 1</div>
                    <div class="order-meta-prio">
                        <span class="prio-tag">Prio 1: Mingyu</span>
                        <span class="prio-tag">Prio 2: Wonwoo</span>
                        <span class="prio-tag">Prio 3: Hoshi</span>
                    </div>
                </div>
                <div>
                    <div class="order-total-label">Total Estimasi</div>
                    <div class="order-total-val">Rp350.000</div>
                    <span class="badge badge-yellow" style="margin-top:6px;display:inline-flex">Menunggu DP 2</span>
                </div>
            </div>
            <div class="order-card-body">
                <div class="cargo-tracker" style="margin-bottom:1.5rem">
                    <div class="cargo-step">
                        <div class="cargo-dot active"><svg width="12" height="12" fill="none" stroke="#fff"
                                stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg></div>
                        <div class="cargo-label" style="color:var(--accent-400)">Di Korea</div>
                    </div>
                    <div class="cargo-line"></div>
                    <div class="cargo-step">
                        <div class="cargo-dot"><svg width="12" height="12" fill="none" stroke="#64748b"
                                stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg></div>
                        <div class="cargo-label">OTW Indo</div>
                    </div>
                    <div class="cargo-line"></div>
                    <div class="cargo-step">
                        <div class="cargo-dot"><svg width="12" height="12" fill="none" stroke="#64748b"
                                stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg></div>
                        <div class="cargo-label">Tiba Indo</div>
                    </div>
                    <div class="cargo-line"></div>
                    <div class="cargo-step">
                        <div class="cargo-dot"><svg width="12" height="12" fill="none" stroke="#64748b"
                                stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg></div>
                        <div class="cargo-label">Dikirim</div>
                    </div>
                </div>
                <div class="fin-grid" style="margin-bottom:1.25rem">
                    <span class="fin-label">Total Estimasi Album</span><span class="fin-val">Rp350.000</span>
                    <span class="fin-label">Sudah Dibayar</span><span class="fin-val neon">Rp50.000</span>
                    <span class="fin-label">Kekurangan Tahap Ini</span><span class="fin-val accent">Rp100.000</span>
                    <span class="fin-label">Sisa Harga Album</span><span class="fin-val">Rp200.000</span>
                </div>
                <div class="bank-info-box">
                    <div class="bank-info-row">
                        <div>
                            <div class="bank-name">BRI</div>
                            <div class="bank-number">1234567890</div>
                            <div class="bank-holder">PT. GO K-POP Indonesia</div>
                        </div>
                        <button class="btn-copy" data-copy="1234567890">Salin</button>
                    </div>
                    <div class="bank-total-row"><span>Bayar Sekarang (DP 2)</span><span>Rp100.000</span></div>
                </div>
                <div class="upload-area" id="upload-area-ord2" data-order="ord2">
                    <svg width="32" height="32" fill="none" stroke="var(--slate-500)" stroke-width="1.5"
                        viewBox="0 0 24 24" style="margin:0 auto 8px">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <polyline points="17 8 12 3 7 8" />
                        <line x1="12" y1="3" x2="12" y2="15" />
                    </svg>
                    <p>Drag &amp; drop atau klik untuk pilih file</p>
                    <small>JPG, PNG maks. 5MB</small>
                    <input type="file" class="upload-input hidden" accept="image/*" />
                </div>
                <button class="btn btn-accent" style="width:100%;margin-top:12px;padding:12px;border-radius:12px">Kirim DP
                    2</button>
            </div>
        </div>

        <!-- ══════════════════════════════════════════
                                     ORD-003 — FASE 3: Menunggu Kedatangan
                                ═══════════════════════════════════════════ -->
        <div class="order-card">
            <div class="order-card-header">
                <div>
                    <div class="order-meta-id">ORD-003 · 10 Januari 2024 pukul 07.00 WIB</div>
                    <div class="order-meta-title">aespa - MY WORLD</div>
                    <div class="order-meta-sub">Varian: Smini | Qty: 1</div>
                    <div class="order-meta-prio">
                        <span class="prio-tag">Prio 1: Winter</span>
                        <span class="prio-tag">Prio 2: Karina</span>
                        <span class="prio-tag">Prio 3: Ningning</span>
                    </div>
                </div>
                <div>
                    <div class="order-total-label">Total Estimasi</div>
                    <div class="order-total-val">Rp350.000</div>
                    <span class="badge badge-blue" style="margin-top:6px;display:inline-flex">DP 2 Lunas / Menunggu
                        Tiba</span>
                </div>
            </div>
            <div class="order-card-body">
                <div class="cargo-tracker" style="margin-bottom:1.5rem">
                    <div class="cargo-step">
                        <div class="cargo-dot done"><svg width="12" height="12" fill="none" stroke="#fff"
                                stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg></div>
                        <div class="cargo-label" style="color:var(--neon-400)">Di Korea</div>
                    </div>
                    <div class="cargo-line done"></div>
                    <div class="cargo-step">
                        <div class="cargo-dot active"><svg width="12" height="12" fill="none" stroke="#fff"
                                stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg></div>
                        <div class="cargo-label" style="color:var(--accent-400)">OTW Indo</div>
                    </div>
                    <div class="cargo-line"></div>
                    <div class="cargo-step">
                        <div class="cargo-dot"><svg width="12" height="12" fill="none" stroke="#64748b"
                                stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg></div>
                        <div class="cargo-label">Tiba Indo</div>
                    </div>
                    <div class="cargo-line"></div>
                    <div class="cargo-step">
                        <div class="cargo-dot"><svg width="12" height="12" fill="none" stroke="#64748b"
                                stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg></div>
                        <div class="cargo-label">Dikirim</div>
                    </div>
                </div>
                <div class="fin-grid" style="margin-bottom:1.25rem">
                    <span class="fin-label">Total Estimasi Album</span><span class="fin-val">Rp350.000</span>
                    <span class="fin-label">Sudah Dibayar</span><span class="fin-val neon">Rp150.000</span>
                    <span class="fin-label">Sisa Harga Album</span><span class="fin-val">Rp200.000</span>
                </div>
                <div class="info-box">
                    <svg width="20" height="20" fill="none" stroke="var(--sky-400)" stroke-width="2"
                        viewBox="0 0 24 24" style="flex-shrink:0">
                        <path d="M20 7H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
                    </svg>
                    <p>Paket sedang dalam perjalanan laut/udara. Menu pengisian alamat dan pelunasan ongkir lokal akan
                        otomatis terbuka di sini begitu barang tiba di gudang Indonesia.</p>
                </div>
            </div>
        </div>

        <!-- ══════════════════════════════════════════
                                     ORD-004 — FASE 4: Menunggu Pelunasan
                                ═══════════════════════════════════════════ -->
        <div class="order-card">
            <div class="order-card-header">
                <div>
                    <div class="order-meta-id">ORD-004 · 8 Januari 2024 pukul 06.00 WIB</div>
                    <div class="order-meta-title">Stray Kids - 5-STAR</div>
                    <div class="order-meta-sub">Varian: Photobook A | Qty: 1</div>
                    <div class="order-meta-prio">
                        <span class="prio-tag">Prio 1: Felix</span>
                        <span class="prio-tag">Prio 2: Hyunjin</span>
                        <span class="prio-tag">Prio 3: Han</span>
                    </div>
                </div>
                <div>
                    <div class="order-total-label">Total Estimasi</div>
                    <div class="order-total-val">Rp350.000</div>
                    <span class="badge badge-yellow" style="margin-top:6px;display:inline-flex">Menunggu Pelunasan</span>
                </div>
            </div>
            <div class="order-card-body">
                <div class="cargo-tracker" style="margin-bottom:1.5rem">
                    <div class="cargo-step">
                        <div class="cargo-dot done"><svg width="12" height="12" fill="none" stroke="#fff"
                                stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg></div>
                        <div class="cargo-label" style="color:var(--neon-400)">Di Korea</div>
                    </div>
                    <div class="cargo-line done"></div>
                    <div class="cargo-step">
                        <div class="cargo-dot done"><svg width="12" height="12" fill="none" stroke="#fff"
                                stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg></div>
                        <div class="cargo-label" style="color:var(--neon-400)">OTW Indo</div>
                    </div>
                    <div class="cargo-line done"></div>
                    <div class="cargo-step">
                        <div class="cargo-dot active" style="animation:pulse 2s infinite"><svg width="12"
                                height="12" fill="none" stroke="#fff" stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg></div>
                        <div class="cargo-label" style="color:var(--gold-400)">Tiba Indo</div>
                    </div>
                    <div class="cargo-line"></div>
                    <div class="cargo-step">
                        <div class="cargo-dot"><svg width="12" height="12" fill="none" stroke="#64748b"
                                stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg></div>
                        <div class="cargo-label">Dikirim</div>
                    </div>
                </div>
                <div class="fin-grid" style="margin-bottom:1.25rem">
                    <span class="fin-label">Total Estimasi Album</span><span class="fin-val">Rp350.000</span>
                    <span class="fin-label">Sudah Dibayar</span><span class="fin-val neon">Rp150.000</span>
                    <span class="fin-label">Kekurangan Tahap Ini</span><span class="fin-val accent">Rp200.000</span>
                    <span class="fin-label">Ongkir Kurir Lokal (J&T)</span><span class="fin-val">Rp20.000</span>
                    <span class="fin-label" style="font-weight:600;color:#fff">Total Pelunasan Akhir</span><span
                        class="fin-val accent" style="font-size:1.125rem">Rp220.000</span>
                </div>
                <!-- Alamat -->
                <div class="form-group">
                    <label class="form-label">Alamat Lengkap Pengiriman</label>
                    <textarea class="form-textarea" rows="3" placeholder="Masukkan alamat lengkap tujuan pengiriman..."></textarea>
                </div>
                <!-- Kurir -->
                <div class="form-group">
                    <label class="form-label">Pilihan Kurir</label>
                    <div class="select-wrap">
                        <select class="form-select" id="kurir-ord4">
                            <option value="">Pilih kurir</option>
                            <option value="jnt" selected>J&amp;T — Rp20.000</option>
                            <option value="jne">JNE — Rp25.000</option>
                            <option value="sicepat">SiCepat — Rp18.000</option>
                        </select>
                        <svg class="select-arrow" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </div>
                </div>
                <!-- Bank -->
                <div class="bank-info-box">
                    <div class="bank-info-row">
                        <div>
                            <div class="bank-name">BRI</div>
                            <div class="bank-number">1234567890</div>
                            <div class="bank-holder">PT. GO K-POP Indonesia</div>
                        </div>
                        <button class="btn-copy" data-copy="1234567890">Salin</button>
                    </div>
                    <div class="bank-total-row"><span>Total Pelunasan</span><span>Rp220.000</span></div>
                </div>
                <div class="upload-area" id="upload-area-ord4" data-order="ord4">
                    <svg width="32" height="32" fill="none" stroke="var(--slate-500)" stroke-width="1.5"
                        viewBox="0 0 24 24" style="margin:0 auto 8px">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <polyline points="17 8 12 3 7 8" />
                        <line x1="12" y1="3" x2="12" y2="15" />
                    </svg>
                    <p>Drag &amp; drop atau klik untuk pilih file</p>
                    <small>JPG, PNG maks. 5MB</small>
                    <input type="file" class="upload-input hidden" accept="image/*" />
                </div>
                <button class="btn btn-accent" style="width:100%;margin-top:12px;padding:12px;border-radius:12px">Kirim
                    Pelunasan</button>
            </div>
        </div>

        <!-- ══════════════════════════════════════════
                                     ORD-005 — FASE 5: Shipped / Selesai
                                ═══════════════════════════════════════════ -->
        <div class="order-card">
            <div class="order-card-header">
                <div>
                    <div class="order-meta-id">ORD-005 · 5 Januari 2024 pukul 05.00 WIB</div>
                    <div class="order-meta-title">NewJeans - Get Up</div>
                    <div class="order-meta-sub">Varian: Bag Ver. | Qty: 1</div>
                    <div class="order-meta-prio">
                        <span class="prio-tag">Prio 1: Minji</span>
                        <span class="prio-tag">Prio 2: Hanni</span>
                        <span class="prio-tag">Prio 3: Danielle</span>
                    </div>
                </div>
                <div>
                    <div class="order-total-label">Total Estimasi</div>
                    <div class="order-total-val">Rp350.000</div>
                    <span class="badge badge-green" style="margin-top:6px;display:inline-flex">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                        Shipped / Paket Dikirim
                    </span>
                </div>
            </div>
            <div class="order-card-body">
                <div class="cargo-tracker" style="margin-bottom:1.5rem">
                    <div class="cargo-step">
                        <div class="cargo-dot done"><svg width="12" height="12" fill="none" stroke="#fff"
                                stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg></div>
                        <div class="cargo-label" style="color:var(--neon-400)">Di Korea</div>
                    </div>
                    <div class="cargo-line done"></div>
                    <div class="cargo-step">
                        <div class="cargo-dot done"><svg width="12" height="12" fill="none" stroke="#fff"
                                stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg></div>
                        <div class="cargo-label" style="color:var(--neon-400)">OTW Indo</div>
                    </div>
                    <div class="cargo-line done"></div>
                    <div class="cargo-step">
                        <div class="cargo-dot done"><svg width="12" height="12" fill="none" stroke="#fff"
                                stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg></div>
                        <div class="cargo-label" style="color:var(--neon-400)">Tiba Indo</div>
                    </div>
                    <div class="cargo-line done"></div>
                    <div class="cargo-step">
                        <div class="cargo-dot done"><svg width="12" height="12" fill="none" stroke="#fff"
                                stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg></div>
                        <div class="cargo-label" style="color:var(--neon-400)">Dikirim</div>
                    </div>
                </div>
                <div class="fin-grid" style="margin-bottom:1.25rem">
                    <span class="fin-label">Total Estimasi Album</span><span class="fin-val">Rp350.000</span>
                    <span class="fin-label">Sudah Dibayar</span><span class="fin-val neon">Rp350.000</span>
                    <span class="fin-label">Sisa Kekurangan</span><span class="fin-val neon">Rp0 (LUNAS TOTAL)</span>
                </div>
                <!-- Verified badge -->
                <div class="verified-badge">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                    Pembayaran Lunas &amp; Terverifikasi
                </div>
                <!-- Alamat readonly -->
                <div class="form-group">
                    <label class="form-label" style="color:var(--slate-500)">Alamat Pengiriman</label>
                    <div class="readonly-field">Jl. Sudirman No. 45, RT 03/RW 05, Kel. Menteng, Jakarta Pusat 10310</div>
                </div>
                <!-- Kurir readonly -->
                <div class="form-group">
                    <label class="form-label" style="color:var(--slate-500)">Kurir</label>
                    <div class="readonly-field">J&amp;T</div>
                </div>
                <!-- Tracking -->
                <div class="tracking-box">
                    <div>
                        <div class="tracking-label">Nomor Resi Resmi (J&amp;T)</div>
                        <div class="tracking-number">JNT1234567890</div>
                    </div>
                    <button class="btn-copy" data-copy="JNT1234567890">Salin Resi</button>
                </div>
            </div>
        </div>

    </div><!-- /container -->
@endsection

@section('js_custom')
    <script src="{{ asset('asset/js/dashboard.js') }}"></script>
@endsection
