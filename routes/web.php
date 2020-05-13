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
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;
use App\Models\Region;


Route::get('/', function() {
    return view('test');
});

Route::get('/db', function() {
    return DB::select('select connection_id()');
});

Route::get('/nw', function() {
    echo 2;
});

Route::get('/mail', function() {
    Mail::send(new OrderShipped);
    return "the email has been send!";
});


Route::get('/b', function() {
    echo file_get_contents('https://lowb.top');
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
