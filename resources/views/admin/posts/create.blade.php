@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron w-75 m-auto border border-dark">
            <h1 class="display-4">Create your post!</h1>
            <form method="POST" action="{{ route('admin.posts.store') }}">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" required autocomplete="title" autofocus>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" rows="3" required autocomplete="description"
                              autofocus></textarea>
                </div>
                <div class="button-holder d-flex justify-content-center pt-3">
                    <button class="btn btn-info w-50">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection
