<?php
use App\Notifications\TaskCompleted;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/posts/create', 'PostsController@create');
Route::resource('posts', 'PostsController');
Route::post('posts/changeStatus', array('as' => 'changeStatus', 'uses' => 'PostsController@changeStatus'));

Auth::routes();
Route::resource('charge','ChargingController');
Route::get('/home', 'HomeController@index');
Route::resource('user-settings','UserSettingsController');
Route::resource('users','UserController');

Route::get('mail',function(){
  dd(Config::get('mail'));
});
