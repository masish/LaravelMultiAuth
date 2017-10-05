<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $guarded = ['id', 'created_at'];

    public function players()
    {
        return $this->hasMany('App\Player');
    }
}
