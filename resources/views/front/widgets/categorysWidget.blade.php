<div class="col-md-4">
                    
    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
            <h5>Categories</h5>
        </li>
        @foreach ($categories as $category )
       
        <li class="list-group-item d-flex justify-content-between align-items-center @if(Request::segment(2)==strtolower(trim($category->slag,'-'))) active @endif">
            <a href="{{route('category',$category->slag)}}">{{$category->name}}</a>
              <span class="badge bg-primary rounded-pill">{{$category->articleCount()}}</span>
            </li>
            
        @endforeach
        
      </ul>
</div>