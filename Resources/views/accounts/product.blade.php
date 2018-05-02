@if($product && $product->manufacturerProductDetails()->exists())
    {{ Former::populateField(config('manufacturer.name') . '_part_number', $product->manufacturerProductDetails()->first()->part_number) }}
    {{ Former::populateField(config('manufacturer.name') . '_ean13', $product->manufacturerProductDetails()->first()->ean13) }}
    {{ Former::populateField(config('manufacturer.name') . '_upca', $product->manufacturerProductDetails()->first()->upca) }}
    {{ Former::populateField(config('manufacturer.name') . '_barcode', $product->manufacturerProductDetails()->first()->barcode) }}
@endif

{!! Former::text(config('manufacturer.name') . '_part_number')->label('Part Number') !!}
{!! Former::text(config('manufacturer.name') . '_ean13')->label('EAN13') !!}
{!! Former::text(config('manufacturer.name') . '_upca')->label('UPC-A') !!}
{!! Former::text(config('manufacturer.name') . '_barcode')->label('Bar Code') !!}