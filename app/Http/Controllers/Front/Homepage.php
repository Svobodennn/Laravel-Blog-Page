<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Database\Seeders\ArticleSeeder;
use Illuminate\Http\Request;

// Models
use App\Models\Category;
use App\Models\Article;
class Homepage extends Controller
{
    public function index(){
        $data['articles'] = Article::orderBy('created_at','DESC')->paginate(2);
        $data['articles']->withPath(url('articles'));
        $data['categories'] = Category::orderBy('id','ASC')->get();
        return view('front.homepage', $data);
    }

    public function single($category,$slug){
        $category=Category::where('slug',$category)->first() ?? abort (404); // whereSlug($slug)
        $article=Article::where('slug',$slug)->whereCategoryId($category->id)->first() ?? abort (404);

        $article->increment('hit');
        $data['article'] = $article;
        $data['categories'] = Category::orderBy('id','ASC')->get();
        return view('front.single',$data);
    }

    public function category($slug){
        $category=Category::where('slug',$slug)->first() ?? abort (404,"This category doesn't exist");
        $data['category'] = $category;
        $data['articles'] = Article::where('category_id',$category->id)->orderBy('created_at','DESC')->paginate(2);
        $data['categories'] = Category::orderBy('id','ASC')->get();

        return view('front.category',$data);
    }
}
