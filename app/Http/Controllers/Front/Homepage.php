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
        $data['articles'] = Article::orderBy('created_at','DESC')->get();
        $data['categories'] = Category::inRandomOrder()->get();
        return view('front.homepage', $data);
    }

    public function single($category,$slug){
        $category=Category::where('slug',$category)->first() ?? abort (404); // whereSlug($slug)
        $article=Article::where('slug',$slug)->whereCategoryId($category->id)->first() ?? abort (404);

        $article->increment('hit');
        $data['article'] = $article;
        $data['categories'] = Category::inRandomOrder()->get();
        return view('front.single',$data);
    }
}
