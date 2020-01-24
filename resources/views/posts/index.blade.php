@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="posts-wrapper w-90 m-auto">
            @foreach($posts as $post)
                <div class="card mb-3 bg-transparent border border-dark">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->description }}</p>
                    </div>
                    <div class="button-holder d-flex justify-content-center p-3">
                        <a href="{{ route('posts.show', $post) }}" class="btn btn-info w-25">Read</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pagination-wrapper d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
