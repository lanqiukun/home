<?php

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Article::truncate();
        factory(Article::class, 40) -> create();

        // \App\Models\Article::unguard();

        // $this->call('Country');
    }
}
