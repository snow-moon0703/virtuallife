@extends('layouts.app') 
@section('content')
<h4 class="pb-2 text-center h3">{{ __('New Management') }}</h4>
@include('layouts.search')
    <div class="row py-1">
        <div class="col-md-12 text-right">
            <a class="btn btn-outline-info" href="{{ route('new.create') }}">{{__('New News')}}</a>
        </div>
    </div>
    <div class="row table-active">
        <div class="col-md-1"></div>
        <div class="col-md-2"></div>
        <div class="col-md-2 col-sm-4 col-4 h5">{{__('Title')}}</div>
        <div class="col-md-4 col-sm-4 col-4 text-center h5">{{__('Image')}}</div>
        <div class="col-md-3 col-sm-4 col-4 text-right h5">{{__('Release Date')}}</div>
    </div>
    @forelse($news as $new)
    <div class="media row py-1 @if($loop->index%2==0) table-warning @else table-active @endif">
        <div class="col-md-1 col-sm-6 col-6">
            <a class="btn btn-primary" href="{{ route('new.edit',$new->id) }}">{{__('Modify')}}</a>
        </div>
        <div class="col-md-2 col-sm-6 col-6">
            <button type="button" class="btn btn-danger btn-del-news" data-id="{{ $new->id }}">{{__('Delete')}}</button>
        </div>
        <div class="col-md-2">
        <a class="text-dark" href="{{ route('news.show',$new->id) }}">{{ $new->title }}</a>
        </div>
        <div class="col-md-4 ">
            <a class="text-dark" href="{{ route('news.show',$new->id) }}"><img src="{{ URL::asset($new->image) }}" alt="img" class="d-block rounded mx-auto" style="height:150px;width:150px;"></a>
        </div>
        <div class="col-md-3 text-right"><a class="text-dark" href="{{ route('news.show',$new->id) }}" style="text-decoration:none;">{{ $new->startdate }}</a></div>
    </div>
    @empty
    @include('layouts.nodata') 
    @endforelse
<div class="row">
    <div class="col-md-12">{{ $news->links() }}（共 {{$news->total()}} 筆資料）</div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('.btn-del-news').click(function() {
            var id = $(this).data('id');
            swal({
                title: "確定要刪除消息嗎？",
                text: "刪除後該消息就救不回來囉！",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "{{__('Yes! With tears deleted!')}}",
                cancelButtonText: "{{__('Wait! Let me think again!')}}",
            }).then((result) => {
                if (result.value) {
                    swal("OK！刪掉消息惹！", "該消息已經隨風而逝了...", "success");
                    axios.delete('/news/'+id+'/delete').then(function () {
                        location.reload();
                    });
                }
            });
        });
    });
</script>
@endsection