@if($product && $product->manufacturerProductDetails()->exists())
    {{ Former::populateField(config('manufacturer.name') . '__manufacturer_public_id', $product->manufacturerProductDetails()->first()->manufacturer->public_id) }}
    {{ Former::populateField(config('manufacturer.name') . '__part_number', $product->manufacturerProductDetails()->first()->part_number) }}
    {{ Former::populateField(config('manufacturer.name') . '_barcode_ean13', $product->manufacturerProductDetails()->first()->ean13) }}
    {{ Former::populateField(config('manufacturer.name') . '__upca', $product->manufacturerProductDetails()->first()->upca) }}
    {{ Former::populateField(config('manufacturer.name') . '__barcode', $product->manufacturerProductDetails()->first()->barcode) }}
@endif

{!! Former::select(config('manufacturer.name') . '__manufacturer_public_id')->fromQuery($manufacturers, 'name', 'public_id')->placeholder('Select the manufacturer')->label('Manufacturer') !!}
{!! Former::text(config('manufacturer.name') . '__part_number')->label('Part Number') !!}
{!! Former::text(config('manufacturer.name') . '__ean13')->label('EAN13') !!}
{!! Former::text(config('manufacturer.name') . '__upca')->label('UPC-A') !!}
{!! Former::text(config('manufacturer.name') . '__barcode')->label('Bar Code') !!}
