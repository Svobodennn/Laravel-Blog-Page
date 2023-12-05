<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category as CategoryModel;
use Illuminate\Support\Str;

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

    public function delete(string $id)
    {
        CategoryModel::find($id)->delete();
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
        toastr()->success('Data has been saved successfully!', 'Congrats');
        return redirect()->route('categories.index');

    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'min:3',
        ]);

        $category = CategoryModel::findOrFail($id);
        $category->name=$request->name;
        $category->slug=Str::slug($request->name);

        $category->save();
        toastr()->success('Data has been updated successfully!', 'Congrats');
        return redirect()->route('categories.index');
    }

    public function edit(string $id)
    {
        $category = CategoryModel::findOrFail($id);
        return view('back.categories.edit',compact('category'));
    }
}
