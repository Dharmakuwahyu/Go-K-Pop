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
    $(document).on('click', '.btn-payment-approve', function () {
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

                // location.reload();
                // Hapus card pembayaran yang sudah diverifikasi
                $btn.closest('.payment-card').fadeOut(300, function () {
                    $(this).remove();
                });

                // Ambil ulang halaman payment
                $.get('/admin/payment', function (html) {

                    // Ambil daftar tahap berikutnya dari halaman yang baru
                    const nextPhase = $(html).find('#next-phase-list').html();

                    // Ganti isi yang sekarang
                    $('#next-phase-list').html(nextPhase);

                });

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

    /* ============================
       Buka Tahap Pembayaran Berikutnya
    ============================ */

    $(document).on('click', '.btn-open-phase', function () {

        const btn = $(this);
        const orderId = btn.data('order-id');

        $.ajax({

            url: `/admin/payment/${orderId}/next-phase`,
            type: 'POST',

            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },

            success: function (response) {

                GKP.showToast(response.message, 'success');

                btn.closest('.payment-card').fadeOut(300, function () {
                    $(this).remove();
                });

            },

            error: function (xhr) {

                GKP.showToast(
                    xhr.responseJSON?.message ?? 'Terjadi kesalahan.',
                    'error'
                );

            }

        });

    });

});
