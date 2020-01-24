@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <div class="container">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th>Read</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td><a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-info">Read</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
@endsection
