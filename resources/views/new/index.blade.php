@extends('layouts.app') 
@section('content')
<div class="page-header h2 text-center">{{ __('News') }}</div>
<div class="my-3 p-3">
    @forelse($news as $new)
    <a href="news/{{ $new->id }}" >
        {{-- style="text-decoration:none;" --}}
        {{-- @if($loop->iteration%2==0) table-warning @endif --}}
        <div class="media text-muted py-2 row border-bottom" style="text-decoration:none;">
            <div class="col-md-4 col-sm-4 col-12">
                <h5 class="media-body pb-3 border-gray">
                    <strong class="d-block text-gray-dark">{{ $new->title }}</strong>
                </h5>
            </div>
            <div class="col-md-5 col-12">
                <img src="{{ $new->image }}" class="img-fluid d-block rounded mx-auto" style="height:200px;width:350px">
            </div>
            <div class="col-md-3 col-sm-12 col-12 text-right">
                <h7>{{ $new->startdate }}</h7>
            </div>
        </div>
    </a>
    @empty
    @include('layouts.nodata')
    @endforelse
    <div class="row">
        <div class="col-md-12">{{ $news->links() }}</div>
    </div>
</div>
@endsection