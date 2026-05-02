<table class="table table-bordered table-striped">
    <thead class="table-dark">
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
        <tr>
            <td>{{ $users->firstItem() + $key }}</td>

            <td>{{ $user->fullName }}</td>
            <td>{{ $user->email }}</td>

            <td>
                <!-- Bootstrap Toggle Switch -->
                <div class="form-check form-switch">
                    <input 
                        class="form-check-input" 
                        type="checkbox" 
                        role="switch"
                        id="user_{{ $user->id }}"
                        {{ $user->status == 'active' ? 'checked' : '' }}
                        onclick="toggleBtn({{ $user->id }})"
                    >
                </div>
            </td>

            <td>
                <!-- Edit Button -->
                <a class="btn btn-sm btn-primary" 
                   href="{{ route('admin.user.edit', $user->id) }}">
                   Edit
                </a>

                <!-- Delete Button -->
                <form 
                    action="{{ route('admin.user.delete', $user->id) }}" 
                    method="POST" 
                    style="display:inline;"
                    onsubmit="return confirm('Are you sure you want to delete this user?');"
                >
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-sm btn-danger" type="submit">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination -->
<div class="d-flex justify-content-center">
    {{ $users->links('pagination::bootstrap-5') }}
</div>