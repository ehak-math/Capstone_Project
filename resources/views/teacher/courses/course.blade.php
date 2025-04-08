@extends('layout.navbar_teacher')
@section('title', 'Course')
@section('mainContent')

    <div class="content">
        <div class="row">
            <!-- Main content area -->
            <div class="col-lg-8 col-md-12">
                <div class="row g-2 mt-5">
                    <h1 class="mt-5 mx-2">Courses</h1>
                    @foreach($Teacher as $teacher)
                        <!-- Course Card -->
                        <div class="col-6 col-md-6">
                            <div class="subject">
                                <div class="card" style="z-index: 1;">
                                    <!-- Course Image -->
                                    <img src="{{ asset('images/subject.jpg') }}" class="card-img-top"
                                        alt="{{ $teacher->sub_name }}">

                                    <div class="card-body">
                                        <!-- Grade and Teacher Information -->
                                        <h5 class="card-title">{{$teacher->sub_name}}</h5>
                                        <p class="card-text">Teacher: {{$teacher->tea_fname}} 
                                        </br> Grade: {{$teacher->gra_class}} {{$teacher->gra_group}} 
                                        </p>
                                        <p class="card-text"></p>

                                        <!-- Action Buttons -->
                                        <div class="d-flex justify-content-between">
                                            <!-- Open Attendance Button -->
                                            <a href="{{ route('teacher.attendance.show', ['id' => $teacher->cou_id]) }}"
                                                class="btn btn-primary">Open Attendance</a>

                                            <!-- Upload Scores Button -->
                                            <a href="{{ route('teacher.score.show', ['id' => $teacher->cou_id]) }}"
                                                class="btn btn-secondary">Upload Scores</a>
                                        </div>
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