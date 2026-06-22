@extends('layout.member')

@section('title', 'Akun Saya — GO K-POP')

@section('member_content')
    <div class="container" style="max-width:768px">

        <!-- Profile header -->
        <div class="profile-header">
            <div class="profile-avatar">
                <svg width="48" height="48" fill="none" stroke="#0a0a0f" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </div>
            <div>
                <h1 class="profile-name" id="profile-display-name">Rina Aulia</h1>
                <div class="profile-email">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    rinalaulia@email.com
                </div>
                <span class="profile-role">Standard Member</span>
            </div>
        </div>

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-card-label">Total Pesanan</div>
                <div class="stat-card-num" style="color:#fff">7</div>
            </div>
            <div class="stat-card">
                <div class="stat-card-label">Pesanan Aktif</div>
                <div class="stat-card-num" style="color:var(--accent-400)">6</div>
            </div>
            <div class="stat-card">
                <div class="stat-card-label">Pesanan Selesai</div>
                <div class="stat-card-num" style="color:var(--neon-400)">1</div>
            </div>
        </div>

        <!-- Data Diri -->
        <div class="form-card">
            <h2>Data Diri</h2>
            <div class="form-group">
                <label class="form-label" for="input-name">Nama Lengkap</label>
                <input type="text" class="form-input no-icon" id="input-name" value="Rina Aulia" />
            </div>
            <div class="form-group">
                <label class="form-label" for="input-wa">Nomor WhatsApp</label>
                <input type="tel" class="form-input no-icon" id="input-wa" value="081234567890" />
            </div>
            <div class="form-group">
                <label class="form-label" for="input-address">Alamat Utama Rumah</label>
                <textarea class="form-textarea" id="input-address" rows="3">Jl. Sudirman No. 45, RT 03/RW 05, Kel. Menteng, Kec. Menteng, Jakarta Pusat 10310</textarea>
            </div>
            <button class="btn" style="padding:12px 24px;border-radius:12px;background:linear-gradient(to right,var(--accent-500),var(--accent-400));color:#fff;border:none;box-shadow:0 4px 20px rgba(225,29,72,.3)" id="btn-save-profile">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Simpan Perubahan
            </button>
            <div class="save-success" id="save-success">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                Perubahan berhasil disimpan!
            </div>
        </div>

        <!-- Keamanan -->
        <div class="form-card">
            <h2>Keamanan &amp; Akses</h2>
            <div class="form-group">
                <label class="form-label" for="pw-lama">Password Lama</label>
                <div class="input-wrap">
                    <input type="password" class="form-input" id="pw-lama" placeholder="Masukkan password lama" style="padding-left:16px" />
                    <button type="button" class="input-eye pw-toggle" data-target="pw-lama">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="pw-baru">Password Baru</label>
                <div class="input-wrap">
                    <input type="password" class="form-input" id="pw-baru" placeholder="Masukkan password baru" style="padding-left:16px" />
                    <button type="button" class="input-eye pw-toggle" data-target="pw-baru">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
            </div>
            <button class="btn btn-ghost" style="width:100%;padding:12px;border-radius:12px;justify-content:center" id="btn-change-pw">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                Ubah Password
            </button>
        </div>

        <!-- Keluar -->
        <button class="btn-logout-danger" id="btn-logout" style="transition:all .2s">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" class="logout-icon" style="transition:transform .2s"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
            Keluar Akun
        </button>

    </div>
@endsection

@section('js_custom')
<script src="{{ asset('asset/js/profile.js') }}"></script>
@endsection
