/**
 * GO K-POP — js/global.js
 * Wajib di-load di semua halaman (setelah jQuery).
 * Berisi: Auth Modal, Order Modal, Sidebar Admin, Toast, Helpers
 */

/* ============================================================
   HELPERS
   ============================================================ */
const GKP = {
    formatRupiah(n) {
        return 'Rp' + Number(n).toLocaleString('id-ID');
    },

    waUrl(number) {
        const clean = String(number).replace(/\D/g, '').replace(/^0/, '62');
        return 'https://wa.me/' + clean + '?text=Halo%20GO%20K-POP%2C%20saya%20ingin%20bertanya...';
    },

    showToast(msg, type) {
        type = type || 'default';
        const colors = {
            default: 'rgba(26,26,36,.97)',
            success: 'rgba(22,101,52,.95)',
            error: 'rgba(127,29,29,.95)',
        };
        const $t = $('<div class="toast"></div>')
            .text(msg)
            .css('background', colors[type] || colors.default);
        $('body').append($t);
        setTimeout(() => $t.fadeOut(400, () => $t.remove()), 2500);
    },

    copyText(text, $btn, label) {
        label = label || $btn.text();

        function copied() {
            $btn.text('✓ Disalin!');
            setTimeout(() => $btn.text(label), 2000);
        }

        function fallback() {
            const ta = $('<textarea>')
                .val(text)
                .css({
                    position: 'fixed',
                    left: '-9999px'
                });

            $('body').append(ta);

            ta[0].focus();
            ta[0].select();

            document.execCommand('copy');

            ta.remove();
            copied();
        }

        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard
                .writeText(text)
                .then(copied)
                .catch(fallback);
        } else {
            fallback();
        }
        // label = label || $btn.text();
        // navigator.clipboard.writeText(text).then(() => {
        //     $btn.text('✓ Disalin!');
        //     setTimeout(() => $btn.text(label), 2000);
        // }).catch(() => {
        //     /* fallback */
        //     const ta = document.createElement('textarea');
        //     ta.value = text; document.body.appendChild(ta);
        //     ta.select(); document.execCommand('copy');
        //     document.body.removeChild(ta);
        //     $btn.text('✓ Disalin!');
        //     setTimeout(() => $btn.text(label), 2000);
        // });
    },

    albums: [
        {
            id: '1', group: 'NCT 127', title: 'ISTJ - The 5th Album', price: 285000, totalSlots: 30, slotsLeft: 15,
            variants: ['Photobook', 'Digipack', 'Smini'],
            members: ['Jaehyun', 'Mark', 'Taeyong', 'Yuta', 'Doyoung', 'Johnny', 'Haechan', 'Jungwoo', 'Taeil'],
            image: 'https://images.pexels.com/photos/1762537/pexels-photo-1762537.jpeg?auto=compress&cs=tinysrgb&w=600'
        },
        {
            id: '2', group: 'SEVENTEEN', title: 'FML - 10th Mini Album', price: 310000, totalSlots: 50, slotsLeft: 8,
            variants: ['Photobook', 'Carat Ver.', 'KiT Ver.'],
            members: ['S.Coups', 'Jeonghan', 'Joshua', 'Jun', 'Hoshi', 'Wonwoo', 'Woozi', 'DK', 'Mingyu', 'The8', 'Seungkwan', 'Vernon', 'Dino'],
            image: 'https://images.pexels.com/photos/1190297/pexels-photo-1190297.jpeg?auto=compress&cs=tinysrgb&w=600'
        },
        {
            id: '3', group: 'aespa', title: 'MY WORLD - 3rd Mini Album', price: 250000, totalSlots: 40, slotsLeft: 22,
            variants: ['Photobook', 'Digipack', 'Smini'],
            members: ['Karina', 'Giselle', 'Winter', 'Ningning'],
            image: 'https://images.pexels.com/photos/1540137/pexels-photo-1540137.jpeg?auto=compress&cs=tinysrgb&w=600'
        },
        {
            id: '4', group: 'Stray Kids', title: '5-STAR - 3rd Album', price: 295000, totalSlots: 35, slotsLeft: 3,
            variants: ['Photobook A', 'Photobook B', 'Digipack'],
            members: ['Bang Chan', 'Lee Know', 'Changbin', 'Hyunjin', 'Han', 'Felix', 'Seungmin', 'I.N'],
            image: 'https://images.pexels.com/photos/1644697/pexels-photo-1644697.jpeg?auto=compress&cs=tinysrgb&w=600'
        },
        {
            id: '5', group: 'NewJeans', title: 'Get Up - 2nd EP', price: 240000, totalSlots: 45, slotsLeft: 30,
            variants: ['Bag Ver.', 'Weverse Ver.', 'KiT Ver.'],
            members: ['Minji', 'Hanni', 'Danielle', 'Haerin', 'Hyein'],
            image: 'https://images.pexels.com/photos/1670934/pexels-photo-1670934.jpeg?auto=compress&cs=tinysrgb&w=600'
        },
        {
            id: '6', group: 'ENHYPEN', title: 'DARK BLOOD - 4th Mini Album', price: 270000, totalSlots: 30, slotsLeft: 12,
            variants: ['Photobook A', 'Photobook B', 'Digipack'],
            members: ['Heeseung', 'Jay', 'Jake', 'Sunghoon', 'Sunoo', 'Jungwon', 'Ni-ki'],
            image: 'https://images.pexels.com/photos/1540137/pexels-photo-1540137.jpeg?auto=compress&cs=tinysrgb&w=600'
        },
    ],
};

