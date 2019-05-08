<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Plant extends Model
{
    protected $table = 'plant';

    protected $primaryKey = 'id';

    public $timestamps = false;

    public static function insertData($data){
        $value=DB::table('plant')->where('id', $data['id'])->get();
        if($value->count() == 0){
            DB::table('plant')->insert($data);
        }
    }

    /**
     * A Plant has one Breeder. Technically this isn't true, but limitations on the data for the breeders makes it
     * impossible to accurately pinpoint the individual breeders for plants that have more than one.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

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
}
