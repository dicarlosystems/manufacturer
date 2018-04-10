<?php

namespace Modules\Manufacturer\Models;

use App\Models\EntityModel;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manufacturer extends EntityModel
{
    use PresentableTrait;
    use SoftDeletes;

    /**
     * @var string
     */
    protected $presenter = 'Modules\Manufacturer\Presenters\ManufacturerPresenter';

    /**
     * @var string
     */
    protected $fillable = [""];

    /**
     * @var string
     */
    protected $table = 'manufacturer';

    public function getEntityType()
    {
        return 'manufacturer';
    }

}
