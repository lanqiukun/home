<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function __construct()
    {
        $this->middleware(['checkadminlogin']);
    }

    //
    public function index() {
        

        return view('admin.index.index');
    }

    public function welcome() {

        return view('admin.index.welcome');
    }


}
