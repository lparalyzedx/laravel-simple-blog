@extends('back.layouts.master')
@section('title','Sayfa Oluştur')
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
            <form action="{{route('pages.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Sayfa Başlığı</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="form-group">
                    <label>Sayfa Fotoğrafı</label>
                    <input type="file" class="form-control" name="image" required>
                </div>
                <div class="form-group">
                    <label>Sayfa İçeriği</label>
                    <textarea class="form-control" id="editor" rows='4' name="content" required></textarea>
                </div>

                <div class="form-group">
                   <button class="btn btn-block btn-primary">Sayfa Oluştur</button>
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
