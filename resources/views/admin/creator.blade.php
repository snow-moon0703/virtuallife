@extends('layouts.app') 
@section('content')
<h4 class="col-md-12 pb-2 mb-0 text-center">{{__('Creator Management')}}</h6>
@include('layouts.search')
<div class="my-3 row">
    <div class="col-md-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th colspan="4" scope="col">{{ __('Creator Name') }}</th>
                    <th colspan="2" scope="col" class="text-center">{{ __('E-Mail Address') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($creators as $creator)
                <tr>
                    <th scope="col">
                        @if($creator->status =="T") 
                        <button type="button" class="btn btn-primary btn-creator" data-id="{{$creator->id}}" data-priority="T">{{__('Stop Right')}}</button>
                        @else 
                        <button type="button" class="btn btn-primary btn-creator" data-id="{{$creator->id}}" data-priority="false">{{__('Restore')}}</button>
                        @endif
                    </th>
                    <td colspan="4">
                        <a class="text-dark" href="{{route('admin.member.show',$creator->id)}}">
                            {{$creator->name}}
                        </a>
                    </td>
                    <td colspan="2" class="text-center">
                        {{$creator->user->email}}
                    </td>
                </tr>
                @empty
                @include('layouts.nodata') 
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="col-md-12">{{ $creators->links() }}</div>
    {{-- （共 {{$creators->total()}} 筆資料） --}}
</div>
@endsection

@section('js') 
    @Auth('admin')
        @include('js.admin-creator') 
    @endAuth
@endsection
