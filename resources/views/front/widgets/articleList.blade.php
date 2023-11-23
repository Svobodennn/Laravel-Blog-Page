@if(count($articles) > 0)

    @foreach($articles as $article)
        <div class="post-preview">
            <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}">
                <h2 class="post-title">{{$article->title}}</h2>
                <img class="img-fluid" src="{{$article->image}}" alt="{{$article->title}}">
                <h3 class="post-subtitle">{{\Illuminate\Support\Str::limit($article->content,80,'...    [click to read more]') }}</h3>
            </a>
            <p class="post-meta">
                <a href="#!">{{$article->getCategory->name}}</a>
                <span class="float-end">{{$article->created_at->diffForHumans()}}</span>
            </p>
        </div>
        @if(!$loop->last)

            <hr class="my-4"/>
        @endif
        <!-- Divider-->
    @endforeach
    {{$articles->links('pagination::bootstrap-5')}}
@else
    <div class="alert alert-danger">
        <h1>There are no articles belonging this category.</h1>
    </div>
@endif
