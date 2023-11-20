@extends('front.layouts.master')

@section('title','Homepage')

@section('content')
    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-9">
                <!-- Post preview-->
                @foreach($articles as $article)
                <div class="post-preview">
                    <a href="post.html">
                        <h2 class="post-title">{{$article->title}}</h2>
                        <h3 class="post-subtitle">{{\Illuminate\Support\Str::limit($article->content,80,'    [click to read more...]') }}</h3>
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
            </div>
            @include('front.widgets.categoryWidget')
        </div>
    </div>
@endsection
