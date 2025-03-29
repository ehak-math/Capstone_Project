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
            height: 100vh;
            background-position: center;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>
            
</head>
<body>
<div class="container-login">
    <div class="login-form">
        <h1>Student Login</h1>
        
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('student.login.submit') }}" method="POST">
            @csrf
            <div class="input-box">
                <input type="text" name="username" id="username" class="input-field" placeholder="Username" required>
            </div>

            <div class="input-box">
                <input type="password" name="password" id="password" class="input-field" placeholder="Password" required>
            </div>
            
            <button type="submit" class="btn-submit">Login</button>
        </form>
    </div>
    </div>
</body>
</html>