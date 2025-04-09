@extends('layout.navbar_student')
@section('title', 'Dashboard')
@section('mainContent')
    <!-- Main Content -->
    <div class="content">
        <div class="row">
            <!-- Main content area -->
            <div class="col-lg-8 col-md-12">
                <div class="date_name">
                    <h3>Greatings, {{ $student->stu_fname }}!</h3>
                    <p>Your grade, {{ $student->grade->gra_class }}{{ $student->grade->gra_group }}</p>
                </div>
                <div class="row g-4 mt-2">
                    <div class="col-md-6">
                        <div class="overview-box1 d-flex gap-2">
                            <h2 class="title_over">10</h2>

                            <div class="total-teach-stu">
                                <h4>Students</h4>
                                <div class="lh-1">
                                    <p style="font-size: 15px"><span class="color-female"><i
                                                class="fa-solid fa-user"></i></span>Female(6)</p>
                                    <p style="font-size: 15px"><span class="color-male"><i
                                                class="fa-solid fa-user"></i></span>Male(4)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="overview-box1 d-flex gap-2">
                            <h2 class="title_over">2</h2>

                            <div class="total-teach-stu">
                                <h4>Attendance</h4>
                                <div class="lh-1">
                                    <p style="font-size: 15px"><span class="color-female"><i
                                                class="fa-solid fa-user"></i></span>Absent(0)</p>
                                    <p style="font-size: 15px"><span class="color-male"><i
                                                class="fa-solid fa-user"></i></span>Present(2)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-4 mt-2">
                    <h2>List of Attendance</h2>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
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

                    </div>
                </div>
            </div>
        </div>
@endsection