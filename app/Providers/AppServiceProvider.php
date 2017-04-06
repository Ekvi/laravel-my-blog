<?php

namespace App\Providers;

use App\Article;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('includes.sidebar', function ($view) {
            $categories = Category::all();
            $recent_articles = Article::orderBy('id', 'desc')->take(5)->get();

            $tags = $this->getTagsWithCount();

            $view->with('categories', $categories)->with('recent_articles', $recent_articles)->with('tags', $tags);
        });
    }

    private function getTagsWithCount()
    {
        return Tag::join('article_tag', 'tags.id', '=', 'article_tag.tag_id')
            // group by tags.id in order to count number of rows in join and to get each tag only once
            ->groupBy('tags.id')
            // get only columns from tags table along with aggregate COUNT column
            ->select(['tags.title', DB::raw('COUNT(*) as count')])
            // order by count in descending order
            ->orderBy('count', 'desc')
            ->get();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
