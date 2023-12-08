@extends('back.layouts.master')
@section('title','Create Page')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </div>
                    </ul>
                @endif
{{--                enctype --> uploading photo --}}
                <form method="post" action="{{route('pages.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Page Title</label>
                        <input placeholder="Enter Page Title" type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Page Image</label>
                        <input placeholder="Enter Page Title" type="file" name="image" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Page Content</label>
                        <textarea id="summernote" name="text" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Create Page</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('css')
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    @endsection
    @section('js')
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#summernote').summernote(
                    {
                        'height':200
                    }
                );
            });
        </script>

    @endsection
@endsection
