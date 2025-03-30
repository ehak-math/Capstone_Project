@extends('layout.navbar_student')
@section('title', 'Courses detail')
@section('mainContent')
    <!-- Main Content -->
    <div class="content">
        <div class="row">
            <!-- Main content area -->
            <div class="col-lg-8 col-md-12 mt-5">
                <div class="course-detail m-2">
                    <div class="course-title mt-5 d-flex align-items-center justify-content-between">
                        <h1 class="">Course Details</h1>
                        <a href="/student/subject">
                            <span class="icon-back"><i class="fa-solid fa-arrow-left"></i></span>
                        </a>
                    </div>

                    <div class="course-detail-content mt-4">
                        <div class="course-detail-image">
                            <img src="{{ asset('images/math.jpg') }}" class="rounded-3" alt="" width="100%" height="300px">
                        </div>
                        <div class="btn-course-detail mt-3">
                            <a href="/student/attendance" class="btn btn-primary">Attendance</a>
                            <a href="/student/scheldule" class="btn btn-info">Lecture</a>
                            <a href="/student/scheldule" class="btn btn-info">Homework</a>
                        </div>

                    

                </div>
            </div>
        </div>
    </div>
@endsection