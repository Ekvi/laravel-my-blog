<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Tag;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all()->sortByDesc("created_at");
        //$articles = Article::paginate(10);

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
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('image')) {
            $image = $request->file('image');

            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('/images/articles/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);
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

        Session::flash('success', 'Article successfully created!');

        return redirect()->route('articles.index');
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
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'content' => 'required',
            'category' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $article = Article::find($id);

        $article->title = $request->title;
        $article->slug = $article->setSlug($request->title);
        $article->description = $request->description;
        $article->content = $request['content'];
        $article->category_id = $request->category;

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('/images/articles/' . $filename);

            $oldImage = $article->image;

            if(!empty($oldImage)) {
                Storage::delete('articles/' . $oldImage);
            }

            Image::make($image)->resize(800, 400)->save($location);

            $article->image = $filename;
        }

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
        $article->tags()->detach();

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
