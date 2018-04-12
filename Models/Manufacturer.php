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
    protected $fillable = [
        "name"
    ];

    /**
     * @var string
     */
    protected $table = 'manufacturer__manufacturers';

    public function getEntityType()
    {
        return 'manufacturer';
    }

}
