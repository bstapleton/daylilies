<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Genome
 * @package App
 */
class Genome extends Model
{
    /**
     * @var string Table name for this model.
     */
    protected $table = 'genomes';

    /**
     * A Genome type has many Plants.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function plants()
    {
        return $this->hasMany(Plant::class);
    }
}
