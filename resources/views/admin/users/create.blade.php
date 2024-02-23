@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create User</h4>
                        <a class="btn btn-danger float-end" href="{{ route('users.index') }}">Back</a>
                    </div>
                </div>
                <div class="card-body m-2">

                    <form action="{{ route('users.store') }}" method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="name">Name:</label>
                            <input class="form-control" type="text" name="name" id="name"
                                value="{{ old('name') }}" autocomplete="off">
                        </div>

                        <div class="mb-3">
                            <label for="email">Email:</label>
                            <input class="form-control" type="email" name="email" id="email"
                                value="{{ old('email') }}" autocomplete="off">
                        </div>

                        <div class="mb-3">
                            <label for="password">Password:</label>
                            <input class="form-control" type="password" name="password" id="password"
                                value="{{ old('password') }}" autocomplete="off">
                        </div>

                        <div class="mb-3">
                            <label for="roles[]">Roles:</label>
                            <select class="form-control" name="roles[]" id="roles[]" multiple>
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}">
                                        {{ $role }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Save</button>
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
