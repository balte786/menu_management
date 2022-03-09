@extends('layouts.app', ['title' => __('Template Management')])

@section('content')
@include('restorants.partials.header', ['title' => 'Edit Template'])
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Template Management') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ URL::to('/template') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(!empty($errors->first()))
                    <div class="row col-lg-12">
                        <div class="alert alert-danger">
                            <span>{{ $errors->first() }}</span>
                        </div>
                    </div>
                    @endif
                    <form action="{{ URL::to('change-template/'.$user_data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">{{ __('Template Details') }}</h6>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name_owner') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="name_template">{{ __('Template Name') }}</label>
                                <input type="text" name="name_template" class="form-control form-control-alternative" placeholder="{{ __('Template Name here') }} ..." value="{{$user_data['name']}}" autofocus>
                            </div>
                            <div class="form-group{{ $errors->has('email_owner') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="image_template">{{ __('Template Image') }}</label>
                                <input type="file" name="image_template" accept="image/x-png,image/gif,image/jpeg" placeholder="{{ __('Select Template image') }} ..." autofocus>
                                <img class="rounded" src="{{ asset('uploads/template/' . $user_data->picture) }}" width="50px" height="50px">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footers.auth')
</div>
@endsection