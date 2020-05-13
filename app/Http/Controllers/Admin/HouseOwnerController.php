<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HouseOwner;
use Illuminate\Http\Request;
use App\Exports\HouseOwnerExport;
use Maatwebsite\Excel\Facades\Excel;

class HouseOwnerController extends BaseController
{
    //
    public function index(Request $request)
    {
        $data = HouseOwner::orderBy('id', 'desc')->paginate($this->pagesize);;
        $current_page = $request -> get('page') ?? 1;

        return view('admin.houseowner.index', ["total" => HouseOwner::count(), 'current_page' => $current_page, 'data' => $data]);
    }

    public function create(Request $request)
    {
        if ($request -> isMethod('get'))
        {
            return view('admin.houseowner.create');
        }

        if ($request -> isMethod('post'))
        {
            // dd($request->all());

            $this->validate($request, [
                'name' => 'required',
                'address' => 'required',
                'phone' => 'required'
            ],[
                'name.required' => '请填写房东名',
                'address.required' => '请填写房东地址',
                'phone.required' => '请填写房东电话',
            ]);

            $data = $request-> only(['name', 'address', 'sex', 'phone', 'pic', 'age', 'card', 'email']);

            
            
            HouseOwner::create($data);

            return redirect(route('admin.houseowner.index')) -> with(['success' => '添加房东成功！']);

        }
    }

    public function update(Request $request, HouseOwner $houseowner)
    {
        if (request() -> isMethod('get'))
        {
            return view('admin.houseowner.update', compact('houseowner'));
        }

        if ($request -> isMethod('post'))
        {
            // dd($request->all());

            $this->validate($request, [
                'name' => 'required',
                'address' => 'required',
                'phone' => 'required'
            ],[
                'name.required' => '请填写房东名',
                'address.required' => '请填写房东地址',
                'phone.required' => '请填写房东电话',
            ]);

            $data = $request-> only(['name', 'address', 'sex', 'phone', 'pic', 'age', 'card', 'email']);

            
            
            HouseOwner::create($data);

            return redirect(route('admin.houseowner.index')) -> with(['success' => '更新房东信息成功！']);

        }
    }


    public function delete()
    {

    }

    public function houseowner_pic(Request $request) 
    {
        $pic = config('admin_upload.houseowner_default_pic');

        if ($request->hasFile('houseowner_pic'))
        {
            //store方法会并生成散列文件名，并自动加上上传的文件的真正格式的后缀！
            $pic = '/upload/houseowner/pic/' . $request -> file('houseowner_pic') -> store('test', 'alioss');
   
            
        }

        return $pic;
    }

    public function excel()
    {
        return Excel::download(new HouseOwnerExport(), 'houseowner.xlsx');
    }
    
    public function search() 
    {

        $kw = request() -> get('kw');

        $query_builder = HouseOwner::query();

        if (strlen($kw))
            $query_builder -> where('name', 'like', "%{$kw}%") -> orWhere('phone', 'like', "%{$kw}%");

        return $query_builder -> select('id', 'phone', 'name')->orderBy('id', 'desc') ->limit(40) ->get() -> toArray();
    }

}
