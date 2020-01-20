@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th>Delete</th>
                <th>Restore</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr onclick="window.location='{{ route("admin.users.edit", $user) }}'" style="cursor: pointer">
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                    <td>
                        @if($user->trashed())
                            <form action="{{ route('admin.users.restore', $user) }}" method="POST">
                                @csrf
                                @method('patch')
                                <button type="submit" class="btn btn-sm btn-primary">Restore</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
@endsection
