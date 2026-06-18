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
            otw:   'Perjalanan Laut OTW Indo',
            tiba:  'Tiba di Indonesia',
        };
        GKP.showToast('Status kargo diperbarui: ' + labels[val], 'success');
        $('#cargo-status-select').val('');
    });

    /* ── Submit resi ───────────────────────────────────────── */
    $('#btn-submit-resi').on('click', function () {
        const orderId = $('#resi-order-select').val();
        const resi    = $('#resi-input').val().trim();
        if (!orderId) { GKP.showToast('Pilih pesanan terlebih dahulu.', 'error'); return; }
        if (!resi)    { GKP.showToast('Masukkan nomor resi.', 'error'); return; }

        // Update badge di daftar siap kirim
        $('#ready-to-ship-list .logistics-order-item').each(function () {
            const name = $(this).find('.logistics-order-name').text();
            if (name.includes(orderId)) {
                $(this).find('.badge-yellow').replaceWith(
                    `<span class="resi-badge">Resi: ${resi}</span>`
                );
            }
        });

        GKP.showToast('Resi ' + resi + ' berhasil disimpan!', 'success');
        $('#resi-order-select').val('');
        $('#resi-input').val('');
    });

});
