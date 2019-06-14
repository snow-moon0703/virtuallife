@extends('layouts.app') 
@section('content')
<div class="row py-5">
    @forelse($orders as $order)
    <div class="col-md-3">
        <a href="{{ route('product.show',$order->product->id) }}" style="text-decoration:none;color:black;">
            <div class="card mb-4 box-shadow">
                <h4 class="text-center">
                    {{ $order->product['name'] }} </h4>
                <h4 class="text-center">
                    <img class="card-img-to center" src="{{ URL::asset(DB::table('product_image')->where('id', $order->product->id)->value('image'))}}"
                        alt="Card image cap" style="width: 80%;">
                </h4>
                <h6 class="text-right">NT{{ $order->price }}</h6>
            </div>
        </a>
    </div>
    @empty
    @include('layouts.nodata')
    @endforelse
    {{-- @endforeach --}}
</div>
@endsection