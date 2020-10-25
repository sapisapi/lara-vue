<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    public function user()
   {
     return $this->belongsTo('App\User');
   }

   protected $fillable = [
    'user_id',
    'content_0',
    'question',
    'content_1',
    'answer'
  ];

}
