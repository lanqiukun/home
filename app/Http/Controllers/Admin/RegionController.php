<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;


class RegionController extends Controller
{
    //
    public function regiondata()
    {
        
        $pid = request() -> get('level', 0);
        return Region::where('pid', $pid)->pluck('name', 'id');
    }



}
