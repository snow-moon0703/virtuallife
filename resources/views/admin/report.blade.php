@extends('layouts.app') 
@section('content')
<div class="text-center h4">
    {{__('Report')}}
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-12 text-right">
        <div class="btn-group">
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @if(substr(url()->current(),-4)=="year") {{__('Year')}} @elseif(substr(url()->current(),-3)=="all") {{__('All Date')}} @else {{__('Month')}} @endif
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('admin.report.index','month') }}">{{__('Month')}}</a>
                <a class="dropdown-item" href="{{ route('admin.report.index','year') }}">{{__('Year')}}</a>
                <a class="dropdown-item" href="{{ route('admin.report.index','all') }}">{{__('All Date')}}</a>
            </div>
        </div>
        <form action="{{ url()->current() }}" method="get" class="form-inline justify-content-end">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" value="{{request('search')}}" aria-label="Search"
                name="search">
            <button class="btn btn-outline-info my-2" type="submit">{{ __('Search') }}</button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="text-muted py-3 row table-active h5">
            <div class="col-md-3 col-6">{{__('Member')}}</div>
            <div class="col-md-3 col-6">{{__('Products Name')}}</div>
            <div class="col-md-2 col-4">{{__('Price')}} (NT)</div>
            <div class="col-md-2 col-4">{{__('Purchases')}}</div>
            <div class="col-md-2 col-4 text-right">{{__('Total')}} (NT)</div>
        </div>
    </div>

    <div class="col-md-12">
        @forelse($orders as $product)
        <a href="{{ route('admin.product.record',$product->id)}}" style="text-decoration:none;">
            <div class="text-muted py-3 h5 row @if($loop->index%2!=0) table-warning @endif">
                <div class="col-md-3 col-6">{{ $product->cr_name }}</div>
                <div class="col-md-3 col-6">{{ $product->name }}</div>
                <div class="col-md-2 col-4">{{ $product->price }}</div>
                <div class="col-md-2 col-4">{{ $product->total }}</div>
                <div class="col-md-2 col-4 text-right">{{ $product->sum }}</div>
            </div>
        </a> 
        @empty
        @include('layouts.nodata')
        @endforelse
    </div>
</div>
@endsection