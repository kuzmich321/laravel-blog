@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron bg-dark text-danger">
            <h1 class="display-4">{{ $post->title }}</h1>
            <p class="lead text-light">{{ $post->description }}</p>
            <hr class="my-4">
            <a href="{{ route('users.show', $post->user_id) }}"
               class="card-link">{{ $post->user->name }}</a>
        </div>
    </div>
@endsection
