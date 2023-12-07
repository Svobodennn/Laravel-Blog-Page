<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category as CategoryModel;
use Illuminate\Support\Str;
use App\Models\Article;

class Category extends Controller
{
    public function index()
    {
        $categories = CategoryModel::all();
        return view('back.categories.index',compact('categories'));
    }

    public function trashed()
    {
        $categories = CategoryModel::onlyTrashed()->orderBy('deleted_at','DESC')->get();
        return view('back.categories.trashed',compact('categories'));
    }

    public function recover($id)
    {
        $category = CategoryModel::onlyTrashed()->find($id)->restore();
        toastr()->success('Category has restored.');
        return redirect()->back();
    }

    public function switch(Request $request){
        $category = CategoryModel::findOrFail($request->id);
        $category->status=$request->statu ? 1 : 0; // 1 if true, 0 if false
        $category->save();
    }
    public function getData(Request $request){
        $category = CategoryModel::findOrFail($request->id);
        return response()->json($category);
    }

    public function delete(string $id)
    {


        $category = CategoryModel::find($id);

        if ($category->id == 1) {
            toastr()->error('General category can not be archived');
            return redirect()->route('categories.index');
        }

        $count = $category->articleCount();
        if ($category->articleCount()>0){
            Article::where('category_id',$category->id)->update(['category_id'=>1]);
            $defaultCategory = $category->find(1)->name;
            toastr()->success($count.' Articles belonging this category moved to '.$defaultCategory.' category.');
        }

        $category->delete();
        toastr()->success('Category has archived.');
        return redirect()->route('categories.index');
    }
    public function hardDelete(string $id)
    {
        $category = CategoryModel::onlyTrashed()->find($id);
        $category->forceDelete();

        toastr()->success('Category has deleted.');
        return redirect()->route('categories.index');
    }

    public function create()
    {
        return view('back.categories.create');

    }

    public function store(Request $request)
    {

        $isExist=CategoryModel::whereSlug(Str::slug($request->name))->first();

        if ($isExist){
            toastr()->error($request->name. ' category already exists.');
            return redirect()->back();
        }

        $request->validate([
            'name' => 'min:3',
        ]);

        $category = new CategoryModel();
        $category->name=$request->name;
        $category->slug = Str::slug($request->name);

        $result = $category->save();
        toastr()->success('Category has been created successfully!', 'Congrats');
        return redirect()->route('categories.index');

    }


    public function update(Request $request)
    {

        $request->validate([
            'name' => 'min:3',
            'slug'=> 'min:3'
        ]);

        $nameExists = CategoryModel::where('name', $request->name)
            ->where('id', '!=', $request->id)
            ->first();

        $slugExists = CategoryModel::where('slug', Str::slug($request->slug))
            ->where('id', '!=', $request->id)
            ->first();

        if ($nameExists || $slugExists){

            toastr()->error($request->name. ' category already exists.');
            return redirect()->back();
        }


        $category = CategoryModel::findOrFail($request->id);
        $category->name=$request->name;
        $category->slug=Str::slug($request->slug);
        $category->save();
        toastr()->success('Category has been updated successfully!', 'Congrats');
        return redirect()->route('categories.index');
    }

    public function edit(string $id)
    {
        $category = CategoryModel::findOrFail($id);
        return view('back.categories.edit',compact('category'));
    }
}
