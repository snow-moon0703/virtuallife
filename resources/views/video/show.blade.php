@extends('layouts.app') 
@section('content')
    <h2 class="text-center">{{ $video->name }}</h2>
        <video class="card-img-top" controls>
            <source src="{{URL::asset($video->video)}}" type="video/mp4">
        </video>
    <h5 class="text-right">
        {{ $video->t_name }}
        {{ $video->rating }}
    </h5>
    <div>
        <h3>{{__('Summary')}}:</h3>
        <br>
        <h4>{{ $video->summary }}</h4>
    </div>
@endsection