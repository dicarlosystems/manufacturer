<?php

return [
    'product' => [
        'manufacturerProductDetails' => function ($self) {
            return $self->hasOne('Modules\Manufacturer\Models\ManufacturerProductDetails');
       }
    ],
];
