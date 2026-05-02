@extends('layouts.app')

@section('content')

<style>
body {
    background-color: #f4f6f9;
    font-family: Arial, sans-serif;
}

.form-wrapper {
    max-width: 600px;
    margin: 50px auto;
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.form-wrapper h2 {
    text-align: center;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
}

.form-control:focus {
    outline: none;
    border-color: #0d6efd;
}

/* Button */
.btn-submit {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 6px;
    background-color: #0d6efd;
    color: #fff;
    font-weight: 500;
    cursor: pointer;
}

.btn-submit:hover {
    background-color: #0b5ed7;
}

/* Error */
.error-text {
    color: red;
    font-size: 13px;
    margin-top: 3px;
}
</style>

<div class="form-wrapper">

    <h2>Create Plan</h2>

    <form action="{{ route('plans.store') }}" method="POST">
        @csrf

        <!-- Name -->
        <div class="form-group">
            <label>Plan Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
            @error('name')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <!-- Description -->
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <!-- Price -->
        <div class="form-group">
            <label>Price (INR)</label>
            <input type="number" name="price" value="{{ old('price') }}" class="form-control" required>
            @error('price')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <!-- Interval -->
        <div class="form-group">
            <label>Billing Interval</label>
            <select name="interval" class="form-control" required>
                <option value="">-- Select --</option>
                <option value="month" {{ old('interval') == 'month' ? 'selected' : '' }}>Monthly</option>
                <option value="year" {{ old('interval') == 'year' ? 'selected' : '' }}>Yearly</option>
            </select>
            @error('interval')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <!-- Status -->
        <div class="form-group">
            <label>Status</label>
            <select name="is_active" class="form-control">
                <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-submit">
            Create Plan
        </button>
    </form>
</div>
@endsection