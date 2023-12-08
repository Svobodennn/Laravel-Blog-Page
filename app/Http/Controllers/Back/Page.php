<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page as ModelPage;
use App\Models\Category as CategoryModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class Page extends Controller
{
    public function index()
    {
        $pages = ModelPage::all();
        return view('back.pages.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryModel::all();
        return view('back.pages.create',compact('categories'));
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

        $last = ModelPage::orderBy('order','DESC')->first();

        $page = new ModelPage();
        $page->title=$request->title;
        $page->content=$request->text;
        $page->order = $last->order+1;
        $page->slug= Str::slug($request->title);

        if ($request->hasFile('image')){
            $imageName = Str::slug($request->title).'.'.$request->image->getClientOriginalExtension(); // get the extension of the image
            $request->image->move(public_path('uploads'),$imageName); // copy to directory move(directory,imagename) | public_path(directory) -> refers to public directory
            $page->image='uploads/'.$imageName;
        }

        $result = $page->save();
        toastr()->success('Data has been saved successfully!', 'Congrats');
        return redirect()->route('pages.index');

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
        $page = ModelPage::findOrFail($id);
        return view('back.pages.edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'min:3',
            'image' => 'image|mimes:jpeg,jpg,png|max:2024'
        ]);

        $page = ModelPage::findOrFail($id);
        $page->title=$request->title;
        $page->content=$request->text;
        $page->slug= Str::slug($request->title);

        if ($request->hasFile('image')){
            $imageName = Str::slug($request->title).'.'.$request->image->getClientOriginalExtension(); // get the extension of the image
            $request->image->move(public_path('uploads'),$imageName); // copy to directory move(directory,imagename) | public_path(directory) -> refers to public directory
            $page->image='uploads/'.$imageName;
        }

        $page->save();
        toastr()->success('Data has been updated successfully!', 'Congrats');
        return redirect()->route('pages.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function delete(string $id)
    {
        ModelPage::find($id)->delete();
        toastr()->success('Page has archived.');
        return redirect()->route('pages.index');
    }
    public function hardDelete(string $id)
    {
        $page = ModelPage::onlyTrashed()->find($id);

        if(File::exists($page->image)){
            File::delete(public_path($page->image));
        }

        $page->forceDelete();

        toastr()->success('Page has deleted.');
        return redirect()->route('pages.index');
    }

    public function trashed()
    {
        $pages = ModelPage::onlyTrashed()->orderBy('deleted_at','DESC')->get();
        return view('back.pages.trashed',compact('pages'));
    }

    public function recover($id)
    {
        $page = ModelPage::onlyTrashed()->find($id)->restore();
        toastr()->success('Page has restored.');
        return redirect()->back();
    }

    public function switch(Request $request){
        $page = ModelPage::findOrFail($request->id);
        $page->status=$request->statu ? 1 : 0; // 1 if true, 0 if false
        $page->save();
    }
}
