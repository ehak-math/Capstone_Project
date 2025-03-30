<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background: url("{{ asset('images/cover-school.jpg') }}") no-repeat center center fixed;
            background-size: cover;
            background-position: center;
            backdrop-filter: blur(10px);
        }
    </style>
            
</head>
<body>
<div class="container-login">
    <div class="login-form">
        <form action="" method="POST">
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
            <a href="/teacher/dashboard" class="btn-login">Login</a>
        </form>
    </div>
    </div>
</body>
</html>