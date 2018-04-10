<?php

namespace Modules\Manufacturer\;

use App\Providers\AuthServiceProvider;

class ManufacturerAuthProvider extends AuthServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \Modules\Manufacturer\Models\Manufacturer::class => \Modules\Manufacturer\Policies\ManufacturerPolicy::class,
    ];
}
