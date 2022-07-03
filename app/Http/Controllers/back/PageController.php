<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pages;
use Illuminate\Support\Str;
use App\Models\contacts;

class PageController extends Controller
{

  public function __construct()
  {
    view()->share('pages',Pages::orderBy('order','ASC')->get());
    view()->share('contact',contacts::all());
    view()->share('count',contacts::where('status',1)->get()->count());
  }

    public function index()
    {
      return view('back.pages.index');
    }

    public function switch(Request $request)
    {
      $page= pages::findOrFail($request->id);
      $page->status= $request->statu =='true' ? 1: 0;
      $page->save();
    }

    public function create()
    {
      return view('back.pages.create');
    }

    public function store(Request $request)
    {
    $request->validate([
      'title' => 'required|min:3',
      'image' => 'required|image|mimes:jpeg,jpg,png|max:1048576'
    ]);

    $last = pages::orderBy('order','DESC')->first();

    $page = new pages;
    $page->title= $request->title;
    $page->content= $request->content;
    $page->slug= Str::slug($request->title);
    $page->order= $last->order+1;

    if($request->hasFile('image')){
     $imageName = Str::slug($request->title) .'.'.$request->image->getClientOriginalExtension();
     $request->image->move(public_path('uploads'),$imageName);
     $page->image= 'uploads/'.$imageName;
    }
    $page->save();
    toastr()->success('Başaryıla Oluşturuldu','Sayfa');
    return redirect()->route('pages.index');

    }

    public function updatePage($id)
    {
      $page= pages::findOrFail($id);
      return view('back.pages.update',compact('page'));
    }

    public function update(Request $request,$id)
    {
      $request->validate([
        'title' => 'required|min:3',
        'content' => 'required|min:5',
        'image' => 'image|mimes:jpeg,jpg,png'
      ]);
      $page = pages::findOrFail($id);
      $page->title= $request->title;
      $page->content= $request->content;
      $page->slug= Str::slug($request->title);

      if($request->hasFile('image')){
       $imageName = Str::slug($request->title) .'.'.$request->image->getClientOriginalExtension();
       $request->image->move(public_path('uploads'),$imageName);
       $page->image= 'uploads/'.$imageName;
      }
      $page->save();
      toastr()->success('Başaryıla Güncellendi','Sayfa');
      return redirect()->route('pages.index');

    }

    public function delete($id)
    {
      $page= pages::findOrFail($id);
      $page->delete();
      toastr()->success('Başarıyla Silindi', $page->title);
      return redirect()->back();
    }

    public function trashed()
    {
      $pages= pages::onlyTrashed()->get();
      return view('back.pages.trashed',compact('pages'));
    }

    public function hard_delete($id)
    {
      $page= pages::onlyTrashed()->findOrFail($id);
      $page->forceDelete();
      toastr()->success('Kalıcı olarak silindi',$page->title);
      return redirect()->back();
    }

    public function recover($id)
    {
      $page= pages::onlyTrashed()->findOrFail($id);
      $page->restore();
      toastr()->success('Başarıyla kurtarıldı',$page->title);
      return redirect()->route('pages.index');
    }

    public function order(Request $request)
    {
     foreach ($request->page as $key => $order) {
     pages::where('id',$order)->update(['order' => $key]);
     }
    }
}
