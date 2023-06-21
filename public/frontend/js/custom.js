$(document).ready(function () {
    loadCart();
    loadWishlist();

    $(document).on("click", ".increment-btn", function (e) {
        e.preventDefault();
        var inc_val = $(this).closest(".product_data").find(".qty-input").val();
        var value = parseInt(inc_val, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $(this).closest(".product_data").find(".qty-input").val(value);
        }
    });

    $(document).on("click", ".decrement-btn", function (e) {
        e.preventDefault();
        var dec_val = $(this).closest(".product_data").find(".qty-input").val();
        var value = parseInt(dec_val, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).closest(".product_data").find(".qty-input").val(value);
        }
    });

    $(".addToCartBtn").click(function (e) {
        e.preventDefault();
        var product_id = $(this)
            .closest(".product_data")
            .find(".product_id")
            .val();
        var product_quantity = $(this)
            .closest(".product_data")
            .find(".qty-input")
            .val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            method: "POST",
            url: "/add_to_cart",
            data: {
                product_id: product_id,
                product_quantity: product_quantity,
            },
            success: function (response) {
                swal("", response.status, "success");
                loadCart();
            },
        });
    });

    $(".addToWishlist").click(function (e) {
        e.preventDefault();
        var product_id = $(this)
            .closest(".product_data")
            .find(".product_id")
            .val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            method: "POST",
            url: "/add_to_wishlist",
            data: {
                product_id: product_id,
            },
            success: function (response) {
                swal("", response.status, "success");
                loadWishlist();
            },
        });
    });

    $(document).on("click", ".delete_cart_item", function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var product_id = $(this)
            .closest(".product_data")
            .find(".product_id")
            .val();

        $.ajax({
            method: "POST",
            url: "delete_cart_item",
            data: {
                product_id: product_id,
            },
            success: function (response) {
                loadCart();
                $(".cartItems").load(location.href + " .cartItems");
                swal("", response.status, "success");
            },
        });
    });

    $(document).on("click", ".remove-wishlist-item", function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var product_id = $(this)
            .closest(".product_data")
            .find(".product_id")
            .val();

        $.ajax({
            method: "POST",
            url: "remove-wishlist-item",
            data: {
                product_id: product_id,
            },
            success: function (response) {
                $(".wishlistItems").load(location.href + " .wishlistItems");
                loadWishlist();
                swal("", response.status, "success");
            },
        });
    });
    $(document).on("click", ".changeQuantity", function (e) {
        e.preventDefault();

        var product_id = $(this)
            .closest(".product_data")
            .find(".product_id")
            .val();
        var product_quantity = $(this)
            .closest(".product_data")
            .find(".qty-input")
            .val();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            method: "POST",
            url: "update_cart",
            data: {
                product_id: product_id,
                product_quantity: product_quantity,
            },
            success: function (response) {
                $(".cartItems").load(location.href + " .cartItems");
            },
        });
    });

    function loadCart() {
        $.ajax({
            method: "GET",
            url: "/load-cart-data",

            success: function (response) {
                $(".cart-count").html("");
                $(".cart-count").html(response.count);
            },
        });
    }

    function loadWishlist() {
        $.ajax({
            method: "GET",
            url: "/load-wishlist-data",

            success: function (response) {
                $(".wishlist-count").html("");
                $(".wishlist-count").html(response.count);
            },
        });
    }
});
