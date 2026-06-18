/**
 * GO K-POP — js/landing.js
 * Carousel hero, inisialisasi halaman landing
 */
$(function () {

    /* ── Carousel ─────────────────────────────────────────── */
    let current = 0;
    const total  = $('.carousel-slide').length;
    let timer    = null;

    function goTo(idx) {
        current = (idx + total) % total;
        $('.carousel-slide').removeClass('active');
        $(`.carousel-slide[data-idx="${current}"]`).addClass('active');
        $('.carousel-dot').removeClass('active');
        $(`.carousel-dot[data-idx="${current}"]`).addClass('active');
    }

    function startAuto() {
        stopAuto();
        timer = setInterval(() => goTo(current + 1), 5000);
    }

    function stopAuto() { clearInterval(timer); }

    startAuto();

    $('#carousel-prev').on('click', () => { goTo(current - 1); stopAuto(); startAuto(); });
    $('#carousel-next').on('click', () => { goTo(current + 1); stopAuto(); startAuto(); });
    $(document).on('click', '.carousel-dot', function () {
        goTo(parseInt($(this).data('idx')));
        stopAuto(); startAuto();
    });

    /* ── Hero CTA scroll ──────────────────────────────────── */
    $('#btn-scroll-catalog').on('click', function () {
        $('html, body').animate({ scrollTop: $('#catalog').offset().top }, 600);
    });

    /* ── Book Slot → open order modal ────────────────────── */
    $(document).on('click', '.btn-book[data-album-id]', function () {
        const id = $(this).data('album-id');
        GKP.orderModal.open(String(id));
    });

    /* ── Smooth anchor links ──────────────────────────────── */
    $('a[href^="#"]').on('click', function (e) {
        const target = $($(this).attr('href'));
        if (target.length) {
            e.preventDefault();
            $('html, body').animate({ scrollTop: target.offset().top }, 600);
        }
    });

});
