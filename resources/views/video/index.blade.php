@extends('layouts.app') 
@section('content')
<h4 class="text-center h3 text-dark"><b>{{__('Video')}}</b></h4>
@include('layouts.search')
<div class="my-3 p-3 row">
    @forelse($videos as $video)
        <div class="col-md-4 py-3 ">
            <div class="card">
                <a href="{{ route('video.show',$video->id) }}" style="text-decoration:none;" class="text-white">
                    <div class="card-header text-center h5" style="background:#353434">{{ $video->name }}</div>
                    <video class="card-img-top" src="{{ URL::asset($video->video) }}" controls></video>
                    {{-- <h4 class="text-center" style="font-style:微軟正黑體">{{ $video->p_name }}</h4>--}}
                </a>
            </div>
        </div>
    @empty
    @include('layouts.nodata')
    @endforelse    
    <div class="row col-md-12 justify-content-center">{{ $videos->links() }}</div>
    {{-- <div class="mx-auto">（共 {{$videos->total()}} 筆資料）</div> --}}
</div>
@endsection