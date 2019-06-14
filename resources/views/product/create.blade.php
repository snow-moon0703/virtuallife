@extends('layouts.app') 
@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">{{ __('Apply Work') }}</div>
            <div class="card-body">
                <form class="needs-validation" method="POST" enctype="multipart/form-data" action="{{ isset($product) ? @route('product.update', $product->id) : @route('product.store')}}" novalidate>
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Products Name') }}</label>
                        <div class="col-md-6">
                            <input name="name" type="text" value="{{ isset($product->name) ? $product->name : old('name')}}" class="form-control" maxlength="20" required>
                            @if ($errors->first('name'))
                            <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Summary') }}</label>
                        <div class="col-md-6">
                            <textarea name="summary" maxlength="400" class="form-control" required style="width:100%;height:150px;" >{{ isset($product->summary) ? $product->summary : old('summary')}}</textarea>
                            @if ($errors->first('summary'))
                            <div class="alert alert-danger">{{ $errors->first('summary') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>
                        <div class="col-md-6">
                            <input name="price" type="number" class="form-control" maxlength="10" value="{{ isset($product->price) ? $product->price : old('price')}}" required>
                            @if ($errors->first('price'))
                            <div class="alert alert-danger">{{ $errors->first('price') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Kind') }}</label>
                        <div class="col-md-6">
                            <select name="type" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                <option value="1">{{ __('Action') }}</option>
                                <option value="2">{{ __('Education') }}</option>                          
                                <option value="3">{{ __('Cosplay') }}</option>                             
                                <option value="4">{{ __('Motion') }}</option>                              
                                <option value="5">{{ __('Puzzle') }}</option>                              
                            </select>
                            @if ($errors->first('type'))
                            <div class="alert alert-danger">{{ $errors->first('type') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Grading') }}</label>
                        <div class="col-md-6">
                            <div class="custom-control custom-radio">
                                <input id="credit" value="普遍級" name="rating" type="radio" class="custom-control-input" checked required>
                                <label class="custom-control-label" for="credit">普遍級</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="debit" value="限制級" name="rating" type="radio" class="custom-control-input" required>
                                <label class="custom-control-label" for="debit">限制級</label>
                            </div>
                            @if ($errors->first('rating'))
                            <div class="alert alert-danger">{{ $errors->first('rating') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Upload Image') }}</label>
                        <div class="col-md-6">
                            <input type="file" name="img0" class="form-control-file" accept="image/png, image/jpeg, image/gif, image/jpg" onchange="checkimg(this);" > 
                            @if ($errors->first('img0'))
                            <div class="alert alert-danger">{{ $errors->first('img0') }}</div>
                            @endif
                            <input type="file" name="img1" class="form-control-file" accept="image/png, image/jpeg, image/gif, image/jpg" onchange="checkimg(this);" > @if ($errors->first('img1'))
                            <div class="alert alert-danger">{{ $errors->first('img1') }}</div>
                            @endif
                            <input type="file" name="img2" class="form-control-file" accept="image/png, image/jpeg, image/gif, image/jpg" onchange="checkimg(this);" /> @if ($errors->first('img2'))
                            <div class="alert alert-danger">{{ $errors->first('img2') }}</div>
                            @endif
                            <input type="file" name="img3" class="form-control-file" accept="image/png, image/jpeg, image/gif, image/jpg" onchange="checkimg(this);" /> @if ($errors->first('img3'))
                            <div class="alert alert-danger">{{ $errors->first('img3') }}</div>
                            @endif
                            <input type="file" name="img4" class="form-control-file" accept="image/png, image/jpeg, image/gif, image/jpg" onchange="checkimg(this);" /> @if ($errors->first('img4'))
                            <div class="alert alert-danger">{{ $errors->first('img4') }}</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Upload File') }}</label>
                        <div class="col-md-6">
                            <input type="file" id="file" name="file" class="form-control-file" accept=".exe" onchange="checkfile(this);" />
                            @if ($errors->first('file'))
                            <div class="alert alert-danger">{{ $errors->first('file') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Upload Video') }}</label>
                        <div class="col-md-6">
                            <input type="file" name="video" accept="video/*" class="form-control-file" onchange="checkvideo(this);" />
                            @if ($errors->first('video'))
                            <div class="alert alert-danger">{{ $errors->first('video') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">{{ __('Send') }}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script type="text/javascript" language="javascript">
    function checkvideo(sender) {
        var validExts = new Array(".mkv", ".mp4", ".avi");
        var fileExt = sender.value;
        fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
        if (validExts.indexOf(fileExt) < 0) {
            alert("檔案類型錯誤，可接受的副檔名有：" + validExts.toString());
            sender.value = null;
            return false;
        }
        else return true;
    }
</script>

<script type="text/javascript" language="javascript">
    function checkfile(sender) {
        var validExts = new Array(".exe");
        var fileExt = sender.value;
        fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
        if (validExts.indexOf(fileExt) < 0) {
            alert("檔案類型錯誤，可接受的副檔名有：" + validExts.toString());
            sender.value = null;
            return false;
        }
        else return true;
        }
</script>
    
<script type="text/javascript" language="javascript">
    function checkimg(sender) {
        var validExts = new Array(".jpg", ".png", ".gif");
        var fileExt = sender.value;
        fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
        if (validExts.indexOf(fileExt) < 0) {
            alert("檔案類型錯誤，可接受的副檔名有：" + validExts.toString());
            sender.value = null;
            return false;
        }
        else return true;
    }
</script>
@endsection