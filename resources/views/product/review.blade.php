@if ($errors->first('content'))
<div class="alert alert-danger">{{ $errors->first('content') }}</div>
@endif
<div class="collapse multi-collapse" id="multiCollapseExample2">
    @foreach($reviews as $review)
    <div class="media py-2 @if($loop->index%2==0) table-active @endif">
        <div class="media-body">
            <h4 class="media-heading">{{$review->user->name}}</h4>
            <p>{!! nl2br(e($review->content)) !!}</p>
        </div>
        <div class="media-right">
            {{$review->date}}
            <h5 class="text-right"></h5>
        </div>
    </div>
    @endforeach
    <div class="row col-md-12 justify-content-center">
        {{ $reviews->links() }}
    </div>
    @if(!$product->review_ch(Auth::id(),$product->id)&&$product->display=="T"&&$product->creator_id!=Auth::id()) 
    @Auth('admin') @else @Auth
    <form class="needs-validation py-3" method="POST" action="{{ route('review.store') }}" novalidate>
        @csrf
        <input type="text" name="id" hidden value="{{$product->id}}">
        <textarea name="content" maxlength="400" class="form-control" required style="width:100%; height: 300px">{{ old('content') }}</textarea>
        <button type="submit" class="btn btn-primary">{{__('Send')}}</button>
    </form>
    @endAuth @endAuth @endif
</div>