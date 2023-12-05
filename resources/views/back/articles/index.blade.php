@extends('back.layouts.master')
@section('title','Articles')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')
            <span class="m-0 font-weight-bold text-primary float-right"> <strong>{{$articles->count()}}</strong> Articles found</span></h6>
            <a href="{{route('trashed.articles')}}" class="btn btn-warning btn-sm float-right"> <i class="fa fa-trash"></i> Deleted Articles</a>
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
                            <img src="{{asset($article->image)}}" width="150" alt="">
                        </td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->getCategory->name}}</td>
                        <td>{{$article->hit}}</td>
                        <td>{{$article->created_at}}</td>
                        <td>
                            <input class="switch" article-id="{{$article->id}}" type="checkbox" data-on="Active" data-off="Passive" data-onstyle="success" data-offstyle="danger" @if($article->status==1) checked
                                   @endif data-toggle="toggle">
                        </td>
                        <td>
                                <a target="_blank" href="{{route('single',[$article->getCategory->slug,$article->slug])}}" title="View" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                <a href="{{route('articles.edit',$article->id)}}" title="Edit" class="btn btn-sm btn-warning"><i class="fa fa-pen"></i></a>

                                <a href="{{route('delete.article',$article->id)}}" title="Archive" class="btn btn-sm btn-danger"><i class="fa fa-archive"></i></a>
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
                id = $(this)[0].getAttribute('article-id');
                statu=$(this).prop('checked');
                $.get("{{route('switch.article')}}", {id:id,statu:statu},  function(data, status) {});
            })
        })


    </script>
@endsection
