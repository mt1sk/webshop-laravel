$(function () {
    $(document).on('click', '.fn_cart_add', function () {
        var product_block = $(this).closest('.fn_product_block'),
            amount = Math.max(1, product_block.find('.fn_product_amount').val());
        if (isNaN(amount)) {
            amount = 1;
        }
        $.ajax({
            url: cart_ajax_url,
            method: 'post',
            data: {
                'action': 'add',
                'product_id': $(this).data('product_id'),
                'amount': amount,
                '_token': csrf_token,
            },
            success: function (result) {
                if (result.success) {
                    $('.fn_cart_informer').replaceWith(result.cart_informer);
                }
            },
            error: error_ajax_cart_function,
        });
        return false;
    });

    $(document).on('click', '.fn_cart_delete', function () {
        var is_cart_page = current_route === 'cart_page';
        $.ajax({
            url: cart_ajax_url,
            method: 'post',
            data: {
                'action': 'delete',
                'product_id': $(this).data('product_id'),
                'is_cart_page': is_cart_page,
                '_token': csrf_token,
            },
            success: function (result) {
                if (result.success) {
                    $('.fn_cart_informer').replaceWith(result.cart_informer);
                    if (is_cart_page) {
                        if (!result.is_cart_empty) {
                            $('.fn_cart_purchases').replaceWith(result.cart_purchases);
                            deliveryChange($('input[name="delivery_id"]').val());
                        } else {
                            $('.fn_content').html('<div class="checkout-area pb-30 pl-10 pt-30 pb-sm-60">\n' +
                                '            <div class="container">\n' +
                                '                <div class="row">\n' +
                                '                    <div class="col-lg-12 col-md-12 pb-20">Empty cart</div></div></div></div>');
                        }
                    }
                }
            },
            error: error_ajax_cart_function,
        });
        return false;
    });

    $(document).on('change', '.fn_purchase_amount', function () {
        var is_cart_page = current_route === 'cart_page',
            amount = Math.max(1, $(this).val());
        $.ajax({
            url: cart_ajax_url,
            method: 'post',
            data: {
                'action': 'update',
                'product_id': $(this).data('product_id'),
                'amount': amount,
                'is_cart_page': is_cart_page,
                '_token': csrf_token,
            },
            success: function (result) {
                if (result.success) {
                    $('.fn_cart_informer').replaceWith(result.cart_informer);
                    if (is_cart_page) {
                        $('.fn_cart_purchases').replaceWith(result.cart_purchases);
                        deliveryChange($('input[name="delivery_id"]').val());
                    }
                }
            },
            error: error_ajax_cart_function,
        });
        return false;
    });

    $(document).on('click', '.fn_coupon_apply', function () {
        var is_cart_page = 1;
        $('.fn_coupon_errors').remove();
        $.ajax({
            url: cart_ajax_url,
            method: 'post',
            data: {
                'action': 'coupon_apply',
                'coupon_code': $('.fn_coupon_code').val(),
                'is_cart_page': is_cart_page,
                '_token': csrf_token,
            },
            success: function (result) {
                $('.fn_cart_informer').replaceWith(result.cart_informer);
                if (is_cart_page) {
                    $('.fn_cart_purchases').replaceWith(result.cart_purchases);
                    $('.fn_cart_coupon').replaceWith(result.cart_coupon);
                    deliveryChange($('input[name="delivery_id"]').val());
                }
            },
            error: error_ajax_cart_function,
        });
        return false;
    });
});