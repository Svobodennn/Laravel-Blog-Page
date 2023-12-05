@extends('back.layouts.master')
@section('title','Deleted Categories')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')
            <span class="m-0 font-weight-bold text-primary float-right"> <strong>{{$categories->count()}}</strong> Categoriess found</span></h6>
            <a href="{{route('categories.index')}}" class="btn btn-primary btn-sm float-right"> <i class="fa fa-eye"></i>Categories</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Article Title</th>
                        <th>Article Count</th>
                        <th>Created date</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Article Title</th>
                        <th>Article Count</th>
                        <th>Created date</th>
                        <th>Operations</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($categories as $category)
                    <tr>

                        <td>{{$category->name}}</td>
                        <td>{{$category->articleCount()}}</td>
                        <td>{{$category->created_at}}</td>

                        <td>
                                <a href="{{route('recover.category',$category->id)}}" title="Recover Category" class="btn btn-sm btn-primary"><i class="fa fa-recycle"></i></a>
                                <a href="{{route('hard.delete.category',$category->id)}}" title="Delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

