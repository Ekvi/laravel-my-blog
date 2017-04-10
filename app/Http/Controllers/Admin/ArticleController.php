<?php

namespace App\Http\Controllers\admin;

use App\Article;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    const ADMIN_PAGE_LIMIT = 15;

    public function index()
    {
        $articles = Article::paginate(self::ADMIN_PAGE_LIMIT);

        return view('admin.articles.index', compact('articles'));
    }
}