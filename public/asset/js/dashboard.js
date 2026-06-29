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
        const $area = $btn.closest('.order-card').find('.upload-area');

        const file = $area.data('selected-file');

        if (!file) {
            GKP.showToast('Silakan pilih bukti transfer terlebih dahulu.', 'error');
            return;
        }

        const formData = new FormData();
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
        formData.append('order_id', orderId);
        formData.append('proof_image', file);

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

    /* ── Pilih kurir — update total pelunasan ─────────────── */
    const ongkirMap = { jnt: 20000, jne: 25000, sicepat: 18000 };
    $('#kurir-ord4').on('change', function () {
        const val = $(this).val();
        const ongkir = ongkirMap[val] || 0;
        const album = 200000;
        const total = album + ongkir;
        // Update label di bank info box (jika perlu, Laravel akan handle datanya)
        GKP.showToast('Kurir dipilih. Total pelunasan diperbarui.', 'success');
    });

});
