@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <div id="app">
        <div class="container">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                </tr>
                </tbody>
            </table>
            <user-posts :per-page="3" :user-id="'{{ $user->id }}'"
                        :api-url="'{{ route('api.posts.index') }}'"></user-posts>
        </div>
    </div>
@endsection
