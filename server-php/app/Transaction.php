<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\User;
class Transaction extends Model
{
      // Import Notifiable Trait
    use Notifiable;
    public function TransactionUser(){
        return $this->hasOne(User::class,'id','user_id');
    }
        public function ReceivingUser(){
        return $this->hasOne(User::class,'id','charger_id');
    }
     public function routeNotificationForSlack() {
        return $this->slack_webhook_url;
    }
    
}
