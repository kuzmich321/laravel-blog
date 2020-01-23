@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card bg-transparent border border-dark">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->description }}</p>
                <a href="{{ route('users.show', $post->user_id) }}"
                   class="card-link">{{ $post->user->name }}</a>
            </div>
        </div>
    </div>
@endsection
