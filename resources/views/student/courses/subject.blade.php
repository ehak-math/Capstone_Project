@extends('layout.navbar_student')
@section('title', 'Subject')
@section('mainContent')
    <!-- Main Content -->
    <div class="content">
        <div class="row">
            <!-- Main content area -->
            <div class="col-lg-12 col-md-12">
                <div class="row g-2 mt-5">
                    <h1 class="mt-5 mx-2">Courses</h1>
                    <!-- Loop through courses for the student -->
                    @foreach($course as $cou)
                        <div class="col-6 col-md-3">
                            <div class="subject">
                                <div class="card" style="z-index: 1;">
                                <img src="{{ asset('images/subject.jpg') }}" class="card-img-top" alt="Mathematics">
                                    <div class="card-body">
                                        <!-- Course Title -->
                                        <h5 class="card-title" style="color: #11117E">Subject: {{ $cou->sub_name }}</h5>
                                        <!-- Course Details -->
                                        <p class="card-text">Teacher: {{ $cou->tea_fname }} <br> Grade: {{ $cou->gra_class }} {{ $cou->gra_group }}</p>

                                        <!-- Buttons for student actions -->
                                        <a href="{{ route('student.course.submit.show', ['id' => $cou->cou_id]) }}"
                                            class="btn btn-success mt-2">Submit Attendance</a>
                                        <a href="{{ route('student.course.document', ['id' => $cou->cou_id]) }}"
                                            class="btn btn-primary mt-2">
                                            View Documents
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection