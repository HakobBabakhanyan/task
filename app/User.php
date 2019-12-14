<?php

namespace App;

use App\Services\JsonModel\AbstractModel;

class User extends AbstractModel
{
    protected $filename = 'users.json';

    protected $attributes = [
        'first_name', 'last_name', 'email', 'country_id', 'role'
    ];

    protected $relations = [
        'country' => [
            'key' => 'country_id',
            'model' => Country::class,
        ]
    ];
}
