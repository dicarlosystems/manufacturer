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
                ->withTrashed()
                ->where('is_deleted', '=', false)
                ->orderBy('created_at', 'desc')
                ->get();
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

        if($filter) {
            $query->where(function ($query) use ($filter) {
                    $query->where('manufacturers.name', 'like', '%'.$filter.'%');
            });
        }

        if ($userId) {
            $query->where('clients.user_id', '=', $userId);
        }

        $this->applyFilters($query, 'manufacturer');

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
