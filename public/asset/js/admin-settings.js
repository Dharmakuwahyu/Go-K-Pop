/**
 * GO K-POP — js/admin-settings.js
 * Interaksi halaman Pengaturan Admin:
 * - 3 tabs (Rekening, Kontak, Keamanan)
 * - Preview live rekening & WA
 * - Toggle show/hide password
 * - Simpan & logout
 */
$(function () {

    /* ══════════════════════════════════════════
       TABS
    ══════════════════════════════════════════ */
    $('.settings-tab').on('click', function () {
        const tab = $(this).data('tab');

        // Update tab active
        $('.settings-tab').removeClass('active');
        $(this).addClass('active');

        // Update panel active
        $('.settings-panel').removeClass('active');
        $('#panel-' + tab).addClass('active');
    });

    /* ══════════════════════════════════════════
       TAB 1 — REKENING TOKO
       Preview live saat user mengetik
    ══════════════════════════════════════════ */
    $('#bank-name').on('change', function () {
        // Hapus emoji dari label option untuk preview
        const raw = $(this).find('option:selected').text();
        const clean = raw.replace(/[🏦📱]\s*/g, '').trim();
        $('#preview-bank-name').text(clean);
    });

    $('#bank-number').on('input', function () {
        $('#preview-bank-number').text($(this).val() || '—');
    });

    $('#bank-holder').on('input', function () {
        $('#preview-bank-holder').text($(this).val() || '—');
    });

    $('#btn-save-rekening').on('click', function () {
        const bank   = $('#bank-name').val();
        const number = $('#bank-number').val().trim();
        const holder = $('#bank-holder').val().trim();

        if (!number || !holder) {
            GKP.showToast('Lengkapi nomor rekening dan nama pemilik.', 'error');
            return;
        }
        GKP.showToast('Rekening toko berhasil disimpan!', 'success');
    });

    /* ══════════════════════════════════════════
       TAB 2 — KONTAK BANTUAN
       Preview WA button live
    ══════════════════════════════════════════ */
    $('#wa-number').on('input', function () {
        const val = $(this).val().trim() || '081234567890';
        $('#wa-preview-number').text(val);
    });

    $('#btn-save-kontak').on('click', function () {
        const wa = $('#wa-number').val().trim();
        if (!wa) {
            GKP.showToast('Masukkan nomor WhatsApp admin.', 'error');
            return;
        }
        GKP.showToast('Kontak bantuan berhasil disimpan!', 'success');
    });

    /* ══════════════════════════════════════════
       TAB 3 — KEAMANAN
       Toggle show/hide password
    ══════════════════════════════════════════ */
    $(document).on('click', '.admin-pw-toggle', function () {
        const targetId = $(this).data('target');
        const $inp     = $('#' + targetId);
        const isText   = $inp.attr('type') === 'text';

        $inp.attr('type', isText ? 'password' : 'text');
        $(this).find('svg').html(isText
            ? '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>'
            : '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>');
    });

    /* Ubah password admin */
    $('#btn-change-admin-pw').on('click', function () {
        const lama = $('#admin-pw-lama').val();
        const baru = $('#admin-pw-baru').val();

        if (!lama || !baru) {
            GKP.showToast('Isi password lama dan baru.', 'error');
            return;
        }
        if (baru.length < 8) {
            GKP.showToast('Password baru minimal 8 karakter.', 'error');
            return;
        }

        GKP.showToast('Password admin berhasil diubah!', 'success');
        $('#admin-pw-lama, #admin-pw-baru').val('');
    });

    /* Logout admin */
    $('#btn-logout-admin').on('click', function () {
        window.location.href = '../../index.html';
    });

});
