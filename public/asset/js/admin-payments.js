/**
 * GO K-POP — js/admin-payments.js
 * Interaksi halaman Verifikasi Pembayaran
 */
$(function () {

    /* ── Lihat Resi (Image Viewer) ────────────────────────── */
    $(document).on('click', '.btn-view-proof, .payment-proof', function () {
        const img = $(this).data('img');
        $('#img-viewer-src').attr('src', img);
        $('#img-viewer').addClass('open');
    });

    /* Tutup image viewer */
    $('#img-viewer').on('click', function () {
        $(this).removeClass('open');
        $('#img-viewer-src').attr('src', '');
    });

    $(document).on('keydown', function (e) {
        if (e.key === 'Escape') {
            $('#img-viewer').removeClass('open');
            $('#reject-modal').removeClass('open');
        }
    });

    /* ── Approve ──────────────────────────────────────────── */
    $(document).on('click', '.btn-approve', function () {
        const $btn = $(this);
        const payId = $btn.data('pay-id').replace('pay-', '');

        $.ajax({

            url: '/admin/payment/' + payId + '/approve',
            method: 'POST',

            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },

            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },

            success: function (response) {

                GKP.showToast(response.message, 'success');

                location.reload();

            },

            error: function (xhr) {

                let message = 'Terjadi kesalahan.';

                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }

                GKP.showToast(message, 'error');

            }

        });

    });
    // $(document).on('click', '.btn-approve', function () {
    //     const payId = $(this).data('pay-id');
    //     const $card = $('#' + payId);

    //     // Update badge ke approved
    //     $card.find('.payment-id .badge')
    //         .removeClass('badge-yellow')
    //         .addClass('badge-green')
    //         .html('<svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg> Approved');

    //     // Sembunyikan tombol aksi
    //     $card.find('.payment-actions').html(
    //         '<span style="font-size:.875rem;color:var(--neon-400);font-weight:600">✓ Pembayaran Dikonfirmasi</span>'
    //     );

    //     GKP.showToast('Pembayaran berhasil dikonfirmasi!', 'success');
    // });


    /* ── Buka Reject Modal ────────────────────────────────── */
    $(document).on('click', '.btn-reject', function () {
        const payId = $(this).data('pay-id');
        $('#reject-pay-id').val(payId);
        $('#reject-reason').val('');
        $('#reject-modal').addClass('open');
    });

    /* Tutup Reject Modal */
    $('#reject-close, #btn-reject-cancel').on('click', function () {
        $('#reject-modal').removeClass('open');
    });
    $(document).on('click', '#reject-modal', function (e) {
        if ($(e.target).is('#reject-modal')) $(this).removeClass('open');
    });

    /* ── Konfirmasi Reject ────────────────────────────────── */
    $('#btn-reject-confirm').on('click', function () {

        const payId = $('#reject-pay-id').val();
        const reason = $('#reject-reason').val().trim();

        if (!reason) {
            GKP.showToast('Isi alasan penolakan terlebih dahulu.', 'error');
            return;
        }

        $.ajax({
            url: '/admin/payment/' + payId + '/reject',
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                reason: reason
            },
            success: function (response) {
                // Tutup modal
                $('#reject-modal').removeClass('open');

                // Toast
                GKP.showToast(response.message, 'error');

                location.reload();
            },
            error: function (xhr) {
                let message = 'Terjadi kesalahan.';

                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }

                GKP.showToast(message, 'error');
            }
        });

    });
    // $('#btn-reject-confirm').on('click', function () {
    //     const payId = $('#reject-pay-id').val();
    //     const reason = $('#reject-reason').val().trim();

    //     if (!reason) {
    //         GKP.showToast('Isi alasan penolakan terlebih dahulu.', 'error');
    //         return;
    //     }

    //     const $card = $('#' + payId);

    //     // Update badge ke rejected
    //     $card.find('.payment-id .badge')
    //         .removeClass('badge-yellow')
    //         .addClass('badge-accent')
    //         .html('<svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg> Ditolak');

    //     $card.find('.payment-actions').html(
    //         '<span style="font-size:.875rem;color:var(--accent-400);font-weight:600">✗ Pembayaran Ditolak</span>'
    //     );

    //     $('#reject-modal').removeClass('open');
    //     GKP.showToast('Pembayaran ditolak. Notifikasi dikirim ke pembeli.', 'error');
    // });

});
