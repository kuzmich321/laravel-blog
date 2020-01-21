@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="posts-wrapper w-90 m-auto">
            @foreach($posts as $post)
                <div class="card bg-transparent border-dark mb-3">
                    <div class="card-body text-dark">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->description }}</p>
                        <div class="buttons float-right">
                            <button type="submit"
                                    class="btn btn-info"
                                    onclick="window.location='{{ route('admin.posts.edit', $post) }}'">Edit
                            </button>
                            <button class="btn btn-danger">Delete</button>
                            <button class="btn btn-primary">Restore</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pagination-wrapper d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
