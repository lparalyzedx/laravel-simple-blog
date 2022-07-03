@extends('back.layouts.master')
@section('title','Mesajlarım')
@section('content')
<?php use Illuminate\Support\Carbon; ?>
<div class="container shadow">
<div class="row clearfix">
    <div class="col-lg-12">

            <div class="chat">
                <div class="chat-header clearfix">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                <img src="https://bootdey.com/img/Content/avatar/avatar{{rand(0,9)}}.png" alt="avatar">
                            </a>
                            <div class="chat-about">
                                <h6 class="m-b-0">{{$user->name}}</h6>
                                <small>{{Carbon::parse($user->create_at)->diffForHumans()}}</small>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="chat-history">
                    <ul class="m-b-0">

                        <li class="clearfix">
                            <div class="message my-message">{{$user->message}},<br/><br/><span>E-posta adresi: </span>{{$user->email}},
                            <br/><br/><span>Telefon numarası: </span>{{$user->phone}}</div>
                        </li>
                    </ul>
                </div>

    </div>
</div>
</div>
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('back/css/messages.css')}}">
@endsection
