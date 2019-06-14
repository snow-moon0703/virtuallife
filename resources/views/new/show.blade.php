@extends('layouts.app') 
@section('content')
    <div class="row p-3">
        <div class="col-md-2 h5">{{__('New')}}：</div>
        <div class="col-md-8 h4">{{ $new->title}}</div>
    </div>
    <div class="row p-2">
        <div class="col-md-2 h5">{{__('New Time')}}：</div>
        <div class="col-md-8 h5">{{ $new->startdate}}　~　{{ $new->enddate}}</div>
    </div>
    <div class="row p-3">
        <div class="col-md-3"></div>
        <div class="col-md-5"> 
            {{-- style="width:100%;height:auto;" --}}
            <img src="{{ URL::asset($new->image)}}" class="img-fluid d-block rounded mx-auto">
        </div>
    </div>
    <div class="row p-3">
        {{-- <div class="col-md-2"></div> --}}
        <div class="col-md-2 h5">{{__('Content')}}：</div>
        <div class="col-md-10 h5">{!! nl2br(e($new->content)) !!}</div>
    </div>
@endsection