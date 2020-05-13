<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Node;

class IndexController extends Controller
{

    //
    public function index(Request $request) {
        $data = (new Node()) -> treeData(array_keys(session('user_node')));


        return view('admin.index.index', compact('data'));
    }

    public function welcome() {

        return view('admin.index.welcome');
    }


}
