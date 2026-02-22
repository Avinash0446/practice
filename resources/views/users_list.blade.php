@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Users List</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                {{-- @dd($user); --}}
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" id="user_{{ $user->id }}" type="checkbox" role="switch" {{ $user->status == 'active' ? 'checked' : 'unchecked' }} onclick="toggleBtn({{ $user->id }})">
                            </div>
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.user.edit', $user->id) }}">Edit</a>
                            <form style="display:inline;" action="{{ route('admin.user.delete', $user->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @role('admin')
            <a class="btn btn-secondary mt-3" href="{{ route('admin.dashboard') }}">Back</a>
        @endrole

    </div>
<script>
    function toggleBtn(userId) {
        $.ajax({
            url: "{{ url('admin/user-toggle-status') }}/" + userId,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function (res) {
                console.log(res);
                alert(res.message ?? 'Status updated');
            },
            error: function (xhr) {
                console.log(xhr);
                alert('Something went wrong!');
            }
        });
    }
</script>

@endsection
