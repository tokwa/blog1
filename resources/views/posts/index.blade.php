@extends('layouts.app')
{{-- Default layouts --}}

@section('title', 'My Posts')
@section('content')
    <div class="container">
        <div class="jumbotron">
            @if(count($x) > 0)
                @foreach($x as $post)
                    <div class="card bg-light p-3">
                        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <hr>
                        <small>Written on {{$post->created_at}} by: {{$post->user->name}}</small>
                    </div>
                    <br>
                @endforeach
                {{$x->links()}}
             {{-- above line is added for pagination --}}
                @else
                    You do have any posts at the moment.
            @endif
        </div>
    </div>
@endsection
{{-- Default layouts --}}
