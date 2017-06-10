<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Charger;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function UserHasBalance(){
        return $this->hasOne(Balance::class);
    }
    
    public function routeNotificationForSlack() {
        return 'https://hooks.slack.com/services/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';
    }
}
