<?php

namespace App\Models;

use App\Breeder;
use App\Category;
use App\Season;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Plant extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'plants';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['slug', 'name', 'category_id', 'year_added', 'breeder_id', 'year_bred', 'height', 'flower_size', 'genome', 'foliage', 'season', 'description', 'in_stock', 'quantity_in_stock'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

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

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
