<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryOfChange extends Model
{
    //
    public function comment(){
       return $this->belongsTo('App\Comment', 'general_id', 'id');
   }
}
