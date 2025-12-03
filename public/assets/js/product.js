if (document.getElementById('product-page')) {
    var thumbs = new Swiper(".slider__thumbs", {
        direction: "vertical",
        slidesPerView: 4,
        spaceBetween: 20,
        freeMode: true,
        watchSlidesProgress: true,
    });
    var mainSlider = new Swiper(".slider__main", {
        direction: "vertical",
        spaceBetween: 20,
        thumbs: {
            swiper: thumbs,
        },
    });
}