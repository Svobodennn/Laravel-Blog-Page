@extends('front.layouts.master')

@section('title',$page->title)
@section('bg',$page->image)

@section('content')
    <!-- Main Content-->
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-9">
                   {{!!$page->content!!}}
{{--                    allow html tags--}}
                </div>
            </div>
        </div>
    </article>

@endsection
