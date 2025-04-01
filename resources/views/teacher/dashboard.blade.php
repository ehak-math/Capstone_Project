@extends('layout.navbar_teacher')
@section('title', 'Dashboard')
@section('mainContent')
    <!-- Main Content -->
    <div class="content">
        <div class="row">
            <!-- Main content area -->
            <div class="col-lg-8 col-md-12">
                <div class="date_name">
                    <h3>Greatings, Bro!</h3>
                    <p >Welcome,{{$Teacher->tea_fname}}
                    </p>
                    <p >You is grade,
                    </p>
                </div>
                <div class="row g-4 mt-2">
                    <div class="col-md-6">
                        <div class="overview-box1 d-flex">
                            <canvas id="myChart"></canvas>
                            <div class="total-teach-stu">
                                <h4>Attendance</h4>
                                <div class="lh-1">
                                    <p style="font-size: 10px"><span class="color-icon-female"><i class="fa-solid fa-droplet"></i></span>Absent(60%)</p>
                                    <p style="font-size: 10px"><span class="color-icon-male"><i class="fa-solid fa-droplet"></i></span>Present(40%)</p>
                                </div>
                                <h2>108</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="overview-box2 d-flex">
                            <canvas id="myChart1"></canvas>
                            <div class="total-teach-stu">
                                <h4>Students</h4>
                                <div class="lh-1">
                                    <p style="font-size: 10px"><span class="color-icon-female"><i class="fa-solid fa-droplet"></i></span>Female(60%)</p>
                                    <p style="font-size: 10px"><span class="color-icon-male"><i class="fa-solid fa-droplet"></i></span>Male(40%)</p>
                                </div>
                                <h2>308</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-4 mt-2">
                    <div class="col-md-6">
                        <div class="overview-box3 p-3">
                            <div class="attendance-summary mb-4 d-flex justify-content-between align-items-center">
                                <h4>Attendance Summary</h4>
                                <div class="d-flex">
                                    <!-- Date Range Dropdown -->
                                    <div class="dropdown me-2">
                                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dateDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            Today
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dateDropdown">
                                            <li><a class="dropdown-item" href="#" onclick="updateAttendanceChart('today')">Today</a></li>
                                            <li><a class="dropdown-item" href="#" onclick="updateAttendanceChart('weekly')">Weekly</a></li>
                                        </ul>
                                    </div>
                        
                                    <!-- Category Dropdown -->
                                    <div class="dropdown">
                                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            Students
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                                            <li><a class="dropdown-item" href="#" onclick="updateAttendanceCategory('students')">Students</a></li>
                                            <li><a class="dropdown-item" href="#" onclick="updateAttendanceCategory('teachers')">Teachers</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <canvas id="attendanceChart"></canvas>
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="overview-box4 p-3">
                            <div class="student-selected mb-4 d-flex justify-content-between align-items-center">
                                <h4>Student Selected</h4>
                            </div>
                            <canvas id="departmentChart"></canvas>
                        </div>
                    </div>

                </div>
            </div>
    
            <!-- Schedule section -->
            <div class="col-lg-4 col-md-12 mt-4 mt-lg-5 p-3 scheldule-section">
                <!-- FullCalendar -->
                <div class="calender mt-4 bg-white rounded">
                    <div>
                        <div class="header">
                            <button id="prevBtn">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>
                            <div class="monthYear" id="monthYear"></div>
                            <button id="nextBtn">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                        <div class="days">
                            <div class="day">Sun</div>
                            <div class="day">Mon</div>
                            <div class="day">Tue</div>
                            <div class="day">Wed</div>
                            <div class="day">Thu</div>
                            <div class="day">Fri</div>
                            <div class="day">Sat</div>
                        </div>
                        <div class="dates" id="dates"></div>
                    </div>
                </div>
                <!-- next Event -->
                <div class="next-event mt-4 rounded">
                    <div class="event-today mb-2 d-flex justify-content-between">
                        <h3 style="color: #11117E">Event</h3>
                        <h5 style="color: #11117E" id="currentDate"></h5>
                    </div>
                    <div class="event">
                        <div class="event1 rounded">
                            <div>
                                <h5>7h - 8h</h5>
                                <h5>Math</h5>
                            </div>
                            <div class="lh-1">
                                <p>Event 1 Description</p>
                                <p>12A</p>
                            </div>
                        </div>
                        <div class="event2 rounded">
                            <div>
                                <h5>8h - 9h</h5>
                                <h5>Physical</h5>
                            </div>
                            <div class="lh-1">
                                <p>Event 1 Description</p>
                                <p>12A</p>
                            </div>
                        </div>
                        <div class="event3 rounded">
                            <div>
                                <h5>9h - 10h</h5>
                                <h5>Khmer</h5>
                            </div>
                            <div class="lh-1">
                                <p>Event 1 Description</p>
                                <p>12A</p>
                            </div>
                        </div>

                    </div>
            </div>
        </div>
    </div>
@endsection