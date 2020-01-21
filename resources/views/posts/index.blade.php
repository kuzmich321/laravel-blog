@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="posts-wrapper w-90 m-auto">
            @foreach($posts as $post)
                <div class="card mb-3"
                     onclick="window.location='{{ route("posts.show", $post) }}'"
                     style="cursor: pointer;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pagination-wrapper d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
