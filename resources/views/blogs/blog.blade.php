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
                    <th>Title</th>
                    <th>Description</th>
                    <th>Small Description</th>
                    <th>Image</th>
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
                        <td>{{ $row->image }}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                data-target="#edit{{ $row->id }}" title="Edit"><i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#delete{{ $row->id }}" title="Delete">
                                <i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                <!-- delete_modal_blog -->
     <div class="modal fade" id="delete{{ $row->id }}" tabindex="-1"
        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;"
                        class="modal-title" id="exampleModalLabel">
                                  Delete Blog                    </h5>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('blog.destroy', 'test') }}"
                        method="post">
                        {{ method_field('Delete') }}
                        @csrf
                       <h6>Are You Sure you want to delete this blog?</h6>
                        <input id="id" type="hidden" name="id"
                            class="form-control" value="{{ $row->id }}">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Close</button>
                            <button type="submit"
                                class="btn btn-danger">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
</div>
</div>
            </tbody>
        </table>
    </div>

{{-- add --}}

                <div class="modal fade" id="#exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                    id="exampleModalLabel">
                                    Add Blog
                                </h5>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- add form -->
                                <form action="{{ route('blog.store') }}" method="POST">
                                    @csrf
                    <div class="row">
                            <div class="col">
                                <label for="title" class="mr-sm-2">Title:</label>
                                <input type="text" class="form-control" name="title">
                            </div>

                        <div class="col">
                            <label for="Description" class="mr-sm-2">Description
                                :</label>
                            <textarea class="form-control" name="Description" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    <div class="col">
                            <label for="exampleFormControlTextarea1">Small Description
                                :</label>
                            <input type="text" class="form-control" name="smallDes">
                        </div>

                    <div class="col">
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Choose Category</label>

                        <select name="" id="" class="form-control" required>
                            <option value="" selected disabled> ---Choose Category--</option>
                        </select>
                    </div>
                    <div class="col">
                        <div class="custom-file">
                            <input required type="file" class="custom-file-input" onchange="id_proof(event, this.id)"
                                id="customFile" name="customFile" />
                            <label class="custom-file-label" for="customFile" id="customFiles">Choose file</label>
                            <small id="upload_msg" class="form-text" style="display: none;">
                        </div>
                    </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                data-dismiss="modal">Close</button>
            <button type="submit"
                class="btn btn-success">Submit</button>
        </div>
    </form>
</div>   </div>   </div>


    </div>
    <!-- row closed -->
@endsection
@section('js')

@endsection
