@if($product && $product->manufacturerProductDetails()->exists())
    {{ Former::populateField(config('manufacturer.name') . '__manufacturer_public_id', ($product->manufacturerProductDetails()->first()->manufacturer()->exists() ? $product->manufacturerProductDetails()->first()->manufacturer->public_id : null)) }}
    {{ Former::populateField(config('manufacturer.name') . '__part_number', $product->manufacturerProductDetails()->first()->part_number) }}
    {{ Former::populateField(config('manufacturer.name') . '__gtin', $product->manufacturerProductDetails()->first()->gtin) }}
@endif

{!! Former::select(config('manufacturer.name') . '__manufacturer_public_id')->fromQuery($manufacturers, 'name', 'public_id')->placeholder('Select the manufacturer')->label('Manufacturer') !!}
{!! Former::text(config('manufacturer.name') . '__part_number')->label('Part Number') !!}
{!! Former::text(config('manufacturer.name') . '__gtin')->label('GTIN') !!}
{!! Former::checkbox(config('manufacturer.name') . '__serialized')->label('Is Serialized') !!}
