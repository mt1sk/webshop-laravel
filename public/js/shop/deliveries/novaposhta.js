$(function() {
    $(document).on('change', '.fn_novaposhta_city', function() {
        deliveryChange($('input[name="delivery_id"]').val());
    });

    $(document).on('change', '.fn_novaposhta_warehouse', function() {
        $('.fn_novaposhta_warehouse_name').val($(this).find("option:selected").text());
        $('.fn_novaposhta_city_name').val($('.fn_novaposhta_city').find("option:selected").text());
    });
});