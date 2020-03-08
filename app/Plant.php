<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Plant
 * @package App
 */
class Plant extends Model
{
    /**
     * @var string Table for this model
     */
    protected $table = 'plants';

    /**
     * @var string Primary table key.
     */
    protected $primaryKey = 'id';

    /**
     * @var array Editable fields for this model.
     */
    protected $fillable = ['slug', 'name', 'category_id', 'year_added', 'hybridisers', 'year_registered', 'height', 'flower_size', 'genome_id', 'foliage_id', 'seasons', 'forms', 'description', 'in_stock', 'price', 'quantity_in_stock'];

    /**
     * A Plant belongs to one Category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * A Plant can have many Hybridisers. The vast majority have one, but they are jointly hybridised between two hybridisers
     * occasionally.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function hybridisers()
    {
        return $this->belongsToMany(Hybridiser::class, 'hybridiser_plant');
    }

    /**
     * A Plant can have one or more Flower Colour.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function flower_colours()
    {
        return $this->belongsToMany(FlowerColour::class, 'flower_colour_plant');
    }

    /**
     * A Plant can have one or more Stamen Colour.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function stamen_colours()
    {
        return $this->belongsToMany(StamenColour::class, 'stamen_colour_plant');
    }

    /**
     * A Plant can have one or more Throat Colour.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function throat_colours()
    {
        return $this->belongsToMany(ThroatColour::class, 'throat_colour_plant');
    }

    /**
     * A Plant belongs to one Genome type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function genome()
    {
        return $this->belongsTo(Genome::class);
    }

    /**
     * A Plant belongs to one Foliage type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function foliage()
    {
        return $this->belongsTo(Foliage::class);
    }

    /**
     * A Plant can have many Seasons. Most times it is a single season, but it can be more.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'season_plant');
    }

    /**
     * A Plant can have many registered Forms. Since we're doing categories for sorting, a plant categorised as 'spider'
     * may actually be an 'unusual form' as its registered form.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function forms()
    {
        return $this->belongsToMany(Form::class, 'form_plant');
    }

    /**
     * A Plant can appear on many different order Rows.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rows()
    {
        return $this->hasMany(Row::class);
    }

    /**
     * A Plant can have many Awards.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function awards()
    {
        return $this->belongsToMany(Award::class, 'award_plant');
    }
}
