@extends('layouts.app') 
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Basic Information') }}</div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                    <div class="col-md-6">
                        <input type="email" class="form-control" value="{{$user->email}}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" readonly value="{{ $user->phone }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">{{ __('Birthday') }}</label>
                    <div class="col-md-6">
                        <input type="text" value="{{$user->birthday}}" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                    <div class="col-md-6">
                        <input value="{{$user->gender}}" type="text" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>
                    <div class="col-md-6">
                        <input value="{{$user->country['name']}}" type="text" class="form-control" readonly>
                    </div>
                </div>
                @Auth('admin')
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">{{ __('Creator Name') }}</label>
                    <div class="col-md-6">
                        <input value="{{$user->creator['name']}}" type="text" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">{{ __('Bank Code') }}</label>
                    <div class="col-md-6">
                        <input value="{{$user->creator['code']}}" type="text" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">{{ __('Bank Account') }}</label>
                    <div class="col-md-6">
                        <input value="{{$user->creator['account']}}" type="text" class="form-control" readonly>
                    </div>
                </div>
                @elseif(Auth::user()->creator_null())
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Creator Name') }}</label>
                        <div class="col-md-6">
                            <input value="{{$user->creator['name']}}" type="text" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Bank Code') }}</label>
                        <div class="col-md-6">
                            <input value="{{$user->creator['code']}}" type="text" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Bank Account') }}</label>
                        <div class="col-md-6">
                            <input value="{{$user->creator['account']}}" type="text" class="form-control" readonly>
                        </div>
                    </div>
                @endAuth
            </div>
        </div>
    </div>
</div>
@endsection