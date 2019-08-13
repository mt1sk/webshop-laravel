$(function () {
    $(document).on('click', '.fn_wishlist', function() {
        var elem = $(this),
            /*product_block = elem.closest('.fn_product_block'),*/
            action = elem.hasClass('fn_selected') ? 'delete' : 'add',
            is_wishlist_page = current_route === 'wishlist_page';
        $.ajax({
            url: wishlist_ajax_url,
            method: 'post',
            data: {
                'action': action,
                'product_id': elem.data('product_id'),
                'is_wishlist_page': is_wishlist_page,
                '_token': csrf_token,
            },
            success: function (result) {
                if (result.success) {
                    $('.fn_wishlist_informer').replaceWith(result.wishlist_informer);
                    if (is_wishlist_page) {
                        if (!result.is_wishlist_empty) {
                            $('.fn_wishlist_items').replaceWith(result.wishlist_items);
                        } else {
                            $('.fn_content').html('<div class="main-shop-page pt-20 pb-100 ptb-sm-60">\n' +
                                '            <div class="container">\n' +
                                '                <div class="row">\n' +
                                '                    <div class="col-lg-12 order-1 order-lg-2">WishList is empty.</div></div></div></div>');
                        }
                    } else {
                        elem.toggleClass('fn_selected');

                        var text = elem.data('toggle_text'),
                            title = elem.find('span').text();
                        elem.data('toggle_text', title);
                        elem.find('span').text(text);
                    }
                }
            },
            error: error_ajax_cart_function,
        });
        return false;
    });
});