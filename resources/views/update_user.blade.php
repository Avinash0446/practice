@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm p-4">
            <h2 class="mb-4">Update {{ $user->name }}</h2>

            <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label" for="name">Name</label>
                    <input class="form-control" id="name" name="name" type="text"
                        value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" id="email" name="email" type="email"
                        value="{{ old('email', $user->email) }}" required>
                </div>

                @if ($user->profile_photo)
                    <div class="mb-3">
                        <img class="img-thumbnail mb-2" src="{{ asset('storage/' . $user->profile_photo) }}"
                            alt="Profile Photo" style="width: 120px; height: 120px; object-fit: cover;">
                    </div>
                @else
                    <div class="mb-3 text-muted">
                        No profile image uploaded yet.
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label" for="profile_photo">
                        {{ $user->profile_photo ? 'Change Profile Image' : 'Add Profile Image' }}
                    </label>
                    <input class="form-control" id="profile_photo" name="profile_photo" type="file" accept="image/*">
                </div>

                <button class="btn btn-primary" type="submit">Update Profile</button>
            </form>

            <a class="btn btn-secondary mt-3" href="{{ url()->previous() }}">Back</a>
        </div>
    </div>
@endsection
