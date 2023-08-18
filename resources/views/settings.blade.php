@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-6">
                @auth
                    <form action="{{ route('updateUsername') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="username">To modify the username, enter the new username</label>
                            <input type="text" name="username" class="form-control" id="username"
                                value="{{ Auth::user()->name }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>


                    <form action="{{ route('deleteAccount') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete Account</button>
                    </form>

                @endauth

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-lg-6">
                <div class="card-header">Your Data</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Name</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ Auth::user()->name }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Name</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Registration date</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ Auth::user()->created_at->format('Y-m-d H:i:s') }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endsection

</div>
