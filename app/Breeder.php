<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Breeder
 * @package App
 */
class Breeder extends Model
{
    /**
     * @var string Table name for this model.
     */
    protected $table = 'breeders';

    /**
     * @var array Fillable fields for this model.
     */
    protected $fillable = ['slug', 'surname', 'full_name', 'biography'];

    /**
     * A Breeder has many Plants.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function plants()
    {
        return $this->hasMany(Plant::class);
    }
}
