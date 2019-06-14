@extends('layouts.app') 
@section('content')
<h4 class="border-gray pb-2 mb-0 text-center">{{ __('Products Management') }}</h6>
@include('layouts.search')
<div class="row h5 py-1">
    @auth('admin')
    <div class="col-md-10 col-8 text-right">
        <a class="btn btn-outline-info" href="{{ route('admin.product.apply') }}">{{ __('Products Review') }}</a>
    </div>
    <div class="col-md-2 col-4 text-right">
        <a class="btn btn-outline-info" href="{{ route('admin.product') }}">{{ __('Products Management') }}</a>
    </div>
    @endauth
</div>
<div class="row table-active">
    <div class="col-md-1"></div>
    <div class="col-md-2">{{__('Condition')}}</div>
    <div class="col-md-3 col-sm-4 col-4 h5">{{__('Products Name')}}</div>
    <div class="col-md-4 col-sm-4 col-4 text-center h5">{{__('Image')}}</div>
    <div class="col-md-2 col-sm-4 col-4 text-right h5">{{__('Price')}}</div>
</div>
@forelse($products as $product)
<div class="media row py-1 @if($loop->index%2==0) table-warning @else table-primary @endif">
    <div class="col-md-1 col-sm-6 col-6">
        @if($product->status =='申請中')
            <button type="submit" class="btn btn-primary btn-apply-product" data-id="{{$product->id}}">{{__('Agree')}}</button>
        @else
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$product->id}}">
                {{__('Down')}}
            </button>
            <div class="modal fade" id="exampleModalCenter{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form class="needs-validation" method="POST" action="{{ route('admin.product.update',$product->id) }}" novalidate>
                            @csrf {{ method_field('PATCH') }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <textarea name="description" class="form-control" maxlength="30" required style="width:100%;height:200px;"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">{{__('Send')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="col-md-2 col-sm-6 col-6">
        @if($product->status =='申請中')
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$product->id}}">
                {{__('Refuse')}}
            </button>
            <div class="modal fade" id="exampleModalCenter{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form class="needs-validation" method="POST" action="{{ route('admin.product.update',$product->id) }}" novalidate>
                            @csrf {{ method_field('PATCH') }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <textarea name="description" class="form-control" maxlength="30" required style="width:100%;height:200px;"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">{{__('Send')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <a class="text-dark" href="{{ route('admin.product.record',$product->id) }}">{{__('On The Shelf')}}</a>
        @endif
    </div>
    <div class="col-md-3">
        <a class="text-dark" href="{{ route('admin.product.record',$product->id) }}">{{$product->name}}</a>
    </div>
    <div class="col-md-4">
        <a class="text-dark" href="{{ route('admin.product.record',$product->id) }}">
            @foreach($product->product_image as $img)
                <img class="d-block rounded mx-auto img-fluid" src="{{ URL::asset($img->image)}}" alt="Card image cap" style="width: 150px;"> 
            @break 
            @endforeach
        </a>
    </div>
    <div class="col-md-2 text-right">
        <a class="text-dark" href="{{ route('admin.product.record',$product->id) }}"> NT{{$product->price}}</a>
    </div>
</div>
@empty
@include('layouts.nodata') 
@endforelse
<div class="row py-3">
    <div class="col-md-12">{{ $products->links() }}</div>
    {{-- <div class="col-md-12 text-center">（共 {{$products->total()}} 筆資料）</div> --}}
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('.btn-apply-product').click(function() {
            var id = $(this).data('id');
            swal({
                title: "確定要上架此商品嗎？",
                text: "上架後該商品就可供會員購買囉！",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "是！上架此商品！",
                cancelButtonText: "不...別上架此商品",
            }).then((result) => {
                if (result.value) {
                    swal("OK！上架此商品惹！", "該商品已上架了...", "success");
                    axios.patch('/admin/product/apply/'+id+'/patch').then(function () {
                        location.reload();
                    });
                }
            });
        });
    });
</script>
@endsection
