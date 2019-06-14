@extends('layouts.app') 
@section('content') 
@if(Auth::check() && $article->creator['id']==Auth::id())
<div class="row text-right">
    <div class="col-md-11 col-sm-10 col-8">
        <a class="btn btn-primary" href="{{ route('article.edit',$article->id) }}">{{__('Change Article')}}</a>
    </div>
    <div class="col-md-1 col-sm-2 col-2">
        <button type="button" class="btn btn-danger btn-del-article" data-id="{{ $article->id }}">{{__('Delete Article')}}</button>
    </div>
</div>
@endif
@Auth('admin')
<div class="row text-right">
    <div class="col-md-12">
        <button type="button" class="btn btn-danger btn-del-ad-article" data-id="{{ $article->id }}">{{__('Delete Article')}}</button>
    </div>
</div>
@endAuth
<div class="row p-3">
    <div class="col-md-12 h1 text-center">{{$article->title}}</div>
</div>
<hr style="border: thin double #000000;" />
<div class="row">
    <div class="col-md-6 col-sm-6 col-12 h5">{{__('Issuer')}}：{{$article->creator['name']}}</div>
    <div class="col-md-6 col-sm-6 col-12 h5 text-right">{{$article->date}}</div>
</div>
<hr>
<div class="mb-3 h4">{!! nl2br(e($article->content)) !!}</div>
<div class="row h5 border-top">
    <div class="col-md-12">{{__('Message')}}</div>
</div>
@foreach($messages as $message)
<div class="row border-top @if($loop->index%2==0) table-warning @else table-info @endif">
    <div class="col-md-6 h5">{{$message->creator['name']}}</div>
    <div class="col-md-6 text-right h5">
        <div>{{$message->me_date}}</div>
        @if(Auth::id()==$message->creator['id'])
        <button class="btn btn-danger btn-del-message" data-id="{{ $message->id }}" type="submit">{{__('Delete Message')}}</button>
        @else
            @Auth('admin')
            <button class="btn btn-danger btn-del-ad-message" data-id="{{ $message->id }}" type="submit">{{__('Delete Message')}}</button>
            @endAuth
        @endif
    </div>
    <div class="col-md-12 h4 font-weight-normal">
        {!! nl2br(e($message->content)) !!}
    </div>
    <hr>
</div>
@endforeach

<div class="row col-md-12 justify-content-center">
    {{ ($messages->render()) }}
</div>
{{-- <div class="mx-auto">（共 {{$messages->total()}} 筆資料）</div> --}}
@Auth('admin')
@else
<form action="{{ route('message.store') }}" method="post" class="mb-3">
    <textarea name="text" maxlength="400"  class="form-control" required style="width:100%;height:200px;"></textarea>
    <div class="row">
        <div class="col-md-12 text-right"><button type="submit" class="btn btn-primary">{{__('Message')}}</button></div>
    </div>
    @csrf
    <input name="id" type="hidden" value="{{ $article->id }}">
</form>
@endAuth
@endsection

@section('js')

@Auth('admin')
    @include('js.admin-article')
@elseif(Auth::check() && $article->creator['id']==Auth::id())
    @include('js.article')
@else
    @include('js.message')
@endAuth

@endsection