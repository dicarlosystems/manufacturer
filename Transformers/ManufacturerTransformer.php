<?php

namespace Modules\Manufacturer\Transformers;

use Modules\Manufacturer\Models\Manufacturer;
use App\Ninja\Transformers\EntityTransformer;

/**
 * @SWG\Definition(definition="Manufacturer", @SWG\Xml(name="Manufacturer"))
 */

class ManufacturerTransformer extends EntityTransformer
{
    /**
    * @SWG\Property(property="id", type="integer", example=1, readOnly=true)
    * @SWG\Property(property="user_id", type="integer", example=1)
    * @SWG\Property(property="account_key", type="string", example="123456")
    * @SWG\Property(property="updated_at", type="integer", example=1451160233, readOnly=true)
    * @SWG\Property(property="archived_at", type="integer", example=1451160233, readOnly=true)
    */

    /**
     * @param Manufacturer $manufacturer
     * @return array
     */
    public function transform(Manufacturer $manufacturer)
    {
        return array_merge($this->getDefaults($manufacturer), [
            
            'id' => (int) $manufacturer->public_id,
            'updated_at' => $this->getTimestamp($manufacturer->updated_at),
            'archived_at' => $this->getTimestamp($manufacturer->deleted_at),
        ]);
    }
}
