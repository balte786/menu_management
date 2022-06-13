@if(auth()->user()->hasRole('staff'))
<h6 class="heading-small text-muted mb-4">{{ __('Restaurant Owner information') }}</h6>
@else
<h6 class="heading-small text-muted mb-4">{{ __('Brand Owner information') }}</h6>
@endif
<div class="pl-lg-4">
    <div class="form-group{{ $errors->has('name_owner') ? ' has-danger' : '' }}">
        @if(auth()->user()->hasRole('staff'))
        <label class="form-control-label" for="name_owner">{{ __('Restaurant Owner Name') }}</label>
        <input type="text" name="name_owner" id="name_owner" class="form-control form-control-alternative" placeholder="{{ __('Restaurant Owner Name') }}" value="{{ old('name', $restorant->name) }}" readonly>
        @else
        <label class="form-control-label" for="name_owner">{{ __('Brand Owner Name') }}</label>
        <input type="text" name="name_owner" id="name_owner" class="form-control form-control-alternative" placeholder="{{ __('Brand Owner Name') }}" value="{{ old('name', $restorant->name) }}" readonly>
        @endif
    </div>
    <div class="form-group{{ $errors->has('email_owner') ? ' has-danger' : '' }}">
        @if(auth()->user()->hasRole('staff'))
        <label class="form-control-label" for="email_owner">{{ __('Restaurant Owner Email') }}</label>
        <input type="text" name="email_owner" id="email_owner" class="form-control form-control-alternative" placeholder="{{ __('Restaurant Owner Email') }}" value="{{ old('email', $restorant->email) }}" readonly>
        @else
        <label class="form-control-label" for="email_owner">{{ __('Brand Owner Email') }}</label>
        <input type="text" name="email_owner" id="email_owner" class="form-control form-control-alternative" placeholder="{{ __('Brand Owner Email') }}" value="{{ old('email', $restorant->email) }}" readonly>
        @endif
    </div>
    <div class="form-group{{ $errors->has('phone_owner') ? ' has-danger' : '' }}">
        @if(auth()->user()->hasRole('staff'))
        <label class="form-control-label" for="phone_owner">{{ __('Restaurant Owner Phone') }}</label>
        <input type="text" name="phone_owner" id="phone_owner" class="form-control form-control-alternative" placeholder="{{ __('Restaurant Owner Phone') }}" value="{{ old('name', $restorant->phone) }}" readonly>
        @else
        <label class="form-control-label" for="phone_owner">{{ __('Brand Owner Phone') }}</label>
        <input type="text" name="phone_owner" id="phone_owner" class="form-control form-control-alternative" placeholder="{{ __('Brand Owner Phone') }}" value="{{ old('name', $restorant->phone) }}" readonly>
        @endif
    </div>
</div>