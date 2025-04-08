@extends('layout.navbar_admin')
@section('title', 'Dashboard')
@section('mainContent')
    <!-- Main Content -->
    <div class="content">
        <div class="row">
            <!-- Main content area -->
            <div class="col-lg-8 col-md-12">
                <div class="date_name">
                    <h3>Greatings, {{ Auth::user()->name }}!</h3>
                    <p id="currentDate"></p>
                </div>

                <div class="row g-4 mt-2">
                    <div class="col-md-6">
                        <div class="overview-box1 d-flex">
                            <canvas id="teacherChart"></canvas>
                            <div class="total-teach-stu">
                                <h4>Teachers</h4>
                                <div class="lh-1">
                                    <p style="font-size: 12px"><span class="color-icon-female"><i
                                                class="fa-solid fa-droplet"></i></span>Female({{ $femaleTeachers }})</p>
                                    <p style="font-size: 12px"><span class="color-icon-male"><i
                                                class="fa-solid fa-droplet"></i></span>Male({{ $maleTeachers }})</p>
                                </div>
                                <h2>{{ $totalTeachers }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="overview-box2 d-flex">
                            <canvas id="studentChart"></canvas>
                            <div class="total-teach-stu">
                                <h4>Students</h4>
                                <div class="lh-1">
                                    <p style="font-size: 12px"><span class="color-icon-female"><i
                                                class="fa-solid fa-droplet"></i></span>Female({{ $femaleStudents }})</p>
                                    <p style="font-size: 12px"><span class="color-icon-male"><i
                                                class="fa-solid fa-droplet"></i></span>Male({{ $maleStudents }})</p>
                                </div>
                                <h2>{{ $totalStudents }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-4 mt-2">
                    <h4>List of user</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Profile</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Phone Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teachers as $teacher)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($teacher->tea_profile && file_exists(public_path('storage/' . $teacher->tea_profile)))
                                                <img class="profile_teacher" src="{{ asset('storage/' . $teacher->tea_profile) }}"
                                                    alt="Teacher Profile">
                                            @else
                                                <img class="profile_teacher" src="{{ asset('images/placeholder_teacher.jpg') }}"
                                                    alt="Placeholder Image">
                                            @endif
                                        </td>
                                        <td>{{ $teacher->tea_fname }}</td>
                                        <td>{{ $teacher->tea_gender }}</td>
                                        <td>{{ $teacher->tea_ph_number }}</td>
                                    </tr>
                                @endforeach
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($student->stu_profile && file_exists(public_path('storage/' . $student->stu_profile)))
                                                <img class="profile_stu" src="{{ asset('storage/' . $student->stu_profile) }}"
                                                    alt="Student Profile">
                                            @else
                                                <img class="profile_stu" src="{{ asset('images/placeholder_student.jpg') }}"
                                                    alt="Placeholder Image">
                                            @endif
                                        </td>
                                        <td>{{ $student->stu_fname }}</td>
                                        <td>{{ $student->stu_gender }}</td>
                                        <td>{{ $student->stu_ph_number }}</td>
                                    </tr>
                                @endforeach

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
            </div>
        </div>
@endsection
    <script>
        const teacherGenderData = @json($teacherGender);
        const studentGenderData = @json($studentGender);
    </script>