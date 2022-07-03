<?php use Illuminate\Support\Carbon; ?>


@extends('front.layouts.master')
@section('title','Anasayfa')
@section('post_title','Anasayfa')
@section('content')
                    <div class="col-md-8 col-lg-8 col-xl-7">
                    @foreach ($articles as $article)
                    <div class="post-preview">
                        <h2 class="post-title">{{$article->title}}</h2>
                        <a href="{{route('single',$article->slug)}}">
                            <img src="{{$article->image}}" alt="" style="width: 80%">
                            
                            <h3 class="post-subtitle">{!!Str::limit($article->content,50)!!}</h3>
                            
                        </a>
                        
                        <p class="post-meta">
                            Categories : 
                            <a href="#!">{{$article->getCategory->name}}</a>
                           

                            <span class="float-end">{{Carbon::parse($article->created_at)->diffForHumans(now());}}</span> 
                        </p>
                    </div>
                    
                    @if(!$loop->last)
                    <hr class="my-4" />
                    @endif
                    
                    @endforeach
                    {{$articles->links("pagination::bootstrap-4")}}
                    </div>
                    @include('front.widgets.categorysWidget')
@endsection
        