@if($product && $product->manufacturerProductDetails()->exists())
    {{ Former::populateField(config('manufacturer.name') . '__manufacturer_public_id', ($product->manufacturerProductDetails()->first()->manufacturer()->exists() ? $product->manufacturerProductDetails()->first()->manufacturer->public_id : null)) }}
    {{ Former::populateField(config('manufacturer.name') . '__part_number', $product->manufacturerProductDetails()->first()->part_number) }}
    {{ Former::populateField(config('manufacturer.name') . '__upc', $product->manufacturerProductDetails()->first()->upc) }}
    {{ Former::populateField(config('manufacturer.name') . '__serialized', $product->manufacturerProductDetails()->first()->serialized) }}
@endif

@render('App\Http\ViewComponents\SimpleSelectComponent', [
    'entityType' => 'manufacturer',
    'items' => $manufacturers,
    'itemLabel' => 'name',
    'fieldLabel' => 'fieldLabel',
    'module' => 'manufacturer',
    'selectId' => config('manufacturer.name') . '__manufacturer_public_id',
    ])

{!! Former::text(config('manufacturer.name') . '__part_number')->label('Part Number') !!}
{!! Former::text(config('manufacturer.name') . '__upc')->label('UPC') !!}
{!! Former::checkbox(config('manufacturer.name') . '__serialized')->label('Is Serialized')->value(1) !!}
