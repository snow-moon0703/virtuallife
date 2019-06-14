@extends('layouts.app') 
@section('content')
<h4 class="border-gray pb-2 mb-0 text-center">
    @if(substr(url()->current(),-5)=="order") {{ __('My Products') }} @else {{ __('My Collection') }} @endif</h4>
@include('layouts.search')
<div class="my-1 row">
    @forelse($collects as $collect)
    <div class="col-md-3 col-sm-4 py-3">
        <div class="card">
            <a href="{{ route('product.show',$collect->product_id) }}" style="text-decoration:none;color:black;">
                <div class="card-header text-center h5">{{ $collect->product->name }}</div>
                @foreach($collect->product->product_image as $img)
                <img class="card-img-top img-fluid d-block rounded mx-auto" src="{{ URL::asset($img->image)}}" alt="image" style="width:200px;height:200px;">           
                @break
                @endforeach
                <div class="card-footer text-center">NT{{ $collect->product->price }}</div>
            </a>
        </div>
    </div>
    @empty
    @include('layouts.nodata')
    @endforelse
</div>

@endsection