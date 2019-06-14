<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Colour
 * @package App
 */
class Colour extends Model
{
    /**
     * @var array Editable fields for this model.
     */
    protected $fillable = ['name', 'slug'];
}
