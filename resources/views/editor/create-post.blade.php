@extends('layouts.app')
@section('content')

<div class="container">
    <h1>Create a New Post</h1>
    <form action="{{ route('editor.create-post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Caption</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Image Only</label>
        <input type="file" class="form-control" name="post_image" accept="image/*"/>
        </div>
        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>

@endsection