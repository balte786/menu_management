@extends('layouts.app', ['title' => __('Templatess')])
@section('admin_title')
{{__('Templates')}}
@endsection
@section('content')
@include('restorants.partials.modals')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
</div>

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Templates') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ URL::to('/add-template') }}" class="btn btn-sm btn-primary">{{ __('Add Template') }}</a>
                            <!--<a href="{{ URL::to('/view-template') }}" class="btn btn-sm btn-primary">{{ __('View Template') }}</a>-->

                        </div>
                    </div>
                </div>

                <div class="col-12">
                    @include('partials.flash')
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('ID') }}</th>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Image') }}</th>
                                <th scope="col">{{ __('Creation Date') }}</th>
                                <th scope="col">{{ __('Update Date') }}</th>
                                <th colspan="3" style="text-align: center;">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($tempData as $temp)

                            <tr>
                                <td><a href=" #">{{ $temp->id }}</a></td>
                                <td>{{ $temp->name }}</td>
                                <td>
                                    <img class="rounded" src="{{ asset('uploads/template/' . $temp->picture) }}" width="50px" height="50px">
                                </td>
                                <td>{{ $temp->created_at }}</td>
                                <td>{{ $temp->updated_at }}</td>

                                <td><a href="{{URL::to('/edit-template/'.$temp->id)}}"><button type="button" class="btn btn-info btn-sm">Edit</button></a></td>
                                <td><a href="{{URL::to('/delete-template/'.$temp->id)}}"><button type="button" class="btn btn-danger btn-sm">Delete</button></a></td>



                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">

                    </nav>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection