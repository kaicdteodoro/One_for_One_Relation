<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    public function address()
    {
        return $this->hasOne('App\Address');
    }

    protected $fillable = (['name', 'phone']);
}
