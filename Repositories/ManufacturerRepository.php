<?php

namespace Modules\Manufacturer\Repositories;

use DB;
use Modules\Manufacturer\Models\Manufacturer;
use App\Ninja\Repositories\BaseRepository;
//use App\Events\ManufacturerWasCreated;
//use App\Events\ManufacturerWasUpdated;

class ManufacturerRepository extends BaseRepository
{
    public function getClassName()
    {
        return 'Modules\Manufacturer\Models\Manufacturer';
    }

    public function all()
    {
        return Manufacturer::scope()
                ->orderBy('created_at', 'desc')
                ->withTrashed();
    }

    public function find($filter = null, $userId = false)
    {
        $query = DB::table('manufacturers')
                    ->where('manufacturers.account_id', '=', \Auth::user()->account_id)
                    ->select(
                        'manufacturers.name',
                        'manufacturers.public_id',
                        'manufacturers.deleted_at',
                        'manufacturers.created_at',
                        'manufacturers.is_deleted',
                        'manufacturers.user_id'
                    );

        $this->applyFilters($query, 'manufacturer');

        if ($userId) {
            $query->where('clients.user_id', '=', $userId);
        }

        /*
        if ($filter) {
            $query->where();
        }
        */

        return $query;
    }

    public function save($data, $manufacturer = null)
    {
        $entity = $manufacturer ?: Manufacturer::createNew();

        $entity->fill($data);
        $entity->save();

        /*
        if (!$publicId || $publicId == '-1') {
            event(new ClientWasCreated($client));
        } else {
            event(new ClientWasUpdated($client));
        }
        */

        return $entity;
    }
}
