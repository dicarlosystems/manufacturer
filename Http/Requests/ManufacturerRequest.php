<?php

namespace Modules\Manufacturer\Http\Requests;

use App\Http\Requests\EntityRequest;

class ManufacturerRequest extends EntityRequest
{
    protected $entityType = 'manufacturer';
}
