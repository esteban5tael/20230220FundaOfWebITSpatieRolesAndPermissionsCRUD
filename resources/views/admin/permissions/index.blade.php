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
                        <h4>Permissions</h4>
                        <a class="btn btn-primary float-end" href="{{ route('permissions.create') }}">Add Permission</a>
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
                            @foreach ($permissions as $permission)
                                <tr>

                                    <td>
                                        <form action="{{ route('permissions.destroy', $permission) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <a class="btn btn-success btn-sm"
                                                href="{{ route('permissions.edit', $permission) }}">Edit</a>

                                            <button class="btn btn-danger btn-sm" type="submit"
                                                onclick="return confirm('Are you sure?')">
                                                Delete
                                            </button>

                                        </form>
                                    </td>
                                    <td>{{ $permission->id }} </td>
                                    <td>{{ $permission->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>


                </div>

            </div>
        </div>
    </div>
@endsection
