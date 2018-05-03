<?php

namespace Modules\Manufacturer\Http\ViewComposers;

use Illuminate\View\View;
use Modules\Manufacturer\Repositories\ManufacturerRepository;

class ProductViewComposer
{
    protected $manufacturerRepo;

    public function __construct(ManufacturerRepository $manufacturerRepo)
    {
        $this->manufacturerRepo = $manufacturerRepo;
    }

    public function compose(View $view)
    {
        $manufacturers = $this->manufacturerRepo->find()->get()->toArray();
        $view->with('manufacturers', $manufacturers);
    }
}
