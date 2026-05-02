@extends('layouts.app')
@section('content')
<form action="{{ route('plans.store') }}" method="POST">
    @csrf

    <div>
        <label>Plan Name</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
        @error('name') <div>{{ $message }}</div> @enderror
    </div>

    <div>
        <label>Description</label>
        <textarea name="description">{{ old('description') }}</textarea>
    </div>

    <div>
        <label>Price (INR)</label>
        <input type="number" name="price" value="{{ old('price') }}" required>
        @error('price') <div>{{ $message }}</div> @enderror
    </div>

    <div>
        <label>Billing Interval</label>
        <select name="interval" required>
            <option value="">-- Select --</option>
            <option value="month">Monthly</option>
            <option value="year">Yearly</option>
        </select>
        @error('interval') <div>{{ $message }}</div> @enderror
    </div>

    <div>
        <label>Status</label>
        <select name="is_active">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
    </div>

    <button type="submit">Create Plan</button>
</form>
@endsection