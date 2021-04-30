<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable =
        ([
            'street',
            'number',
            'district',
            'city',
            'uf',
            'cep'
        ]);

    public function client() {
        return $this->belongsTo('App\Client','client_id', 'id');
    }
}
