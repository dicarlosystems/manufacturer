<?php

namespace Modules\Manufacturer\Models;

use App\Models\EntityModel;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManufacturerProductDetails extends EntityModel
{
    use PresentableTrait;
    use SoftDeletes;

    /**
     * @var string
     */
    protected $presenter = 'Modules\Manufacturer\Presenters\ManufacturerProductDetailsPresenter';

    /**
     * @var string
     */
    protected $fillable = [
        'manufacturer_id',
        'part_number',
        'upc',
        'serialized'
    ];

    /**
     * @var string
     */
    protected $table = 'manufacturer_product_details';

    public function getEntityType()
    {
        return 'manufacturer_product_details';
    }

    public function manufacturer()
    {
        return $this->belongsTo('Modules\Manufacturer\Models\Manufacturer');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
