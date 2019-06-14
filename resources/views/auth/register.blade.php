@extends('layouts.app') 
@section('laydate')
<script src="/laydate/laydate.js"></script>
@endsection
@section('content') 
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ isset($user) ? __('Change Basic Information') : __('Register') }}</div>
            <div class="card-body">
                <form method="POST" action="{{ isset($user) ? @route('member.update') : @route('register') }}" aria-label="{{ __('Register') }}">
                    @if(isset($user)) 
                    {{ method_field('PATCH') }} 
                    @endif
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" maxlength="50" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ isset($user->name) ? $user->name : old('name')}}"
                                required autofocus> 
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span> 
                            @endif
                        </div>
                    </div>
                    @if(isset($user))
                    @else
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="email" maxlength="50" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ isset($user->email) ? $user->email : old('email')}}"
                                required> 
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                            </span> 
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                        <div class="col-md-6">
                            <input id="password" type="password" maxlength="50" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                required> 
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span> 
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" maxlength="50" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>
                    

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                        <div class="col-md-6">
                            <input name="phone" type="text" pattern="[0-9]{5,10}" title="0~9-max10" class="form-control" placeholder="0912345678" maxlength="10" required value="{{ isset($user->phone) ? $user->phone : old('phone')}}">
                            @if ($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span> 
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Birthday') }}</label>
                        <div class="col-md-6 date">
                            <input type="text" name="birthday" class="form-control" placeholder="YYYY-MM-DD" maxlength="10" id="datepicker" value="{{ isset($user->birthday) ? $user->birthday : old('birthday')}}"  required>
                            @if ($errors->has('birthday'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('birthday') }}</strong>
                            </span> 
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                        <div class="col-md-6">
                            <div class="custom-control custom-radio">
                                <input id="credit" value="男" name="gender" type="radio" class="custom-control-input" checked required>
                                <label class="custom-control-label" for="credit">男</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="debit" value="女" name="gender" type="radio" class="custom-control-input" required>
                                <label class="custom-control-label" for="debit">女</label>
                            </div>
                        </div>
                    </div>

                    
                    @endif

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>
                        <div class="col-md-6">
                            <select name="country" class="custom-select mr-sm-2">
                                <option value="1">台灣</option>
                                <option value="2">USA</option>
                            </select>
                            @if ($errors->has('country'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('country') }}</strong>
                            </span> 
                            @endif
                        </div>
                    </div>
                    @if(Auth::check() && Auth::user()->creator_id())
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Creator Name') }}</label>
                        <div class="col-md-6">
                            <input type="text" maxlength="15" class="form-control" name="c_name" value="{{ $user->creator['name'] }}" required autofocus>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Bank Code') }}</label>
                        <div class="col-md-6">
                            <select name="code" class="custom-select mr-sm-2">
                                <option value="004">臺灣銀行</option>
                                <option value="013">國泰世華</option>
                                <option value="812">台新銀行</option>
                                <option value="822">中國信託</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Bank Account') }}</label>
                        <div class="col-md-6">
                            <input type="text" maxlength="20" class="form-control" name="account" value="{{ $user->creator['account'] }}" required autofocus>
                        </div>
                    </div>
                    @endif
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                    {{ __('Send') }}
                                </button>
                        </div>
                    </div>

                </form>
            </div>
            {{-- @endif  --}}
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" defer="defer">
    laydate.render({ 
        elem: '#datepicker'
    });
</script>
@endsection