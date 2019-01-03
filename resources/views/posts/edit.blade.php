@extends('layouts.app')
{{-- Default layouts --}}

@section('title', 'Edit Posts')
{{-- title came from @yield('title') in app.blade.php --}}
@section('content')
{{-- test form --}}
<div class="container">
    <div class="card-body">
        <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
            {{-- to get id $post->id --}}
            @csrf
            @method('PUT')
            {{-- --}}
            <div class="form-group row">
                    &nbsp;&nbsp;&nbsp;<label for="title" class="text-md-right">{{ __('Title') }}</label>

                <div class="col-md-12">
                    <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"
                        value="{{ $post->title ?? old('title') }}" autofocus>

                    @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                    &nbsp;&nbsp;&nbsp;<label for="body" class="text-md-right">{{ __('Body') }}</label>

                <div class="col-md-12">
                    <textarea rows="6" class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}" id="article-ckeditor"
                        ; name="body">{{ old('body') ?? html_entity_decode($post->body) }}</textarea>
                    @if ($errors->has('body'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('body') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <a href="/posts" class="btn btn-primary">Back</a>
                <button type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection