<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\contactRequest;
use App\Models\categories;
use App\Models\articles;
use App\Models\pages;
use App\Models\contacts;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Models\Configs;
use Mail;

class Homecontroller extends Controller
{

    public function __construct()
    {
      if(Configs::find(1)->status==0){
        return redirect()->to('bakimdayiz')->send();
      }
       view()->share('categories',categories::where('status',1)->inRandomOrder()->get());
       view()->share('pages',pages::where('status',1)->orderBy('order','ASC')->get());
       view()->share('config',Configs::find(1));
       view()->share('socials', ['facebook','twitter','instagram','youtube','github']);
    }

    public function index()
    {
        $data['articles'] = articles::with('getCategory')->where('status',1)->whereHas('getCategory',function($query){
          $query->where('status',1);
        })->orderBy('create_at','DESC')->paginate(3);
       return view('front.homepage',$data);
    }

    public function single($slug)
    {

        $article = articles::whereSlug($slug)->first() ?? abort(403,'Sayfa Bulunamadı');
        $data['article'] = $article;
        $article->increment('hit');

        return view('front.posts',$data);
    }

    public function category($slug)
    {
       $category = categories::where('status',1)->whereSlag($slug)->first() ?? abort(403,'Kategori Bulunamadı');
       $data['articles'] = articles::where('status',1)->where('category_id',$category->id)->paginate(1);
       $data['currentKategory'] = $category;
       return view('front.category',$data);
    }

    public function page($slug)
    {
        $data['Currentpage'] = pages::whereSlug($slug)->first() ?? abort(403,'Sayfa Bulunamadı');
        return view('front.page',$data);
    }

        public function contact()
        {
            return view('front.contact');
        }

        public function contactPost(contactRequest $request)
        {
            if($request->validated()){

              contacts::insert([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'email' => $request->email,
                'phone' => $request->phone,
                'topic' => $request->topic,
                'message' => $request->message
              ]);


              return redirect()->route('contact')->with('success','Mesajınız Bize İletildi, Teşekkür Ederiz.');
            }else{
                redirect()->back()->withErrors()->withInput();
            }
        }

        public function bakim()
        {
          return 'Bakımdayiz...';
        }


}
