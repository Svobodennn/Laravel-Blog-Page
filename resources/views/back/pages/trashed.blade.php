@extends('back.layouts.master')
@section('title','Deleted Pages')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')
            <span class="m-0 font-weight-bold text-primary float-right"> <strong>{{$pages->count()}}</strong> Pages found</span></h6>
            <a href="{{route('pages.index')}}" class="btn btn-primary btn-sm float-right"> <i class="fa fa-eye"></i>Pages</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Page Title</th>
                        <th>Created Date</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Image</th>
                        <th>Page Title</th>
                        <th>Created Date</th>
                        <th>Operations</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($pages as $page)
                    <tr>
                        <td>
                            <img src="{{asset($page->image)}}" width="150" alt="">
                        </td>
                        <td>{{$page->title}}</td>
                        <td>{{$page->created_at}}</td>

                        <td>
                                <a href="{{route('recover.page',$page->id)}}" title="Recover Page" class="btn btn-sm btn-primary"><i class="fa fa-recycle"></i></a>
                                <a href="{{route('hard.delete.page',$page->id)}}" title="Delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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

