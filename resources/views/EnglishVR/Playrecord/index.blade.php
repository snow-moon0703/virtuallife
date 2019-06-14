@extends('EnglishVR.app') 
@section('content')
<h4 class="border-gray pb-2 mb-0 text-center">遊玩記錄</h4>

@forelse($playrecords as $playrecord)
<div class="row py-2 @if($loop->iteration%2==0) table-warning @endif">
    <div class="col-md-12">
        {{-- p_id-{{$playrecord->p_id}}.c_id..{{$playrecord->c_id}}.l_level.{{$playrecord->levelrecord->l_id}}
    .l_leve2.{{$playrecord->levelrecord2->l_id}}.l_leve3.{{$playrecord->levelrecord3->l_id}} --}}
    {{$loop->iteration}}
    </div>
    <div class="row col-md-12">
        <div class="col-md-4">
            <div class="col-md-12">第一關</div>
        @forelse($playrecord->levelrecord->errorrecord as $errorrecord)
            <div class="col-md-12 row">
                <div class="col-md-6">
                {{$errorrecord->word->w_english}}
                </div>
                <div class="col-md-6">
                {{$errorrecord->word->w_Chinese}}
                </div>
            </div>
        @empty
            <div class="col-md-12">not error</div>
        @endforelse
        </div>

        <div class="col-md-4">
            <div class="col-md-12">第2關</div>
        @forelse($playrecord->levelrecord2->errorrecord as $errorrecord) 
            <div class="col-md-12 row">
                <div class="col-md-6">
                    {{$errorrecord->word->w_english}}
                </div>
                <div class="col-md-6">
                    {{$errorrecord->word->w_Chinese}}
                </div>
            </div>
        @empty
            <div class="col-md-12">not error</div>
        @endforelse
        </div>

        <div class="col-md-4">
            <div class="col-md-12">第3關</div>
        @forelse($playrecord->levelrecord3->errorrecord as $errorrecord)
            <div class="col-md-12 row">
                <div class="col-md-6">
                    {{$errorrecord->word->w_english}}
                </div>
                <div class="col-md-6">
                    {{$errorrecord->word->w_Chinese}}
                </div>
            </div>
        @empty 
            <div class="col-md-12">not error</div>
        @endforelse
        </div>


    </div>


{{-- <div>第二關</div>
@forelse($playrecord->levelrecord2->errorrecord as $errorrecord) {{$errorrecord->w_id}}---->{{$errorrecord->word->w_english}}---{{$errorrecord->word->w_Chinese}}
@empty
    @include('layouts.nodata') @endforelse --}}
{{-- <div>第三關</div>
    @forelse($playrecord->levelrecord3->errorrecord as $errorrecord) {{$errorrecord->w_id}}---->{{$errorrecord->word->w_english}}---{{$errorrecord->word->w_Chinese}}
    @empty
    @include('layouts.nodata') @endforelse --}}


    {{-- <br>
{{$playrecord->levelrecord->errorrecord}}
    <br>
   
    <br> --}}
</div>
@empty
    @include('layouts.nodata') @endforelse
@endsection
    {{-- @forelse($errorrecords as $errorrecord)
    <div class="col-md-3 col-sm-4 py-3">
        <br> {{$errorrecord->w_id}}
        <br>  --}}
        {{--
        <div class="card">
            <a href="{{ route('product.show',$collect->product_id) }}" style="text-decoration:none;color:black;">
                <div class="card-header text-center h5">{{ $collect->product->name }}</div>
                @foreach($collect->product->product_image as $img)
                <img class="card-img-top img-fluid d-block rounded mx-auto" src="{{ URL::asset($img->image)}}" alt="image" style="width:200px;height:200px;">            @break @endforeach
                <div class="card-footer text-center">NT{{ $collect->product->price }}</div>
            </a>
        </div> --}}
    {{-- </div>
    @empty
    @include('layouts.nodata') 
    @endforelse --}}