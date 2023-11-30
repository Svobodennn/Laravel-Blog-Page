<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article as ArticleModel;
use App\Models\Category as CategoryModel;
use Illuminate\Support\Str;


class Article extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = ArticleModel::orderBy('created_at','asc')->get();
        return view('back.articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryModel::all();
        return view('back.articles.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
           'title' => 'min:3',
           'image' => 'required|image|mimes:jpeg,jpg,png|max:2024'
        ]);

        $article = new ArticleModel();
        $article->title=$request->title;
        $article->category_id=$request->category;
        $article->content=$request->text;
        $article->slug= Str::slug($request->title);

        if ($request->hasFile('image')){
            $imageName = Str::slug($request->title).'.'.$request->image->getClientOriginalExtension(); // get the extension of the image
            $request->image->move(public_path('uploads'),$imageName); // copy to directory move(directory,imagename) | public_path(directory) -> refers to public directory
            $article->image='uploads/'.$imageName;
        }

        $result = $article->save();
        toastr()->success('Data has been saved successfully!', 'Congrats');
        return redirect()->route('articles.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
