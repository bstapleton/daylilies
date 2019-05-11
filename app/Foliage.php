<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Foliage
 * @package App
 */
class Foliage extends Model
{
    /**
     * @var string Table name for this model.
     */
    protected $table = 'foliages';

    /**
     * A Foliage type has many Plants.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function plants()
    {
        return $this->hasMany(Plant::class);
    }
}
