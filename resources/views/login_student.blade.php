<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            background: url("{{ asset('images/cover-school.jpg') }}") no-repeat center center fixed;
            background-size: cover;
            background-position: center;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>
            
</head>
<body>
<div class="container-login">
    <div class="login-form">
    @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="" method="POST">
        @csrf
            <h1>Login</h1>
            <div class="input-box">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="username" id="username" class="input-field" required>
                <label for="">Username</label>
            </div>

            <div class="input-box">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" id="password" class="input-field" required>
                <label for="">Password</label>
            </div>
            <button type="submit" class="btn-submit">Login</button>
        </form>
    </div>
    </div>
</body>
</html>