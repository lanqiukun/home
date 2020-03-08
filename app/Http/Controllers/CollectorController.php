<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use QL\QueryList;


class CollectorController extends Controller
{
    //

    public function index()
    {


        $url = 'https://news.ke.com/bj/baike/0033/';

        $content = file_get_contents($url);

        $data = QueryList::html($content)

        ->rules([
            'title' => ['.tit.LOGCLICK', 'text'],
            'cover' => ['.item>a>img.lj-lazy', 'data-original'],
            'desc' => ['p.summary', 'text'],
            'content' => ['div.text>a.tit.LOGCLICK', 'href']
        ])
        ->queryData();

        

        foreach($data as $item)
        {
            $file_name =  md5(pathinfo($item['cover'], PATHINFO_FILENAME)) . '.'. pathinfo($item['cover'], PATHINFO_EXTENSION);
            $location = '/upload/article/img/';
            file_put_contents(public_path() . $location . $file_name, file_get_contents($item['cover']));
            $item['cover'] = $location . $file_name;

            $article = file_get_contents($item['content']);
            $article_data = QueryList::html($article)

            ->rules([
                'content' => ['.m-content>.wrap>.box-l', 'html'],
            ])
            ->queryData();

            $item['content'] = $article_data[0]['content'];

            Article::create($item);
        }


            
    }


}
