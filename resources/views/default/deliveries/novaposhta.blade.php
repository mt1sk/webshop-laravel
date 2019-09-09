@if($errors->hasBag('delivery'))
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->getBag('delivery')->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
<div>
    <select class="fn_deliveries_module_input fn_novaposhta_city" name="novaposhta[city]">
        <option value="">Nothing selected</option>
        @foreach($novaposhta_cities as $city)
            <option value="{{$city->Ref}}" @if($novaposhta_city == $city->Ref) selected="" @endif>{{$city->DescriptionRu}}</option>
        @endforeach
    </select>

    <select class="fn_deliveries_module_input fn_novaposhta_warehouse" name="novaposhta[warehouse]">
        <option value="">Nothing selected</option>
        @foreach($novaposhta_warehouses as $warehouse)
            <option value="{{$warehouse->Ref}}" @if($novaposhta_warehouse == $warehouse->Ref) selected="" @endif>{{$warehouse->DescriptionRu}}</option>
        @endforeach
    </select>

    <input type="hidden" name="novaposhta[city_name]" value="{{$novaposhta_city_name}}" class="fn_novaposhta_city_name" />
    <input type="hidden" name="novaposhta[warehouse_name]" value="{{$novaposhta_warehouse_name}}" class="fn_novaposhta_warehouse_name" />
    {{--<input type="hidden" name="novaposhta[delivery_price]" value="{{$delivery->price}}"/>--}}
</div>