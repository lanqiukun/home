<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;

class LoginController extends Controller
{
    //
    public function index() {
        if (auth() -> check())
            return redirect(route('admin.index'));
        return view('admin.login.login');
    } 

    public function login(Request $request) {

        // dump($request);
        // return;

        $post_data = $this -> validate($request, [
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => '请填写账号',
            'password.required' => '请填写密码'
        ]);
            
        
        $logged =  auth() -> attempt($post_data);

        if ($logged) {


            if (session()->has('attempt_to'))
                return redirect(route(session('attempt_to')));
 

            return redirect(route('admin.index'));
        } else {
            return redirect(route('admin.login'))->withErrors(['账号或密码不正确']);
        }

    }

    public function logout() {

        session()->forget('attempt_to');
        
        auth() -> logout();
        
        return redirect(route('admin.login')) -> with('success', '退出成功！');
    }



}
