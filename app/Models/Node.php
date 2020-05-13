<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Node extends Base
{
    //

    public function setRouteAttribute($value) 
    {

        $this->attributes['route'] = empty($value) ? '' : $value;
    }

    public function getMenuAttribute()
    {
        if ($this->is_menu == '1')
            return '<span class="label label-success radius">是</span>';
        else 
            return '<span class="label label-warning radius">否</span>';
    }

    public static function getAllList() {
        $data = self::get() -> toArray();
        
        return (new Node) -> tree_level($data);
    }

    public function getAllCreatableList() {
        $layer1 = self::where('pid', 0)->pluck('id')->toArray();

        $layer2 = self::whereIn('pid', $layer1)->pluck('id')->toArray();

        $data = self::whereIn('id', array_merge($layer1, $layer2)) -> get() -> toArray();
        return $this->tree_level($data);
    }

    public function treeData($user_node) {


        $data = self::where('is_menu', "1") -> whereIn('id', $user_node) ->get()->toArray();

        return $this -> subTree($data);
    }

}
