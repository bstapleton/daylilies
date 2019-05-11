<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;

class Plant extends \App\Plant
{
    use CrudTrait;

    /**
     * @var string
     */
    protected $table = 'plants';
}
