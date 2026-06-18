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
        if ($(e.target).is('input')) return;
        $(this).find('.upload-input').trigger('click');
    });

    /* ── Upload area: file dipilih via input ──────────────── */
    $(document).on('change', '.upload-input', function () {
        const file = this.files && this.files[0];
        if (!file) return;
        const $area = $(this).closest('.upload-area');
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

    /* ── Pilih kurir — update total pelunasan ─────────────── */
    const ongkirMap = { jnt: 20000, jne: 25000, sicepat: 18000 };
    $('#kurir-ord4').on('change', function () {
        const val    = $(this).val();
        const ongkir = ongkirMap[val] || 0;
        const album  = 200000;
        const total  = album + ongkir;
        // Update label di bank info box (jika perlu, Laravel akan handle datanya)
        GKP.showToast('Kurir dipilih. Total pelunasan diperbarui.', 'success');
    });

});
