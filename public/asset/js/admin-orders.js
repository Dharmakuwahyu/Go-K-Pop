/**
 * GO K-POP — js/admin-orders.js
 * Search realtime & filter tabel pesanan
 */
$(function () {

    function applyFilter() {
        const q       = $('#order-search').val().toLowerCase().trim();
        const album   = $('#filter-album').val();
        const status  = $('#filter-status').val();
        let visible   = 0;

        $('#orders-tbody tr').each(function () {
            const $row      = $(this);
            const buyer     = $row.data('buyer').toLowerCase();
            const id        = $row.data('id').toLowerCase();
            const rowAlbum  = $row.data('album');
            const rowStatus = $row.data('status');

            const matchQ      = !q || buyer.includes(q) || id.includes(q);
            const matchAlbum  = album === 'all' || rowAlbum === album;
            const matchStatus = status === 'all' || rowStatus === status;

            if (matchQ && matchAlbum && matchStatus) {
                $row.show();
                visible++;
            } else {
                $row.hide();
            }
        });

        if (visible === 0) {
            $('#orders-empty').removeClass('hidden');
        } else {
            $('#orders-empty').addClass('hidden');
        }
    }

    $('#order-search').on('input', applyFilter);
    $('#filter-album').on('change', applyFilter);
    $('#filter-status').on('change', applyFilter);

});
