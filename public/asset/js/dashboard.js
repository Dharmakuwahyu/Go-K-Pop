/**
 * GO K-POP — js/dashboard.js
 * Interaksi halaman Pesanan Saya (dashboard.html)
 */
$(function () {

    /* ── Copy rekening / resi ─────────────────────────────── */
    $(document).on('click', '.btn-copy', function () {
        const text = $(this).data('copy');
        GKP.copyText(String(text), $(this));
    });

    /* ── Upload area: klik untuk buka file picker ─────────── */
    $(document).on('click', '.upload-area', function (e) {
        if ($(e.target).is('.upload-input')) {
            return;
        }

        e.preventDefault();
        e.stopPropagation();

        $(this).find('.upload-input')[0].click();
    });

    /* ── Upload area: file dipilih via input ──────────────── */
    $(document).on('change', '.upload-input', function () {
        // console.log('CHANGE');
        const file = this.files && this.files[0];
        if (!file) return;

        const $area = $(this).closest('.upload-area');

        // simpan file
        $area.data('selected-file', file);

        showPreview($area, file);
    });

    /* ── Drag & Drop ──────────────────────────────────────── */
    $(document).on('dragover dragenter', '.upload-area', function (e) {
        e.preventDefault();
        $(this).addClass('drag-over');
    });
    $(document).on('dragleave drop', '.upload-area', function (e) {
        e.preventDefault();
        $(this).removeClass('drag-over');
        if (e.type === 'drop') {
            const file = e.originalEvent.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {

                $(this).data('selected-file', file);

                showPreview($(this), file);
            }
        }
    });

    function showPreview($area, file) {
        const url = URL.createObjectURL(file);
        $area.html(`
            <div class="upload-preview">
                <img src="${url}" alt="Preview bukti transfer" />
                <p>✓ ${file.name} siap diupload</p>
            </div>
            <input type="file" class="upload-input hidden" accept="image/*" />
        `);
    }

    /* ── Upload bukti pembayaran ───────────────────────── */
    $(document).on('click', '.btn-upload-payment', function () {

        const $btn = $(this);
        const orderId = $btn.data('order-id');
        const status = $btn.data('status');
        const $area = $btn.closest('.order-card').find('.upload-area');

        const file = $area.data('selected-file');

        // inputan alamat
        const address = $('#address-' + orderId).val();
        const courier = $('#kurir-' + orderId).val();
        const shippingCost = {
            jnt: 20000,
            jne: 25000,
            sicepat: 18000
        }[courier] || 0;

        // validasi bukti transfer
        if (!file) {
            GKP.showToast('Silakan pilih bukti transfer terlebih dahulu.', 'error');
            return;
        }

        // Data pengiriman (alamat, kurir, ongkir) hanya diperlukan
        // pada tahap Pelunasan, sehingga wajib diisi sebelum upload.
        if (status === 'pending_pelunasan') {

            if (!address.trim()) {
                GKP.showToast('Silakan isi alamat pengiriman.', 'error');
                return;
            }

            if (!courier) {
                GKP.showToast('Silakan pilih kurir.', 'error');
                return;
            }

        }

        const formData = new FormData();
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
        formData.append('order_id', orderId);
        formData.append('proof_image', file);

        // Data pengiriman (alamat, kurir, ongkir) hanya diperlukan
        // pada tahap Pelunasan, sehingga hanya dikirim ketika status
        // order adalah pending_pelunasan.
        if (status === 'pending_pelunasan') {
            formData.append('address', address);
            formData.append('courier', courier);
            formData.append('shipping_cost', shippingCost);
        }

        $.ajax({
            url: '/member/payments/upload',
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
                // refresh supaya status terbaru tampil
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


    /* ── Pilih kurir — update rincian ongkir ─────────────── */
    const ongkirMap = {
        jnt: 20000,
        jne: 25000,
        sicepat: 18000
    };

    // UJI COBA
    // Tandai bahwa perubahan dilakukan oleh user.
    $(document).on('focus', '.courier-select', function () {
        $(this).data('user-change', true);
    });


    $(document).on('change', '.courier-select', function () {

        const orderId = $(this).data('order-id');
        const albumPayment = Number($(this).data('album-payment'));

        const value = $(this).val();
        const ongkir = ongkirMap[value] || 0;

        const kurir = $(this)
            .find('option:selected')
            .text()
            .split('—')[0]
            .trim();

        $('#shipping-label-' + orderId)
            .text('Ongkir Kurir Lokal (' + kurir + ')');

        $('#shipping-price-' + orderId)
            .text('Rp' + ongkir.toLocaleString('id-ID'));

        // Update nominal pembayaran di bank
        const basePayment = Number($('#bank-total-' + orderId).data('base'));
        const totalPayment = basePayment + ongkir;

        $('#bank-total-' + orderId)
            .text('Rp' + totalPayment.toLocaleString('id-ID'));

        // GKP.showToast('Kurir berhasil dipilih.', 'success');
        // UJI COBA
        // Tampilkan toast hanya jika user benar-benar mengganti kurir,
        // bukan saat event change dipanggil otomatis ketika halaman dimuat.
        if ($(this).data('user-change')) {
            GKP.showToast('Kurir berhasil dipilih.', 'success');
            $(this).removeData('user-change');
        }
    });

    // UJI COBA
    // Jika halaman dimuat dan kurir sudah tersimpan dari database,
    // jalankan event change agar ongkir dan total pembayaran ikut diperbarui.
    $('.courier-select').each(function () {

        if ($(this).val()) {
            $(this).trigger('change');
        }

    });

});
