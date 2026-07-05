/**
 * GO K-POP — js/admin-logistics.js
 * Update kargo massal & input resi domestik
 */
$(function () {

    /* ── Update kargo massal ───────────────────────────────── */
    $('#btn-update-cargo').on('click', function () {
        const val = $('#cargo-status-select').val();
        if (!val) { GKP.showToast('Pilih status kargo terlebih dahulu.', 'error'); return; }
        const labels = {
            korea: 'Di Gudang Korea',
            otw: 'Perjalanan Laut OTW Indo',
            tiba: 'Tiba di Indonesia',
        };
        GKP.showToast('Status kargo diperbarui: ' + labels[val], 'success');
        $('#cargo-status-select').val('');
    });

    /* ── Submit resi ───────────────────────────────────────── */
    // $('#btn-submit-resi').on('click', function () {
    //     const orderId = $('#resi-order-select').val();
    //     const resi    = $('#resi-input').val().trim();
    //     if (!orderId) { GKP.showToast('Pilih pesanan terlebih dahulu.', 'error'); return; }
    //     if (!resi)    { GKP.showToast('Masukkan nomor resi.', 'error'); return; }

    //     // Update badge di daftar siap kirim
    //     $('#ready-to-ship-list .logistics-order-item').each(function () {
    //         const name = $(this).find('.logistics-order-name').text();
    //         if (name.includes(orderId)) {
    //             $(this).find('.badge-yellow').replaceWith(
    //                 `<span class="resi-badge">Resi: ${resi}</span>`
    //             );
    //         }
    //     });

    //     GKP.showToast('Resi ' + resi + ' berhasil disimpan!', 'success');
    //     $('#resi-order-select').val('');
    //     $('#resi-input').val('');
    // });

    /* ── Submit Resi (AJAX) ───────────────────────── */
    $('#shipment-form').on('submit', function (e) {

        e.preventDefault();

        const orderId = $('#resi-order-select').val();
        const trackingNumber = $('#resi-input').val().trim();

        if (!orderId) {
            GKP.showToast('Pilih pesanan terlebih dahulu.', 'error');
            return;
        }

        if (!trackingNumber) {
            GKP.showToast('Masukkan nomor resi.', 'error');
            return;
        }

        const formData = new FormData();

        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
        formData.append('order_id', orderId);
        formData.append('tracking_number', trackingNumber);

        $.ajax({

            url: '/admin/shipment/update-resi',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,

            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },

            success: function (response) {

                GKP.showToast(response.message, 'success');

                // Hapus option dari dropdown
                $('#resi-order-select option[value="' + response.order_id + '"]').remove();
                // Hapus card dari daftar siap kirim
                $('.logistics-order-item[data-order-id="' + response.order_id + '"]').fadeOut(300, function () {
                    $(this).remove();
                });

                // Reset form
                $('#shipment-form')[0].reset();
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
});
