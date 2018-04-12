<?php

namespace Modules\Manufacturer\Listeners;

use App\Events\ProductWasCreated;
use App\Events\ProductWasUpdated;
use Modules\Manufacturer\Models\ManufacturerProductDetails;

class ManufacturerEventSubscriber
{
    public function onProductCreated(ProductWasCreated $event)
    {
        $product = $event->product;

        // filter out all non-module fields; convention <module_name>__<field_name>
        $input = array_filter($event->input, function ($key) {
            return strpos($key, config('manufacturer.name') . '__') === 0;
        }, ARRAY_FILTER_USE_KEY);

        // strip the module identifier from the keys
        $keys = array_map(function ($value) {
            return str_replace(config('manufacturer.name') . '__', '', $value);
        }, array_keys($input));

        // combine the field values with the stripped key names
        $input = array_combine($keys, $input);

        $details = ManufacturerProductDetails::createNew($product);
        $details->fill($input);

        $product->manufacturerProductDetails()->save($details);
    }

    public function onProductUpdated(ProductWasUpdated $event)
    {
        $product = $event->product;
        $details = $product->manufacturerProductDetails()->first();

        // filter out all non-module fields; convention <module_name>__<field_name>
        $input = array_filter($event->input, function ($key) {
            return strpos($key, config('manufacturer.name') . '__') === 0;
        }, ARRAY_FILTER_USE_KEY);

        // strip the module identifier from the keys
        $keys = array_map(function ($value) {
            return str_replace(config('manufacturer.name') . '__', '', $value);
        }, array_keys($input));

        // combine the field values with the stripped key names
        $input = array_combine($keys, $input);

        $details->fill($input);

        $product->manufacturerProductDetails()->save($details);
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\ProductWasCreated',
            'Modules\Manufacturer\Listeners\ManufacturerEventSubscriber@onProductCreated'
        );

        $events->listen(
            'App\Events\ProductWasUpdated',
            'Modules\Manufacturer\Listeners\ManufacturerEventSubscriber@onProductUpdated'
        );
    }
}
