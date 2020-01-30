@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <div class="container">
        <div class="card-columns">
            @foreach($users as $user)
                <div class="card bg-dark border-danger text-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $user->name }} #{{ $user->id }}</h5>
                        <p class="card-text">{{ $user->email }}</p>
                        <a href="{{ route('users.show', $user) }}" class="btn btn-outline-warning w-25">Read</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pagination-wrapper d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
@endsection
