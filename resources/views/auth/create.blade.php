@extends('layouts.app') 
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Apply Creator') }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('order.create',1) }}" aria-label="{{ __('Register') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Creator Name') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
                                required autofocus maxlength="10"> 
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span> 
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Bank Code') }}</label>
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
                        <label for="account" class="col-md-4 col-form-label text-md-right">{{ __('Bank Account') }}</label>
                        <div class="col-md-6">
                            <input name="account" type="text" class="form-control" maxlength="16" pattern="[0-9]{5,16}" title="0~9-max16" required value="{{ old('account') }}">
                            @if ($errors->first('account'))
                            <span class="error" role="alert">
                                <strong>{{ $errors->first('account') }}</strong>
                            </span> 
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary" name="apply">{{ __('Apply Creator') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">條款</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
                <img class="card-img-top img-fluid d-block rounded mx-auto" src="{{URL::asset('')}}image/11.jpg" alt="">
            </div>
            <div class="modal-footer">
                <a class="btn btn-secondary" href="/">不同意</a>
                <button type="button" class="btn btn-primary" id="apply" onclick="apply()">同意</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function(){ 
        $("#myModal").modal('show');
    });
    function apply(){
        $("#myModal").modal('hide'); 
    }
</script>
@endsection