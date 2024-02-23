@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {{-- session messages --}}
                @if (session('message'))
                    <div class="alert alert-success m-1">
                        {{ session('message') }}
                    </div>
                @endif
                {{-- session messages --}}

                <div class="card">
                    <div class="card-header">
                        <h4>Users
                            <a class="btn btn-primary float-end" href="{{ route('users.create') }}">Add User</a>
                        </h4>
                    </div>
                </div>

                <div class="card-body">

                    <table class="table table-bordered m-1">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $user)
                                <tr>

                                    <td>
                                        <form action="{{ route('users.destroy', $user) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <a class="btn btn-success btn-sm"
                                                href="{{ route('users.edit', $user) }}">Edit</a>

                                            <button class="btn btn-danger btn-sm" type="submit"
                                                onclick="return confirm('Are you sure?')">
                                                Delete
                                            </button>


                                        </form>
                                    </td>
                                    <td>{{ $user->id }} </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $rolename)
                                                <label class="badge bg-primary mx-1">{{ $rolename }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>


                </div>

            </div>
        </div>
    </div>
@endsection
