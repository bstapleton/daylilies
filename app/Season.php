<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Season
 * @package App
 */
class Season extends Model
{
    /**
     * @var string Table name for this model.
     */
    protected $table = 'seasons';

    /**
     * A Season belongs to many Plants.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function plants()
    {
        return $this->belongsToMany(Plant::class, 'season_plant');
    }
}
