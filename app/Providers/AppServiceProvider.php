<?php

namespace App\Providers;

use App\Article;
use App\Category;
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
            $view->with('categories', $categories)->with('recent_articles', $recent_articles);
        });
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
