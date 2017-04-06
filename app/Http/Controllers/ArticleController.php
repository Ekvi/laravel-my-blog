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
    public function index()
    {
        $articles = Article::all()->sortByDesc("created_at");

        return view('articles.index', compact('articles'));

        //$tags = Tag::all();
        //$tags = Tag::find(1)->articles()->orderBy('title')->get();

        /*$articles = Article::all();
        foreach($articles as $article) {
            echo "<pre>";
            print_r($article->tagsCount);
            echo "<pre>";
        }*/
   /*     $counts = Tag::join('article_tag', 'tags.id', '=', 'article_tag.tag_id')
// group by tags.id in order to count number of rows in join and to get each tag only once
            ->groupBy('tags.id')
// get only columns from tags table along with aggregate COUNT column
            ->select(['tags.title', DB::raw('COUNT(*) as count')])
// order by count in descending order
            ->orderBy('count', 'desc')
            ->get();

        echo "<pre>";
        print_r($counts);
        echo "<pre>";*/

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('articles.create', compact('categories', 'tags'));
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
}
