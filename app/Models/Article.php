<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Base
{
    //

    protected $appends = ['action'];

    public function getStatusAttribute($value)
    {
        switch ($value) {
            case '0':
                return '<span class="label label-primary radius">已保存</span>';
            case '1':
                return '<span class="label label-success radius">已发布</span>';
            case '2':
                return '<span class="label label-danger  radius">已删除</span>';
        }
    }


    public function getActionAttribute()
    {
        $update = in_array('admin.article.update', session('user_node'));
        $delete = in_array('admin.article.delete', session('user_node'));
        $update_btn = '<a class="label label-success radius" href="http://home.com/admin/article/update/' . $this->id  . '">编辑</a>';
        $delete_btn = '<a class="label label-danger  radius">删除</a>';

        if ($update && $delete)
            return $update_btn . '&nbsp;' . $delete_btn;
        else if ($update)
            return $update_btn;
        else if ($delete)
            return $delete_btn;
    }
}
