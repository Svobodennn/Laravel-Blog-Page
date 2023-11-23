@extends('front.layouts.master')

@section('title',$category->name)

@section('content')
    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-9">
                @include('front.widgets.articleList')
            </div>
            @include('front.widgets.categoryWidget')
        </div>
    </div>
@endsection
