@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr onclick="window.location='{{ route("admin.users.edit", $user) }}'" style="cursor: pointer">
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
@endsection
