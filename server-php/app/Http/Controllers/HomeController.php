<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use LaravelFCM\Message\Topics;
use Firebase\Token\TokenGenerator;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $optionBuilder = new OptionsBuilder();
  $optionBuilder->setTimeToLive(60*20);

  $notificationBuilder = new PayloadNotificationBuilder('my title');
  $notificationBuilder->setBody('Hello world')
  				    ->setSound('default');

  $dataBuilder = new PayloadDataBuilder();
  $dataBuilder->addData(['a_data' => 'my_data']);

  $option = $optionBuilder->build();
  $notification = $notificationBuilder->build();
  $data = $dataBuilder->build();
$generator = new TokenGenerator('AAAAG5UgDZQ:APA91bHjWRw1vvwv9vYYWg5zz9Xnks0Sw9GHPkQNlmDhqn8d4Zpp1hiiwD1eKpsIRAtXz9tDFSk5GfNNWC1ZSkTdB3gDkk4qI6iJHlYIylDnctkTu-WoRHuErxjcSRVT1VawKxioajpB');
  $token = $generator
      ->setOptions(array(
          'admin' => true,
          'debug' => true
      ))
      ->setData(array('uid' => 'exampleID'))
      ->create();

  $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
  $data = $downstreamResponse->numberSuccess();
  return view('home',['dat'=> $data]);
    }
}
