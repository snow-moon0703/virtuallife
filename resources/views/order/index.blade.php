@extends('layouts.app') 
@section('content')
<h4 class="text-center">{{__('Order')}}</h4>
@include('layouts.search')
<div class="my-3 row">
    <div class="col-md-12">
        <table class="table table-hover table-bordered">
            <thead class="thead-light">
                <tr>
                    <th colspan="3" scope="col">{{ __('Products Name') }}</th>
                    <th scope="col" class="text-right">{{ __('Condition') }}</th>
                    <th scope="col" class="text-right">{{ __('Price') }}</th>
                    <th scope="col" class="text-right">{{ __('Buy Time') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr class="table-warning">
                    <td colspan="3">
                        <a class="text-dark" href="{{route('product.show',$order->product_id)}}">
                        {{ $order->product->name }}
                        </a>
                    </td>
                    <td class="text-right">
                        <a class="text-dark" href="{{route('product.show',$order->product_id)}}">
                        {{ $order->status }}
                        </a>
                    </td>
                    <td class="text-right">
                        <a class="text-dark" href="{{route('product.show',$order->product_id)}}">
                        {{ $order->price }}
                        </a>
                    </td>
                    <td class="text-right">
                        <a class="text-dark" href="{{route('product.show',$order->product_id)}}">
                        {{ $order->date }}
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td>
                    @include('layouts.nodata') 
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="row col-md-12 justify-content-center">
    {{ $orders->links() }}
</div>
{{-- <div class="mx-auto">（共 {{$orders->total()}} 筆資料）</div> --}}
</div>
@endsection