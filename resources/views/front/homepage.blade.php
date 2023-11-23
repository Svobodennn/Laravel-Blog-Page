@extends('front.layouts.master')

@section('title','Homepage')

@section('content')
    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-9">
                <!-- Post preview-->
                @include('front.widgets.articleList');
            </div>
                @include('front.widgets.categoryWidget')
        </div>
    </div>
@endsection
