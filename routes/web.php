<?php

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

use Illuminate\Http\Request;

Route::get('/', function() {
    return view('test');
});

Route::get('/b', function() {
    if (request() -> header('X-Requested-With') =="XMLHttpRequest")
        return 'is ajax';
    else
        return 'is not ajax';
});

Route::get('/collect', 'CollectorController@index') ->name('collect');

Route::match(['get', 'post'], '/test', function(Request $request) {
    return 123;
    dd($request -> all());

    $res = ['status' => '0', 'msg' => 'success'];

    return json_encode($res);
});



//后台路由
include base_path('routes/admin.php');
