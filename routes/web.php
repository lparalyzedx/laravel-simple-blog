<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\Homecontroller;
use App\Http\Controllers\back\Dashboardcontroller;
use App\Http\Controllers\back\Authcontroller;
use App\Http\Controllers\back\ArticleController;
use App\Http\Controllers\back\CategoriesController;
use App\Http\Controllers\back\PageController;
use App\Http\Controllers\back\ConfigController;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
*/

Route::get('/bakimdayiz',function(){
  return view('front.bakim');
})->name('bakim');
Route::get('/',[Homecontroller::class,'index'])->name('index');
Route::get('blog/{slug}',[Homecontroller::class,'single'])->name('single');
Route::get('/category/{category}',[Homecontroller::class,'category'])->name('category');
Route::get('/iletisim',[Homecontroller::class,'contact'])->name('contact');
Route::post('/iletisim',[Homecontroller::class,'contactPost'])->name('contact.post');
Route::get('/{page}',[Homecontroller::class,'page'])->name('page');



/*
|--------------------------------------------------------------------------
| Back Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('İsadmin')->group(function(){
    Route::get('panel',[Dashboardcontroller::class,'index'])->name('dashboard');
    // ARTİCLE ROUTE'S
    Route::resource('articles',ArticleController::class);
    Route::get('/switch',[ArticleController::class,'switch'])->name('switch');
    Route::get('delete/{id}',[ArticleController::class,'delete'])->name('delete');
    Route::get('recover/{id}',[ArticleController::class,'recover'])->name('recover');
    Route::get('hard-delete/{id}',[ArticleController::class,'hard_delete'])->name('hard_delete');
    Route::get('/trashed',[ArticleController::class,'trashed'])->name('trashed');
    // CATEGORİE ROUTE'S
    Route::get('/kategoriler',[CategoriesController::class,'index'])->name('categories');
    Route::get('/status',[CategoriesController::class,'switch'])->name('category.switch');
    Route::post('/add',[CategoriesController::class,'add'])->name('add');
    Route::get('/data',[CategoriesController::class,'getData'])->name('getdata');
    Route::post('/category_update',[CategoriesController::class,'update'])->name('category_update');
    Route::post('/category_delete',[CategoriesController::class,'delete'])->name('category_delete');
    Route::get('/mesajlar/{slug}',[Dashboardcontroller::class,'messages'])->name('message');
    Route::get('logout',[Authcontroller::class,'logout'])->name('logout');
    // PAGES ROUTE'S
    Route::prefix('sayfalar')->group(function(){
      Route::get('/',[PageController::class,'index'])->name('pages.index');
      Route::get('/page-switch',[PageController::class,'switch'])->name('pages.switch');
      Route::get('/olustur',[PageController::class,'create'])->name('pages.create');
      Route::post('/olustur',[PageController::class,'store'])->name('pages.store');
      Route::get('/guncelle/{id}',[PageController::class,'updatePage'])->name('pages.update');
      Route::post('/update/{id}',[PageController::class,'update'])->name('pages.updatePost');
      Route::get('/delete/{id}',[PageController::class,'delete'])->name('pages.delete');
      Route::get('/silinenler',[PageController::class,'trashed'])->name('pages.trashed');
      Route::get('/hard_delete/{id}',[PageController::class,'hard_delete'])->name('pages.hard_delete');
      Route::get('/recover/{id}',[PageController::class,'recover'])->name('pages.recover');
      Route::get('/order',[PageController::class,'order'])->name('pages.orders');

    });

    // CONFİG ROUTE'S
    Route::get('/ayarlar',[ConfigController::class,'index'])->name('config');
    Route::post('/update',[ConfigController::class,'update'])->name('update');

});



Route::prefix('admin')->middleware('İslogin')->group(function(){
    Route::post('giris',[Authcontroller::class,'loginPost'])->name('loginPost');
    Route::get('giris',[Authcontroller::class,'login'])->name('login');
});
