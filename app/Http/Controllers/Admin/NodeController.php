<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Node;
use Illuminate\Http\Request;

class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $node = (new Node) -> getAllList();


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
    public function create()
    {
        //

        $data = Node::where('pid', 0) -> get();

        return view('admin.node.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        print_r($request->all());

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
        $data = Node::where('pid', 0) -> get();

        return redirect(route('admin.node.create', compact('data')))->with(['success' => '节点添加成功']);



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Node $node)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node)
    {
        //
    }
}