/* ============================================================
   HAMBURGER MOBILE NAV (semua halaman member)
   ============================================================ */
$(document).on('click', '#hamburger', function () {
    const $nav = $('#mobile-nav');
    $nav.toggleClass('open');
    $(this).find('svg').html($nav.hasClass('open')
        ? '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>'
        : '<line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>');
});

/* ============================================================
   AUTH MODAL
   ============================================================ */
GKP.authModal = {
    _mode: 'login',

    open(mode) {
        this._mode = mode || 'register';

        $('#auth-modal').addClass('open');

        if (this._mode === 'register') {
            $('#register-form').removeClass('hidden');
        }
    },

    close() { $('#auth-modal').removeClass('open'); },

    init() {
        /* Close on backdrop click */
        $(document).on('click', '#auth-modal', function (e) {
            if ($(e.target).is('#auth-modal')) GKP.authModal.close();
        });
        /* Close button */
        $(document).on('click', '#auth-close', () => this.close());
        /* ESC */
        $(document).on('keydown', e => { if (e.key === 'Escape') { this.close(); GKP.orderModal.close(); } });

        /* Toggle password */
        $(document).on('click', '#auth-pw-toggle', function () {
            const $inp = $('#auth-pw');
            const isText = $inp.attr('type') === 'text';
            $inp.attr('type', isText ? 'password' : 'text');
            $('#auth-eye-icon').html(isText
                ? '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>'
                : '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>');
        });

        /* Submit member */
        // $(document).on('click', '#auth-submit', function () {
        //     GKP.authModal.close();
        //     // window.location.href = GKP._memberRoot + 'catalog.html';
        //     window.location.href = '/member/catalog';
        // });

        /* Demo admin */
        $(document).on('click', '#auth-admin-demo', function () {
            GKP.authModal.close();
            window.location.href = '/admin/dashboard';
        });

        /* Switch mode */
        $(document).on('click', '#auth-switch', function (e) {
            e.preventDefault();

            GKP.showToast('Form login belum dibuat', 'default');
        });

        /* Open triggers */
        $(document).on('click', '.js-open-auth, #btn-open-auth, #mobile-btn-auth', function () {
            GKP.authModal.open('login');
        });
    },
};

/* ============================================================
   ORDER MODAL
   ============================================================ */
