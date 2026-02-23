@extends('layouts.app')
@section('content')
    <div class="admin-container">
        <div class="heading-section">
            <h1>Welocome ({{ auth()->user()->name }})</h1>
            <h3>Your role is: {{ auth()->user()->getRoleNames()->first() }}</h3>
        </div>
        <div class="form-container">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <div class="logout-section">
                    <button type="submit" class="btn btn-danger">
                        Logout
                    </button>
                </div>
            </form>
        </div>
        <div class="button-sections">
            <div class="profile-link">
                <a href="{{ route('profile') }}" class="btn btn-primary mt-3">
                    View Profile
                </a>
            </div>
            <div class="user-section">
                <a href="{{ route('admin.users') }}" class="btn btn-primary mt-3">
                    View Users
                </a>
            </div>
            <div>
            </div>
        @endsection
