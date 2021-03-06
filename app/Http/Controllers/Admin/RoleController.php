<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

use App\Models\Node;


class RoleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        
        //
        $rolename = $request->get('rolename', '');
        $role_data = Role::when($rolename, function ($query) use ($rolename) {
            $query -> where('name', 'like', "%{$rolename}%");
        })->paginate($this->pagesize);
        // dd($role_data);
        $total = count($role_data);
        return view('admin.role.index', ['total' => $total], compact('role_data', 'rolename'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request -> isMethod('get'))
        {
            return view('admin.role.create');
        }

        if ($request -> isMethod('post'))
        {

            $this->validate($request, [
                'name' => 'required|unique:roles,name'
            ], [
            'name.required' => '请输入角色名',
            'name.unique' => '已有重复的角色名'
            ]);
            
            Role::create($request->except('_token'));
            
            return redirect(route('admin.role.create')) -> with(['success' => '角色添加成功']);
            
        }
    }

    public function update(Request $request, $id)
    {
        //
        if ($request->isMethod('get'))
        {
            $role = Role::find($id);
    
            return view('admin.role.update', compact('role'));
        }

        if ($request -> isMethod('post'))
        {

            $this->validate($request, [
                'name' => 'required|unique:roles,name,' . $id . ',id',
            ], [
                'name.required' => '角色名不能为空！',
                'name.unique' => '已有相同的角色名'
            ]);
            
            Role::find($id) -> update(['name' => $request->get('name')]);
            
            return redirect(route('admin.role.update', $id))->with(['success' => '角色名已修改']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
    }

    public function node(Request $request, Role $role) {
        
        if (request() -> isMethod('get'))
        {

            $all_node = (new Node) -> getAllList();

            $has_node = $role -> nodes()->pluck('id')-> toArray();


            return view('admin.role.node', compact('role', 'all_node', 'has_node'));
        }

        if (request() -> isMethod('post')) 
        {
            $role->nodes() -> sync($request->get('nodes'));
            return redirect(route('admin.role.node', $role));
        }

    }
}
