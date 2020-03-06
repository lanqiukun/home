<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Node;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mail;

class UserController extends BaseController
{
    //

    public function index()
    {

        //->withTrashed()表示已经软删除的也要查询出来（如果模型中没有引入软删除就不用->withTrashed()）
        // $user_data = User::orderBy('id', 'desc')->withTrashed()->paginate($this->pagesize);
        $user_data = User::orderBy('id', 'desc')->paginate($this->pagesize);

        return view('admin.user.index', ["total" => User::count()], compact('user_data'));
    }

    public function create(Request $request)
    {

        if (request() -> isMethod('get'))
        {
            $all_role = Role::all();
            return view('admin.user.create', compact('all_role'));
        }    
            


        if (request() -> isMethod('post'))
        {
            $post_data = $this->validate($request, [
                'username' => 'required|unique:users,username',
                'truename' => 'required',
                'password' => 'required|confirmed',
                'sex' => 'required',
                'phone' => 'required|phone',

                'email' => 'required',

            ], [
                'username.required' => '请填写账号',
                'truename.required' => '请填写真实姓名',
                'password.required' => '请填写密码',

                'phone.required' => '请填写手机号码',

                'email.required' => '请填写邮箱地址',

            ]);

            $user_model = User::create($request->except(['_token', 'password_confirmation']));

            // dump($user_model);

            $email_template = 'email.signup';
            $from = '1543323033@qq.com';
            $sender = 'admin';
            $to   = $request->get('email');
            $receiver = $request->get('username');

            Mail::send($email_template, ["username" => $request->username], function(\Illuminate\Mail\Message $message) use($from, $sender, $to, $receiver) {
                
                $message->from($from, $sender);

                $message->to($to, $receiver);

                $message->subject('you successfully join us!');

                $message->attach('nginx-doc.pdf', ['as' => 'nginx_documentation.pdf', 'mime' => 'application/pdf']);
            });

            return redirect(route('admin.user.create'))->with('success', '新增用户成功！');

        }
    }

    public function delete(int $target)
    {
        $removed = User::find($target);

        if ($removed)
        {
            $removed->delete();
            return json_encode(['code' => 0, 'msg' => '用户成功删除', 'target' => $target]);
        }
        else {
            if (User::onlyTrashed() -> find($target))
                return json_encode(['code' => 1, 'msg' => '用户在此操作之前已被删除', 'target' => $target]);
            else
                return json_encode(['code' => 2, 'msg' => '用户不存在', 'target' => $target]);
        }

        //在配置了软删除的时候，强制删除
        //User::find($target)->forceDelete();

    }

    public function trashed()
    {
        //->withTrashed()表示已经软删除的也要查询出来（如果模型中没有引入软删除就不用->withTrashed()）
        $user_data = User::onlyTrashed()-> orderBy('deleted_at', 'desc')->paginate($this->pagesize);

        return view('admin.user.trashed', ['total' => User::onlyTrashed()->count()], compact('user_data'));
    }

    public function restore(int $target) {
        $removed = User::onlyTrashed()->find($target);



        if ($removed)
        {
            $removed->restore();
            return json_encode(['code' => 0, 'msg' => '数据恢复成功', 'target' => $target]);
        }
        else {
            if (User::find($target))
                return json_encode(['code' => 1, 'msg' => '数据在此操作之前已被恢复', 'target' => $target]);
            else
                return json_encode(['code' => 2, 'msg' => '数据不存在', 'target' => $target]);
        }

        //在配置了软删除的时候，强制删除
        //User::find($target)->forceDelete();
    }

    public function delete_all(Request $request) {
        


        User::destroy($request->get("targets"));

    }


    public function restore_all(Request $request) {
        
        User::whereIn('id', $request->get("targets"))->restore();

    }


    public function update(Request $request) {

        if ($request -> isMethod('get'))
        {
            $user = auth() -> user();
            return view('admin.user.update');
        }


        if ($request -> isMethod('post'))
        {
            $users = User::withTrashed()->where('username', $request->get('username'))->get()->all();
        
            if (count($users) && $users[0]->id != auth()->user()->id)
                return redirect(route('admin.user.profile'))->withErrors('已有相同的用户名');
            
            $post_data = $this->validate($request, [
                'truename' => 'required',
                'phone' => 'required|phone',
                'sex' => 'required'
            ], [
                'truename.required' => '请填写真实姓名',
            ]);
    
            $user = User::find(auth()->user()->id);
    
            $user->update($request->only(['truename', 'phone', 'sex']));
    
            return redirect(route('admin.user.update'))->with('success', '修改成功');
        }
        
    }       

    public function change_password(Request $request) {

        if (request() -> isMethod('get'))
            return view('admin.user.change_password');

        if (request() -> isMethod('post'))
        {
            $this->validate($request, [
                'current_password' => 'required',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required'
            ], [
                'current_password.required' => '请输入当前密码',
                'password.required' => '请输入新密码',
                'password_confirmation.required' => '请输入重新输入新密码',
    
            ]
            );
    
            $current_password_hash = User::find(auth()->user()->id)->password;
            
            if (Hash::check($request->get('current_password'), $current_password_hash))
            {
                User::find(auth()->id())->update(['password' =>  bcrypt($request->get('password'))]);
                return redirect(route('admin.user.change_password')) -> with('success', '密码修改成功');
            }
            else
                return redirect(route('admin.user.change_password')) -> withErrors('当前密码不正确');
    
        }
        

    }

    public function role(Request $request, User $user) {
        if ($request -> isMethod('get'))
        {   
            $all_role = Role::all();


            return view('admin.user.role', compact('all_role', 'user'));
        }
        if ($request -> isMethod('post'))
        {
            $this->validate($request, [
                'role_id' => 'required|min: 1'
            ], [
                'role_id.required' => '未选择角色',
                'role_id.min' => '所选角色非法'
            ]);

            $user->update($request->only('role_id'));

            return redirect(route('admin.user.role', $user))->with(['success' => '角色修改成功！']);
        }
    }

}
