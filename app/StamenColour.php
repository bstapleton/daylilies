<?php

namespace App;

/**
 * Class StamenColour
 * @package App
 */
class StamenColour extends Colour
{
    /**
     * @var string Table for this model.
     */
    protected $table = 'stamen_colours';

    /**
     * @var string Primary key for this model.
     */
    protected $primaryKey = 'id';

    /**
     * The stamen colour belongs to many plants.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function plants()
    {
        return $this->belongsToMany(Plant::class, 'stamen_colour_plant');
    }
}
