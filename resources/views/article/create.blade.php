@extends('layouts.app') 
@section('content') 
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">{{ isset($article) ? __('Change Article') : __('New Article') }}</div>
            <div class="card-body">
                <form class="needs-validation" method="POST" action="{{ isset($article) ? @route('article.update',$article->id) : @route('article.store') }}" novalidate>
                    @if(isset($article)) {{ method_field('PATCH') }} @endif
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>
                        <div class="col-md-8">
                            <input name="title" type="text" class="form-control" maxlength="20" value="{{ isset($article->title) ? $article->title : old('title')}}"required> 
                            @if ($errors->first('title'))
                            <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label text-md-right">{{ __('Article Content') }}</label>
                        <div class="col-md-8">
                            <textarea name="text" maxlength="400" class="form-control" required style="width:100%;height:500px;">{{ isset($article->content) ? $article->content : old('text')}}</textarea>                            
                            @if ($errors->first('text'))
                            <div class="alert alert-danger">{{ $errors->first('text') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4 text-right">
                            <button type="submit" class="btn btn-primary">{{ __('Send') }}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection