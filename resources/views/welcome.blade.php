<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | High School Management System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .welcome-container {
            text-align: center;
            margin-top: 100px;
        }

        .welcome-title {
            font-size: 36px;
            font-weight: bold;
            color: #11117E;
        }

        .welcome-subtitle {
            font-size: 18px;
            color: #555;
        }

        .welcome-icon {
            font-size: 50px;
            color: #11117E;
            margin-bottom: 20px;
        }

        .btn-animated {
            padding: 12px 24px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin: 10px;
        }

        .btn-login {
            background-color: #11117E;
            color: white;
        }

        .btn-register {
            background-color: #4CAF50;
            color: white;
        }

        .btn-animated:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        footer {
            margin-top: 60px;
        }

        .social-icons a {
            color: #555;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: #11117E;
        }

        .features-section {
            background-color: #fff;
            padding: 50px 20px;
            margin-top: 50px;
            border-top: 4px solid #11117E;
        }

        .feature {
            margin-bottom: 30px;
        }

        .feature i {
            font-size: 30px;
            color: #11117E;
            margin-bottom: 10px;
        }

        .feature h5 {
            font-weight: bold;
        }

        .feature p {
            color: #555;
        }
    </style>
</head>

<body>

    <!-- Hero -->
    <div class="container welcome-container">
        <div class="welcome-icon">
            <i class="fa-solid fa-school"></i>
        </div>
        <h1 class="welcome-title">Welcome to the High School Management System</h1>
        <p class="welcome-subtitle">Efficiently manage students, teachers, courses, and more.</p>

        @auth
            @if (auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="btn btn-animated btn-register">
                    Go to Admin Dashboard <i class="fa-solid fa-arrow-right"></i>
                </a>
            @elseif (auth()->user()->role === 'student')
                <a href="{{ route('student.dashboard') }}" class="btn btn-animated btn-register">
                    Go to Student Dashboard <i class="fa-solid fa-arrow-right"></i>
                </a>
            @elseif (auth()->user()->role === 'teacher')
                <a href="{{ route('teacher.dashboard') }}" class="btn btn-animated btn-register">
                    Go to Teacher Dashboard <i class="fa-solid fa-arrow-right"></i>
                </a>
            @endif
        @else
            <a href="{{ route('login') }}" class="btn btn-animated btn-login">
                <i class="fa-solid fa-right-to-bracket mx-2"></i>Admin Login
            </a>
            <a href="{{ route('teacher.login') }}" class="btn btn-animated btn-login">
                <i class="fa-solid fa-right-to-bracket mx-2"></i>Teacher Login
            </a>
            <a href="{{ route('student.login') }}" class="btn btn-animated btn-login">
                <i class="fa-solid fa-right-to-bracket mx-2"></i>Student Login
            </a>
            <a href="{{ route('register') }}" class="btn btn-animated btn-register">
                <i class="fa-solid fa-user-plus"></i> Register
            </a>
        @endauth
    </div>

    <!-- Features Section -->
    <div class="features-section text-center">
        <div class="container">
            <h2 class="mb-4">What You Can Do with HSMS</h2>
            <div class="row">
                <div class="col-md-4 feature">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <h5>Manage Teachers</h5>
                    <p>Add, update, and assign subjects to teachers easily.</p>
                </div>
                <div class="col-md-4 feature">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <h5>Manage Students</h5>
                    <p>Register students, track performance, and manage profiles.</p>
                </div>
                <div class="col-md-4 feature">
                    <i class="fa-solid fa-book-open-reader"></i>
                    <h5>Manage Courses</h5>
                    <p>Create and organize subjects or courses by grade levels.</p>
                </div>
                <div class="col-md-4 feature">
                    <i class="fa-solid fa-calendar-days"></i>
                    <h5>Schedule Timetables</h5>
                    <p>Set class schedules and view weekly plans by teacher or class.</p>
                </div>
                <div class="col-md-4 feature">
                    <i class="fa-solid fa-marker"></i>
                    <h5>Assign Grades</h5>
                    <p>Teachers can assign grades and view class performance reports.</p>
                </div>
                <div class="col-md-4 feature">
                    <i class="fa-solid fa-lock"></i>
                    <h5>User Roles & Login</h5>
                    <p>Secure logins for Admins, Teachers, and Students.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="text-center mt-5 mb-4">
        <div class="mb-2">
            <!-- Social Media Icons -->
            <a href="https://facebook.com" target="_blank" class="text-decoration-none mx-2 text-dark">
                <i class="fab fa-facebook fa-lg"></i>
            </a>
            <a href="https://twitter.com" target="_blank" class="text-decoration-none mx-2 text-dark">
                <i class="fab fa-twitter fa-lg"></i>
            </a>
            <a href="https://instagram.com" target="_blank" class="text-decoration-none mx-2 text-dark">
                <i class="fab fa-instagram fa-lg"></i>
            </a>
            <a href="https://linkedin.com" target="_blank" class="text-decoration-none mx-2 text-dark">
                <i class="fab fa-linkedin fa-lg"></i>
            </a>
        </div>
        <small class="text-muted">
            &copy; {{ date('Y') }} High School Management System. All rights reserved.
        </small>
    </footer>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>