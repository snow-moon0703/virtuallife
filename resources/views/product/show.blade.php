@extends('layouts.app') 
@section('content')
<div class="row py-3">
    <div class="col-md-12 text-center">
        <h1 class="text-center py-2">{{ $product->name }}　{{ $product->type->name }}</h1>
    </div>
    <div class="col-md-6">
        <div class="col-md-12 h5">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="height: 100%; width:100%">
                <div class="carousel-inner">
                    @foreach($product->product_image as $img) @if($loop->first)
                    <div class="carousel-item active">
                        @else
                        <div class="carousel-item">
                            @endif
                            <img src="{{ URL::asset($img->image) }}" class="d-block" style="height: 100%; width:100%">
                        </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            
        </div>
    
        <div class="col-md-6 row h5">
            <div class="pt-2 col-md-12 h5">{{ __('Creator') }}：　{{ $product->creator['name'] }}</div>
            <div class="pt-2 col-md-12 h5">{{__('Release Date')}}：{{ $product->date }}</div>
            <div class="pt-2 col-md-12 h5">{{__('Price')}}：NT{{ $product->price }}</div>
            @if(isset($order))
            <div class="pt-2 col-md-12 h5">{{__('Purchases')}}：{{ $order}}</div>
            @endif
            <hr>
            @Auth 
            @if($product->creator_id==Auth::id())
            <div class="col-md-12 py-3 text-right">
                <a href="{{ route('product.download',$product->id) }}" class="btn btn-primary">
                    {{__('Download')}}
                </a>
            </div>
            @else
            <div class="col-md-10 col-8 text-right">
                @if($product->collect_ch($product->id,Auth::id()))
                <button type="button" class="btn btn-primary btn-del-collect">{{__('Cancel Collection')}}</button>
                @include('js.collect-del')
                @else
                <button type="button" class="btn btn-primary btn-add-collect">{{__('Collection')}}</button>
                @include('js.collect-add')
                @endif
            </div>
            <div class="col-md-2 col-4 text-right">
                @if($product->order_ch($product->id,Auth::id()))
                {{-- <a href="{{ URL::asset($product->file) }}" class="btn btn-primary" download="{{ $product->name }}.exe">
                            {{__('Download')}}
                </a>  --}}
                <a href="{{ route('product.download',$product->id) }}" class="btn btn-primary">
                    {{__('Download')}}
                </a>
                @else
                <form class="needs-validation" method="POST" action="{{ route('order.create',$product->id) }}" novalidate>
                    @csrf
                    <button type="submit" class="btn btn-primary">{{__('Buy')}}</button>
                </form>
                @endif
            </div>
            @endif 
            @else
            @Auth('admin')
            <div class="col-md-12 py-3 text-right">
                <a href="{{ route('admin.product.download',$product->id) }}" class="btn btn-primary">
                    {{__('Download')}}
                </a> 
            </div>
                @endAuth
            @endAuth
        </div>
        <div class="col-md-12">
            <div class="col-md-12 h5 p-2">商品介紹：</div>
            <div class="col-md-12 h5">
                {!! nl2br(e($product->summary)) !!}
                <hr>
            </div>
        </div>
</div>

@if(isset($reviews))
<div class="row py-2">
    <div class="col-md-12 text-right">
        <button class="btn btn-primary"  type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">{{ __('Review')}}
            <span class="badge badge-light">{{ $reviews->total() }}</span>
        </button> 
    </div>
</div>
@include('product.review')
@endif

@endsection