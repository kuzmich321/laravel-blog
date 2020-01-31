@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card-wrapper w-75 m-auto">
            <form method="POST" action="{{ route('admin.posts.update', $post) }}">
                @csrf
                @method('PATCH')
                <div class="card bg-transparent text-dark border-dark">
                    <div class="card-header">
                        <h5>Edit your post here</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text"
                                   name="title"
                                   class="form-control"
                                   value="{{ $post->title }}"
                                   required
                                   autocomplete="title"
                                   autofocus>
                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description"
                                      class="form-control"
                                      rows="3"
                                      required
                                      autocomplete="description"
                                      autofocus>{{ $post->description }}</textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="button-holder d-flex justify-content-center p-3">
                        <button class="btn btn-lg btn-info w-25" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
