@extends('back.layouts.master')
@section('title','Edit Category')
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
                <form method="post" action="{{route('categories.update',$category->id)}}">
                    @method('PUT')
{{--                    update operation--}}
                    @csrf
                    <div class="form-group">
                        <label for="">Category Name</label>
                        <input value="{{$category->name}}" placeholder="Enter Category Title" type="text" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
