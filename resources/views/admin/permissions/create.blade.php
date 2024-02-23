@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Permission</h4>
                        <a class="btn btn-danger float-end" href="{{ route('permissions.index') }}">Back</a>
                    </div>
                </div>
                <div class="card-body m-2">

                    <form action="{{ route('permissions.store') }}" method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="name">Name:</label>
                            <input class="form-control" type="text" name="name" id="name"
                                value="{{ old('name') }}">


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
