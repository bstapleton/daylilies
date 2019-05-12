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
    protected $table = 'plant';

    /**
     * @var string Primary table key.
     */
    protected $primaryKey = 'id';

    /**
     * @var array Editable fields for this model.
     */
    protected $fillable = ['slug', 'name', 'category_id', 'year_added', 'breeders', 'year_bred', 'height', 'flower_size', 'genome_id', 'foliage_id', 'seasons', 'forms', 'description', 'in_stock', 'price', 'quantity_in_stock'];

    /**
     * Dirty, dirty injection of values. Remove before taking down maintenance mode on the live site, but after setup.
     * TODO: Remove before taking out of maintenance mode.
     * @param $data
     */
    public static function insertData($data){
        $value=DB::table('plant')->where('id', $data['id'])->get();
        if($value->count() == 0){
            DB::table('plant')->insert($data);
        }
    }

    /**
     * A Plant belongs to one Category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * A Plant can have many Breeders. The vast majority have one, but they are jointly hybridised between two breeders
     * occasionally.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function breeder()
    {
        return $this->belongsToMany(Breeder::class, 'breeder_plant');
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
}
