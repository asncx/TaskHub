@extends('layouts.layout')

@section('content')

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <p class="text-muted mb-1">Profile of</p>
                        <h5 class="my-3">{{ $selected_user->name }}</h5>                        
                        <div class="d-flex justify-content-center mb-2">
                            <form action="{{ route('users.update', $selected_user->id) }}">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                            <form action="{{ route('users.destroy', $selected_user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $selected_user->name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $selected_user->email }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Registration date</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $selected_user->created_at }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Permission</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">@if ($selected_user->permission === null)
                                    User
                                @else
                                    {{ $selected_user->permission }}
                                @endif</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
