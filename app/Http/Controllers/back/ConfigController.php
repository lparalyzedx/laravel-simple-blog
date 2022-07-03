<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Configs;
use App\Models\contacts;
use Illuminate\Support\Str;

class ConfigController extends Controller
{
  public function __construct()
  {
    view()->share('contact',contacts::all());
    view()->share('count',contacts::where('status',1)->get()->count());
  }
    public function index()
    {
      $config= Configs::find(1);
      return view('back.config.index',compact('config'));
    }

    public function update(Request $request)
    {
      $config= Configs::find(1);
      $config->title= $request->title;
      $config->status= $request->status;
      $config->facebook= $request->facebook ? $request->facebook: null;
      $config->instagram= $request->instagram ? $request->instagram: null;
      $config->youtube= $request->youtube ? $request->youtube: null;
      $config->github= $request->github ? $request->github: null;

      if($request->hasFile('icon')){
        $imageName= Str::slug($request->title).'-icon.'.$request->icon->getClientOriginalExtension();
        $request->icon->move(public_path('uploads'),$imageName);
        $config->icon= 'uploads/'.$imageName;
      }

      if($request->hasFile('favicon')){
        $imageName= Str::slug($request->title).'-favicon.'.$request->favicon->getClientOriginalExtension();
        $request->favicon->move(public_path('uploads'),$imageName);
        $config->favicon= 'uploads/'.$imageName;
      }

      $config->save();
      toastr()->success('Başarıyla Güncellendi','Ayarlar');
      return redirect()->back();
    }
}
