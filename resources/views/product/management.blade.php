@extends('layouts.app') 
@section('content')
<h4 class="border-gray pb-2 mb-0 text-center">{{ __('Products Management') }}</h6>
@include('layouts.search')
<div class="row h5 py-1">
    <div class="col-md-12 text-right">
        <a class="btn btn-outline-info" href="{{ route('product.create') }}">{{ __('Apply Work') }}</a>
    </div>
</div>

<div class="row table-active">
    <div class="col-md-1"></div>
    <div class="col-md-2">{{__('Condition')}}</div>
    <div class="col-md-3 col-sm-4 col-4 h5">{{__('Products Name')}}</div>
    <div class="col-md-4 col-sm-4 col-4 text-center h5">{{__('Image')}}</div>
    <div class="col-md-2 col-sm-4 col-4 text-right h5">{{__('Price')}}</div>
</div>
@forelse($products as $product)
    <div class="media row py-1 @if($loop->index%2==0) table-warning @else table-info @endif">
        <div class="col-md-1 col-sm-6 col-6">
            @if($product->status =='申請中') 
                {{__('Apply')}}
            @elseif($product->status =='未通過') 
            <a class="btn btn-primary" href="{{ route('product.edit',$product->id) }}">{{__('Modify')}}</a>
            @else 
            <a class="btn btn-primary" href="{{ route('product.edit',$product->id) }}">{{__('Modify')}}</a>
            @endif
        </div>
        <div class="col-md-2 col-sm-6 col-6">
            @if($product->status =='申請中') 
            {{__('Please wait for the review to complete!')}}
            @elseif($product->status =='未通過') 
            <div class="alert alert-danger">{{__('No Pass')}}</div>
            <div class="alert alert-danger">
                {!! nl2br(e($product->description)) !!}
            </div>
            @else 
            {{__('Pass')}}
            @endif
        </div>
        <div class="col-md-3">
            <a class="text-dark" href="{{ route('product.record',$product->id) }}">{{$product->name}}</a>
        </div>
        <div class="col-md-4">
            <a class="text-dark" href="{{ route('product.record',$product->id) }}">
                @foreach($product->product_image as $img)
                <img class="d-block rounded mx-auto img-fluid" src="{{ URL::asset($img->image)}}" alt="Card image cap" style="width: 150px;"> 
                @break 
                @endforeach
            </a>
        </div>
        <div class="col-md-2 text-right">
            NT{{$product->price}}
        </div>
    </div>
@empty
@include('layouts.nodata') 
@endforelse
<div class="row py-3">
    <div class="col-md-12">{{ $products->links() }}</div>
    {{-- <div class="col-md-12 text-center">（共 {{$products->total()}} 筆資料）</div> --}}
</div>
@endsection