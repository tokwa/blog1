@extends('layouts.app')
{{-- Default layouts --}}

@section('title', 'Make a Post')
@section('content')
<div class="container">
    <div class="jumbotron">
        <div class="card-body">
            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    &nbsp;&nbsp;&nbsp;&nbsp;<label for="title" class="text-md-right">{{ __('Post Title') }}</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"
                            value="{{ old('title') }}" autofocus>

                        @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                        &nbsp;&nbsp;&nbsp;&nbsp;<label for="body" class="text-md-right">{{ __('Post Content') }}</label>

                    <div class="col-md-12">
                        <textarea rows="6" class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}" id="article-ckeditor"
                            ; name="body">{{ old('body') }}</textarea>
                        @if ($errors->has('body'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('body') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="image" id="image" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection