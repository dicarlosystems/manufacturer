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
        $query = DB::table('manufacturer__manufacturers')
                    ->where('manufacturer.account_id', '=', \Auth::user()->account_id)
                    ->select(

                        'manufacturer.public_id',
                        'manufacturer.deleted_at',
                        'manufacturer.created_at',
                        'manufacturer.is_deleted',
                        'manufacturer.user_id'
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
