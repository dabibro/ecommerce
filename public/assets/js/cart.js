
function addToCart(id) {
    $.post(base_path + 'cart/add/' + id, {}, function (e) {
        $(ajax_response).html(e);
    });
}

document.querySelectorAll('.add-to-cart').forEach(btn => {
    btn.addEventListener('click', function () {
        let itemQty = $('.item-qty');
        let formData = new FormData();
        formData.append("action", this.dataset.action);
        formData.append("id", this.dataset.id);
        formData.append("name", this.dataset.name);
        formData.append("price", this.dataset.price);
        formData.append("image", this.dataset.image);
        if (itemQty && itemQty.val() > 0) {
            formData.append("qty", itemQty.val());
        }
        fetch(base_path + "cart/add", {
            method: "POST",
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                document.getElementById("cartCount").innerText = data.cartCount;
                if (data.redirect) {
                    location.replace(data.redirect);
                }
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
                document.getElementById("cart-subtotal").innerText = data.total;
                document.getElementById("cart-total").innerText = data.total;
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
                document.getElementById("cart-subtotal").innerText = data.total;
                document.getElementById("cart-total").innerText = data.total;
            });

    });
});

document.querySelectorAll('.checkout-update input[type=radio]').forEach(btn => {
    btn.addEventListener('click', function () {
        let formData = new FormData();
        if (this.dataset.delivery) {
            formData.append("delivery", this.dataset.delivery);
        }
        if (this.dataset.charges) {
            formData.append("charges", this.dataset.charges);
        }
        if (this.dataset.payment) {
            formData.append("payment", this.dataset.payment);
            formData.append("payment_methods", this.dataset.payment);
        }
        formData.append("pk", this.dataset.id);
        fetch(base_path + "checkout/update", {
            method: "POST",
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                orderSummary(this.dataset.id)
            });

    });
});

function orderSummary(id) {
    $.post(base_path + 'checkout/order-summary', {
        id: id
    }, function (resp) {
        $("#order-summary").html(resp);
    });
}