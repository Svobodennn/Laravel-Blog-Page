<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Categories
        </div>
        <div class="list-group">
            @foreach($categories as $category)
                <a href="{{route('category',$category->slug)}}" class="list-group-item @if(Request::segment(2)==$category->slug) active @endif">{{$category['name']}} <span class="badge @if(Request::segment(2)==$category->slug) bg-info @else bg-primary @endif float-end ">{{$category->articleCount()}}</span></a>

            @endforeach
        </div>
    </div>
</div>
