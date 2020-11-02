<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    public function tests(){
        return $this->hasMany('App\Test');
    }

    protected $fillable = [
        'user_id',
        'title',
      ];
}
