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
                            <h3 class="mb-0">Restaurant Management</h3>
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
                        <h6 class="heading-small text-muted mb-4">{{ __('Restaurant information') }}</h6>
                        <div class="pl-lg-4">
                            <input type="hidden" name="id" value="{{$user_data->id}}">
                            <div class="form-group{{ $errors->has('name_owner') ? ' has-danger' : '' }}">

                                <label class="form-control-label" for="name_owner">{{ __('Restaurant Owner Name') }}</label>
                                <input type="text" name="name_staff" id="name_staff" class="form-control form-control-alternative{{ $errors->has('name_staff') ? ' is-invalid' : '' }}" placeholder="{{ __('Restaurant Owner Name here') }} ..." value="{{$user_data->name}}" required autofocus>
                                @if ($errors->has('name_staff'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name_staff') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('branch_name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="branch_name">{{ __('Restaurant Name') }}</label>
                                <input type="text" name="branch_name" id="branch_name" class="form-control form-control-alternative{{ $errors->has('branch_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Restaurant Name here') }} ..." value="{{$restorant->name}}">
                                @if ($errors->has('branch_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('branch_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password_staff') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="password_staff">{{ __('Restaurant Owner Password') }}</label>
                                <input type="password" name="password_staff" id="password_staff" class="form-control form-control-alternative{{ $errors->has('password_staff') ? ' is-invalid' : '' }}" placeholder="{{ __('Restaurant Owner Password here') }} ..." value="$user_data->password">
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