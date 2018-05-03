<?php

namespace Modules\Manufacturer\Listeners;

use App\Events\ProductWasCreated;
use App\Events\ProductWasUpdated;
use Modules\Manufacturer\Models\ManufacturerProductDetails;
use Modules\Manufacturer\Repositories\ManufacturerRepository;

class ProductEventSubscriber
{
    protected $manufacturerRepo;

    public function __construct(ManufacturerRepository $manufacturerRepo) {
        $this->manufacturerRepo = $manufacturerRepo;
    }

    protected function fixInput($input) {
        // filter out all non-module fields; convention <module_name>__<field_name>
        $input = array_filter($input, function ($key) {
            return strpos($key, config('manufacturer.name') . '__') === 0;
        }, ARRAY_FILTER_USE_KEY);

        // strip the module identifier from the keys
        $keys = array_map(function ($value) {
            return str_replace(config('manufacturer.name') . '__', '', $value);
        }, array_keys($input));

        // combine the field values with the stripped key names
        $input = array_combine($keys, $input);

        // replace the manufacturer public ID with the internal ID
        $input['manufacturer_id'] = $this->manufacturerRepo->findByPublicIdsWithTrashed($input['manufacturer_public_id'])->first()->id;

        return $input;
    }

    public function onProductCreated(ProductWasCreated $event)
    {
        $product = $event->product;

        $input = $this->fixInput($event->input);

        $details = ManufacturerProductDetails::createNew();
        $details->fill($input);

        $product->manufacturerProductDetails()->save($details);
    }

    public function onProductUpdated(ProductWasUpdated $event)
    {
        $product = $event->product;
        $details = $product->manufacturerProductDetails()->first();

         $input = $this->fixInput($event->input);

        if(!$details) {
            $details = ManufacturerProductDetails::createNew();
        }

        $details->fill($input);

        $product->manufacturerProductDetails()->save($details);
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\ProductWasCreated',
            'Modules\Manufacturer\Listeners\ProductEventSubscriber@onProductCreated'
        );

        $events->listen(
            'App\Events\ProductWasUpdated',
            'Modules\Manufacturer\Listeners\ProductEventSubscriber@onProductUpdated'
        );
    }
}
