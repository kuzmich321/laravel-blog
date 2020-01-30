@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card-columns w-90 m-auto">
            @foreach($posts as $post)
                <div class="card mb-3 bg-dark border-danger text-white">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->description }}</p>
                    </div>
                    <div class="button-holder d-flex justify-content-center p-3">
                        <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-warning w-25">Read</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pagination-wrapper d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
