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
     * TODO: Remove this when normalised
     */
    protected $table = 'plant';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

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
     * A Plant has one Category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne(Category::class);
    }

    /**
     * A Plant has one Breeder. Technically this isn't true, but limitations on the data for the breeders makes it
     * impossible to accurately pinpoint the individual breeders for plants that have more than one.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function breeder()
    {
        return $this->hasOne(Breeder::class);
    }

    /**
     * A Plant can have many Seasons. Most times it is a single season, but it can be up to two.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seasons()
    {
        return $this->hasMany(Season::class);
    }
}
