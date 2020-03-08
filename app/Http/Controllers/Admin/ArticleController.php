<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Role;

class ArticleController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = Article::all();

        if ($request -> header('X-Requested-With') =="XMLHttpRequest")
        {

            $start = (int)$request->get('start', 0);

            $order = $request->get('order')[0];
            $column = $order['column'];
            $dir = $order['dir'];
            $order = $request->get('columns')[$column]['data'];
            // dd($column, $dir, $order);

            $start = $request -> get('start');
            $len = min(100, $request->get('length'));

            $datemin = $request->get('datemin');
            $datemax = $request->get('datemax');
            $title = $request->get('title');

            if (!empty($datemin))
                $datemin = date('Y-m-d H:i:s', strtotime($datemin . " 00:00:00"));
            if (!empty($datemax))
                $datemax = date('Y-m-d H:i:s', strtotime($datemax . " 23:59:59"));


            $query_builder = Article::where([]);

            if (!empty($datemin) && !empty($datemax))
                $query_builder -> whereBetween('created_at', [$datemin, $datemax]);
            else if (!empty($datemin)) 
                $query_builder -> where('created_at', '>=', $datemin);
            else if (!empty($datemax)) 
                $query_builder -> where('created_at', '<=', $datemax);
            
            

            if (!empty('title'))
                $query_builder -> where('title', 'like', "%{$title}%");


            $total = $query_builder->count();


            $data = $query_builder -> offset($start) -> limit($len) -> orderBy($order, $dir) -> get() -> toArray();



            $result = [
                'draw' => $request -> get('draw'),
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
                'data' => $data
            ];

            return $result;
        
        }

        return view('admin.article.index', ['total' => count($data)], compact('data'));
    }

    public function create(Request $request) 
    {
        if ($request -> isMethod('get'))
            return view('admin.article.create');

        if ($request -> isMethod('post'))
        {
            $this-> validate($request, [
                'title' => 'required',
                'desc' => 'required'
            ], [
                'title.required' => '请输入文章标题',
                'desc.required' => '请输入文章描述',
            ]);

            $data = $request->only(['title', 'desc', 'cover', 'content']);

            if (empty($data['content']))
                $data['content'] = '';

            Article::create($data);
            
            return redirect(route('admin.article.index'))->with('success', '文章添加成功');
        }
    }



    public function article_cover(Request $request) {
        $pic = config('article_upload.article_default_cover');

        if ($request->hasFile('cover'))
        {
            $pic = '/upload/article/cover/' . $request -> file('cover') -> store('', 'article_cover');
        }

        return $pic;
    }

    public function article_img(Request $request) {
        if ($request->hasFile('articlt_img'))
        {
            $pic = '/upload/article/img/' . $request -> file('articlt_img') -> store('', 'article_img');
            $result['success'] = true;
            // $result['msg'] = '已经保存到服务器';
            $result['file_path'] = $pic;
            return json_encode($result);
        } else {
            $result['success'] = false;
            $result['msg'] = '未选择上传的文件';
            return json_encode($result);
        }
    }

    public function update(Request $request, $article) 
    {
        $article = Article::find((int)$article);

        if($request -> isMethod('get'))
            return view('admin.article.update', compact('article'));

        if ($request -> isMethod('post'))
        {
            $this-> validate($request, [
                'title' => 'required',
                'desc' => 'required'
            ], [
                'title.required' => '请输入文章标题',
                'desc.required' => '请输入文章描述',
            ]);

            $data = $request->only(['title', 'desc', 'cover', 'content']);

            if (empty($data['content']))
                $data['content'] = '';
            
            $article->update($data);
            
            return redirect(route('admin.article.update', $article))->with('success', '文章添加成功');
        }
    }
}
