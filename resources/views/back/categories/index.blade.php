@extends('back.layouts.master')
@section('title','Tüm Kategoriler')
@section('content')

<div class="row">
  <div class="col-md-4">
    <div class="shadow p-3 mb-5 bg-white rounded">
        <div class="card-header py3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
        </div>
            <div class="card-body">
              <form action="{{route('add')}}" method="post">
               @csrf
                <div class="form-group">
                  <label for="">Kategori Adı</label>
                  <input type="text" name="name" value="" class="form-control" required>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-block btn-primary">Ekle</button>
                </div>
              </form>
    </div>
    </div>
  </div>

  <div class="col-md-8">
    <div class="shadow p-3 mb-5 bg-white rounded">
        <div class="card-header py3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
            <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                          <tr>
                              <th>Kategori Adı</th>
                              <th>Makale Sayısı</th>
                              <th>Durum</th>
                              <th>İşlemler</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($categories as $categorie )
                          <tr>
                              <td>{{$categorie->name}}</td>
                              <td>{{$categorie->articleCount()}}</td>
                              <td><input type="checkbox"  class="switch" data-id='{{$categorie->id}}'  {{$categorie->status== 1 ? 'checked' : ''}} data-toggle="toggle" data-onstyle='success' data-offstyle='danger'  data-on="Aktif" data-off="Pasif"></td>
                              <td>
                                  <a title="Kategoriyi Düzenle" class="btn btn-sm btn-primary edit" data-id='{{$categorie->id}}' data-toggle="modal" data-target="#editCategory"><i class="fa-solid fa-pen-to-square"></i></a>
                                  <a title="Kategoriyi Sil" class="btn btn-sm btn-danger delete" data-id='{{$categorie->id}}' data-name='{{$categorie->name}}' data-count= '{{$categorie->articleCount()}}' data-toggle="modal" data-target="#deleteCategory"><i class="fas fa-times"></i></a>
                              </td>

                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
    </div>
    </div>
  </div>
  <div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Kategoriyi Düzenle</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('category_update')}}" method="post">
          @csrf
          <div class="form-group">
            <label for="">Kategori Adı</label>
            <input id="name" type="text" name="name" value="" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="">Kategori Slug</label>
            <input id='slug' type="text" name="slug" value="" class="form-control" required>
            <input id="id" type="hidden" name="id" value="">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
          <button type="submit" class="btn btn-success">Kaydet</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="deleteCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kategoriyi Sil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="category-body">
        <div class="category_text alert alert-danger">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
        <form action="{{route('category_delete')}}" method="post">
         @csrf
        <input type="hidden" id="delete_id" name="id" value="">
        <button type="submit" id="deleteBtn" class="btn btn-success">Sil</button>
        </form>
      </div>
    </div>
    </form>
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


// delete

$(function(){
  $('.delete').click(function(){
   id= $(this)[0].getAttribute('data-id');
   count= $(this)[0].getAttribute('data-count');
   name= $(this)[0].getAttribute('data-name');

   if(id==1){
      $('.category_text').html(name+' Kategorisi Sabit kategoridir, Silinen diğer kategorilere ait makaleler bu kategori içerisine gelecektir..');
      $('#deleteBtn').hide();
      $('#category-body').show();
      return;
   }

  $('.category_text').html('');
  $('#category-body').hide();
  $('#deleteBtn').show();
  $('#delete_id').val(id);

   if(count>0){
  $('.category_text').html('Bu kategoriye ait '+count+ ' makale bulunmakta silmek istediğinizden emin misiniz ?');
  $('#category-body').show();
   }
  })
})


// guncelleme
$(function(){
  $('.edit').click(function(){
  id= $(this)[0].getAttribute('data-id');
  $.ajax({
    type: 'GET',
    url: "{{route('getdata')}}",
    data: {id: id},
    success: function(data){
      $('#name').val(data.name);
      $('#slug').val(data.slag);
      $('#id').val(data.id);
    }
  });
  });
});


// switch

$(function() {
      $('.switch').change(function() {
      id= ($(this)[0].getAttribute('data-id'))
      statu= $(this).prop('checked')
      $.get("{{route('category.switch')}}", {id: id, statu: statu}, function(data, status){
   });
    })
  })
</script>
@endsection
