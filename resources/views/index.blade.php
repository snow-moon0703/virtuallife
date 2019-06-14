@extends('layouts.app') 
@section('content')
<h4 class="border-gray pb-2 mb-0 text-center"> </h4>

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-md-12">
            <div class="carousel slide" id="carousel-525632">
                <ol class="carousel-indicators">
                    @foreach($news as $i=> $new) 
                        @if($loop->first)
                        <li class="active" data-target="#carousel-525632" data-slide-to="0"></li>
                        @else
                        <li data-target="#carousel-525632" data-slide-to="{{$i}}"></li>
                        @endif
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach($news as $new)
                    @if($loop->first)
                        <div class="carousel-item active">
                    @else
                        <div class="carousel-item">
                    @endif
                        <a href="news/{{ $new->id }}" style="text-decoration:none;">
                            <img src="{{ $new->image }}" class="d-block w-100 h-100" style="height:150px;width:200px">
                        </a> 
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carousel-525632" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="sr-only">Previous</span>
                    </a>
                <a class="carousel-control-next" href="#carousel-525632" data-slide="next">
                    <span class="carousel-control-next-icon"></span> 
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>

{{-- <div class="row h5 py-1">
    <div class="col-md-12 h5">{{__('News')}}</div>
</div>

@forelse($news as $new)
<a href="news/{{ $new->id }}" style="text-decoration:none;">
    <div class="media text-muted py-2 row" style="@if($loop->iteration%2==0)background:#FFFFBB @endif">
        <div class="col-md-4">
            <img src="{{ $new->image }}" class="mr-2 rounded" style="height:150px;width:200px">
        </div>
        <div class="col-md-4">
            <h5 class="media-body pb-3 mb-0 lh-125  border-gray">
                <strong class="d-block text-gray-dark">{{ $new->title }}</strong>
            </h5>
        </div>
        <div class="col-md-4 text-right">
            <h7>{{ $new->startdate }}</h7>
        </div>
    </div>
</a> 
@empty
@include('layouts.nodata')
@endforelse --}}
<hr>
<div class="row py-2">
    <div class="col-md-12 h5">{{__('Shop')}}</div>
@forelse($products as $product)
    <div class="col-md-3 col-sm-4 py-2">
        <a href="{{ route('product.show',$product->id) }}" class="text-dark">
            <div class="carousel-inner">
                <div class="text-center h5">{{ $product->name }}</div>
                <div class="carousel-item active">
                @foreach($product->product_image as $img)
                    <img src="{{ URL::asset($img->image)}}" alt="img"  class="d-block rounded mx-auto" width="200px" height="200px">
                @break @endforeach
                    <div class="carousel-caption p-4" style="botton:-20px">
                        <div >NT.{{ $product->price }}</div>
                    </div>
                </div>
            </div>
                {{-- <div class=" text-center h5">{{ $product->name }}</div>
                @foreach($product->product_image as $img)
                <img class="card-img-top img-fluid d-block img-thumbnail mx-auto" src="{{ URL::asset($img->image)}}" alt="image" style="width:200px;height:200px">            @break @endforeach
                <div class=" text-center">NT.{{ $product->price }}</div> --}}
        </a>
    </div>
@empty
@include('layouts.nodata')
@endforelse
</div>
<br>
<div class="row py-2 border-top">
    <div class="col-md-6 border-right">
        <div class="col-md-12 pt-2 h5 ">{{__('New Leaderboard')}}</div>
        @forelse($products_new as $i => $product)
        <a href="{{ route('product.show',$product->id) }}" style="text-decoration:none;" class="text-dark">
            <div class="media text-muted pt-3 row">
                <div class="col-md-1 col-2"> {{ $i+1 }}</div>
                <div class="col-md-6 col-10">
                    <h5 class="pb-3">
                        <strong class="d-block text-gray-dark">{{ $product->name }}</strong>
                        <h6 class="text-bottom">　</h6>
                        <h6 class="text-bottom">NT{{ $product->price }}</h6>
                    </h5>
                </div>
                <div class="col-md-5">
                    @foreach($product->product_image as $img)
                    <img class="img-fluid d-block rounded mx-auto" src="{{ URL::asset($img->image)}}" alt="image" style="height: 100px;width:200px;"> 
                    @break @endforeach
                </div>
            </div>
        </a>
        @empty 
        @include('layouts.nodata')
        @endforelse
    </div>
    <div class="col-md-6">
        <div class="col-md-12 pt-2 h5">{{__('Hot Leaderboard')}}</div>
        @forelse($products_hot as $i => $product)
        <a href="{{ route('product.show',$product->product->id) }}" style="text-decoration:none;" class="text-dark">
            <div class="media text-muted pt-3 row">
                <div class="col-md-1 col-4">{{ $i+1 }}</div>
                <div class="col-md-5 col-8">
                    <h5 class="pb-3">
                        <strong class="d-block text-gray-dark">{{ $product->product->name }}</strong>
                        <h6 class="text-bottom">　</h6>
                        <h6 class="text-bottom">NT{{ $product->product->price }}</h6>
                    </h5>
                </div>
                <div class="col-md-4 col-12">
                    @foreach($product->product->product_image as $img)
                    <img src="{{ URL::asset($img->image)}}" class="d-block rounded mx-auto" alt="image" style="height: 100px;width:200px;"> 
                    @break @endforeach
                </div>
                <div class="col-md-2 col-10 text-right h6">{{$product->total}}{{__('Times')}}</div>
            </div>
        </a>
        @empty 
        @include('layouts.nodata')
        @endforelse
    </div>
</div>
<br>
<div class="row border-top pt-2">
    <div class="col-md-12 h5">{{__('Video')}}</div>
    @forelse($videos as $video)
    <div class="col-md-3 py-3 ">
        <div class="card">
            <a href="{{ route('video.show',$video->id) }}" class="text-white">
                <div class="card-header text-center h5" style="background:#353434">{{ $video->name }}</div>
                <video class="card-img-top" src="{{ URL::asset($video->video) }}" controls></video> 
                {{-- poster="image/News/1558615134.jpg" --}}
            </a>
        </div>
    </div>
    @empty
    @include('layouts.nodata')
    @endforelse
</div>

<div class="my-3 p-3 bg-white rounded box-shadow">

</div>
@endsection