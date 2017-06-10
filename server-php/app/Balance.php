<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    //
    protected $table = 'balance';
    
    
    public function UserBalance(){
        return $this->hasOne(User::class);
    }
}