GKP.orderModal = {
    _albumId: null,
    _variant: null,
    _qty: 1,
    _p1: '', _p2: '', _p3: '',

    _html() {
        const album = this._album;
        if (!album) return '';
        const dp1 = Math.round(album.price * 0.35) * this._qty;
        const av2 = album.members.filter(m => m.name !== this._p1);

        const av3 = album.members.filter(
            m => m.name !== this._p1 &&
                m.name !== this._p2
        );
        const canSubmit = this._variant && this._p1;

        return `
        <h2 class="modal-title">Formulir Pemesanan</h2>
        <p class="modal-sub">${album.group_name} — ${album.title}</p>

        <div class="form-group">
            <label class="form-label">Pilih Varian Album</label>
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:8px">
                ${album.variants.map(v => `
                    <button
                        class="order-variant-btn ${this._variant == v.id ? 'selected' : ''}"
                        data-id="${v.id}">
                        ${v.name}
                    </button>`
        ).join('')}
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Jumlah Album</label>
            <div style="display:flex;align-items:center;gap:12px">
                <button class="order-qty-btn" id="qty-minus">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/></svg>
                </button>
                <span style="font-size:1.125rem;font-weight:700;color:#fff;min-width:40px;text-align:center" id="qty-val">${this._qty}</span>
                <button class="order-qty-btn" id="qty-plus">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                </button>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Prioritas Member (Photocard)</label>
            <div style="display:flex;flex-direction:column;gap:8px">
                <div class="select-wrap">
                    <select class="form-select" id="prio1">
                        <option value="">Prioritas 1</option>
                        ${album.members.map(m => `
                        <option value="${m.name}"
                            ${this._p1 === m.name ? 'selected' : ''}>
                            ${m.name}
                        </option>
                        `).join('')}
                    </select>
                    <svg class="select-arrow" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="select-wrap">
                    <select class="form-select" id="prio2">
                        <option value="">Prioritas 2</option>
                        ${av2.map(m => `
                        <option value="${m.name}"
                            ${this._p2 === m.name ? 'selected' : ''}>
                            ${m.name}
                        </option>
                        `).join('')}
                    </select>
                    <svg class="select-arrow" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="select-wrap">
                    <select class="form-select" id="prio3">
                        <option value="">Prioritas 3</option>
                        ${av3.map(m => `
                        <option value="${m.name}"
                            ${this._p3 === m.name ? 'selected' : ''}>
                            ${m.name}
                        </option>
                        `).join('')}
                    </select>
                    <svg class="select-arrow" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
            </div>
        </div>

        <div style="border-top:1px solid rgba(255,255,255,.08);padding-top:12px;margin-top:4px">
            <div style="display:flex;justify-content:space-between;font-size:.875rem;margin-bottom:4px">
                <span style="color:#94a3b8">Harga per album</span><span style="color:#fff;font-weight:500">${GKP.formatRupiah(album.price)}</span>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:.875rem;margin-bottom:4px">
                <span style="color:#94a3b8">Jumlah</span><span style="color:#fff;font-weight:500">×${this._qty}</span>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:.875rem">
                <span style="color:#94a3b8">DP 1 (35%)</span><span style="color:#f43f5e;font-weight:700;font-size:1rem">${GKP.formatRupiah(dp1)}</span>
            </div>
        </div>

        <button class="btn btn-accent" style="width:100%;padding:14px;border-radius:12px;margin-top:1rem;font-size:.875rem;${!canSubmit ? 'opacity:.4;cursor:not-allowed;background:var(--dark-600)' : ''}"
            id="order-submit" ${!canSubmit ? 'disabled' : ''}>
            Kirim Pesanan &amp; Lanjut Bayar DP 1
        </button>`;
    },

    open(album) {

        this._album = album;

        this._variant = null;
        this._qty = 1;

        this._p1 = '';
        this._p2 = '';
        this._p3 = '';

        $('#order-modal-content').html(
            this._html()
        );

        $('#order-modal').addClass('open');
    },

    close() { $('#order-modal').removeClass('open'); },

    init() {
        $(document).on('click', '#order-modal', function (e) {
            if ($(e.target).is('#order-modal')) GKP.orderModal.close();
        });
        $(document).on('click', '#order-close', () => this.close());

        /* Variant select */
        $(document).on('click', '.order-variant-btn', function () {
            GKP.orderModal._variant = $(this).data('id');
            $('#order-modal-content').html(GKP.orderModal._html());
        });

        /* Qty */
        $(document).on('click', '#qty-minus', () => { this._qty = Math.max(1, this._qty - 1); $('#order-modal-content').html(this._html()); });
        $(document).on('click', '#qty-plus', () => { this._qty = Math.min(10, this._qty + 1); $('#order-modal-content').html(this._html()); });

        /* Prio selects */
        $(document).on('change', '#prio1', function () { GKP.orderModal._p1 = $(this).val(); GKP.orderModal._p2 = ''; GKP.orderModal._p3 = ''; $('#order-modal-content').html(GKP.orderModal._html()); });
        $(document).on('change', '#prio2', function () { GKP.orderModal._p2 = $(this).val(); GKP.orderModal._p3 = ''; $('#order-modal-content').html(GKP.orderModal._html()); });
        $(document).on('change', '#prio3', function () { GKP.orderModal._p3 = $(this).val(); $('#order-modal-content').html(GKP.orderModal._html()); });

        /* Submit */
        $(document).on('click', '#order-submit', function () {
            if ($(this).prop('disabled')) return;
            GKP.orderModal.close();
            $.ajax({
                url: '/member/orders',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),

                    album_id: GKP.orderModal._album.id,
                    variant_id: GKP.orderModal._variant,
                    qty: GKP.orderModal._qty,
                    price_per_album: GKP.orderModal._album.price,
                    p1: GKP.orderModal._p1,
                    p2: GKP.orderModal._p2,
                    p3: GKP.orderModal._p3
                },

                success: function (response) {
                    GKP.showToast('Pesanan berhasil dibuat!', 'success');

                    setTimeout(() => {
                        window.location.href = '/member/catalog';
                    }, 1000);
                },

                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        /* Book buttons (album cards) */
        $(document).on('click', '.js-book-album', function () {
            const id = $(this).data('album-id');

            $.get('/member/catalog/form/' + id, function (album) {
                console.log(album);
                GKP.orderModal.open(album);
            });
        });
    },
};

/* ============================================================
   LIKE BUTTON (album cards)
   ============================================================ */
GKP.bindLikes = function () {
    $(document).on('click', '.like-btn', function (e) {
        e.stopPropagation();
        const $btn = $(this);
        const $svg = $btn.find('svg');
        const isLiked = $btn.hasClass('liked');
        if (isLiked) {
            $btn.removeClass('liked');
            $svg.attr('fill', 'transparent').attr('stroke', '#cbd5e1');
        } else {
            $btn.addClass('liked');
            $svg.attr('fill', '#f472b6').attr('stroke', '#f472b6');
        }
    });
};

/* ============================================================
   ADMIN SIDEBAR TOGGLE
   ============================================================ */
GKP.adminSidebar = {
    init() {
        $(document).on('click', '#sidebar-toggle', function () {
            const $sb = $('#admin-sidebar');
            const $main = $('#admin-main');
            $sb.toggleClass('collapsed');
            $main.toggleClass('collapsed');
        });
    },
};

/* ============================================================
   PATH HELPERS (relative paths dari sub-folder)
   ============================================================ */
// GKP._memberRoot = '';
// GKP._adminRoot  = '';

// /* Deteksi lokasi halaman saat ini */
// (function () {
//     const p = window.location.pathname;
//     if (p.includes('/pages/member/')) {
//         GKP._memberRoot = '';              /* sudah di folder member */
//         GKP._adminRoot  = '../admin/';
//     } else if (p.includes('/pages/admin/')) {
//         GKP._memberRoot = '../member/';
//         GKP._adminRoot  = '';
//     } else {
//         GKP._memberRoot = 'pages/member/'; /* root = index.html */
//         GKP._adminRoot  = 'pages/admin/';
//     }
// })();

/* ============================================================
   ORDER / VARIANT BUTTON CSS (inject once)
   ============================================================ */
$(function () {
    $('<style>').html(`
        .order-variant-btn {
            padding:12px 8px; border-radius:12px; font-size:.875rem; font-weight:500;
            border:1px solid rgba(255,255,255,.1); background:#1a1a24; color:#94a3b8;
            cursor:pointer; transition:all .2s; font-family:inherit;
        }
        .order-variant-btn:hover { border-color:rgba(255,255,255,.2); color:#fff; }
        .order-variant-btn.selected { background:rgba(225,29,72,.15); border-color:#e11d48; color:#fb7185; box-shadow:0 0 12px rgba(225,29,72,.2); }
        .order-qty-btn {
            width:40px; height:40px; border-radius:12px; background:#1a1a24;
            border:1px solid rgba(255,255,255,.1); color:#94a3b8;
            display:flex; align-items:center; justify-content:center;
            cursor:pointer; transition:all .2s; font-family:inherit;
        }
        .order-qty-btn:hover { border-color:rgba(255,255,255,.2); color:#fff; }
    `).appendTo('head');

    /* Init semua modul */
    GKP.authModal.init();
    GKP.orderModal.init();
    GKP.bindLikes();
    GKP.adminSidebar.init();
});

window.GKP = GKP;
