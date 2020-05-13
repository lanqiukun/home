<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Node;
use Illuminate\Http\Request;

class NodeController extends Controller
{

    public function index(Request $request)
    {
        //

        $node = Node::getAllList();



        $nodename = $request->get('nodename', '');
        $node_data = Node::when($nodename, function ($query) use ($nodename) {
            $query -> where('name', 'like', "%{$nodename}%");
        })->get();

        $total = count($node_data);

        return view('admin.node.index', ['total' => $total], compact('node'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request -> isMethod('get')) {
            $data = (new Node) -> getAllCreatableList();
            return view('admin.node.create', compact('data'));
        }

        if ($request -> isMethod('post')) 
        {

            $this->validate($request, [
                'pid' => 'required|numeric',
                'name' => 'required|unique:nodes,name',
                'route' => 'unique:nodes,route',
                'is_menu' => 'required|in: "0", "1"'
            ], [
                'pid.required' => '请选择层级',
                'pid.numeric' => '层级值不合法',
                'name.required' => '请输入节点名称',
                'name.unique' => '已有相同的节点名称',
                'route.unique' => '已有相同的路由别名',
                'is_menu.required' => '请选择是否为菜单',
                'is_menu.in' => '是否为菜单值不合法',
            ]);

            Node::create($request->except('_token'));

            return redirect(route('admin.node.create'))->with(['success' => '节点添加成功']);    
        }

    }


    public function update(Request $request, Node $node)
    {
        if ($request -> isMethod('get'))
        {
            $data = (new Node()) ->getAllCreatableList();
            
            return view('admin.node.update', compact('node', 'data'));
        }


        if ($request -> isMethod('post'))
        {
            $this->validate($request, [
                'pid' => 'required|numeric',
                'name' => 'required|unique:nodes,name,' .$node->id . ',id',
                'route' => 'unique:nodes,route,' .$node->id . ',id',
                'is_menu' => 'required|in: "0", "1"'
            ], [
                'pid.required' => '请选择层级',
                'pid.numeric' => '层级值不合法',
                'name.required' => '请输入节点名称',
                'name.unique' => '已有相同的节点名称',
                'route.unique' => '已有相同的路由别名',
                'is_menu.required' => '请选择是否为菜单',
                'is_menu.in' => '是否为菜单值不合法',
            ]);

            Node::find($node->id) -> update($request->except(['_token', '_method']));
            
            return redirect(route('admin.node.update', compact('node'))) -> with(['success' => '节点更新成功']);
        }

    }

    public function delete(Request $request)
    {

    }

}
