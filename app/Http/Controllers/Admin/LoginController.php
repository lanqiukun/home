<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends Controller
{
    //
    use ThrottlesLogins;

    public function index() {
        // auth() ->guard('myguard') ->login(User::find(1));
        if (auth()  -> guard('myguard') -> check())
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
            

        $logged =  auth()  -> guard('myguard')-> attempt($post_data);

        if ($logged) {


            if (session()->has('attempt_to'))
            {
                $continue = session('attempt_to');
                session()->forget('attempt_to');
                return redirect(route($continue));
            }
 

            return redirect(route('admin.index'));
        } else {
            return redirect(route('admin.login'))->withErrors(['账号或密码不正确']);
        }

    }

    public function logout(Request $request) {

        // return $request->all();


        
        auth()  -> guard('myguard')-> logout();
        
        return session() -> flash('success', '退出成功！');
    }



}
