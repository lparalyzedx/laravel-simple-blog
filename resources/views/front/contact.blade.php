@extends('front.layouts.master')
@section('title','İletişim')
@section('post_title','İletişim')
@section('bg','https://cdn.glitch.me/c5046b33-5977-434a-bdf2-c97d6e73d42c%2FContact_Banner.jpg')
@section('content')

 <div class="col-md-10 col-lg-8 col-xl-7">
    @if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
    @elseif ($errors->any())
    <div class="alert alert-danger">
       
            <span>{{ $errors->first()}}</span>
    
    </div>
    @endif
    <p>Bizimle İletişime Geçebilirsiniz..</p>
    <div class="my-5">
           <form method='POST' action="{{route('contact.post')}}">
            @csrf
            <label for="exampleFormControlInput" class="form-label">Ad Soyad</label>
            <input type="text" class="form-control" id="exampleFormControlInput" placeholder="Ad Soyad" name="name" value="{{old('name')}}">
             
            <br/>
            <label for="exampleFormControlInput1" class="form-label">E-posta adresi</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="E-posta adresi" name="email" value="{{old('email')}}">
            <br/>
            <label for="exampleFormControlInput2" class="form-label">Telefon Numarası</label>
            <input type="number" class="form-control" id="exampleFormControlInput2" placeholder="Telefon Numarası" name="phone" value="{{old('phone')}}">
            <br/>

            <label for="topic">Konu</label>

            <select name="topic"  id='topic' class="form-select">
                <option value="Destek" @if(old('topic') == 'Destek') selected @endif>Destek</option>
                <option value="Hizmet" @if(old('topic') == 'Hizmet') selected @endif>Hizmet</option>
                <option value="Oneri"  @if(old('topic') == 'Oneri') selected @endif>Görüş / Öneri</option>
            </select>
            <br/>
            <label for="floatingTextarea2">Mesajınız</label>
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="message" value="{{old('message')}}"></textarea>
            <br/>
            <button class="btn btn-primary text-uppercas" id="submitButton" type="submit">Gönder</button>
        </form>
    </div>
</div>
</div>
</div>
</main>
</div>
</div>

@endsection