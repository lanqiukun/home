<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Base extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = [
        
    ];

    public function getSexAttribute($value)
    {
        if ($value === null)
            return '未设置';
        else if ($value == 0)
            return '女士';
        else if ($value == 1)
            return '先生';
        else
            return '其他';
    }

    public function tree_level(array $data, int $pid = 0, string $html = '____', int $level = 0) {

        static $arr = [];
        foreach ($data as $key => $val) {
   
            if ($pid == $val['pid']) {
                $val['html'] = str_repeat($html, $level * 2);
                $val['level'] = $level + 1;
                $arr[] = $val;
                $this->tree_level($data, $val['id'], $html, $val['level']);

            }
        }
        return $arr;
    }

    public function subTree(array $data, int $pid = 0) {

        $arr = [];
        foreach ($data as $val) {
            if ($pid == $val['pid']) {

                $val['sub'] = $this -> subTree($data, $val['id']);


                $arr[] = $val;
            }
        }
        return $arr;
    }


}
