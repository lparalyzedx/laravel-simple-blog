<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\articles;
use App\Models\categories;
use App\Models\contacts;

class Dashboardcontroller extends Controller
{
  public function __construct()
  {
    view()->share('contact',contacts::all());
    view()->share('count',contacts::where('status',1)->get()->count());
  }
    public function index()
    {
      $category= categories::all()->count();
      $hit= articles::sum('hit');
      $article= articles::all()->count();

        return view('back.dashboard',compact('category','hit','article'));
    }

    public function messages($slug)
    {
      $user= contacts::whereSlug($slug)->first();
      $user->status= 0;
      $user->save();
      return view('back.messages.index',compact('user'));
    }

}
