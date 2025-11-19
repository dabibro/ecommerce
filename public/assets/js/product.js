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


function addToCart(id) {
    $.post(base_path + 'cart/add/' + id, {}, function (e) {
        $(ajax_response).html(e);
    });
}

document.querySelectorAll('.add-to-cart').forEach(btn => {
    btn.addEventListener('click', function () {
        let formData = new FormData();
        formData.append("id", this.dataset.id);
        formData.append("name", this.dataset.name);
        formData.append("price", this.dataset.price);
        formData.append("image", this.dataset.image);
        fetch(base_path + "cart/add", {
            method: "POST",
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                document.getElementById("cartCount").innerText = data.cartCount;
            });

    });
});

document.querySelectorAll('.delete-item').forEach(btn => {
    btn.addEventListener('click', function () {
        let formData = new FormData();
        formData.append("id", this.dataset.id);
        fetch(base_path + "cart/remove", {
            method: "POST",
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                document.getElementById("cartCount").innerText = data.cartCount;
                document.getElementById("row-" + this.dataset.id).remove();
                // location.reload();
            });

    });
});
document.querySelectorAll('.iq-qty-btn button').forEach(btn => {
    btn.addEventListener('click', function () {
        let formData = new FormData();
        formData.append("id", this.dataset.id);
        formData.append("qty", $("#row-" + this.dataset.id + " .input-display").val());
        fetch(base_path + "cart/update", {
            method: "POST",
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                document.getElementById("cartCount").innerText = data.cartCount;
                $("#row-" + this.dataset.id + " #cost").html(data.itemCost);
                // location.reload();
            });

    });
});


document.getElementById("place-order").addEventListener("click", function (e) {
    e.preventDefault();
    const btn = this;
    btn.textContent = "Processing...";
    btn.classList.add("disabled");
    $.post(base_path + 'cart/submit', {}, function (e) {
        $(ajax_response).html(e);
        btn.textContent = "Checkout";
        btn.classList.remove("disabled");
    });

    /* fetch("cart/checkout", {
         method: "POST",
     })
         .then(res => res.json())
         .then(data => {
             if (data.status === "success") {
                 window.location.href = "order_success.php?order_id=" + data.order_id;
             } else {
                 alert(data.message);

             }

         })
         .catch(err => {
             console.error(err);
             alert("Something went wrong!");
             btn.textContent = "Checkout";
             btn.classList.remove("disabled");
         });*/
});



