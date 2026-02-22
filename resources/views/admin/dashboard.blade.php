@extends('layouts.app')
@section('content')
<h1>Welocome ({{ auth()->user()->name }})</h1>
<h3>Your role is: {{ auth()->user()->getRoleNames()->first() }}</h3>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">
        Logout
    </button>
</form>
<a href="{{ route('profile') }}" class="btn btn-primary mt-3">
    View Profile
</a>
<a href="{{ route('admin.users') }}" class="btn btn-primary mt-3">
    View Users
</a>
@endsection