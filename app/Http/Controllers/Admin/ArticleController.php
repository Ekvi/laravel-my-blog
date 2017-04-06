<?php

namespace App\Http\Controllers\admin;

use App\Article;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all()->sortByDesc("created_at");

        return view('admin.articles.index', compact('articles'));
    }
}