<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">

</head>
<body>

    <!-- Toggle Button for Large Screen -->
    <div class="bar">
        <button class="btn btn-bar d-none d-md-block" onclick="toggleSidebar()">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="d-flex align-items-center">
            <span class="profile"><i class="fa-solid fa-circle-user"></i></span>
            <div class="mx-3 mt-3 name-email">
                <p class="pro-name">Bro Hong</p>
                <p class="pro-email">bro.hong@gmail.com</p>
            </div>
        </div>
    </div>

    <!-- Mobile Header with Notifications and Profile -->
    <div class="mobile-header d-flex d-md-none position-fixed top-0">
        <button class="btn btn-color" onclick="toggleSidebar()"><i class="fa-solid fa-bars"></i></button>
        <div class="header-icons">
            <i class="fa-solid fa-bell"></i> <!-- Notification Icon -->
            <i class="fa-solid fa-circle-user"></i> <!-- User Profile Icon -->
        </div>
    </div>


    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div>
            
        </div>
        <a href="/dashboard" class="nav-link active" onclick="setActive(this)">
            <i class="fa-solid fa-gauge"></i><span>Dashboard</span>
        </a>
        <a href="teacher.html" class="nav-link" onclick="setActive(this)">
            <i class="fa-solid fa-chalkboard-user"></i><span>Teacher</span>
        </a>
        <a href="student.html" class="nav-link" onclick="setActive(this)">
            <i class="fa-solid fa-graduation-cap"></i><span>Students</span>
        </a>
        <a href="scheldule.html" class="nav-link" onclick="setActive(this)">
            <i class="fa-solid fa-calendar-days"></i><span>Scheldule</span>
        </a>
        <a href="users.html" class="nav-link" onclick="setActive(this)">
            <i class="fa-solid fa-users"></i><span>Users</span>
        </a>
        <a href="#" class="nav-link" onclick="setActive(this)">
            <i class="fa-solid fa-message"></i><span>Message</span>
        </a>
        <a href="#" class="nav-link" onclick="setActive(this)">
            <i class="fa-solid fa-circle-exclamation"></i><span>Notice</span>
        </a>
    </div>

    <!-- main content -->
    @yield('mainContent')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
