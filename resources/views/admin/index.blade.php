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
                        <button type="submit"
                                formaction="{{ route('admin.users.destroy', $user) }}"
                                formmethod="POST"
                                class="btn btn-sm btn-danger"
                                form="delete"
                                @if($user->trashed())
                                disabled
                            @endif>
                            Delete
                        </button>
                    </td>
                    <td>
                        @if($user->trashed())
                            <button type="submit"
                                    formaction="{{ route('admin.users.restore', $user) }}"
                                    class="btn btn-sm btn-primary"
                                    form="restore">Restore
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <form id="delete" method=POST">
            @csrf
            @method('DELETE')
        </form>
        <form id="restore" method="POST">
            @csrf
            @method('PATCH')
        </form>
        <div class="pagination-wrapper d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
@endsection
