@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Role: {{ $role->name }}
                            <a class="btn btn-danger float-end" href="{{ route('roles.index') }}">Back</a>
                        </h4>
                    </div>
                    {{-- session messages --}}
                    @if (session('message'))
                        <div class="alert alert-success m-1">
                            {{ session('message') }}
                        </div>
                    @endif
                    {{-- session messages --}}


                    <form class="m-2" action="{{ route('role.permissionsUpdate', $role) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="">Permissions:</label>

                            <div class="row">
                                @foreach ($permissions as $permission)
                                    <div class="col-md-2">

                                        <label>
                                            <input type="checkbox" name="permission[]" value="{{ $permission->name }}"
                                            {{in_array($permission->id,$rolePermissions)?'checked':''}}
                                            />
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach

                            </div>

                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>

                        @if ($errors->any())
                            <hr>
                            <div class="alert alert-danger mt-1">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
