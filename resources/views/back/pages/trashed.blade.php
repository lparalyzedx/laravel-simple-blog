<?php use Illuminate\Support\Carbon; ?>
@extends('back.layouts.master')
@section('content')
@section('title','Silinen Sayfalar')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary"><strong>{{$pages->count()}} Makale Bulundu</strong></h6>
        <a class="btn btn-primary" href="{{route('articles.index')}}">Aktif Sayfalar</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Sayfa Başlığı</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pages as $page )
                    <tr>
                        <td><img src="{{asset($page->image)}}" width="200" alt=""></td>
                        <td>{{$page->title}}</td>
                        <td>
                            <a title="Kurtar" href="{{route('pages.recover',$page->id)}}" class="btn btn-sm btn-primary"><i class="fa-solid fa-recycle"></i></a>
                            <a title="Sil" href="{{route('pages.hard_delete',$page->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
@endsection

@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script type="text/javascript">
$(function() {
      $('.switch').change(function() {
      id= ($(this)[0].getAttribute('data-id'))
      statu= $(this).prop('checked')
      $.get("{{route('switch')}}", {id: id, statu: statu}, function(data, status){
   });
    })
  })
</script>
@endsection
