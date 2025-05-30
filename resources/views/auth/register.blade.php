<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>

<body>
    <div class="container-login">
        <div class="login-form">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ route('register.submit') }}" method="POST">
                @csrf
                <h1>Register</h1>
                <div class="input-box">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="name" value="{{ old('name') }}" class="input-field" required>
                    <label for="name">Name</label>
                </div>
                <div class="input-box">
                    <i class="fa-solid fa-user"></i>
                    <input type="email" name="email" class="input-field" value="{{ old('email') }}" required>
                    <label for="email">Email</label>
                </div>

                <div class="input-box">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" class="input-field" required>
                    <label for="password">Password</label>
                </div>
                <div class="input-box">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password_confirmation" class="input-field" required>
                    <label for="password_confirmation">Confirm Password</label>
                </div>
                <button type="submit" class="btn-submit">Register</button>
                <div class="register-link mt-3 text-center">
                    <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
                </div>
                <!-- validation error -->
                @if ($errors->any())
                    <div class="alert alert-danger mt-2">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>