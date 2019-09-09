$(function () {
    $(document).on('click', '.fn_payment_method', function (event) {
        event.preventDefault();
        paymentChange($(this).data('id'));
        return false;
    });
    $(document).on('click', '.fn_delivery_method', function (event) {
        event.preventDefault();
        deliveryChange($(this).data('id'));
        return false;
    });
});

function deliveryChange(delivery_id) {
    var payment_id = parseInt($('input[name="payment_id"]').val());
    delivery_id = parseInt(delivery_id);
    if (isNaN(delivery_id)) {
        return false;
    }
    if (isNaN(payment_id)) {
        payment_id = '';
    }
    $('input[name="delivery_id"]').val(delivery_id);

    $requestData = {
        'delivery_id': delivery_id,
        'payment_id': payment_id,
    };
    $('.fn_deliveries_module_input').each(function() {
        $requestData[$(this).attr('name')] = $(this).val();
    });

    $.ajax({
        url: delivery_payment_ajax_url,
        method: 'get',
        data: $requestData,
        success: function (result) {
            if (result.success) {
                $('.fn_cart_delivery_payment').replaceWith(result.cart_delivery_payment);
                $('.fn_novaposhta_warehouse').trigger('change');
            }
        },
        error: error_ajax_cart_function,
    });
}

function paymentChange(payment_id) {
    $('input[name="payment_id"]').val(payment_id);
}