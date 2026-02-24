@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        @if ($errors->any())
            <div id="flash-message" class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card shadow-sm p-4">
            <h2 class="mb-4">Login</h2>
            <form action="{{ route('login.attempt') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input class="form-control" name="email" type="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input class="form-control" name="password" type="password" placeholder="Enter your password" required>
                </div>
                <button class="btn btn-primary w-100 py-2" type="submit">Login</button>
            </form>
            <div class="text-center text-muted my-3">Don't have an account?</div>
            <a class="btn btn-outline-secondary w-100 py-2" href="{{ route('home') }}">Register</a>
        </div>
    </div>
@endsection
