<?php

namespace App\Http\Controllers;
use App\Notifications\TaskCompleted;

use Illuminate\Http\Request;
use App\Balance;
use App\Charger;
use App\User;
use App\Transaction;
use Illuminate\Support\Facades\Input;
use Response;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class ChargingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $transactions = Transaction::all();
            $users = User::all();
        return view('transactions.index', ['transactions' => $transactions,'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
            $transaction = new Transaction();
            Charger::charge($request->user,$request->receiver,$request->amount);

            $transaction->user_id = $request->user;
            $transaction->charger_id = $request->receiver;
            $transaction->amount = $request->amount;
            $transaction->save();
            $resp = clone $transaction;
            $resp->user = $transaction->TransactionUser;
            $resp->receiver = $transaction->ReceivingUser;
            $user = User::find($request->user);
            $user->notify(new TaskCompleted);
            return response()->json($resp);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
