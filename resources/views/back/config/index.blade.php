@extends('back.layouts.master')
@section('content')
@section('title','Ayarlar')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary"><strong>@yield('title')</strong></h6>

    </div>
    <div class="card-body">
     <form class="" action="{{route('update')}}" method="post" enctype="multipart/form-data">
        <div class="row">
          @csrf
          <div class="col-md-6">
          <div class="form-group">
            <label>Site Başlığı</label>
            <input type="text" name="title" class="form-control" value="{{$config->title}}">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>Site Aktiflik Durumu</label>
            <select class="form-control" name="status">
              <option {{$config->status ==0 ? 'selected' : ''}} value="0"> Kapalı</option>
              <option {{$config->status ==1 ? 'selected' : ''}} value="1"> Açık</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Site logo</label>
            <input type="file" name="icon" class="form-control" value="{{$config->icon}}">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Site favicon</label>
            <input type="file" name="favicon" class="form-control" value="{{$config->favicon}}">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Facebook</label>
            <input type="text" name="facebook" class="form-control" value="{{$config->facebook}}">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Instagram</label>
            <input type="text" name="instagram" class="form-control" value="{{$config->instagram}}">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Youtube</label>
            <input type="text" name="youtube" class="form-control" value="{{$config->youtube}}">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Github</label>
            <input type="text" name="github" class="form-control" value="{{$config->github}}">
          </div>
        </div>
        <button type="submit" class="btn  btn-block btn-primary">Güncelle</button>

      </div>
      </form>

</div>

</div>
@endsection
