<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $guarded = ['id', 'created_at'];

    public function club()
    {
        return $this->belongsTo('App\Club');
    }

}
