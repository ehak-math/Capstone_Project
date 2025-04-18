<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery (required for Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">

</head>

<body>

    <!-- Toggle Button for Large Screen -->
    <div class="bar" style="z-index: 1000;">
        <button class="btn btn-bar d-none d-md-block" onclick="toggleSidebar()">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="d-flex align-items-center">
            <span class="profile"><i class="fa-solid fa-circle-user"></i></span>
            <div class="mx-3 mt-3 name-email">
                <p class="pro-name">{{ Auth::user()->name }}</p>
                <p class="pro-email">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>

    <!-- Mobile Header with Notifications and Profile -->
    <div class="mobile-header d-flex d-md-none position-fixed top-0 " style="z-index: 1000;">
        <button class="btn btn-color" onclick="toggleSidebar()"><i class="fa-solid fa-bars"></i></button>
        <div class="header-icons">
            <!-- <i class="fa-solid fa-bell"></i> Notification Icon -->
            <i class="fa-solid fa-circle-user"></i> <!-- User Profile Icon -->
        </div>
    </div>


    <!-- Sidebar -->
    <div class="sidebar" id="sidebar" style="z-index: 1000; ">
        <a href="/admin/dashboard" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}"
            id="dashboard-link">
            <i class="fa-solid fa-gauge"></i><span>Dashboard</span>
        </a>
        <a href="/admin/teachers/index" class="nav-link {{ Request::is('admin/teachers/index') ? 'active' : '' }}"
            id="teacher-link">
            <i class="fa-solid fa-chalkboard-user"></i><span>Teacher</span>
        </a>
        <a href="/admin/students/index" class="nav-link {{ Request::is('admin/students/index') ? 'active' : '' }}"
            id="student-link">
            <i class="fa-solid fa-graduation-cap"></i><span>Students</span>
        </a>
        <a href="/admin/schedule/index" class="nav-link {{ Request::is('admin/schedule/index') ? 'active' : '' }}"
            id="schedule-link">
            <i class="fa-solid fa-calendar-days"></i><span>Schedule</span>
        </a>
        <a href="/admin/courses/index" class="nav-link {{ Request::is('admin/courses/index') ? 'active' : '' }}"
            id="course-link">
            <i class="fa-solid fa-book-open-reader"></i><span>Course</span>
        </a>
        <a href="/admin/grade_subject/index"
            class="nav-link {{ Request::is('admin/grade_subject/index') ? 'active' : '' }}" id="grade_subject-link">
            <i class="fa-solid fa-chalkboard"></i><span>Grade/Subject</span>
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="nav-link" id="logout-link">
                <i class="fa-solid fa-right-from-bracket"></i><span>Logout</span>
            </button>
        </form>

    </div>


    <!-- main content -->
    @yield('mainContent')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>