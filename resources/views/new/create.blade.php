@extends('layouts.app') 
@section('laydate')
<script src="/laydate/laydate.js"></script>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">{{isset($new)? __('Change News') : __('New News')}}</div>
            <div class="card-body">
                <form class="needs-validation" method="POST" action="{{ isset($new) ? @route('new.update', $new->id) : @route('new.store') }}" enctype="multipart/form-data" novalidate>
                    @if(isset($new))
                        {{ method_field('PATCH') }}
                    @endif
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                        <div class="col-md-6">
                            <input name="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" maxlength="20" value="{{ isset($new->title) ? $new->title : old('title')}}" required>
                            @if ($errors->first('title'))
                            <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Start Date') }}</label>
                        <div class="col-md-6 date">
                            <input type="text" name="startdate" class="form-control" id="startdate" value="{{isset($new->startdate) ? substr($new->startdate, 0, -9) : old('startdate') }}" readonly required  >
                            @if ($errors->first('startdate'))
                            <div class="alert alert-danger">{{ $errors->first('startdate') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-3 col-6">
                                <select name="starttimeh" class="custom-select mr-sm-2">
                                    @for($i =0;$i<24;$i++)
                                    @if($i<10)
                                    <option value="0{{$i}}">0{{$i}}</option>
                                    @else
                                    <option value="{{$i}}">{{$i}}</option>
                                    @endif
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3 col-6">
                                <select name="starttimem" class="custom-select mr-sm-2">
                                    @for($i =0;$i<=60;$i++)
                                    @if($i<10)
                                    <option value="0{{$i}}">0{{$i}}</option>
                                    @else
                                    <option value="{{$i}}">{{$i}}</option>
                                    @endif
                                    @endfor
                                </select>
                            </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('End Date') }}</label>
                        <div class="col-md-6 date">
                            <input type="text" name="enddate" class="form-control" id="enddate" value="{{isset($new->enddate) ? substr($new->enddate, 0, -9) : old('enddate') }}" readonly required>
                            @if ($errors->first('enddate'))
                            <div class="alert alert-danger">{{ $errors->first('enddate') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right"></label>
                        <div class="col-md-3 col-6">
                            <select name="endtimeh" class="custom-select mr-sm-2">
                                @for($i =0;$i<24;$i++)
                                <option value="@if($i<10){{0}}@endif{{$i}}">
                                    @if($i<10){{0}}@endif{{$i}}
                                </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3 col-6">
                            <select name="endtimem" class="custom-select mr-sm-2">
                                @for($i =0;$i<=60;$i++)
                                <option value="@if($i<10){{0}}@endif{{$i}}">@if($i<10){{0}}@endif{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Upload Image') }}</label>
                        <div class="col-md-6">
                            <input type="file" name="img" class="form-control-file" onchange="checkfile(this);" >
                            @if ($errors->first('img'))
                            <div class="alert alert-danger">{{ $errors->first('img') }}</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>
                        <div class="col-md-6">
                            <textarea name="content" maxlength="400" class="form-control" required style="width:100%;height:150px;">{{isset($new->content) ? $new->content : old('content')}}</textarea>
                            @if ($errors->first('content'))
                            <div class="alert alert-danger">{{ $errors->first('content') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4 text-right">
                            <button type="submit" class="btn btn-primary">{{ __('Send') }}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" defer="defer">
    laydate.render({ 
        elem: '#enddate'
    });
    laydate.render({ elem: '#startdate' });
</script>
@endsection