<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all()->sortByDesc("created_at");;

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('articles.create', compact('categories'));
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
            'url' => 'required',
            'description' => 'required',
            'content' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //$request['user_id'] = Auth::user()->id;
        //Article::create($request->all());

        $destination = '/images/articles';

        if($request->hasFile('image')) {
            echo 'here';
            //$file = Input::file('image');
            $image = $request->file('image');
            /*echo "<pre>";
            print_r($image);
            echo "<pre>";*/
            //$filename  = $image->getClientOriginalName();
            $filename = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path($destination), $filename);
        } else {
            echo 'else';
        }

        echo 'image ' . $filename;
        Article::create([
            'title' => $request->title,
            'url' => $request->url,
            'description' => $request->description,
            'content' => $request['content'],
            'category_id' => $request->category,
            'user_id' => Auth::user()->id,
            //'image' => 'image'
            'image' => $filename ?? ''
        ]);


        return redirect('/articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
