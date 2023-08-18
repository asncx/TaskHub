@extends('layouts.layout')

@section('content')
@guest
<div class="container pt-5">
    <h4 class="mt-1">Register</h4>
    <form action="/register" method="POST">
        @csrf
        <div class="form-group">
            <label for="name1">Name</label>
            <input name="name" class="form-control" id="name1">
        </div>
        <div class="form-group">
            <label for="email1">Email address</label>
            <input name="email" class="form-control" id="email1">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="pass1">Password</label>
            <input name="password" type="password" class="form-control" id="pass1">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
@endguest
@endsection
