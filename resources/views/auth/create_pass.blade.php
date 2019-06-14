@extends('layouts.app') 
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Change Password') }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('member.pass.update') }}" aria-label="{{ __('Register') }}">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="form-group row">
                        <label for="password_old" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" maxlength="50" class="form-control" name="password_old" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                        <div class="col-md-6">
                            <input id="password" type="password"  maxlength="50" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required> 
                                @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" maxlength="50" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">{{ __('Change Password') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection