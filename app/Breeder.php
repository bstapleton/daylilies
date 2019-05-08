<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Breeder extends Model
{
    /**
     * A Breeder can be the source of many Plants
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function plants()
    {
        return $this->belongsToMany(Plant::class);
    }
}
