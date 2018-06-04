<?php

namespace Modules\Manufacturer\Datatables;

use Utils;
use URL;
use Auth;
use App\Ninja\Datatables\EntityDatatable;

class ManufacturerDatatable extends EntityDatatable
{
    public $entityType = 'manufacturer';
    public $sortCol = 1;

    public function columns()
    {
        return [
            [
                'name',
                function ($model) {
                    return link_to('manufacturers/'.$model->public_id.'/edit', $model->name)->toHtml();
                }
            ],
            [
                'created_at',
                function ($model) {
                    return Utils::fromSqlDateTime($model->created_at);
                }
            ],
        ];
    }

    public function actions()
    {
        return [
            [
                mtrans('manufacturer', 'edit_manufacturer'),
                function ($model) {
                    return URL::to("manufacturers/{$model->public_id}/edit");
                },
                function ($model) {
                    return Auth::user()->can('editByOwner', ['manufacturer', $model->user_id]);
                }
            ],
        ];
    }

}
