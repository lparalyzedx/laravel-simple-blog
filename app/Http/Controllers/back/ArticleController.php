<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\articles;
use App\Models\categories;
use App\Models\Configs;
use App\Models\contacts;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
       view()->share('contact',contacts::all());
       view()->share('count',contacts::where('status',1)->get()->count());
     }

    public function index()
    {
        $articles= articles::orderBy('create_at','DESC')->get();
        return view('back.articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories= categories::inRandomOrder()->get();
      return view('back.articles.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'title' => 'required|min:5',
        'image' => 'required|image|mimes:jpeg,jpg,png'
        ]);
        $article = new articles;
        $article->title = $request->title;
        $article->slug = Str::slug($request->title);
        $article->category_id = $request->category;
        $article->content = $request->content;

        if($request->hasFile('image')){
          $imageName= Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();
          $request->image->move(public_path('uploads'),$imageName);
          $article->image = 'uploads/' . $imageName;
        }

        $article->save();
        toastr()->success('Başarıyla Eklendi','Makale');
        return redirect()->route('articles.index');


    }

    public function switch(Request $request)
    {
      $article= articles::findOrFail($request->id);
      $article->status= $request->statu =='true' ? 1: 0;
      $article->save();
    }

    public function trashed()
    {
      $articles= articles::onlyTrashed()->orderBy('deleted_at','DESC')->get();
      return view('back.articles.trashed',compact('articles'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article= articles::findOrFail($id);
        $categories= categories::get();
        return view('back.articles.update',compact('article','categories'));
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

        $request->validate([
        'title' => 'required|min:5',
        'image' => 'image|mimes:jpeg,jpg,png'
        ]);
        $article= articles::findOrFail($id);
        $article->title = $request->title;
        $article->slug = Str::slug($request->title);
        $article->category_id = $request->category;
        $article->content = $request->content;

        if($request->hasFile('image')){
          $imageName= Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();
          $request->image->move(public_path('uploads'),$imageName);
          $article->image = 'uploads/' . $imageName;
        }

        $article->save();
        toastr()->success('Başarıyla Güncellendi','Makale');
        return redirect()->route('articles.index');
    }

    public function delete($id)
    {
      articles::findOrFail($id)->delete();
      toastr()->success('Başarıyla Silindi','Makale');
      return redirect()->route('articles.index');
    }

    public function hard_delete($id)
    {
      $article= articles::onlyTrashed()->findOrFail($id);
      if(File::exists($article->image)){
        File::delete(public_path($article->image));
      }
      $article->forceDelete();
      toastr()->success('Başarıyla Silindi','Makale');
      return redirect()->back();
    }

    public function recover($id)
    {
      $article= articles::onlyTrashed()->findOrFail($id);
      $article->restore();
      toastr()->success('Başarıyla Kurtarıldı','Makale');
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

    }
}
