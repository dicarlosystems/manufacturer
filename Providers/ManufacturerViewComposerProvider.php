<?php

namespace Modules\Manufacturer\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ManufacturerViewComposerProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            'accounts.product', 'Modules\Manufacturer\Http\ViewComposers\ProductViewComposer'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
