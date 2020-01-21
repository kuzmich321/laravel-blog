@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="posts-wrapper">
            @foreach($posts as $post)
                <div class="card" onclick="window.location='{{ route("admin.posts.edit", $post) }}'">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->description }}</p>
                        <div class="buttons float-right">
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

<style>
    .posts-wrapper {
        width: 90%;
        margin: auto;
    }

    .card {
        margin-bottom: 10px;
        cursor: pointer;
    }

    .card:hover {
        background-color: rgba(0, 0, 0, 0.1);
    }
</style>

