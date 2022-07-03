@extends('back.layouts.master')
@section('title',$article->title .' Makalesini Güncelle')
@section('content')
<div class="shadow p-3 mb-5 bg-white rounded">
    <div class="card-header py3 bg-white">
        <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
    </div>
        <div class="card-body">
          @if($errors->any())
          <div class="alert alert-danger">
            {{$errors->first()}}
          </div>
          @endif
            <form action="{{route('articles.update',$article->id)}}" method="POST" enctype="multipart/form-data">
              @method('PUT')
                @csrf
                <div class="form-group">
                    <label>Makale Başlığı</label>
                    <input type="text" class="form-control" name="title" value="{{$article->title}}" required>
                </div>
                <div class="form-group">
                    <label>Makale Kategorisi</label>
                    <select name="category" class="form-control" required>
                        <option selected>Kategori Seçiniz</option>
                        @foreach ($categories as  $category)
                            <option  {{$article->category_id == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Makale Fotoğrafı</label>
                    <br>
                    <img src="{{asset($article->image)}}" width="300" alt="" class="img-thumbnail rounded">
                    <input type="file" class="form-control" name="image">
                </div>
                <div class="form-group">
                    <label>Makale İçeriği</label>
                    <textarea class="form-control" id="editor" rows='4' name="content" required>{!!$article->content!!}</textarea>
                </div>

                <div class="form-group">
                   <button class="btn btn-block btn-primary">Makaleyi Güncelle</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
  $('#editor').summernote(
    {
      'height' : 240
    }
  );
});

</script>
@endsection
