@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm p-4">
            <h2 class="mb-4">Your Profile</h2>

            <dl class="row mb-3">
                <dt class="col-sm-3">Name:</dt>
                <dd class="col-sm-9">{{ $user->name }}</dd>

                <dt class="col-sm-3">Email:</dt>
                <dd class="col-sm-9">{{ \Illuminate\Support\Str::maskemail($user->email) }}</dd>
            </dl>

            {{-- Optional: Role-specific sections if you ever need them --}}
            @role('admin')
                <div class="alert alert-info mt-4">This is an admin-specific section.</div>
            @endrole

            @role('editor')
                <div class="alert alert-info mt-4">This is an editor-specific section.</div>
            @endrole

            @role('user')
                <div class="alert alert-info mt-4">This is a user-specific section.</div>
            @endrole
        </div>
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Back to Dashboard</a>
@endsection
