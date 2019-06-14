@extends('layouts.app') 
@section('content')
<h4 class="border-gray pb-2 mb-0 text-center">{{__('Forum')}}</h4>
@include('layouts.search')

{{-- <div class="media text-muted row border-top" style="background:#FFFFBB">
    <div class="col-md-5 col-sm-6 col-4">
        <strong class="d-block text-gray-dark h5 border-gray">{{__('Title')}}</strong>
    </div>
    <div class="col-md-4 col-sm-4 col-4 text-right h5">
        {{__('Issuer')}}
    </div>
    <div class="col-md-3 col-sm-4 col-4 text-right h5">
        {{__('Time')}}
    </div>
</div>
@foreach($articles as $article)
    <a href="{{route('article.show',$article->a_id)}}" style="text-decoration:none;">
        <div class="media text-muted row p-2 border-top" style="@if($loop->iteration%2==0)background:#FFFFBB @endif">
            <div class="col-md-5 col-sm-6 col-4">
                <strong class="d-block text-gray-dark h5">{{ $article->a_title }}</strong>
            </div>
            <div class="col-md-4 col-sm-4 col-4 text-right">
                {{$article->creator['cr_name']}}
            </div>
            <div class="col-md-3 col-sm-4 col-4 text-right">
                {{$article->a_date}}
            </div>
        </div>
    </a> 
@endforeach --}}

<div class="row">
    @auth('admin')
    @else
    {{-- text-dark --}}
    <div class="py-1 col-md-12 text-right h5"><a href="{{ route('article.create') }}" class="btn btn-outline-info">{{__('New Article')}}</a></div>
    @endauth
    <div class="col-md-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th colspan="3" scope="col">{{__('Title')}}</th>
                    <th scope="col" class="text-right">{{__('Issuer')}}</th>
                    <th scope="col" class="text-right">{{__('Time')}}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $article)
                <tr>
                    <td colspan="3">
                        <a class="text-dark" href="@Auth('admin') {{route('admin.article.show',$article->id)}} @else{{route('article.show',$article->id)}} @endif">
                    {{$article->title}}
                        </a>
                    </td>
                    <td class="text-right">
                        <a class="text-dark" href="@Auth('admin') {{route('admin.article.show',$article->id)}} @else{{route('article.show',$article->id)}} @endif">
                        {{$article->creator['name']}}
                        </a>
                    </td>
                    <td class="text-right">
                        <a class="text-dark" href="@Auth('admin') {{route('admin.article.show',$article->id)}} @else{{route('article.show',$article->id)}} @endif">
                        {{$article->date}}
                        </a>
                    </td>
                </tr>
                @empty
                @include('layouts.nodata')
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="col-md-12 justify-content-center">{{ $articles->links() }}</div>
    {{-- <div class="mx-auto">（共 {{$articles->total()}} 筆資料）</div> --}}
</div>
@endsection