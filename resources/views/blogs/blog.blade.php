@extends('layouts.master')
@section('css')
@section('title')
    Blog
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="container">
    <div class="row">
        <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal" align="left">
            Add Blog
        </button>
    </div>
    <br>
    <div class="col-sm-6">
        <h4>Here You Can Create/Edit/Delete </h4>
    </div>
    <hr>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="table-responsive">
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
            style="text-align: center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Small Description</th>
                    <th>Image</th>
                    <th>Category Name</th>
                    <th>Proccesses</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                    <tr>
                        <td> {{ $loop->iteration }}</td>
                        <td>{{ $row->title }}</td>
                        <td>{{ $row->Description }}</td>
                        <td>{{ $row->smallDes }}</td>

                        <td>
                            <img src="./images/{{$row->image}}" width="70px" height="70px" alt="Image">
                        </td>
                        <td>{{$row->cat_id}}</td>

                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                data-target="#edit{{ $row->id}}" title="Edit"><i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#delete{{ $row->id}}" title="Delete">
                                <i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    <!-- delete_modal_blog -->
                    <div class="modal fade" id="delete{{$row->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                        id="exampleModalLabel">
                                        Delete Blog </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('blog.destroy', 'test') }}" method="post">
                                        {{ method_field('Delete') }}
                                        @csrf
                                        <h6>Are You Sure you want to delete this blog?</h6>
                                        <input id="id" type="hidden" name="id" class="form-control"
                                            value="{{ $row->id }}">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
</div>
    {{-- EDIT Blog --}}
    <div class="modal fade"  id="edit{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        Edit Blog </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Edit form -->
                    <form action="{{ route('blog.update','test') }}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="mb-3 row">
                            <label for="title" class="mr-sm-2">Title:</label>
                            <input type="text" class="form-control" name="title" value="{{isset($row)?$row->title:''}}">
                        </div>
                        <div class="mb-3 row">
                            <label for="Description" class="mr-sm-2">Description
                                :</label>
                            <textarea class="form-control" value="{{isset($row)?$row->Description:''}}" name="Description" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="mb-3 row">
                            <label for="exampleFormControlTextarea1" class="mr-sm-2">Small Description
                                :</label>
                            <input type="text" class="form-control" name="smallDes"  value="{{isset($row)?$row->smallDes:''}}">
                        </div>

                        <div class="mb-3 row">
                            <label for="inlineFormCustomSelectPref" class="mr-sm-2">Choose Category</label>
                            <select name="" class="form-control" onchange="console.log($(this).val())" required>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}" >
                                    {{$category->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 row">
                            <input type="file" name="image" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png">
                            <button type="submit">Upload</button>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Edit Data</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </tbody>
</table>
</div>
</div>

{{-- add --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Add Blog </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add form -->
                <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <label for="title" class="mr-sm-2">Title:</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="mb-3 row">
                        <label for="Description" class="mr-sm-2">Description
                            :</label>
                        <textarea class="form-control" name="Description" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="mb-3 row">
                        <label for="exampleFormControlTextarea1" class="mr-sm-2">Small Description
                            :</label>
                        <input type="text" class="form-control" name="smallDes">
                    </div>

                    <div class="mb-3 row">
                        <label for="inlineFormCustomSelectPref" class="mr-sm-2">Choose Category</label>
                        <select name="id" class="form-control" selected required>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}" selected>
                                {{$category->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 row">
                        <input type="file" name="image">
                        <button type="submit">Upload</button>
                        </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>

                </form>
            </div>
    </div>
</div>
</div></div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
