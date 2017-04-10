<?php

namespace App\Http\Controllers\api;

use App\Article;
use App\Http\Controllers\Controller;
use App\User;

class ArticleController extends Controller
{
    public function getArticles()
    {
        return Article::all();
    }

    public function getUsers()
    {
        return User::all();
    }

    public function getUserById($id)
    {
        return User::where('id', $id)->first();
    }
}