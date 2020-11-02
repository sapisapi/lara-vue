<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Test;
use App\Title;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:sanctum')->group(function(){

    Route::get('/user', function(Request $request){

        return $request->user();

    });

    Route::get('/authenticated',function(){
        return true;
    });

    Route::get('/show_test/{id}', function (Request $request, $id) {
        return json_encode(Test::where('user_id',$request->user()->id)->where('title_id', $id)->get());
    });

    Route::get('/show_list', function (Request $request) {
        return json_encode(Title::where('user_id',$request->user()->id)->get());
    });

    Route::resource('test', 'TestController',['only' => ['update', 'store', 'destroy', 'show']]);

    Route::resource('list', 'TitleController',['only' => ['update', 'store', 'destroy']]);

});
Route::post('logout', 'UserController@logout');

Route::post('register','UserController@register');
Route::post('login','UserController@login');
