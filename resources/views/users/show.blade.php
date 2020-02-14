@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <div id="app">
        <user :api-url="'{{ route('api.users.show', $user) }}'"></user>
        <user-posts :per-page="3" :user-id="'{{ $user->id }}'"
                    :api-url="'{{ route('api.posts.index') }}'"></user-posts>
    </div>
@endsection
