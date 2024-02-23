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
                        <h4>Roles
                            <a class="btn btn-primary float-end" href="{{ route('roles.create') }}">Add Role</a>
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
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($roles as $role)
                                <tr>

                                    <td>
                                        <form action="{{ route('roles.destroy', $role) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <a class="btn btn-success btn-sm"
                                                href="{{ route('roles.edit', $role) }}">Edit</a>

                                            <button class="btn btn-danger btn-sm" type="submit"
                                                onclick="return confirm('Are you sure?')">
                                                Delete
                                            </button>

                                            <a class="btn btn-primary btn-sm"
                                            href="{{ route('role.permissions', $role) }}">Add / Edit Role Permissions</a>

                                        </form>
                                    </td>
                                    <td>{{ $role->id }} </td>
                                    <td>{{ $role->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>


                </div>

            </div>
        </div>
    </div>
@endsection
