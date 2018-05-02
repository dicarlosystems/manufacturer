<?php

namespace Modules\Manufacturer\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class ManufacturerEventServiceProvider extends EventServiceProvider
{
    protected $listen = [
        //
    ];

    protected $subscribe = [
        'Modules\Manufacturer\Listeners\ProductEventSubscriber',
    ];
}
