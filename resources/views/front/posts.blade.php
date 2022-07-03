@extends('front.layouts.master')
@section('content')
@section('title',$article->title)
@section('bg',asset($article->image))
@section('post_title',$article->title)

<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
              <p>{!!$article->content!!}</p>
                <p class="text-danger">
                    Görüntülenme Sayısı: {{$article->hit}}
                </p>

            </div>
            @isset($categories)
            @include('front/widgets/categorysWidget')
            @endisset
        </div>
        <span class=""></span>
    </div>


</article>
@endsection
