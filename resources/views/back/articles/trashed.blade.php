<?php use Illuminate\Support\Carbon; ?>
@extends('back.layouts.master')
@section('content')
@section('title','Silinen Makaleler')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary"><strong>{{$articles->count()}} Makale Bulundu</strong></h6>
        <a class="btn btn-primary" href="{{route('articles.index')}}">Aktif Makaleler</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Makale Başlığı</th>
                        <th>Kategori</th>
                        <th>Silinme Tarihi</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article )
                    <tr>
                        <td><img src="{{asset($article->image)}}" width="200" alt=""></td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->getCategory->name}}</td>
                        <td>{{Carbon::parse($article->deleted_at)->diffForHumans()}}</td>
                        <td>
                            <a title="Kurtar" href="{{route('recover',$article->id)}}" class="btn btn-sm btn-primary"><i class="fa-solid fa-recycle"></i></a>
                            <a title="Sil" href="{{route('hard_delete',$article->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
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
