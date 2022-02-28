@extends('layouts.app', ['title' => __('Restaurants')])
@section('admin_title')
{{__('Restaurants')}}
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
                            <h3 class="mb-0">{{ __('Staff') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ URL::to('/addStaff') }}" class="btn btn-sm btn-primary">{{ __('Add Staff') }}</a>

                        </div>

                        @if(Session::has('msg'))
                        <div class="alert alert-block alert-success">
                            <i class=" fa fa-check cool-green "></i>
                            {{ nl2br(Session::get('msg')) }}
                            {{ Session::forget('msg') }}
                        </div>
                        @endif

                    </div>
                </div>

                <div class="col-12">
                    @include('partials.flash')
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('Name') }}</th>

                                <th scope="col">{{ __('Email') }}</th>
                                <th scope="col">{{ __('Creation Date') }}</th>
                                <th scope="col">{{ __('Update Date') }}</th>
                                <th colspan="2" style="text-align: center;">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($staffData as $staff)

                            <tr>
                                <td><a href=" #">{{ $staff->name }}</a></td>
                                <td>{{ $staff->email }}</td>
                                <td>{{ $staff->created_at->format('m/d/y h:m:A') }}</td>
                                <td>{{ $staff->	updated_at->format('m/d/y h:m:A') }}</td>
                                <td><a href="{{URL::to('/delete-staff/'.$staff->id)}}"><button type="button" class="btn btn-danger btn-sm">Delete</button></a></td>
                                <td><a href="{{URL::to('/edit-staff/'.$staff->id)}}"><button type="button" class="btn btn-danger btn-sm">Edit</button></a></td>


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