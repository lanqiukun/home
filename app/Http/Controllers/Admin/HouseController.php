<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\House;
use App\Models\HouseAttr;
use App\Models\Region;
use Illuminate\Support\Facades\Storage;

class HouseController extends BaseController
{
    //
    public function index(Request $request)
    {
        $data = House::orderBy('id', 'desc')->paginate($this->pagesize);
        $total = House::count();
        $current_page = $request -> get('page') ?? 1;


        return view('admin.house.index', compact('data', 'total', 'current_page'));

    }

    public function create(Request $request)
    {
        if ($request -> isMethod('get'))
        {


            return view('admin.house.create');
        }

        if ($request -> isMethod('post'))
        {
            dd($request->all());
        }

    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function house_pic()
    {

    }

    public function house_cover()
    {

    }


    public function pic(Request $request)
    {


        if ($request->isMethod('post') && $request->hasFile('house_pic'))
        {
            //store方法会并生成散列文件名，并自动加上上传的文件的真正格式的后缀！
            $pic = '/upload/house/pic/' . $request -> file('house_pic') -> store('', 'house_pic');
   
            

            return $pic;
        }

        if ($request->isMethod('delete')) 
        {
            unlink(public_path() . $request->get('deleted_pic'));


            return json_encode(['msg' => '文件已删除']);
        }

    }



}
