<?php

namespace App;

/**
 * Class ThroatColour
 * @package App
 */
class ThroatColour extends Colour
{
    /**
     * @var string Table for this model.
     */
    protected $table = 'throat_colours';

    /**
     * @var string Primary key for this model.
     */
    protected $primaryKey = 'id';

    /**
     * The throat colour belongs to many plants.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function plants()
    {
        return $this->belongsToMany(Plant::class, 'throat_colour_plant');
    }
}
