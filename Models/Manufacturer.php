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
    protected $fillable = ["name"];

    /**
     * @var string
     */
    protected $table = 'manufacturers';

    public function getEntityType()
    {
        return 'manufacturer';
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User')->withTrashed();
    }

    public function manufacturerProductDetails() {
        return $this->hasMany('Modules\Manufacturer\Models\ManufacturerProductDetails');
    }
}
