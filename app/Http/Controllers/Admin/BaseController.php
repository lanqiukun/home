<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    //
    protected $pagesize = 10;

    public function __construct()
    {
        $this -> pagesize = config('page.pagesize');
    }
}
