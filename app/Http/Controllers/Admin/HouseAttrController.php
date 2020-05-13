<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HouseAttr;
use Illuminate\Http\Request;

class HouseAttrController extends Controller
{
    //
    public function index() 
    {
        $model = new HouseAttr();

        $houseattr = $model -> getList();
        $total = HouseAttr::count();

        return view('admin.houseattr.index', ['houseattr' => $houseattr, 'total' => $total]);

    }

    public function create()
    {
        if (request() -> isMethod('get'))
        {
            $data = HouseAttr::where('pid', 0) -> get();

            return view('admin.houseattr.create', compact('data'));
        }

        if (request() -> isMethod('post'))
        {
            $this->validate(request(), [
                'pid' => 'required|numeric|min: 0',
                // 'field_name' => 'required',
                'name' => 'required',
                
            ],[
                'pid.required' => '请选择层级',
                'pid.numeric' => '层级值非法',
                'pid.min' => '层级值非法',
                // 'field_name.required' => '请输入字段名称',
                'name.required' => '请输入属性名称',

            ]);

            HouseAttr::create(request() -> only(['pid', 'field_name', 'name', 'icon']));

            session() -> flash('operating_pid', request()->pid);

            // dd(request()->pid);

            return redirect(route('admin.houseattr.create')) -> with(['success' => '添加房源属性成功！']);

        }

    }

    public function update(HouseAttr $houseattr)
    {
        if (request() -> isMethod('get'))
        {
            $data = HouseAttr::where('pid', 0) -> get();
            // dd($houseattr);
            return view('admin.houseattr.update', compact('data', 'houseattr'));
        }

        if (request() -> isMethod('post'))
        {
            $this->validate(request(), [
                'pid' => 'required|numeric|min: 0',
                // 'field_name' => 'required',
                'name' => 'required',
                
            ],[
                'pid.required' => '请选择层级',
                'pid.numeric' => '层级值非法',
                'pid.min' => '层级值非法',
                // 'field_name.required' => '请输入字段名称',
                'name.required' => '请输入属性名称',

            ]);

            // dd(request() -> get('icon'));

            $houseattr->update(request() -> only(['pid', 'field_name', 'name', 'icon']));

            return redirect(route('admin.houseattr.index')) -> with(['success' => '修改房源属性成功！']);

        }

    }

    public function delete(int $houseattr)
    {
        $removed = HouseAttr::find($houseattr);

        

        if ($removed)
        {
            $removed->delete();
            return json_encode(['code' => 0, 'msg' => '用户成功删除', 'target' => $houseattr]);
        }
        else {
            if (HouseAttr::onlyTrashed() -> find($houseattr))
                return json_encode(['code' => 1, 'msg' => '用户在此操作之前已被删除', 'target' => $houseattr]);
            else
                return json_encode(['code' => 2, 'msg' => '用户不存在', 'target' => $houseattr]);
        }
    }

    public function houseattr_icon(Request $request) {
        $pic = config('admin_upload.houseattr_default_icon');

        if ($request->hasFile('attr_icon'))
        {
            //store方法会并生成散列文件名，并自动加上上传的文件的真正格式的后缀！
            $pic = '/upload/houseattr/icon/' . $request -> file('attr_icon') -> store('', 'houseattr_icon');
   

        }

        return $pic;
    }

    public function attrs($attrpid)
    {
        return HouseAttr::where('pid', $attrpid) ->pluck('name', 'id') -> toArray();
    }




}
