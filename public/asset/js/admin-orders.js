/**
 * GO K-POP — js/admin-orders.js
 * Search realtime & filter tabel pesanan
 */
$(function () {
    // Menyimpan seluruh data pesanan dari server
    let orders = [];
    // Menyimpan nilai filter yang sedang dipilih
    let searchKeyword = '';
    let selectedAlbum = 'all';
    let selectedStatus = 'all';
    // Mencegah request AJAX berjalan bersamaan
    let isLoading = false;

    /**
     * Mengambil data pesanan terbaru dari server menggunakan AJAX.
     *
     * Fungsi ini nantinya akan digunakan untuk:
     * - Search realtime
     * - Filter Album
     * - Filter Status
     * - Auto Refresh
     * - Render ulang tabel
     */
    function loadOrders() {
        // Jangan kirim request baru jika request sebelumnya belum selesai
        if (isLoading) {
            return;
        }

        isLoading = true;

        $.ajax({
            // Endpoint untuk mengambil data pesanan
            url: '/admin/order/data',
            // Method request
            type: 'GET',
            // Format data yang diterima
            dataType: 'json',
            success: function (response) {
                // Simpan data pesanan
                orders = response.orders;

                // Perbarui kartu statistik
                updateStatistics(response.statistics);

                // Tampilkan ulang tabel sesuai filter yang sedang aktif
                filterOrders();

                // Isi dropdown setelah data berhasil diambil
                updateAlbumDropdown(orders);
                updateStatusDropdown(orders);
            },
            error: function (xhr) {
                console.error('Gagal mengambil data orders.', xhr);
            },
            /**
            * Selalu dijalankan setelah request selesai,
            * baik berhasil maupun gagal.
            */
            complete: function () {
                isLoading = false;
            }
        });
    }

    /**
     * Menampilkan seluruh data pesanan ke dalam tabel.
     *
     * Sumber data berasal dari variabel global `orders`
     * yang diambil melalui AJAX.
     */
    function renderTable(data = orders) {
        // Ambil tbody tabel
        const $tbody = $('#orders-tbody');
        // Kosongkan isi tabel
        $tbody.empty();
        // Jika tidak ada data
        if (data.length === 0) {
            $tbody.append(`
                <tr>
                    <td colspan="9" style="text-align:center;padding:2rem">
                        Belum ada data pesanan.
                    </td>
                </tr>
            `);

            return;
        }

        // Tampilkan seluruh pesanan
        data.forEach(function (order) {
            $tbody.append(`
                <tr  
                    data-album="${order.album.group_name} - ${order.album.title}"
                    data-status="${order.status}"
                    data-buyer="${order.buyer_name.toLowerCase()}"
                    data-id="${order.order_code.toLowerCase()}">

                    <!-- ID Pesanan -->
                    <td class="mono">
                        ${order.order_code}
                    </td>

                    <!-- Pembeli -->
                    <td>
                        <div class="td-buyer-name">
                            ${order.buyer_name}
                        </div>

                        <div class="td-buyer-city">
                            ${order.buyer_city ?? '-'}
                        </div>
                    </td>

                    <!-- Album -->
                    <td>
                        <div class="td-album">
                            ${order.album.group_name} - ${order.album.title}
                        </div>
                        <div class="td-album-sub">
                            ${order.variant.name} × ${order.qty}
                        </div>
                    </td>

                    <!-- Prioritas Member -->
                    <td>
                        <div class="td-prio">
                            ${order.priorities
                    .sort((a, b) => a.priority - b.priority)
                    .map(priority => `
                                    <span>
                                         ${priority.priority}. ${priority.member_name}
                                     </span>
                                `)
                    .join('')
                }
                        </div>
                    </td>

                    <!-- Total Estimasi -->
                    <td class="text-right" style="color:#fff">
                        Rp${Number(order.total_price).toLocaleString('id-ID')}
                    </td>

                    <!-- Sudah Dibayar -->
                    <td class="text-right td-paid">
                        Rp${Number(order.paid_amount).toLocaleString('id-ID')}
                    </td>

                    <!-- Kekurangan Tahap Ini -->
                    <td class="text-right td-due">
                        Rp${Number(order.current_payment_amount).toLocaleString('id-ID')}
                    </td>

                    <!-- Sisa Harga -->
                    <td class="text-right td-remaining">
                        Rp${Number(order.remaining_price).toLocaleString('id-ID')}
                    </td>

                    <!-- Status -->
                    <td>
                        <span class="badge badge-${order.status_color}">
                            ${order.status_label}
                        </span>
                    </td>

                </tr>
            `);
        });
    }


    /**
     * Memperbarui kartu statistik tanpa me-refresh halaman.
     */
    function updateStatistics(statistics) {

        $('#stat-total').text(statistics.total_orders);

        $('#stat-pending').text(statistics.pending_orders);

        $('#stat-lunas').text(statistics.paid_orders);

    }


    /**
     * Melakukan filter data pesanan berdasarkan
     * keyword, album dan status.
     */
    function filterOrders() {

        const filteredOrders = orders.filter(function (order) {

            // Search
            const keywordMatch =
                searchKeyword === '' ||
                order.buyer_name.toLowerCase().includes(searchKeyword) ||
                order.order_code.toLowerCase().includes(searchKeyword);

            // Album
            const albumMatch =
                selectedAlbum === 'all' ||
                `${order.album.group_name} - ${order.album.title}` === selectedAlbum;

            // Status
            const statusMatch =
                selectedStatus === 'all' ||
                order.status === selectedStatus;

            return keywordMatch && albumMatch && statusMatch;

        });

        // Render tabel hasil filter
        renderTable(filteredOrders);

    }


    /**
     * Memperbarui pilihan dropdown Status
     * berdasarkan data yang sedang tampil di tabel.
     */
    function updateStatusDropdown(data = orders) {

        // Simpan status yang sedang dipilih
        const currentStatus = $('#filter-status').val();
        const statuses = [...new Set(data.map(order => order.status))];
        // Ambil elemen dropdown
        const $status = $('#filter-status');
        // Kosongkan seluruh option
        $status.empty();
        // Tambahkan option default
        $status.append(`
            <option value="all">Semua Status</option>
        `);

        // Mapping enum menjadi label yang mudah dibaca
        const statusLabels = {
            pending_dp1: 'Menunggu DP 1',
            dp1_confirmed: 'DP 1 Terverifikasi',
            pending_dp2: 'Menunggu DP 2',
            dp2_confirmed: 'DP 2 Terverifikasi',
            pending_pelunasan: 'Menunggu Pelunasan',
            pelunasan_confirmed: 'Pelunasan Terverifikasi',
            shipped: 'Sudah Dikirim'
        };

        // Tambahkan option sesuai data yang ada
        statuses.forEach(function (status) {
            $status.append(`
                <option value="${status}">
                    ${statusLabels[status]}
                </option>
            `);
        });

        // Jika pilihan sebelumnya masih tersedia,
        // kembalikan pilihan tersebut
        if (statuses.includes(currentStatus)) {
            $status.val(currentStatus);
        }
    }

    /**
     * Memperbarui pilihan dropdown Album
     * berdasarkan data yang sedang tampil di tabel.
     */
    function updateAlbumDropdown(data = orders) {
        // Simpan album yang sedang dipilih
        const currentAlbum = $('#filter-album').val();
        const albums = [
            ...new Set(
                data.map(order => `${order.album.group_name} - ${order.album.title}`)
            )
        ];
        // Ambil dropdown album
        const $album = $('#filter-album');
        // Kosongkan option
        $album.empty();
        // Option default
        $album.append(`
            <option value="all">Semua Album</option>
        `);

        // Tambahkan option album
        albums.forEach(function (album) {
            $album.append(`
                <option value="${album}">
                    ${album}
                </option>
            `);
        });

        // Jika pilihan sebelumnya masih ada
        if (albums.includes(currentAlbum)) {
            $album.val(currentAlbum);
        }
    }

    /**
     * Search realtime berdasarkan nama pembeli
     * atau ID pesanan.
     */
    $('#order-search').on('input', function () {

        // Simpan keyword pencarian
        searchKeyword = $(this).val().toLowerCase().trim();

        // Render ulang data
        filterOrders();

    });

    /**
     * Filter data berdasarkan album.
     */
    $('#filter-album').on('change', function () {

        // Simpan album yang dipilih
        selectedAlbum = $(this).val();

        // Ambil data berdasarkan album yang dipilih
        const albumData = orders.filter(order => {

            return selectedAlbum === 'all'
                || `${order.album.group_name} - ${order.album.title}` === selectedAlbum;

        });

        // Update dropdown status
        updateStatusDropdown(albumData);

        // Render tabel
        filterOrders();

    });

    /**
     * Filter data berdasarkan status.
     */
    $('#filter-status').on('change', function () {

        // Simpan status yang dipilih
        selectedStatus = $(this).val();

        // Ambil data berdasarkan status yang dipilih
        const statusData = orders.filter(order => {

            return selectedStatus === 'all'
                || order.status === selectedStatus;

        });

        // Update dropdown album
        updateAlbumDropdown(statusData);

        // Render tabel
        filterOrders();

    });

    // Ambil data pesanan pertama kali saat halaman dibuka
    loadOrders();

    // Perbarui data otomatis setiap 10 detik
    setInterval(function () {
        loadOrders();
    }, 10000);

});
