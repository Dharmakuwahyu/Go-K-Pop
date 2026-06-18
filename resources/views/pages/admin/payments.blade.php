@extends('layout.admin')

@section('title', 'Pembayaran — GO K-POP Admin')

@section('admin_content')
    <h1 class="admin-panel-title">Verifikasi Pembayaran</h1>
    <p class="admin-panel-sub">Periksa bukti transfer dari pembeli</p>

    <div id="payment-list">

        <!-- PAY-001 -->
        <div class="payment-card" id="pay-001">
            <div class="payment-proof"
                data-img="https://images.pexels.com/photos/4386466/pexels-photo-4386466.jpeg?auto=compress&cs=tinysrgb&w=400">
                <img src="https://images.pexels.com/photos/4386466/pexels-photo-4386466.jpeg?auto=compress&cs=tinysrgb&w=200"
                    alt="Bukti PAY-001">
            </div>
            <div class="payment-info">
                <div class="payment-id">PAY-001 <span class="badge badge-yellow" style="margin-left:6px"><svg width="10"
                            height="10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" />
                        </svg> Menunggu</span></div>
                <div class="payment-buyer">Rina Aulia</div>
                <div class="payment-album">NCT 127 - ISTJ - DP 1</div>
                <div class="payment-amount">Rp50.000</div>
                <div class="payment-date">Diupload pada: 15 Januari 2024 pukul 11.00 WIB</div>
            </div>
            <div class="payment-actions">
                <button class="btn-view-proof"
                    data-img="https://images.pexels.com/photos/4386466/pexels-photo-4386466.jpeg?auto=compress&cs=tinysrgb&w=800">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                    Lihat Resi
                </button>
                <button class="btn-approve" data-pay-id="pay-001"><svg width="14" height="14" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12" />
                    </svg> Approve</button>
                <button class="btn-reject" data-pay-id="pay-001"><svg width="14" height="14" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg> Reject</button>
            </div>
        </div>

        <!-- PAY-002 -->
        <div class="payment-card" id="pay-002">
            <div class="payment-proof"
                data-img="https://images.pexels.com/photos/4386466/pexels-photo-4386466.jpeg?auto=compress&cs=tinysrgb&w=400">
                <img src="https://images.pexels.com/photos/4386466/pexels-photo-4386466.jpeg?auto=compress&cs=tinysrgb&w=200"
                    alt="Bukti PAY-002">
            </div>
            <div class="payment-info">
                <div class="payment-id">PAY-002 <span class="badge badge-yellow" style="margin-left:6px"><svg width="10"
                            height="10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" />
                        </svg> Menunggu</span></div>
                <div class="payment-buyer">Dinda Putri</div>
                <div class="payment-album">SEVENTEEN - FML - DP 2</div>
                <div class="payment-amount">Rp100.000</div>
                <div class="payment-date">Diupload pada: 16 Januari 2024 pukul 09.30 WIB</div>
            </div>
            <div class="payment-actions">
                <button class="btn-view-proof"
                    data-img="https://images.pexels.com/photos/4386466/pexels-photo-4386466.jpeg?auto=compress&cs=tinysrgb&w=800">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                    Lihat Resi
                </button>
                <button class="btn-approve" data-pay-id="pay-002"><svg width="14" height="14" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12" />
                    </svg> Approve</button>
                <button class="btn-reject" data-pay-id="pay-002"><svg width="14" height="14" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg> Reject</button>
            </div>
        </div>

        <!-- PAY-003 -->
        <div class="payment-card" id="pay-003">
            <div class="payment-proof"
                data-img="https://images.pexels.com/photos/4386466/pexels-photo-4386466.jpeg?auto=compress&cs=tinysrgb&w=400">
                <img src="https://images.pexels.com/photos/4386466/pexels-photo-4386466.jpeg?auto=compress&cs=tinysrgb&w=200"
                    alt="Bukti PAY-003">
            </div>
            <div class="payment-info">
                <div class="payment-id">PAY-003 <span class="badge badge-yellow" style="margin-left:6px"><svg
                            width="10" height="10" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" />
                        </svg> Menunggu</span></div>
                <div class="payment-buyer">Sari Dewi</div>
                <div class="payment-album">Stray Kids - 5-STAR - Pelunasan</div>
                <div class="payment-amount">Rp220.000</div>
                <div class="payment-date">Diupload pada: 10 Januari 2024 pukul 08.00 WIB</div>
            </div>
            <div class="payment-actions">
                <button class="btn-view-proof"
                    data-img="https://images.pexels.com/photos/4386466/pexels-photo-4386466.jpeg?auto=compress&cs=tinysrgb&w=800">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                    Lihat Resi
                </button>
                <button class="btn-approve" data-pay-id="pay-003"><svg width="14" height="14" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12" />
                    </svg> Approve</button>
                <button class="btn-reject" data-pay-id="pay-003"><svg width="14" height="14" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg> Reject</button>
            </div>
        </div>

    </div><!-- /#payment-list -->
@endsection


@section('admin_content_custom')
    <!-- Image Viewer Modal -->
    <div class="img-viewer-overlay" id="img-viewer">
        <img src="" alt="Bukti Transfer" id="img-viewer-src" />
    </div>

    <!-- Reject Modal -->
    <div class="modal-overlay" id="reject-modal">
        <div class="modal-box" style="max-width:440px">
            <button class="modal-close" id="reject-close"><svg width="20" height="20" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg></button>
            <h2 class="modal-title">Tolak Pembayaran</h2>
            <p class="modal-sub">Berikan alasan penolakan agar pembeli bisa upload ulang dengan benar.</p>
            <input type="hidden" id="reject-pay-id" />
            <div class="form-group">
                <label class="form-label" for="reject-reason">Alasan Penolakan</label>
                <textarea class="form-textarea" id="reject-reason" rows="4"
                    placeholder="Contoh: Bukti transfer tidak jelas/terpotong. Mohon upload foto mutasi rekening yang lengkap."></textarea>
            </div>
            <div style="display:flex;gap:12px">
                <button class="btn btn-ghost" style="flex:1;padding:12px;border-radius:12px;justify-content:center"
                    id="btn-reject-cancel">
                    Batal
                </button>
                <button class="btn btn-accent" style="flex:1;padding:12px;border-radius:12px" id="btn-reject-confirm">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                    Kirim Penolakan
                </button>
            </div>
        </div>
    </div>
@endsection

@section('js_custom')
    <script src="{{ asset('asset/js/admin-payments.js') }}"></script>
@endsection
