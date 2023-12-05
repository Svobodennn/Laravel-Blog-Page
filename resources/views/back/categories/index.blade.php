@extends('back.layouts.master')
@section('title','Categories')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')
            <span class="m-0 font-weight-bold text-primary float-right"> <strong>{{$categories->count()}}</strong> Categories found</span></h6>
            <a href="{{route('trashed.categories')}}" class="btn btn-warning btn-sm float-right"> <i class="fa fa-trash"></i> Deleted Categories</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Category Title</th>
                        <th>Article Count</th>
                        <th>Created date</th>
                        <th>Status</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Category Title</th>
                        <th>Article Count</th>
                        <th>Created date</th>
                        <th>Status</th>
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
                            <input class="switch" category-id="{{$category->id}}" type="checkbox" data-on="Active" data-off="Passive" data-onstyle="success" data-offstyle="danger" @if($category->status==1) checked
                                   @endif data-toggle="toggle">
                        </td>
                        <td>
                                <a href="{{route('categories.edit',$category->id)}}" title="Edit" class="btn btn-sm btn-warning"><i class="fa fa-pen"></i></a>
                                <a href="{{route('delete.category',$category->id)}}" title="Archive" class="btn btn-sm btn-danger"><i class="fa fa-archive"></i></a>
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
@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function() {
            $('.switch').change(function() {
                id = $(this)[0].getAttribute('category-id');
                statu=$(this).prop('checked');
                $.get("{{route('switch.category')}}", {id:id,statu:statu},  function(data, status) {});
            })
        })


    </script>
@endsection