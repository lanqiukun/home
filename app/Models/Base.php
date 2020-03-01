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

    public function tree_level(array $data, int $pid = 0, string $html = '-', int $level = 0) {
        static $arr = [];
        foreach ($data as $val) {
            if ($pid == $val['pid']) {
                $val['html'] = str_repeat($html, $level * 2);
                $val['level'] = $level + 1;
                $arr[] = $val;
                $this->tree_level($data, $val['id'], $html, $val['level']);

            }
        }
        return $arr;
    }


}