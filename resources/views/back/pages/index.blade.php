<?php use Illuminate\Support\Carbon; ?>
@extends('back.layouts.master')
@section('content')
@section('title','Tüm Sayfalar')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary"><strong>{{$pages->count()}} Sayfa Bulundu</strong></h6>
        <a href="{{route('pages.trashed')}}" class="btn btn-warning">Silinen Sayfalar&nbsp;<i class="fas fa-trash"></i></a>
    </div>
    <div class="card-body">
      <div  id='orderSuccess' style="display:none;" class="alert alert-success">
        Sıralama Başaryıla Güncellendi
      </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sıralama</th>
                        <th>Fotoğraf</th>
                        <th>Sayfa Başlığı</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody id="orders">
                    @foreach ($pages as $page )
                    <tr id='page_{{$page->id}}' class="bg-light">
                        <td width='3%' class="text-center"><i style="cursor:move; margin:auto;" class="fa-solid fa-arrows-up-down fa-3x handle"></i></td>
                        <td><img src="{{asset($page->image)}}" width="200" alt=""></td>
                        <td>{{$page->title}}</td>
                        <td><input type="checkbox"  class="switch" data-id='{{$page->id}}'  {{$page->status== 1 ? 'checked' : ''}} data-toggle="toggle" data-onstyle='success' data-offstyle='danger'  data-on="Aktif_" data-off="Pasif_"></td>
                        <td><a title="Görüntüle"  class="btn btn-sm btn-success" href="{{route('page',$page->slug)}}"><i class="fa fa-eye"></i></a>
                            <a title="Düzenle" class="btn btn-sm btn-primary edit" href="{{route('pages.update',$page->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a title="Sil" href="{{route('pages.delete',$page->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
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
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">

$('#orders').sortable({
 handle: '.handle',
 update: function(sortable){
   var siralama= $('#orders').sortable('serialize');
   $.get('{{route('pages.orders')}}?'+siralama, function(data,status){
     $('#orderSuccess').show();
     setTimeout(function(){
         $('#orderSuccess').hide();
     },1000);
   });
 }
});


$(function() {
      $('.switch').change(function() {
      id= ($(this)[0].getAttribute('data-id'))
      statu= $(this).prop('checked')
      $.get("{{route('pages.switch')}}", {id: id, statu: statu}, function(data, status){
   });
    })
  })
</script>
@endsection
