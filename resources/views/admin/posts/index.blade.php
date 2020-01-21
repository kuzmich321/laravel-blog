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
                                    onclick="window.location='{{ route('admin.posts.edit', $post) }}'"
                                    @if($post->trashed()) disabled @endif>Edit
                            </button>
                            <button type="submit"
                                    class="btn btn-danger"
                                    form="posts-delete"
                                    formaction="{{ route('admin.posts.destroy', $post) }}"
                                    @if($post->trashed()) disabled @endif >Delete
                            </button>
                            <button type="submit"
                                    class="btn btn-success"
                                    form="posts-restore"
                                    formaction="{{ route('admin.posts.restore', $post) }}"
                                    @if(!$post->trashed()) disabled @endif>Restore
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <form id="posts-delete" method="POST">
            @csrf
            @method('DELETE')
        </form>
        <form id="posts-restore" method="POST">
            @csrf
            @method('PATCH')
        </form>
        <div class="pagination-wrapper d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
