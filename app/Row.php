<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Row
 * @package App
 */
class Row extends Model
{
    /**
     * Table name for this model.
     *
     * @var string
     */
    protected $table = 'rows';

    /**
     * Fillable fields for this model.
     *
     * @var array
     */
    protected $fillable = ['amount_requested', 'amount_fulfilled', 'notes'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    /**
     * An Order row has one Plant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function plant()
    {
        return $this->hasOne(Plant::class);
    }
}
