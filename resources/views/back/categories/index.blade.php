@extends('back.layouts.master')
@section('title','Categories')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')
                <span class="m-0 font-weight-bold text-primary float-right"> <strong>{{$categories->count()}}</strong> Categories found</span>
            </h6>
            <a href="{{route('trashed.categories')}}" class="btn btn-warning btn-sm float-right"> <i
                    class="fa fa-trash"></i> Deleted Categories</a>
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
                                <input class="switch" category-id="{{$category->id}}" type="checkbox" data-on="Active"
                                       data-off="Passive" data-onstyle="success" data-offstyle="danger"
                                       @if($category->status==1) checked
                                       @endif data-toggle="toggle">
                            </td>
                            <td>
                                <a category-id="{{$category->id}}" title="Edit"
                                   class="btn btn-sm btn-warning edit-click"><i class="fa fa-pen"></i></a>
                                <a category-id="{{$category->id}}" article-count="{{$category->articleCount()}}"
                                   title="Archive"
                                   class="btn btn-sm btn-danger archive-click"><i class="fa fa-archive"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal" id="editModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>
                </div>
                <div class="modal-body">
                    <form method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input id="name" name="name" class="form-control" placeholder="Category Name..."
                                   type="text">
                            <input type="hidden" name="id" id="idEdit">
                        </div>
                        <div class="form-group">
                            <label for="slug">Category Slug</label>
                            <input id="slug" name="slug" class="form-control" placeholder="Category Name..."
                                   type="text">
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="submit" type="submit" class="btn btn-primary">Save changes</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="archiveModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Are you sure you want to archive this category?</h5>
                </div>
                <div id="archiveBody" class="modal-body">
                    <div id="articleAlert" class="alert alert-danger">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form id="archiveForm" method="get">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="idArchive" id="idArchive">
                            <button type="submit" name="heloheleley" id="submitButton" class="btn btn-danger" data-dismiss="modal">
                                Archive
                            </button>
                        </div>
                    </form>

                </div>
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
        $(function () {

            $('.edit-click').click(function () {

                id = $(this)[0].getAttribute('category-id');

                $.ajax({
                    type: 'GET',
                    url: '{{route('category.getData')}}',
                    data: {id: id},
                    success: function (data) {
                        $('#name').val(data.name)
                        $('#slug').val(data.slug)
                        $('#idEdit').val(data.id)

                        var formAction = '{{ route('categories.update', ['category' => '__ID__']) }}';
                        formAction = formAction.replace('__ID__', data.id);
                        $('form').attr('action', formAction);

                        $('#editModal').modal();


                    }
                })
            })
            $('.archive-click').click(function () {

                id = $(this)[0].getAttribute('category-id');

                articleCount = $(this)[0].getAttribute('article-count');

                $('#articleAlert').html('')
                $('#archiveBody').hide()
                if (articleCount > 0) {
                    $('#articleAlert').html('This category has ' + articleCount + ' articles. Are you sure you want to archive?')
                    $('#archiveBody').show()
                }

                $('#idArchive').val(id)

                var formAction = '{{ route('delete.category', ['id' => '__ID__']) }}';
                formAction = formAction.replace('__ID__', id);
                $('form').attr('action', formAction);

                $('#archiveModal').modal();


            })


            $('#submitButton').click(function (event) {
                console.log('Script is running...');

                event.preventDefault(); // Prevent the default form submission
                $('#archiveForm').submit(); // Submit the form
            });


            $('.switch').change(function () {
                id = $(this)[0].getAttribute('category-id');
                statu = $(this).prop('checked');
                $.get("{{route('switch.category')}}", {id: id, statu: statu}, function (data, status) {
                });
            })

            $('#name').on('input', function() {
                var title = $(this).val().trim().toLowerCase();

                // Turkish character mapping
                var turkishCharacters = {
                    'ç': 'c',
                    'ğ': 'g',
                    'ı': 'i',
                    'ö': 'o',
                    'ş': 's',
                    'ü': 'u'
                };

                // Replace Turkish characters
                title = title.replace(/[çğıöşü]/g, function(match) {
                    return turkishCharacters[match];
                });

                // Replace non-alphanumeric characters
                var slug = title.replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');

                $('#slug').val(slug);
            });
        })


    </script>
@endsection
