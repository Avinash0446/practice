<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home | Register</title>
</head>

<body class="bg-light">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="card shadow-lg border-0 rounded-3" style="max-width: 420px; width: 100%;">
            <div class="card-body p-4 p-md-5">

                <!-- Heading -->
                <h2 class="text-center fw-bold mb-2">Welcome 👋</h2>
                <p class="text-center text-muted mb-4">
                    Create your account to get started
                </p>

                <!-- Register Form -->
                <form id="register" action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input class="form-control" name="name" type="text" placeholder="Enter your name"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input class="form-control" name="email" type="email" placeholder="Enter your email"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input class="form-control" name="password" type="password" placeholder="Enter your password"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select" name="role" required>
                            <option value="" disabled selected>Select a role</option>
                            <option value="editor">Editor</option>
                            <option value="user">User</option>
                        </select>
                    </div>

                    <button class="btn btn-primary w-100 py-2 mb-3" type="submit">
                        Register
                    </button>

                    <!-- Divider -->
                    <div class="text-center text-muted my-2">or</div>

                    <a class="btn btn-outline-secondary w-100 py-2" href="{{ route('login') }}">
                        Login
                    </a>
                </form>

            </div>
        </div>
    </div>

</body>

</html>
