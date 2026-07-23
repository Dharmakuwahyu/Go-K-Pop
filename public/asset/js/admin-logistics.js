/**
 * GO K-POP — js/admin-logistics.js
 * Update kargo massal & input resi domestik
 */
$(function () {

    /* ── Update kargo massal ───────────────────────────────── */
    $('#btn-update-cargo').on('click', function () {

        const cargoStatus = $('#cargo-status-select').val();

        if (!cargoStatus) {
            GKP.showToast('Pilih status kargo terlebih dahulu.', 'error');
            return;
        }

        $.ajax({

            url: '/admin/shipment/update-cargo',
            method: 'POST',

            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                cargo_status: cargoStatus
            },

            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },

            success: function (response) {

                GKP.showToast(response.message, 'success');

                $('#cargo-status-select').val('');

                // Refresh isi halaman tanpa reload
                $.get('/admin/shipment', function (html) {

                    $('#ready-to-ship-list').html(
                        $(html).find('#ready-to-ship-list').html()
                    );

                    $('#resi-order-select').html(
                        $(html).find('#resi-order-select').html()
                    );

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
