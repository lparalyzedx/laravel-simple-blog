<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Authcontroller extends Controller
{
    public function login()
    {
        return view('back.auth.login');
    }

    public function loginPost(Request $request)
    {
      if( Auth::attempt(['email' => $request->email, 'password' => $request->password])){
        toastr()->success('Hoş Geldiniz', Auth::user()->name);
       return redirect()->route('dashboard');
      }else{
        return  redirect()->route('login')->withErrors('E-posta Adresi Veya Şifre Hatalı!');
      }
    }

    public function logout()
    {
      Auth::logout();
      return redirect()->route('login');
    }
}
