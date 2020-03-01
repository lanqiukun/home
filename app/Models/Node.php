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

    public function getAllList() {
        $data = self::get() -> toArray();
        return $this->tree_level($data);
    }
}
