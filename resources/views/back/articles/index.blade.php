@extends('back.layouts.master')
@section('title','Articles')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')
            <span class="m-0 font-weight-bold text-primary float-right"> <strong>{{$articles->count()}}</strong> Articles found</span></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Article Title</th>
                        <th>Category</th>
                        <th>View Count</th>
                        <th>Created date</th>
                        <th>Status</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Image</th>
                        <th>Article Title</th>
                        <th>Category</th>
                        <th>View Count</th>
                        <th>Created date</th>
                        <th>Status</th>
                        <th>Operations</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($articles as $article)
                    <tr>
                        <td>
                            <img src="{{$article->image}}" width="150" alt="">
                        </td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->category_id}}</td>
                        <td>{{$article->hit}}</td>
                        <td>{{$article->created_at}}</td>
                        <td>
                            @if($article->status == 0)
                                <span class="badge bg-danger text-light">Passive</span>
                            @else <span class="badge bg-success text-light">Active</span> @endif
                        </td>
                        <td>
                                <a href="" title="View" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                <a href="" title="Edit" class="btn btn-sm btn-warning"><i class="fa fa-pen"></i></a>
                                <a href="" title="Delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
