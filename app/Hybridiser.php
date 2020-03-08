<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Hybridiser
 * @package App
 */
class Hybridiser extends Model
{
    /**
     * @var string Table name for this model.
     */
    protected $table = 'hybridisers';

    /**
     * @var array Fillable fields for this model.
     */
    protected $fillable = ['slug', 'surname', 'full_name', 'biography'];

    /**
     * A Hybridiser belongs to many Plants.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function plants()
    {
        return $this->belongsToMany(Plant::class, 'hybridiser_plant');
    }
}
