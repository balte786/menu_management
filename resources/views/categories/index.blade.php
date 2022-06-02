@extends('layouts.app', ['title' => __('Restaurant Menu Management')])
@section('admin_title')
{{__('Build Category')}}
@endsection
@section('content')

<div class="header bg-gradient-primary pb-7 pt-5 pt-md-4">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center">
            </div>
        </div>
    </div>
</div>

@if (Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <h4 class="alert-heading">Success!</h4>
    <p>{{ Session::get('success') }}</p>

    <button type="button" class="close" data-dismiss="alert aria-label=" Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (Session::has('errors'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <h4 class="alert-heading">Error!</h4>
    <p>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    </p>

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="container py-3">

    <div class="modal" tabindex="-1" role="dialog" id="editCategoryModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="" method="POST">
                    @csrf


                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" value="" placeholder="Category Name" required>
                        </div>
                    </div>

                    <div class="form-check" style="margin-left:27px;">
                        <input type="checkbox" class="form-check-input" name="parent_id" value="parent_id">
                        <label class="form-check-label" for="parent_id">Assign Parent Category</label>
                    </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <h3>Categories</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($categories as $category)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                {{ $category->name }}

                                <div class="button-group d-flex">
                                    <button type="button" class="btn btn-sm btn-primary mr-1 edit-category" data-toggle="modal" data-target="#editCategoryModal" data-id="{{ $category->id }}" data-name="{{ $category->name}}">Edit</button>

                                    <a class="button delete-confirm" href="{{ url('categories/destroy-category',$category->id) }}">
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </a>
                                    @if($category->active==1)
                                    <a href="{{ url('categories/active-category/'.$category->id.'/'.$category->active) }}">
                                        <button type="submit" class="btn btn-sm ml-1 btn-warning">Deactive</button>
                                    </a>
                                    @else
                                    <a href="{{ url('categories/active-category/'.$category->id.'/'.$category->active) }}">
                                        <button type="submit" class="btn btn-sm ml-1 btn-success">Activate</button>
                                    </a>
                                    @endif


                                </div>
                            </div>

                            @if ($category->children)
                            <ul class="list-group mt-2">
                                @foreach ($category->children as $child)
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        {{ $child->name }}

                                        <div class="button-group d-flex">
                                            <button type="button" class="btn btn-sm btn-primary mr-1 edit-category" data-toggle="modal" data-target="#editCategoryModal" data-id="{{ $child->id }}" data-name="{{ $child->name }}">Edit</button>

                                            <a class="button delete-confirm" href="{{ url('categories/destroy-category',$child->id) }}">
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </a>

                                            @if($child->active==1)
                                            <a href="{{ url('categories/active-category/'.$child->id.'/'.$child->active) }}">
                                                <button type="submit" class="btn btn-sm ml-1 btn-warning">Deactive</button>
                                            </a>
                                            @else
                                            <a href="{{ url('categories/active-category/'.$child->id.'/'.$child->active) }}">
                                                <button type="submit" class="btn btn-sm ml-1 btn-success">Activatepe</button>
                                            </a>
                                            @endif

                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Create Category</h3>
                </div>

                <div class="card-body">
                    <form action="{{ url('categories/store-category') }}" method="POST">
                        @csrf
                        <input type="hidden" name="restorant_id" value="{{auth()->user()->restorant->id}}">
                        <div class="form-group">
                            <select class="form-control" name="parent_id">
                                <option value="0">Select Parent Category</option>

                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Category Name" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script type="text/javascript">
    $('.edit-category').on('click', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var url = "{{ url('categories/update-category') }}/" + id;

        $('#editCategoryModal form').attr('action', url);
        $('#editCategoryModal form input[name="name"]').val(name);
    });
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $('.delete-confirm').on('click', function(event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Are you sure?',
            text: "This Category and it's details will be permanently deleted!",
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    });
</script>
@endsection