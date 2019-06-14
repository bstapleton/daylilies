<?php

namespace App;

/**
 * Class FlowerColour
 * @package App
 */
class FlowerColour extends Colour
{
    /**
     * @var string Table for this model.
     */
    protected $table = 'flower_colours';

    /**
     * @var string Primary key for this model.
     */
    protected $primaryKey = 'id';

    /**
     * The flower colour belongs to many plants.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function plants()
    {
        return $this->belongsToMany(Plant::class, 'flower_colour_plant');
    }
}
