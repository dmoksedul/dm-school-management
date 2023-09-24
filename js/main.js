jQuery(document).ready(function($) {
    var mySwiper = new Swiper('.swiper-container', {
        // Optional: Customize Swiper options here
        slidesPerView: 1,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
});
