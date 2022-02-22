@extends('layouts.app', ['title' => __('Restaurant Management')])

@section('content')
@include('restorants.partials.header', ['title' => 'Edit Staff'])
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Staff Management') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ URL::to('/staff') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
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
                    <form method="post" action="{{ URL::to('/change') }}" autocomplete="off">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">{{ __('Staff information') }}</h6>
                        <div class="pl-lg-4">
                            <input type="hidden" name="id" value="{{$user_data->id}}">
                            <div class="form-group{{ $errors->has('name_owner') ? ' has-danger' : '' }}">

                                <label class="form-control-label" for="name_owner">{{ __('Staff Name') }}</label>
                                <input type="text" name="name_staff" id="name_staff" class="form-control form-control-alternative{{ $errors->has('name_staff') ? ' is-invalid' : '' }}" placeholder="{{ __('Staff Name here') }} ..." value="{{$user_data->name}}" required autofocus>
                                @if ($errors->has('name_staff'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name_staff') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email_owner') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="email_owner">{{ __('Staff Email') }}</label>
                                <input type="email" name="email_staff" id="email_staff" class="form-control form-control-alternative{{ $errors->has('email_staff') ? ' is-invalid' : '' }}" placeholder="{{ __('Staff Email here') }} ..." value="{{$user_data->email}}">
                                @if ($errors->has('email_staff'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email_staff') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password_staff') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="password_staff">{{ __('Staff Password') }}</label>
                                <input type="password" name="password_staff" id="password_staff" class="form-control form-control-alternative{{ $errors->has('password_staff') ? ' is-invalid' : '' }}" placeholder="{{ __('Staff Password here') }} ..." value="">
                                @if ($errors->has('password_staff'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password_staff') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                            </div>
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