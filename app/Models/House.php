<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House extends Base
{
    //
    public function owner()
    {
        return $this->belongsTo(HouseOwner::class, 'houseowner');
    }

    public function toward_to()
    {
        return $this->belongsTo(HouseAttr::class, 'towards');
    }

    public function renttype()
    {
        return $this->belongsToMany(HouseAttr::class, 'house_renttype', 'house_id', 'renttype_id');
    }


    public function pics()
    {
        return $this->belongsToMany(HouseAttr::class, 'house_housepic', 'house_id', 'pic_id');
    }



    
}
