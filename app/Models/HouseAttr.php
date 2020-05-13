<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseAttr extends Base
{
    //
    public function getList()
    {
        $data = self::get()->toArray();

        // dump($data);

        return $this->tree_level($data);

        
    }
}
