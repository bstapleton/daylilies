<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App
 *
 * The public-facing implementation of the order form should include data from its associated rows, but omit the
 * amount_fulfilled and notes fields - these can be filled in by the admin user to form part of the dispatch note to
 * attach to the order, so the customer is aware of any discrepancy between the numbers orders/received and any
 * reasoning behind it - e.g. ordered more than were in stock, or an earlier order sniped stock that this customer
 * requested.
 */
class Order extends Model
{
    /**
     * Table name for this model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * Fillable fields for this model.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'postcode', 'address', 'country', 'email_address', 'contact_number'];

    /**
     * An Order can have many order Rows.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rows()
    {
        return $this->hasMany(Row::class, 'row_id');
    }
}
