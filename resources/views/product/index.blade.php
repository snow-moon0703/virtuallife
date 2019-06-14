@extends('layouts.app') 
@section('content')
<h4 class="border-gray pb-2 mb-0 text-center">{{ __('Shop') }}</h4>
@include('layouts.search')
@if(isset($my))
<div class="row">
    <div class="col-md-8"></div>
    <div class="col-md-2 h5 text-center"></div>
    <div class="col-md-2 h5 text-center "><a href="{{ route('product.create')}}" class="text-dark">{{ __('Apply Work') }}</a></div>
</div>
@endif

<div class="my-1 row">
    @forelse($products as $product)
    <div class="col-md-3 col-sm-4 py-3" >
        <div class="card">
            <a href="{{ route('product.show',$product->id) }}" class="text-dark">
                <div class="card-header text-center h5">{{ $product->name }}</div>
                    @foreach($product->product_image as $img)
                    <img class="card-img-top img-fluid d-block img-thumbnail mx-auto" src="{{ URL::asset($img->image)}}" alt="image" style="width:200px;height:200px">            
                    @break 
                    @endforeach 
                    <div class="card-footer text-center">NT.{{ $product->price }}</div>
            </a>
        </div>
    </div>
    @empty
    @include('layouts.nodata')
    @endforelse
    
    <div class="col-md-12">
        {{ $products->links() }}
    </div>
    {{-- <div class="mx-auto">（共 {{$products->total()}} 筆資料）</div> --}}
</div>
@endsection