/**
 * GO K-POP — js/admin-sorting.js
 * Input kartu per member & sorting otomatis
 */
$(function () {
    let sortingSessionId = null;
    let sortingResult = [];
    let selectedOrders = [];

    $('#album-select').on('change', function () {

        const albumId = $(this).val();

        $('#member-inputs').empty();

        if (!albumId) {
            return;
        }

        $.get('/admin/sortingpc/album/' + albumId, function (response) {

            selectedOrders = response.orders;

            response.members.forEach(function (member) {

                $('#member-inputs').append(`
                <div class="sorting-member-row">
                    <span class="sorting-member-name">
                        ${member}
                    </span>

                    <input
                        type="number"
                        min="0"
                        class="form-input no-icon"
                        style="padding:10px 12px;font-size:.875rem"
                        placeholder="0"
                        data-member="${member}"
                        id="card-${member.toLowerCase().replace(/\s+/g, '-')}"
                    />
                </div>
            `);

            });

        });

    });

    /* ── Jalankan sorting ──────────────────────────────────── */
    $('#btn-run-sorting').on('click', function () {

        const albumId = $('#album-select').val();

        if (!albumId) {
            GKP.showToast('Silakan pilih album terlebih dahulu.', 'warning');
            return;
        }

        let members = {};

        $('#member-inputs input').each(function () {

            members[$(this).data('member')] = Number($(this).val());

        });

        $.ajax({

            url: '/admin/sortingpc/process',

            type: 'POST',

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            data: {
                album_id: albumId,
                members: members
            },

            success: function (response) {
                sortingSessionId = response.session_id;
                sortingResult = response.result;

                const $tbody = $('#sorting-result-tbody').empty();

                response.result.forEach(function (r) {

                    const time = new Date(r.uploaded_at).toLocaleString('id-ID', {
                        day: '2-digit',
                        month: 'short',
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    let prioBadge = '-';

                    if (r.priority === 1) {
                        prioBadge = '<span class="prio-tag-neon">Prio 1</span>';
                    } else if (r.priority === 2) {
                        prioBadge = '<span class="prio-tag-gold">Prio 2</span>';
                    } else if (r.priority === 3) {
                        prioBadge = '<span class="prio-tag">Prio 3</span>';
                    }

                    $tbody.append(`
                        <tr>
                            <td><span class="member-tag">${r.member}</span></td>
                            <td style="color:#fff;font-weight:500">${r.buyer}</td>
                            <td>${prioBadge}</td>
                            <td style="color:var(--slate-400);font-size:.75rem">${time}</td>
                        </tr>
                    `);
                });

                // === Bagian ini sengaja dipertahankan seperti semula ===
                $('#sorting-result').removeClass('hidden');

                // Tampilkan tombol simpan hasil sorting
                $('#btn-save-sorting').removeClass('hidden');

                GKP.showToast('Sorting selesai! Lihat hasil di bawah.', 'success');

                $('html, body').animate({
                    scrollTop: $('#sorting-result').offset().top - 80
                }, 500);

            }

        });

    });
    // $('#btn-run-sorting').on('click', function () {
    //     // Render hasil
    //     const $tbody = $('#sorting-result-tbody').empty();

    //     mockResults.forEach(function (r) {
    //         const time = new Date(r.timestamp).toLocaleString('id-ID', {
    //             day:'2-digit', month:'short', hour:'2-digit', minute:'2-digit'
    //         });
    //         const prioBadge = r.priority === 1
    //             ? '<span class="prio-tag-neon">Prio 1</span>'
    //             : '<span class="prio-tag-gold">Prio 2</span>';

    //         $tbody.append(`
    //             <tr>
    //                 <td><span class="member-tag">${r.member}</span></td>
    //                 <td style="color:#fff;font-weight:500">${r.buyer}</td>
    //                 <td>${prioBadge}</td>
    //                 <td style="color:var(--slate-400);font-size:.75rem">${time}</td>
    //             </tr>
    //         `);
    //     });

    //     $('#sorting-result').removeClass('hidden');
    //     GKP.showToast('Sorting selesai! Lihat hasil di bawah.', 'success');

    //     // Scroll ke hasil
    //     $('html, body').animate({
    //         scrollTop: $('#sorting-result').offset().top - 80
    //     }, 500);
    // });

});
