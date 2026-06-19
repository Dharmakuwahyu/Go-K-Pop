/**
 * GO K-POP — js/admin-campaign.js
 * - Tab: Kelola Campaign / Buka Lapak Baru
 * - Edit campaign (isi form dengan data existing)
 * - Tutup campaign (confirm modal + warning jika ada pesanan)
 * - Hapus campaign (tanpa pesanan)
 * - Upload foto cover (klik + drag & drop + preview + ganti/hapus)
 * - Tambah/hapus tag varian & member
 */
$(function () {

    /* ══════════════════════════════════════════
       STATE
    ══════════════════════════════════════════ */
    let editMode = false;   // true = sedang edit campaign
    let editId = null;    // id campaign yang diedit
    let pendingAction = null;    // { type: 'close'|'delete', id, title }

    /* ══════════════════════════════════════════
       TABS
    ══════════════════════════════════════════ */
    function showTab(tab) {
        if (tab === 'list') {
            $('#panel-list').removeClass('hidden');
            $('#panel-form').addClass('hidden');
            $('#tab-list').addClass('active');
            $('#tab-form').removeClass('active');
            $('#breadcrumb-label').text('Campaign');
        } else {
            $('#panel-list').addClass('hidden');
            $('#panel-form').removeClass('hidden');
            $('#tab-list').removeClass('active');
            $('#tab-form').addClass('active');
            $('#breadcrumb-label').text(editMode ? 'Edit Campaign' : 'Buka Lapak Baru');
        }
    }

    $('.camp-tab').on('click', function () {
        const tab = $(this).data('tab');
        if (tab === 'form' && editMode) {
            // Konfirmasi batal edit
        }
        if (tab === 'list') {
            resetForm();
            editMode = false;
            editId = null;
            $('#tab-form-label').text('Buka Lapak Baru');
        }
        showTab(tab);
    });

    /* Tombol "Buka Lapak Baru" dari panel list */
    $('#btn-new-campaign').on('click', function () {
        resetForm();
        editMode = false;
        editId = null;
        $('#form-title').text('Buka Lapak Baru');
        $('#form-subtitle').text('Buat campaign group order album baru');
        $('#btn-publish-label').text('Simpan & Publikasikan');
        $('#btn-batal-tambah').removeClass('hidden');
        $('#slots-left-group').addClass('hidden');
        $('#tab-form-label').text('Buka Lapak Baru');
        showTab('form');
    });

    /* Tombol Batal tambah */
    $('#btn-batal-tambah').on('click', function () {
        resetForm();
        editMode = false;
        editId = null;
        $('#tab-form-label').text('Buka Lapak Baru');
        showTab('list');
    });

    /* ══════════════════════════════════════════
       TOMBOL EDIT CAMPAIGN
    ══════════════════════════════════════════ */
    // $(document).on('click', '.btn-camp-edit', function () {

    //     editMode = true;
    //     editId = $(this).data('id');

    //     $('#c-group').val($(this).data('group'));
    //     $('#c-title').val($(this).data('title'));
    //     $('#c-price').val($(this).data('price'));
    //     $('#c-slots').val($(this).data('slots'));
    //     $('#c-slots-left').val($(this).data('slots-left'));
    //     const variants = $(this).data('variants');
    //     const members = $(this).data('members');

    //     $('#variant-tags').empty();
    //     $('#member-tags').empty();

    //     variants.forEach(function (item) {
    //         addTagEl('variant-tags', item);
    //     });

    //     members.forEach(function (item) {
    //         addTagEl('member-tags', item);
    //     });

    //     $('#slots-left-group').removeClass('hidden');

    //     $('#form-title').text('Edit Campaign');
    //     $('#form-subtitle').text(
    //         'Perbarui data campaign: ' + $(this).data('title')
    //     );

    //     $('#btn-publish-label').text('Simpan Perubahan');
    //     $('#btn-batal-edit').removeClass('hidden');
    //     $('#tab-form-label').text('Edit Campaign');

    //     showTab('form');
    // });

    /* ══════════════════════════════════════════
       TOMBOL TUTUP CAMPAIGN
    ══════════════════════════════════════════ */
    $(document).on('click', '.btn-camp-close', function () {
        const id = $(this).data('id');
        const title = $(this).data('title');
        const hasOrders = $(this).data('has-orders');

        pendingAction = { type: 'close', id, title, hasOrders };

        $('#confirm-title').text('Tutup Lapak "' + title + '"?');
        $('#confirm-desc').text('Lapak yang ditutup tidak akan menerima pesanan baru. Pesanan yang sudah masuk tetap diproses.');

        if (hasOrders) {
            $('#confirm-note').html('<span style="color:var(--gold-400)">⚠️ Terdapat pesanan aktif di campaign ini. Pastikan semua pesanan sudah diproses sebelum menutup lapak.</span>');
        } else {
            $('#confirm-note').text('');
        }

        $('#confirm-ok-label').text('Ya, Tutup Lapak');
        $('#btn-confirm-ok').css('background', 'rgba(239,68,68,.85)');
        $('#confirm-modal').addClass('open');
    });

    /* ══════════════════════════════════════════
       TOMBOL HAPUS CAMPAIGN (tanpa pesanan)
    ══════════════════════════════════════════ */
    $(document).on('click', '.btn-camp-delete', function () {
        const id = $(this).data('id');
        const title = $(this).data('title');

        pendingAction = { type: 'delete', id, title };

        $('#confirm-title').text('Hapus Campaign "' + title + '"?');
        $('#confirm-desc').text('Campaign yang dihapus tidak dapat dikembalikan. Semua data campaign akan hilang.');
        $('#confirm-note').html('<span style="color:var(--accent-300)">❌ Aksi ini tidak dapat dibatalkan.</span>');
        $('#confirm-ok-label').text('Ya, Hapus Permanen');
        $('#btn-confirm-ok').css('background', '#dc2626');
        $('#confirm-modal').addClass('open');
    });

    /* ══════════════════════════════════════════
       CONFIRM MODAL
    ══════════════════════════════════════════ */
    $('#btn-confirm-cancel').on('click', function () {
        $('#confirm-modal').removeClass('open');
        pendingAction = null;
    });

    $(document).on('click', '#confirm-modal', function (e) {
        if ($(e.target).is('#confirm-modal')) {
            $(this).removeClass('open');
            pendingAction = null;
        }
    });

    $('#btn-confirm-ok').on('click', function () {
        if (!pendingAction) return;

        if (pendingAction.type === 'close') {
            // Update badge jadi "Ditutup"
            const $card = $('[data-campaign-id="' + pendingAction.id + '"]');
            $card.find('.camp-status-badge')
                .removeClass('camp-badge-aktif')
                .addClass('camp-badge-closed')
                .text('Ditutup');
            // Ganti tombol Tutup jadi Buka Kembali
            $card.find('.btn-camp-close')
                .removeClass('btn-camp-close')
                .addClass('btn-camp-open')
                .html('<svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 11V6a2 2 0 0 0-2-2a2 2 0 0 0-2 2v0"/><path d="M14 10V4a2 2 0 0 0-2-2a2 2 0 0 0-2 2v2"/><path d="M10 10.5V6a2 2 0 0 0-2-2a2 2 0 0 0-2 2v8"/><path d="M18 8a2 2 0 1 1 4 0v6a8 8 0 0 1-8 8h-2c-2.8 0-4.5-.86-5.99-2.34l-3.6-3.6a2 2 0 0 1 2.83-2.82L7 15"/></svg> Buka Kembali')
                .attr('data-id', pendingAction.id)
                .attr('data-title', pendingAction.title);
            GKP.showToast('Lapak "' + pendingAction.title + '" berhasil ditutup.', 'success');

        } else if (pendingAction.type === 'delete') {
            $('[data-campaign-id="' + pendingAction.id + '"]').fadeOut(300, function () { $(this).remove(); });
            GKP.showToast('Campaign "' + pendingAction.title + '" berhasil dihapus.', 'success');
        }

        $('#confirm-modal').removeClass('open');
        pendingAction = null;
    });

    /* Buka Kembali campaign yang sudah ditutup */
    $(document).on('click', '.btn-camp-open', function () {
        const id = $(this).data('id');
        const title = $(this).data('title');
        const $card = $('[data-campaign-id="' + id + '"]');
        $card.find('.camp-status-badge').removeClass('camp-badge-closed').addClass('camp-badge-aktif').text('Aktif');
        $(this).removeClass('btn-camp-open').addClass('btn-camp-close')
            .attr('data-has-orders', 'true')
            .html('<svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg> Tutup');
        GKP.showToast('Lapak "' + title + '" dibuka kembali.', 'success');
    });

    /* ══════════════════════════════════════════
       UPLOAD FOTO COVER
    ══════════════════════════════════════════ */
    $('#cover-upload-wrap').on('click', function (e) {
        if ($(e.target).closest('#btn-cover-ganti, #btn-cover-hapus').length) return;
        document.getElementById('cover-file-input').click();
    });

    $('#btn-cover-ganti').on('click', function (e) {
        e.stopPropagation();
        document.getElementById('cover-file-input').click();
    });

    document.getElementById('cover-file-input').addEventListener('change', function () {
        const file = this.files && this.files[0];
        if (file) showCoverPreview(file);
    });

    $('#cover-upload-wrap').on('dragover dragenter', function (e) {
        e.preventDefault();
        $(this).css('border-color', 'rgba(225,29,72,.6)');
    });
    $('#cover-upload-wrap').on('dragleave', function () {
        $(this).css('border-color', 'rgba(255,255,255,.12)');
    });
    $('#cover-upload-wrap').on('drop', function (e) {
        e.preventDefault();
        $(this).css('border-color', 'rgba(255,255,255,.12)');
        const file = e.originalEvent.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            showCoverPreview(file);
        } else {
            GKP.showToast('File harus berupa gambar (JPG/PNG).', 'error');
        }
    });

    function showCoverPreview(file) {
        const url = URL.createObjectURL(file);
        $('#cover-preview-img').attr('src', url);
        $('#cover-empty').addClass('hidden');
        $('#cover-preview').removeClass('hidden');
        $('#cover-upload-wrap').css({ 'border': 'none', 'cursor': 'default' });
    }

    function resetCover() {
        $('#cover-preview-img').attr('src', '');
        $('#cover-preview').addClass('hidden');
        $('#cover-empty').removeClass('hidden');
        document.getElementById('cover-file-input').value = '';
        $('#cover-upload-wrap').css({
            'border': '2px dashed rgba(255,255,255,.12)',
            'cursor': 'pointer'
        });
    }

    $('#btn-cover-hapus').on('click', function (e) {
        e.stopPropagation();
        resetCover();
    });

    /* ══════════════════════════════════════════
       TAG VARIAN & MEMBER
    ══════════════════════════════════════════ */
    window.addTagEl = function (listId, val) {

        let inputName =
            listId === 'variant-tags'
                ? 'variants[]'
                : 'members[]';

        $('#' + listId).append(`
        <div class="tag-item">
            <span>${val}</span>

            <input
                type="hidden"
                name="${inputName}"
                value="${val}"
            >

            <button class="tag-remove" type="button">
                x
            </button>
        </div>
    `);
    }

    function addTag(inputId, listId) {
        const $input = $('#' + inputId);
        const val = $input.val().trim();
        if (!val) return;
        const dup = $('#' + listId + ' .tag-item').filter(function () {
            return $(this).find('span').text().trim() === val;
        }).length > 0;
        if (dup) { GKP.showToast('Sudah ada: ' + val, 'error'); return; }
        addTagEl(listId, val);
        $input.val('').focus();
    }

    $('#btn-add-variant').on('click', () => addTag('variant-input', 'variant-tags'));
    $('#variant-input').on('keydown', function (e) { if (e.key === 'Enter') { e.preventDefault(); addTag('variant-input', 'variant-tags'); } });
    $('#btn-add-member').on('click', () => addTag('member-input', 'member-tags'));
    $('#member-input').on('keydown', function (e) { if (e.key === 'Enter') { e.preventDefault(); addTag('member-input', 'member-tags'); } });
    $(document).on('click', '.tag-remove', function () { $(this).closest('.tag-item').remove(); });

    /* ══════════════════════════════════════════
       RESET FORM
    ══════════════════════════════════════════ */
    function resetForm() {
        $('#c-group, #c-title, #c-price, #c-slots, #c-slots-left').val('');
        $('#variant-tags, #member-tags').empty();
        $('#slots-left-group').addClass('hidden');
        $('#btn-batal-tambah').removeClass('hidden');
        $('#form-title').text('Buka Lapak Baru');
        $('#form-subtitle').text('Buat campaign group order album baru');
        $('#btn-publish-label').text('Simpan & Publikasikan');
        resetCover();
    }

    //     /* ══════════════════════════════════════════
    //    FORM UPDATE - COVER UPLOAD
    // ══════════════════════════════════════════ */

    //     $('#cover-upload-wrap-update').on('click', function (e) {
    //         if ($(e.target).closest('#btn-cover-ganti-update, #btn-cover-hapus-update').length) return;
    //         document.getElementById('cover-file-input-update').click();
    //     });

    //     $('#btn-cover-ganti-update').on('click', function (e) {
    //         e.stopPropagation();
    //         document.getElementById('cover-file-input-update').click();
    //     });

    //     document.getElementById('cover-file-input-update')
    //         ?.addEventListener('change', function () {
    //             const file = this.files && this.files[0];
    //             if (file) showCoverPreviewUpdate(file);
    //         });

    //     $('#cover-upload-wrap-update').on('dragover dragenter', function (e) {
    //         e.preventDefault();
    //         $(this).css('border-color', 'rgba(225,29,72,.6)');
    //     });

    //     $('#cover-upload-wrap-update').on('dragleave', function () {
    //         $(this).css('border-color', 'rgba(255,255,255,.12)');
    //     });

    //     $('#cover-upload-wrap-update').on('drop', function (e) {
    //         e.preventDefault();

    //         $(this).css('border-color', 'rgba(255,255,255,.12)');

    //         const file = e.originalEvent.dataTransfer.files[0];

    //         if (file && file.type.startsWith('image/')) {
    //             showCoverPreviewUpdate(file);
    //         }
    //     });

    //     function showCoverPreviewUpdate(file) {
    //         const url = URL.createObjectURL(file);

    //         $('#cover-preview-img-update').attr('src', url);
    //         $('#cover-empty-update').addClass('hidden');
    //         $('#cover-preview-update').removeClass('hidden');

    //         $('#cover-upload-wrap-update').css({
    //             border: 'none',
    //             cursor: 'default'
    //         });
    //     }

    //     function resetCoverUpdate() {
    //         $('#cover-preview-img-update').attr('src', '');

    //         $('#cover-preview-update').addClass('hidden');
    //         $('#cover-empty-update').removeClass('hidden');

    //         document.getElementById('cover-file-input-update').value = '';

    //         $('#cover-upload-wrap-update').css({
    //             border: '2px dashed rgba(255,255,255,.12)',
    //             cursor: 'pointer'
    //         });
    //     }

    //     $('#btn-cover-hapus-update').on('click', function (e) {
    //         e.stopPropagation();
    //         resetCoverUpdate();
    //     });


    //     /* ══════════════════════════════════════════
    //        FORM UPDATE - TAG VARIAN
    //     ══════════════════════════════════════════ */

    //     function addTagUpdate(inputId, listId) {

    //         const $input = $('#' + inputId);
    //         const val = $input.val().trim();

    //         if (!val) return;

    //         const dup = $('#' + listId + ' .tag-item').filter(function () {
    //             return $(this).find('span').text().trim() === val;
    //         }).length > 0;

    //         if (dup) return;

    //         let inputName =
    //             listId === 'variant-tags-update'
    //                 ? 'variants[]'
    //                 : 'members[]';

    //         $('#' + listId).append(`
    //         <div class="tag-item">
    //             <span>${val}</span>

    //             <input
    //                 type="hidden"
    //                 name="${inputName}"
    //                 value="${val}"
    //             >

    //             <button class="tag-remove-update" type="button">
    //                 x
    //             </button>
    //         </div>
    //     `);

    //         $input.val('').focus();
    //     }

    //     $('#btn-add-variant-update').on('click', function () {
    //         addTagUpdate('variant-input-update', 'variant-tags-update');
    //     });

    //     $('#variant-input-update').on('keydown', function (e) {
    //         if (e.key === 'Enter') {
    //             e.preventDefault();
    //             addTagUpdate('variant-input-update', 'variant-tags-update');
    //         }
    //     });


    //     /* ══════════════════════════════════════════
    //        FORM UPDATE - TAG MEMBER
    //     ══════════════════════════════════════════ */

    //     $('#btn-add-member-update').on('click', function () {
    //         addTagUpdate('member-input-update', 'member-tags-update');
    //     });

    //     $('#member-input-update').on('keydown', function (e) {
    //         if (e.key === 'Enter') {
    //             e.preventDefault();
    //             addTagUpdate('member-input-update', 'member-tags-update');
    //         }
    //     });


    //     /* HAPUS TAG */

    //     $(document).on('click', '.tag-remove-update', function () {
    //         $(this).closest('.tag-item').remove();
    //     });


    //     /* ══════════════════════════════════════════
    //        RESET FORM UPDATE
    //     ══════════════════════════════════════════ */

    //     function resetFormUpdate() {

    //         $('#c-group-update').val('');
    //         $('#c-title-update').val('');
    //         $('#c-price-update').val('');
    //         $('#c-slots-update').val('');
    //         $('#c-slots-left-update').val('');

    //         $('#variant-tags-update').empty();
    //         $('#member-tags-update').empty();

    //         $('#slots-left-group-update').addClass('hidden');

    //         resetCoverUpdate();
    //     }

    //     $('#btn-batal-edit').on('click', function () {
    //         resetFormUpdate();

    //         $('#panel-form-update').addClass('hidden');
    //         $('#panel-list').removeClass('hidden');
    //     });

    //     // menampilkan form update campaign
    //     $(document).on('click', '.btn-camp-edit', function () {

    //         $('#panel-list').addClass('hidden');
    //         $('#panel-form').addClass('hidden');
    //         $('#panel-form-update').removeClass('hidden');

    //         // isi data form update
    //         $('#c-group-update').val($(this).data('group'));
    //         $('#c-title-update').val($(this).data('title'));
    //         $('#c-price-update').val($(this).data('price'));
    //         $('#c-slots-update').val($(this).data('slots'));
    //         $('#c-slots-left-update').val($(this).data('slots-left'));

    //         // kosongkan tag lama
    //         $('#variant-tags-update').empty();
    //         $('#member-tags-update').empty();

    //         // isi varian
    //         $(this).data('variants').forEach(function (item) {
    //             addTagUpdateManual('variant-tags-update', item, 'variants[]');
    //         });

    //         // isi member
    //         $(this).data('members').forEach(function (item) {
    //             addTagUpdateManual('member-tags-update', item, 'members[]');
    //         });

    //     });


    //     function addTagUpdateManual(listId, val, inputName) {
    //         $('#' + listId).append(`
    //         <div class="tag-item">
    //             <span>${val}</span>

    //             <input
    //                 type="hidden"
    //                 name="${inputName}"
    //                 value="${val}"
    //             >

    //             <button class="tag-remove-update" type="button">
    //                 x
    //             </button>
    //         </div>
    //     `);
    //     }
    /* ══════════════════════════════════════════
       FORM UPDATE - COVER UPLOAD
    ══════════════════════════════════════════ */

    $('#cover-upload-wrap-update').on('click', function (e) {
        if ($(e.target).closest('#btn-cover-ganti-update, #btn-cover-hapus-update').length) return;

        document.getElementById('cover-file-input-update').click();
    });

    $('#btn-cover-ganti-update').on('click', function (e) {
        e.stopPropagation();
        document.getElementById('cover-file-input-update').click();
    });

    document.getElementById('cover-file-input-update')
        ?.addEventListener('change', function () {

            const file = this.files && this.files[0];

            if (file) {
                showCoverPreviewUpdate(file);
            }
        });

    $('#cover-upload-wrap-update').on('dragover dragenter', function (e) {
        e.preventDefault();
        $(this).css('border-color', 'rgba(225,29,72,.6)');
    });

    $('#cover-upload-wrap-update').on('dragleave', function () {
        $(this).css('border-color', 'rgba(255,255,255,.12)');
    });

    $('#cover-upload-wrap-update').on('drop', function (e) {

        e.preventDefault();

        $(this).css('border-color', 'rgba(255,255,255,.12)');

        const file = e.originalEvent.dataTransfer.files[0];

        if (file && file.type.startsWith('image/')) {
            showCoverPreviewUpdate(file);
        }
    });

    function showCoverPreviewUpdate(file) {

        const url = URL.createObjectURL(file);

        $('#cover-preview-img-update').attr('src', url);

        $('#cover-empty-update').addClass('hidden');
        $('#cover-preview-update').removeClass('hidden');

        $('#cover-upload-wrap-update').css({
            border: 'none',
            cursor: 'default'
        });
    }

    // function showExistingCoverUpdate(url) {
    window.showExistingCoverUpdate = function(url) {

        $('#cover-preview-img-update').attr('src', url);

        $('#cover-empty-update').addClass('hidden');
        $('#cover-preview-update').removeClass('hidden');

        $('#cover-upload-wrap-update').css({
            border: 'none',
            cursor: 'default'
        });
    }

    function resetCoverUpdate() {

        $('#cover-preview-img-update').attr('src', '');

        $('#cover-preview-update').addClass('hidden');
        $('#cover-empty-update').removeClass('hidden');

        document.getElementById('cover-file-input-update').value = '';

        $('#cover-upload-wrap-update').css({
            border: '2px dashed rgba(255,255,255,.12)',
            cursor: 'pointer'
        });
    }

    $('#btn-cover-hapus-update').on('click', function (e) {

        e.stopPropagation();

        resetCoverUpdate();
    });


    /* ══════════════════════════════════════════
       FORM UPDATE - TAG
    ══════════════════════════════════════════ */

    function addTagUpdate(inputId, listId) {

        const $input = $('#' + inputId);
        const val = $input.val().trim();

        if (!val) return;

        const dup = $('#' + listId + ' .tag-item').filter(function () {
            return $(this).find('span').text().trim() === val;
        }).length > 0;

        if (dup) {
            GKP.showToast('Sudah ada: ' + val, 'error');
            return;
        }

        let inputName =
            listId === 'variant-tags-update'
                ? 'variants[]'
                : 'members[]';

        addTagUpdateManual(listId, val, inputName);

        $input.val('').focus();
    }

    // function addTagUpdateManual(listId, val, inputName) {
    window.addTagUpdateManual = function (listId, val, inputName) {

        $('#' + listId).append(`
        <div class="tag-item">
            <span>${val}</span>

            <input
                type="hidden"
                name="${inputName}"
                value="${val}"
            >

            <button
                type="button"
                class="tag-remove-update"
            >
                x
            </button>
        </div>
    `);
    }

    /* VARIAN */

    $('#btn-add-variant-update').on('click', function () {
        addTagUpdate(
            'variant-input-update',
            'variant-tags-update'
        );
    });

    $('#variant-input-update').on('keydown', function (e) {

        if (e.key === 'Enter') {

            e.preventDefault();

            addTagUpdate(
                'variant-input-update',
                'variant-tags-update'
            );
        }
    });

    /* MEMBER */

    $('#btn-add-member-update').on('click', function () {
        addTagUpdate(
            'member-input-update',
            'member-tags-update'
        );
    });

    $('#member-input-update').on('keydown', function (e) {

        if (e.key === 'Enter') {

            e.preventDefault();

            addTagUpdate(
                'member-input-update',
                'member-tags-update'
            );
        }
    });

    /* HAPUS TAG */

    $(document).on('click', '.tag-remove-update', function () {
        $(this).closest('.tag-item').remove();
    });


    /* ══════════════════════════════════════════
       RESET FORM UPDATE
    ══════════════════════════════════════════ */

    function resetFormUpdate() {

        $('#campaign-form-update')[0].reset();

        $('#variant-tags-update').empty();
        $('#member-tags-update').empty();

        $('#slots-left-group-update').addClass('hidden');

        resetCoverUpdate();
    }


    /* ══════════════════════════════════════════
       BATAL EDIT
    ══════════════════════════════════════════ */

    $('#btn-batal-edit').on('click', function () {

        resetFormUpdate();

        $('#panel-form-update').addClass('hidden');
        $('#panel-list').removeClass('hidden');
    });


    /* ══════════════════════════════════════════
       BUKA FORM EDIT
    ══════════════════════════════════════════ */

    $(document).on('click', '.btn-camp-edit', function () {

        // resetFormUpdate();
        if (!window.isRestoreUpdate) {
            resetFormUpdate();
        }

        const id = $(this).data('id');

        $('#panel-list').addClass('hidden');
        $('#panel-form').addClass('hidden');
        $('#panel-form-update').removeClass('hidden');

        $('#c-group-update').val($(this).data('group'));
        $('#c-title-update').val($(this).data('title'));
        $('#c-price-update').val($(this).data('price'));
        $('#c-slots-update').val($(this).data('slots'));
        $('#c-slots-left-update').val($(this).data('slots-left'));

        $('#slots-left-group-update').removeClass('hidden');

        const variants = $(this).data('variants') || [];
        const members = $(this).data('members') || [];

        variants.forEach(function (item) {
            addTagUpdateManual(
                'variant-tags-update',
                item,
                'variants[]'
            );
        });

        members.forEach(function (item) {
            addTagUpdateManual(
                'member-tags-update',
                item,
                'members[]'
            );
        });

        // update action form
        $('#campaign-form-update').attr(
            'action',
            '/admin/campaign/' + id
        );

        // tampilkan cover lama jika ada
        const cover = $(this).data('cover');

        if (cover) {
            showExistingCoverUpdate(cover);
        }
    });

});
