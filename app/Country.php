<?php

namespace App;

use App\Services\JsonModel\AbstractModel;

class Country extends AbstractModel
{
    protected $filename = 'countries.json';

    protected $attributes = ['name'];
}
