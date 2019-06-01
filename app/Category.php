<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App
 */
class Category extends Model
{
    /**
     * @var string Table name for this model.
     */
    protected $table = 'categories';

    /**
     * @var array Fillable fields for this model.
     */
    protected $fillable = ['name', 'slug', 'description', 'meta_description'];

    /**
     * A Category has many Plants.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function plants()
    {
        return $this->hasMany(Plant::class, 'category_id');
    }
}
