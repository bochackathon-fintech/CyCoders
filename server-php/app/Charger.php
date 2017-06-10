<?php
namespace App;

use App\User;
use App\Balance;
use App\Transaction;

class Charger
{
    public $current_vallue = 0;

    public function __construct()
    {
    }
    public static function charge($where, $to, $amount)
    {
        $amount = floatval($amount);
        $user = User::find($where);
        $receiver = User::find($to);
        $balance = Balance::where('user_id', $where)->first();
        $transaction = new Transaction();
        if($balance->available_amount >= $amount){
            $user->UserHasBalance->available_amount -= $amount;
            $user->UserHasBalance->save();
            
            $transaction->user_id=$user->id;
            $transaction->charger_id = $receiver->id;
            $transaction->amount = $amount;
            $transaction->save();
        }
       else{
           return 'mehh no credit damn';
       }
    }
}
