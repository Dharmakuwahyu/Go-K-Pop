/**
 * GO K-POP — js/profile.js
 * Interaksi halaman Akun Saya (profile.html)
 */
$(function () {

    /* ── Simpan perubahan data diri ───────────────────────── */
    $('#btn-save-profile').on('click', function () {
        const name = $('#input-name').val().trim();
        if (!name) { GKP.showToast('Nama tidak boleh kosong.', 'error'); return; }
        $('#profile-display-name').text(name);
        $('#save-success').addClass('show');
        setTimeout(() => $('#save-success').removeClass('show'), 3000);
        GKP.showToast('Perubahan berhasil disimpan!', 'success');
    });

    /* ── Toggle show/hide password ────────────────────────── */
    $(document).on('click', '.pw-toggle', function () {
        const targetId = $(this).data('target');
        const $inp = $('#' + targetId);
        const isText = $inp.attr('type') === 'text';
        $inp.attr('type', isText ? 'password' : 'text');
        $(this).find('svg').html(isText
            ? '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>'
            : '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>');
    });

    /* ── Ubah password ────────────────────────────────────── */
    $('#btn-change-pw').on('click', function () {
        const lama = $('#pw-lama').val();
        const baru = $('#pw-baru').val();
        if (!lama || !baru) { GKP.showToast('Isi password lama dan baru.', 'error'); return; }
        if (baru.length < 8)  { GKP.showToast('Password baru minimal 8 karakter.', 'error'); return; }
        GKP.showToast('Password berhasil diubah!', 'success');
        $('#pw-lama, #pw-baru').val('');
    });

    /* ── Animasi hover icon logout ────────────────────────── */
    $('#btn-logout').on('mouseenter', function () {
        $(this).find('.logout-icon').css('transform', 'translateX(3px)');
    }).on('mouseleave', function () {
        $(this).find('.logout-icon').css('transform', 'translateX(0)');
    });

    /* ── Keluar ───────────────────────────────────────────── */
    $('#btn-logout').on('click', function () {
        window.location.href = '../../index.html';
    });

});
