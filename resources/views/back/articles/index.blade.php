<?php use Illuminate\Support\Carbon; ?>
@extends('back.layouts.master')
@section('content')
@section('title','Tüm Makaleler')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary"><strong>{{$articles->count()}} Makale Bulundu</strong></h6>
        <a href="{{route('trashed')}}" class="btn btn-warning">Silinen Makaleler&nbsp;<i class="fas fa-trash"></i></a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Makale Başlığı</th>
                        <th>Kategori</th>
                        <th>Görüntülenme Sayısı</th>
                        <th>Oluşturulma Tarihi</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article )
                    <tr>
                        <td><img src="{{asset($article->image)}}" width="200" alt=""></td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->getCategory->name}}</td>
                        <td>{{$article->hit}}</td>
                        <td>{{Carbon::parse($article->create_at)->diffForHumans()}}</td>
                        <td><input type="checkbox"  class="switch" data-id='{{$article->id}}'  {{$article->status== 1 ? 'checked' : ''}} data-toggle="toggle" data-onstyle='success' data-offstyle='danger'  data-on="Aktif_" data-off="Pasif_"></td>
                        <td><a title="Görüntüle"  class="btn btn-sm btn-success" href=""><i class="fa fa-eye"></i></a>
                            <a title="Düzenle" class="btn btn-sm btn-primary" href="{{route('articles.edit',$article)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a title="Sil" href="{{route('delete',$article->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
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
