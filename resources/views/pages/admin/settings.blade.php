@extends('layout.admin')

@section('title', 'Pengaturan — GO K-POP Admin')

@section('breadcrumb', 'Pengaturan')

@section('admin_content')
    <!-- Admin Profile Header -->
    <div class="admin-profile-header">
        <div class="admin-avatar">
            <svg width="40" height="40" fill="none" stroke="#0a0a0f" stroke-width="2" viewBox="0 0 24 24">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
            </svg>
        </div>
        <div>
            <div class="admin-profile-name">Admin Utama</div>
            <div class="admin-profile-email">admin@gokpop.com</div>
            <span class="super-admin-badge">
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                    <polyline points="12 6 12 12 16 14" />
                </svg>
                Super Admin
            </span>
        </div>
    </div>

    <!-- Tab Bar -->
    <div class="settings-tab-bar">
        <button class="settings-tab active" data-tab="rekening">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <line x1="3" y1="22" x2="21" y2="22" />
                <line x1="6" y1="18" x2="6" y2="11" />
                <line x1="10" y1="18" x2="10" y2="11" />
                <line x1="14" y1="18" x2="14" y2="11" />
                <line x1="18" y1="18" x2="18" y2="11" />
                <polygon points="12 2 20 7 4 7" />
            </svg>
            Rekening Toko
        </button>
        <button class="settings-tab" data-tab="kontak">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path
                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.36 11a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.11 0h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
            </svg>
            Kontak Bantuan
        </button>
        <button class="settings-tab" data-tab="keamanan">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <rect x="3" y="11" width="18" height="11" rx="2" />
                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
            </svg>
            Keamanan
        </button>
    </div>

    <!-- ═══ TAB 1: REKENING TOKO ═══ -->
    <div class="settings-panel active" id="panel-rekening">
        <div class="admin-card">
            <div class="settings-section-title">
                <svg width="20" height="20" fill="none" stroke="var(--accent-400)" stroke-width="2"
                    viewBox="0 0 24 24">
                    <line x1="3" y1="22" x2="21" y2="22" />
                    <line x1="6" y1="18" x2="6" y2="11" />
                    <line x1="10" y1="18" x2="10" y2="11" />
                    <line x1="14" y1="18" x2="14" y2="11" />
                    <line x1="18" y1="18" x2="18" y2="11" />
                    <polygon points="12 2 20 7 4 7" />
                </svg>
                Pengaturan Rekening Toko
            </div>
            <p class="settings-section-sub">Data rekening ini akan ditampilkan dalam instruksi pembayaran untuk pembeli</p>

            <div class="form-group">
                <label class="form-label" for="bank-name">Pilihan Bank / E-Wallet</label>
                <div class="select-wrap">
                    <select class="form-select" id="bank-name">
                        <option value="BRI (Bank Rakyat Indonesia)" selected>🏦 BRI (Bank Rakyat Indonesia)</option>
                        <option value="BCA (Bank Central Asia)">🏦 BCA (Bank Central Asia)</option>
                        <option value="Mandiri">🏦 Mandiri</option>
                        <option value="BNI">🏦 BNI</option>
                        <option value="DANA">📱 DANA</option>
                        <option value="GoPay">📱 GoPay</option>
                        <option value="OVO">📱 OVO</option>
                    </select>
                    <svg class="select-arrow" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <polyline points="6 9 12 15 18 9" />
                    </svg>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="bank-number">Nomor Rekening / No. Akun</label>
                <input type="text" class="form-input no-icon" id="bank-number" value="1234567890"
                    placeholder="Nomor rekening" />
            </div>

            <div class="form-group">
                <label class="form-label" for="bank-holder">Atas Nama Rekening</label>
                <input type="text" class="form-input no-icon" id="bank-holder" value="PT. GO K-POP Indonesia"
                    placeholder="Nama pemilik rekening" />
            </div>

            <!-- Preview -->
            <div class="payment-preview-box">
                <p class="payment-preview-label">Preview Instruksi Pembayaran:</p>
                <p class="preview-bank-name" id="preview-bank-name">BRI (Bank Rakyat Indonesia)</p>
                <p class="preview-bank-number">Nomor: <span id="preview-bank-number">1234567890</span></p>
                <p class="preview-bank-holder">Atas Nama: <span id="preview-bank-holder">PT. GO K-POP Indonesia</span></p>
            </div>

            <button class="btn btn-accent" style="padding:12px 24px;border-radius:12px" id="btn-save-rekening">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                    <polyline points="17 21 17 13 7 13 7 21" />
                    <polyline points="7 3 7 8 15 8" />
                </svg>
                Simpan Rekening
            </button>
        </div>
    </div>

    <!-- ═══ TAB 2: KONTAK BANTUAN ═══ -->
    <div class="settings-panel" id="panel-kontak">
        <div class="admin-card">
            <div class="settings-section-title">
                <svg width="20" height="20" fill="none" stroke="var(--neon-400)" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path
                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.36 11a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.11 0h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                </svg>
                Kontak Bantuan
            </div>
            <p class="settings-section-sub">Nomor WhatsApp ini akan ditampilkan untuk pembeli yang butuh bantuan</p>

            <div class="form-group">
                <label class="form-label" for="wa-number">Nomor WhatsApp Admin</label>
                <input type="tel" class="form-input no-icon" id="wa-number" value="081234567890"
                    placeholder="Contoh: 081234567890" />
                <p style="font-size:.75rem;color:var(--slate-500);margin-top:6px">Format: Gunakan kode negara (62 untuk
                    Indonesia)</p>
            </div>

            <!-- Preview WA button -->
            <div style="margin-bottom:1.5rem">
                <p style="font-size:.75rem;color:var(--slate-500);margin-bottom:10px">Preview di Landing Page:</p>
                <div class="wa-preview-btn" id="wa-preview-btn">
                    <span class="wa-preview-dot"></span>
                    Hubungi via WhatsApp: <span id="wa-preview-number">081234567890</span>
                </div>
            </div>

            <button class="btn btn-accent" style="padding:12px 24px;border-radius:12px" id="btn-save-kontak">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                    <polyline points="17 21 17 13 7 13 7 21" />
                    <polyline points="7 3 7 8 15 8" />
                </svg>
                Simpan Kontak
            </button>
        </div>
    </div>

    <!-- ═══ TAB 3: KEAMANAN ═══ -->
    <div class="settings-panel" id="panel-keamanan">
        <div class="admin-card">
            <div class="settings-section-title">
                <svg width="20" height="20" fill="none" stroke="var(--accent-400)" stroke-width="2"
                    viewBox="0 0 24 24">
                    <rect x="3" y="11" width="18" height="11" rx="2" />
                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                </svg>
                Keamanan &amp; Akses
            </div>
            <p class="settings-section-sub" style="margin-bottom:1.5rem">Ubah password akun admin</p>

            <div class="form-group">
                <label class="form-label" for="admin-pw-lama">Password Lama</label>
                <div class="input-wrap">
                    <input type="password" class="form-input" id="admin-pw-lama" placeholder="Masukkan password lama"
                        style="padding-left:16px" />
                    <button type="button" class="input-eye admin-pw-toggle" data-target="admin-pw-lama">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="admin-pw-baru">Password Baru</label>
                <div class="input-wrap">
                    <input type="password" class="form-input" id="admin-pw-baru" placeholder="Masukkan password baru"
                        style="padding-left:16px" />
                    <button type="button" class="input-eye admin-pw-toggle" data-target="admin-pw-baru">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </button>
                </div>
            </div>

            <button class="btn btn-ghost"
                style="width:100%;padding:12px;border-radius:12px;justify-content:center;margin-bottom:1.5rem"
                id="btn-change-admin-pw">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <rect x="3" y="11" width="18" height="11" rx="2" />
                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                </svg>
                Ubah Password
            </button>

            <!-- Divider -->
            <div style="height:1px;background:rgba(255,255,255,.07);margin-bottom:1.5rem"></div>

            <!-- Logout Admin -->
            <button class="btn btn-danger" style="width:100%;padding:12px;border-radius:12px;justify-content:center"
                id="btn-logout-admin">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <polyline points="16 17 21 12 16 7" />
                    <line x1="21" y1="12" x2="9" y2="12" />
                </svg>
                Logout Admin
            </button>
        </div>
    </div>
@endsection

@section('js_custom')
    <script src="{{ asset('asset/js/admin-settings.js') }}"></script>
@endsection
