@if($product)
    {{ Former::populateField(config('manufacturer.name') . '__ean13', $product->manufacturerProductDetails()->first()->ean13) }}
    {{ Former::populateField(config('manufacturer.name') . '__upca', $product->manufacturerProductDetails()->first()->upca) }}
    {{ Former::populateField(config('manufacturer.name') . '__barcode', $product->manufacturerProductDetails()->first()->barcode) }}
@endif

{!! Former::text(config('manufacturer.name') . '__ean13')->label('EAN13') !!}
{!! Former::text(config('manufacturer.name') . '__upca')->label('UPC-A') !!}
{!! Former::text(config('manufacturer.name') . '__barcode')->label('Bar Code') !!}