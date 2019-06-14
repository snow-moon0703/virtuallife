@extends('layouts.app') 
@section('content')
<div class="text-center h4">
    {{ isset($products)? __('New Leaderboard') : __('Hot Leaderboard')}}
</div>
<div class="text-right h6">
    <a href="{{ isset($products)?route('ranking.index','0'):route('ranking.index','1') }}" class="btn btn-outline-info">
    {{ isset($products)? __('Hot Leaderboard') : __('New Leaderboard')}}</a>
</div>
@if(isset($products))
    <div class="row py-3">
        <div class="col-md-12">
        @forelse($products as $i => $product)
        <a href="{{ route('product.show',$product->id) }}" style="text-decoration:none;">
            <div class="media text-muted p-3 row @if($loop->index%2==0)   @else table-info @endif">
                <div class="col-md-1 col-2"> {{ $i+1 }}</div>
                <div class="col-md-3 col-10">
                    <h5 class="pb-3">
                        <strong class="d-block text-gray-dark">{{ $product->name }}</strong>
                        <h6 class="text-bottom">　</h6>
                        <h6 class="text-bottom">NT{{ $product->price }}</h6>
                    </h5>
                </div>
                <div class="col-md-3">
                    @foreach($product->product_image as $img)
                    <img class="card-img-to center mr-2 rounded" src="{{ URL::asset($img->image)}}" alt="image" style="height: 100px;width:200px"> 
                    @break 
                    @endforeach
                </div>
                <div class="col-md-5 text-right h6">
                        {{__('Release Date')}}{{ $product->date }}
                </div>
            </div>
        </a>
        @empty
        @include('layouts.nodata')
        @endforelse
        </div>
    </div>
@else
    <div class="h5 row py-3">
        <div class="col-md-12">
        @forelse($orders as $i => $product)
        <a href="{{ route('product.show',$product->product->id) }}" style="text-decoration:none;">
            <div class="media text-muted p-3 row border-dark @if($loop->index%2==0) table-active @endif">
                <div class="col-md-1 col-2">{{ $i+1 }}</div>
                <div class="col-md-3 col-10">
                    <h5 class="media-body pb-3 mb-0  lh-125  border-gray">
                        <strong class="d-block text-gray-dark">{{ $product->product->name }}</strong>
                    </h5>
                </div>
                <div class="col-md-3">
                    @foreach($product->product->product_image as $img)
                    <img src="{{ URL::asset($img->image)}}"class="mr-2 rounded" style="height: 100px;width:200px">
                    @break 
                    @endforeach
                </div>
                <div class="col-md-1 text-right h6">NT{{ $product->product->price }}</div>
                <div class="col-md-4 text-right  h6">
                    {{__('Release Date')}}{{ $product->product->date }}
                    <h6 class="text-bottom">　</h6>
                    {{$product->total}}次
                </div>
            </div>
        </a>
        @empty
        @include('layouts.nodata')
        @endforelse
        </div>
    </div>
@endif

@endsection