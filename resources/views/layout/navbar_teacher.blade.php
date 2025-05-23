<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>

    <!-- Toggle Button for Large Screen -->
    <div class="bar" style="z-index: 1000;">
        <button class="btn btn-bar d-none d-md-block" onclick="toggleSidebar()">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="d-flex align-items-center">
            @if($teacher->tea_profile && file_exists(public_path('storage/' . $teacher->tea_profile)))
                <img class="profile_bar" src="{{ asset('storage/' . $teacher->tea_profile) }}" alt="teacher Profile">
            @else
                <img class="profile_bar" src="{{ asset('images/placeholder_teacher.jpg') }}" alt="Placeholder Image">
            @endif
            <div class="mx-3 mt-3 name-email">
                <p class="pro-name">{{ $teacher->tea_fname }}</p>
                <!-- <p class="pro-email">bro.hong@gmail.com</p> -->
            </div>
        </div>
    </div>

    <!-- Mobile Header with Notifications and Profile -->
    <div class="mobile-header d-flex d-md-none position-fixed top-0" style="z-index: 1000;" >
        <button class="btn btn-color" onclick="toggleSidebar()"><i class="fa-solid fa-bars"></i></button>
        <div class="header-icons">
        @if($teacher->tea_profile && file_exists(public_path('storage/' . $teacher->tea_profile)))
                <img class="profile_bar_mobile" src="{{ asset('storage/' . $teacher->tea_profile) }}" alt="teacher Profile">
            @else
                <img class="profile_bar_mobile" src="{{ asset('images/placeholder_teacher.jpg') }}" alt="Placeholder Image">
            @endif
        </div>
    </div>


    <!-- Sidebar -->
    <div class="sidebar" id="sidebar" style="z-index: 1000; ">
        <a href="/teacher/dashboard" class="nav-link {{ Request::is('teacher/dashboard') ? 'active' : '' }}"
            id="dashboard-link">
            <i class="fa-solid fa-gauge"></i><span>Dashboard</span>
        </a>
         <a href="/teacher/topstudent" class="nav-link {{ Request::is('teacher/topstudent') ? 'active' : '' }}" id="topstudent-link">
            <i class="fa-solid fa-graduation-cap"></i><span>Top Students</span>
        </a> 
        <a href="/teacher/attendance" class="nav-link {{ Request::is('teacher/attendance') ? 'active' : '' }}" id="attendance-link">
            <i class="fa-solid fa-user-clock"></i><span>Attendance</span>
        </a>
        <a href="/teacher/course" class="nav-link {{ Request::is('teacher/course') ? 'active' : '' }}" id="course-link">
            <i class="fa-solid fa-book-open-reader"></i><span>Course</span>
        </a>
        <a href="/teacher/scheldule" class="nav-link {{ Request::is('teacher/scheldule') ? 'active' : '' }}"
            id="scheldule-link">
            <i class="fa-solid fa-calendar-days"></i><span>Schedule</span>
        </a>
        <a href="/teacher/document" class="nav-link {{ Request::is('teacher/document') ? 'active' : '' }}"
            id="document-link">
            <i class="fa-solid fa-calendar-days"></i><span>Document</span>
        </a>
        <form action="{{ route('teacher.logout') }}" method="POST">
            @csrf
            <button class="nav-link" id="logout-link">
                <i class="fa-solid fa-right-from-bracket"></i><span>Logout</span>
            </button>
        </form>
    </div>


    <!-- main content -->
    @yield('mainContent')

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>