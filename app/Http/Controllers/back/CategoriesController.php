<?php

namespace App\Http\Controllers\back;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\categories;
use App\Models\articles;
use App\Models\contacts;

class CategoriesController extends Controller
{

  public function __construct()
  {
    view()->share('contact',contacts::all());
    view()->share('count',contacts::where('status',1)->get()->count());
  }

    public function index()
    {
      $categories= categories::orderBy('id','DESC')->get();
      return view('back.categories.index',compact('categories'));
    }

    public function switch(Request $request)
    {
      $category= categories::findOrFail($request->id);
      $category->status= $request->statu =='true' ? 1: 0;
      $category->save();
    }

    public function add(Request $request)
    {
      $isExists = categories::whereSlag(Str::slug($request->name))->first();
      if($isExists){
        toastr()->error($request->name . ' adında kategori zaten mevcut!');
        return redirect()->back();
      }
      $category= new categories;
      $category->name = $request->name;
      $category->slag = Str::slug($request->name);
      $category->save();
      toastr()->success('Başarıyla Eklendi',$request->name);
      return redirect()->back();
    }

    public function getData(Request $request)
    {
      $category= categories::find($request->id);
      return response()->json($category);
    }

    public function update(Request $request)
    {
      $isName= categories::whereName($request->name)->whereNotIn('id',[$request->id])->first();
      $isSlug= categories::whereName($request->slug)->whereNotIn('id',[$request->id])->first();
                                                      //bu id hariç demek
     if($isName || $isSlug){
       toastr()->error($request->name . ' adında kategori zaten mevcut!');
       return redirect()->back();
     }else{

     $category= categories::find($request->id);
     $category->name= $request->name;
     $category->slag= $request->slug;
     $category->save();
     toastr()->success('Başarıyla Güncellendi',$request->name);
     return redirect()->back();
   }
 }

 public function delete(Request $request)
 {
   $category= categories::findOrFail($request->id);
   $defaultCategory= categories::find(1);
   $message='';

   if($category->id == 1){
     toastr()->error('Bu Kategori Silinemez');
    return redirect()->back();
   }
   $count= $category->articleCount();

   if($count>0){
     articles::where('category_id',$category->id)->update(['category_id' => 1]);
     $message= 'bu kategoriye ait ' .$count. ' makale ' .$defaultCategory->name . ' Kategorisine taşındı';
   }
   $category->delete();

   toastr()->success($message,'Kategori Başarıyla Silindi');
   return redirect()->back();
 }
}
