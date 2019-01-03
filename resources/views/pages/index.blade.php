@extends('layouts.app')
{{-- Default layouts --}}

@section('title', 'Home')
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
                @else
                <p>There is no posts at the moment</p>
            @endif
        </div>
    </div>
@endsection
{{-- Default layouts --}}
