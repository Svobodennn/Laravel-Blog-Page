@extends('front.layouts.master')

@section('title',$article->title)
@section('bg',$article->image)

@section('content')
    <!-- Main Content-->
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-9">
                   {{!!$article->content!!}}
{{--                    allow html tags--}}
                    <span class="text-danger">Hit count: <b>{{$article->hit}}</b></span>
                </div>
                @include('front.widgets.categoryWidget')
            </div>
        </div>
    </article>

@endsection
