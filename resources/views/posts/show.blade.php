@extends('layouts.app')
{{-- Default layouts --}}

@section('title', 'Home')
@section('content')
<div class="container">
    <div class="card text-center">
        <div class="card-header">
            Card
        </div>
        <div class="card-body">
            <h5 class="card-title">{{$post->title ?? 'Default'}}</h5>
            {{-- Default will be the title if the user did not enter a title but since there is a validation in post
            controller this will no longer appear --}}
            <img class="card-img-top" src="{{ asset('images/' . $post->image) }}" alt="Card image cap">
            <p class="card-text">{!!html_entity_decode($post->body)!!}</p>
            {{-- to decode escape --}}
        </div>
        <div class="card-footer text-muted">
            <small>Written on {{$post->created_at}} by: {{$post->user->name}}</small>
        </div>
    </div>
    <div>
        {{-- @if($post->user_id == Auth::user()->id) --}}
        @if(Auth::check() && $post->user_id == Auth::user()->id)
        <a href="/" class="btn btn-primary">Back</a>
        <a href="/posts/{{$post->id}}/edit" class="btn btn-danger">Edit</a>
        {{-- Delete starts here.. --}}
        <button class="btn btn-xs btn-info" type="button" data-toggle="modal" data-target="#post-{{ $post->id }}">Delete</button>
        @else
        <a href="/" class="btn btn-primary">Back</a>
        @endif
    </div>
</div>
@if(Auth::check() && $post->user_id == Auth::user()->id)
{{-- @if($post->user_id == Auth::user()->id) --}}
<div class="modal fade show" id="post-{{ $post->id }}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title"><span class="text-danger">Delete</span> {{ $post->title }}?</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <p>
                        Deleting will permanently remove the item from our database.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Proceed</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection