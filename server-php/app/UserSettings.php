<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    //
    public function UserofSetting(){
      return $this->hasOne(User::class,'id','user_id');
    }
}
