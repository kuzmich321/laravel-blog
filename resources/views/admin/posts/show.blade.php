@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card bg-transparent text-dark">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->description }}</p>
                <blockquote class="blockquote mb-0">
                    <footer class="blockquote-footer">The post was
                        created at {{ date('d m Y', strtotime($post->created_at)) }}</footer>
                </blockquote>
            </div>
        </div>
    </div>
@endsection
