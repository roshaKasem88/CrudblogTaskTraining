@extends('layouts.master')
@section('css')

@section('title')
    empty
@stop
@section('page-header')

@endsection
@section('content')
<!-- row -->
<div class="container">
    <div class="row">
        <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal" align="left">
            Add Category
        </button>
    </div>
    <br>
    <div class="col-sm-6">
        <h4>Here You Can Create/Edit/Delete </h4>
    </div>
    <hr>
    @if ($errors->any())
        <div class="error">{{ $errors->first('Name') }}</div>
    @endif
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
                    <th>Category Name</th>
                    <th>Proccesses</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td> {{ $loop->iteration }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                data-target="#edit{{ $category->id }}" title="Edit"><i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#delete{{ $category->id }}" title="Delete">
                                <i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
<!-- edit_modal_category -->
<div class="modal fade" id="edit{{$category->id}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                    id="exampleModalLabel">
                    Edit Category
                </h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Edit_form -->
                <form action="{{route('category.update', 'test') }}" method="post">
                    {{ method_field('patch') }}
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="col">
                                <label for="title" class="mr-sm-2">Category Name:</label>
                                <input type="text" class="form-control" value="{{isset($category)?$category->category_name:''}}" name="category_name">
                                <input id="cat_id" type="hidden" name="cat_id"
                                class="form-control" value="{{ $category->cat_id}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>

                </form>
            </div>   </div>   </div>

                 <!-- delete_modal_Grade -->
                 <div class="modal fade" id="delete{{$category->id}}" tabindex="-1"
                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;"
                                    class="modal-title" id="exampleModalLabel">
                                    Delete Category
                                </h5>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('category.destroy', 'test') }}"
                                    method="post">
                                    {{ method_field('Delete') }}
                                    @csrf
                                   <h6>Are You Sure You want to delete this category?</h6>
                                    <input id="id" type="hidden" name="cat_id"
                                        class="form-control" value="{{ $category->cat_id }}">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit"
                                            class="btn btn-danger">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
            </tbody>
        </table>
    </div>
</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Add Category
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_blog_form -->
                <form action="{{ route('category.store') }}" method="POST">
                    @csrf
                        <div class="row">
                            <div class="col">
                                <div class="col">
                                    <label for="title" class="mr-sm-2">Category Name:</label>
                                    <input type="text" class="form-control" name="category_name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                    </div>
                    </div>
        </div>
    </form>

    </div>
   </div>
    </div>

<!-- row closed -->
@endsection
@section('js')

@endsection
