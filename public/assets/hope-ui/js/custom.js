document.addEventListener("DOMContentLoaded", function () {
    const priceSlider = document.getElementById('price-slider');
    const minDisplay = document.getElementById('min-price-display');
    const maxDisplay = document.getElementById('max-price-display');
    const minInput = document.getElementById('min-price');
    const maxInput = document.getElementById('max-price');
    const minPrice = parseInt(document.getElementById('min-sale-price').value) || 0;
    const maxPrice = parseInt(document.getElementById('max-sale-price').value) || 0;
    // Initialize slider
    noUiSlider.create(priceSlider, {
        start: [500, 20000],
        connect: true,
        range: {
            'min': minPrice,
            'max': maxPrice,
        },
        format: {
            to: value => Math.round(value),
            from: value => Number(value)
        }
    });
    priceSlider.noUiSlider.on('update', function (values) {
        const minVal = values[0];
        const maxVal = values[1];
        minDisplay.innerText = minVal;
        maxDisplay.innerText = maxVal;
        minInput.value = minVal;
        maxInput.value = maxVal;
    });
});

function updateSortOrder(select) {
    const order = select.value;
    const url = new URL(window.location.href);

    if (order) {
        url.searchParams.set('order', order); // add or update ?order=
    } else {
        url.searchParams.delete('order'); // remove if empty
    }

    window.location.href = url.toString(); // reload with new URL
}

document.addEventListener('DOMContentLoaded', function () {
    const fadeSection = document.querySelector('.fade-in-section');
    if (!fadeSection) return;
    const onScroll = () => {
        const rect = fadeSection.getBoundingClientRect();
        if (rect.top < window.innerHeight - 100) {
            fadeSection.classList.add('visible');
            window.removeEventListener('scroll', onScroll);
        }
    };
    window.addEventListener('scroll', onScroll);
    onScroll();
});

if ($('.app-slider').length > 0) {
    const options = {
        centeredSlides: false,
        loop: false,
        slidesPerView: 4,
        autoplay: false,
        spaceBetween: 32,
        breakpoints: {
            270: {slidesPerView: 1},
            550: {slidesPerView: 2},
            991: {slidesPerView: 3},
            1400: {slidesPerView: 3},
            1500: {slidesPerView: 3},
            1920: {slidesPerView: 3},
            2040: {slidesPerView: 3},
            2440: {slidesPerView: 3}
        },
        pagination: {
            el: '.swiper-pagination'
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        },
        // And if we need scrollbar
        scrollbar: {
            el: '.swiper-scrollbar'
        }
    }
    let swiper = new Swiper('.app-slider', options);

    document.addEventListener('theme_scheme_direction', (e) => {
        swiper.destroy(true, true)
        setTimeout(() => {
            swiper = new Swiper('.app-slider', options);
        }, 500);
    })
}

//--------------testimonial---------------//
if ($('#testimonial-slider').length > 0) {
    const options = {
        centeredSlides: false,
        loop: false,
        slidesPerView: 4,
        autoplay: false,
        spaceBetween: 32,
        breakpoints: {
            270: {slidesPerView: 1},
            550: {slidesPerView: 1},
            991: {slidesPerView: 1},
            1400: {slidesPerView: 1},
            1500: {slidesPerView: 1},
            1920: {slidesPerView: 1},
            2040: {slidesPerView: 1},
            2440: {slidesPerView: 1}
        },
        pagination: {
            el: '.swiper-pagination'
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        },
        // And if we need scrollbar
        scrollbar: {
            el: '.swiper-scrollbar'
        }
    }
    let swiper = new Swiper('#testimonial-slider', options);

    document.addEventListener('theme_scheme_direction', (e) => {
        swiper.destroy(true, true)
        setTimeout(() => {
            swiper = new Swiper('#testimonial-slider', options);
        }, 500);
    })
}
if ($('#testimonial-one-slider').length > 0) {
    const options = {
        centeredSlides: false,
        loop: false,
        slidesPerView: 4,
        autoplay: false,
        spaceBetween: 32,
        breakpoints: {
            270: {slidesPerView: 1},
            320: {slidesPerView: 1},
            550: {slidesPerView: 2},
            991: {slidesPerView: 3},
            1400: {slidesPerView: 3},
            1500: {slidesPerView: 3},
            1920: {slidesPerView: 3},
            2040: {slidesPerView: 4},
            2440: {slidesPerView: 4}
        },
        pagination: {
            el: '.swiper-pagination'
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        },
        // And if we need scrollbar
        scrollbar: {
            el: '.swiper-scrollbar'
        }
    }
    let swiper = new Swiper('#testimonial-one-slider', options);

    document.addEventListener('theme_scheme_direction', (e) => {
        swiper.destroy(true, true)
        setTimeout(() => {
            swiper = new Swiper('#testimonial-one-slider', options);
        }, 500);
    })
}

if ($('#testimonial-slider-two').length > 0) {
    const options = {
        centeredSlides: false,
        loop: false,
        slidesPerView: 4,
        autoplay: false,
        spaceBetween: 32,
        breakpoints: {
            270: {slidesPerView: 1},
            550: {slidesPerView: 1.5},
            991: {slidesPerView: 2},
            1400: {slidesPerView: 2},
            1500: {slidesPerView: 2.2},
            1920: {slidesPerView: 2.2},
            2040: {slidesPerView: 2.2},
            2440: {slidesPerView: 2.2}
        },
        pagination: {
            el: '.swiper-pagination'
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        },
        // And if we need scrollbar
        scrollbar: {
            el: '.swiper-scrollbar'
        }
    }
    let swiper = new Swiper('#testimonial-slider-two', options);

    document.addEventListener('theme_scheme_direction', (e) => {
        swiper.destroy(true, true)
        setTimeout(() => {
            swiper = new Swiper('#testimonial-slider-two', options);
        }, 500);
    })
}

/*------------Minus-plus--------------*/
const plusBtns = document.querySelectorAll('.iq-quantity-plus')
const minusBtns = document.querySelectorAll('.iq-quantity-minus')
const updateQtyBtn = (elem, value) => {
    const oldValue = elem.closest('[data-qty="btn"]').querySelector('[data-qty="input"]').value
    const newValue = Number(oldValue) + Number(value)
    if (newValue >= 1) {
        elem.closest('[data-qty="btn"]').querySelector('[data-qty="input"]').value = newValue
    }
}
Array.from(plusBtns, (elem) => {
    elem.addEventListener('click', (e) => {
        updateQtyBtn(elem, 1)
    })
})
Array.from(minusBtns, (elem) => {
    elem.addEventListener('click', (e) => {
        updateQtyBtn(elem, -1)
    })
})