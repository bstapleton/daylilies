<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Form
 * @package App
 */
class Form extends Model
{
    /**
     * @var string Table name for this model.
     */
    protected $table = 'forms';

    /**
     * @var array Fillable fields for this model.
     */
    protected $fillable = ['name'];

    /**
     * A Form belongs to many Plants.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function plants()
    {
        return $this->belongsToMany(Plant::class, 'form_plant');
    }
}
