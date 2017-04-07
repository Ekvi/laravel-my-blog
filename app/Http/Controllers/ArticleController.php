<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(/*$tag_id = 0*/)
    {
        /*if($tag_id == 0) {
            echo 0;
        } else {
            $articles = DB::table('articles')
                ->join('article_tag', 'articles.id', '=', 'article_tag.tag_id')
                ->where('article_tag.tag_id', $tag_id)
                ->sortByDesc("created_at")->get();

            echo "<pre>";
            print_r($articles);
            echo "<pre>";
        }*/
        /*if($tag_id == 0) {
            $articles = Article::all()->sortByDesc("created_at");
        } else {
            $articles = Article::whereHas('tags', function ($query) use($tag_id) {
                $query->where('tags.id', $tag_id);
            })->get();
        }*/

        $articles = Article::all()->sortByDesc("created_at");

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            $categories = Category::all();
            $tags = Tag::all();

            return view('articles.create', compact('categories', 'tags'));
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'content' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $destination = '/images/articles';

        if($request->hasFile('image')) {
            $image = $request->file('image');

            $filename = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path($destination), $filename);
        }

        $article = new Article();

        $article->title = $request->title;
        $article->slug = $article->setSlug($request->title);
        $article->description = $request->description;
        $article->content = $request['content'];
        $article->category_id = $request->category;
        $article->user_id = Auth::user()->id;
        $article->image = $filename ?? '';

        $article->save();

        $article->tags()->sync($request->tags, false);

        return redirect('/articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->first();

        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);

        $categories = Category::all();
        $tags = Tag::all();

        return view('articles.edit', compact('article', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*echo "<pre>";
        print_r($request->all());
        echo "<pre>";*/

        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'content' => 'required',
            'category' => 'required',
            //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $article = Article::find($id);

        $article->title = $request->title;
        $article->slug = $article->setSlug($request->title);
        $article->description = $request->description;
        $article->content = $request['content'];
        $article->category_id = $request->category;
        $article->user_id = Auth::user()->id;
        //$article->image = $filename ?? '';

        $article->save();

        $article->tags()->sync($request->tags, false);

        Session::flash('success', 'Article successfully updated!');

        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        $path = public_path() . '/images/articles/' . $article->image;

        if(file_exists($path)){
            @unlink($path);
        }

        $article->delete();

        return Redirect::route('articles.index');
    }

    public function findByTag($slug)
    {
        $articles = Article::whereHas('tags', function ($query) use($slug) {
            $query->where('tags.slug', $slug);
        })->get();

        return view('articles.index', compact('articles'));
    }
}
