<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Award
 * @package App
 */
class Award extends Model
{
    /**
     * @var bool Disable timestamps.
     */
    public $timestamps = false;

    /**
     * @var string Table name for this model.
     */
    protected $table = 'awards';

    /**
     * @var array Fillable fields for this model.
     */
    protected $fillable = ['name', 'description'];

    /**
     * An award belongs to many Plants.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function plants()
    {
        return $this->belongsToMany(Plant::class, 'award_plant');
    }
}
