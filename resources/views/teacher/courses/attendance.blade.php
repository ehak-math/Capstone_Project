@extends('layout.navbar_teacher')
@section('title', 'Attendance')
@section('mainContent')

    @php
        $carbon = app('Carbon\Carbon');
        $currentDay = strtolower(now('Asia/Phnom_Penh')->format('l'));
        $currentTime = now('Asia/Phnom_Penh');
        $currentdmy = $carbon::today('Asia/Phnom_Penh')->format('Y-m-d');
    @endphp

    <div class="content">
        <div class="row">
            <!-- Main content area -->
            <div class="col-lg-12 col-md-12">
                <div class="row g-2 mt-2">
                    <div class="date_name">
                        <h3>Greatings, {{ $teacher->tea_fname }}!</h3>
                        <p id="currentDate"></p>
                    </div>
                    <div class="info-coures rounded mt-2">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center gap-4">
                                <a href="{{ route('teacher.course') }}" class="btn btn-primary"><i
                                        class="fa-solid fa-arrow-left"></i></a>
                                <h3>Attandance</h3>
                            </div>
                        </div>
                        <hr>
                        @if($att_dis->count() > 0)
                                        @foreach($att_dis as $att)
                                                        <div class="card shadow-sm mb-4">
                                                            <div class="card-header bg-primary text-white">
                                                                <h5 class="mb-0">
                                                                    <i class="fas fa-calendar-alt me-2"></i>
                                                                    Course:
                                                                    @if($course->teacher)
                                                                        {{$course->sub_name}}
                                                                    @else
                                                                        No subject available
                                                                    @endif
                                                                </h5>
                                                            </div>
                                                            <div class="card-body">
                                                                @php
                                                                    $scheduleStart = \Carbon\Carbon::parse($att->sch_start_time);
                                                                    $scheduleEnd = \Carbon\Carbon::parse($att->sch_end_time);
                                                                    $isTimeValid = $currentTime->between($scheduleStart, $scheduleEnd);
                                                                @endphp
                                                                <p><strong>Day:</strong> {{$att->sch_day}}</p>
                                                                <p><strong>Time:</strong> {{$att->sch_start_time}} to {{$att->sch_end_time}}</p>
                                                                <p><strong>Current Day:</strong> {{$currentDay}}</p>

                                                                @if($att->sch_day == $currentDay && $isTimeValid)
                                                                    @if(!isset($getatt))
                                                                        <div class="text-center">
                                                                            <form action="{{ route('teacher.attendance.open') }}" method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="sch_id" value="{{ $att->sch_id }}">
                                                                                <input type="hidden" name="course_id" value="{{ $course->cou_id }}">
                                                                                <button type="submit" class="btn btn-success btn-lg w-100">
                                                                                    <i class="fas fa-door-open me-2"></i>Open Attendance
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    @elseif($getatt->att_status == 'Open')
                                                                        <div class="alert alert-info text-center">
                                                                            <p><strong>Attendance Code:</strong> {{$getatt->att_code}}</p>
                                                                            <p><strong>Status:</strong> <span
                                                                                    class="badge bg-success">{{$getatt->att_status}}</span>
                                                                            </p>
                                                                        </div>
                                                                        <div class="text-center">
                                                                            <form id="closeAttendanceForm" action="{{ route('teacher.attendance.close') }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="att_sch_id" value="{{$att->sch_id}}">
                                                                                <input type="hidden" name="attendance_id" value="{{$getatt->att_id}}">
                                                                                <input type="hidden" name="auto_close" value="false">
                                                                                <button type="submit" class="btn btn-danger btn-lg w-100">
                                                                                    <i class="fas fa-door-closed me-2"></i>Close Attendance
                                                                                </button>
                                                                            </form>

                                                                        </div>

                                                                        @if($selectAttSub->contains('sch_id', $att->sch_id))
                                                                            <div class="text-center">
                                                                                @foreach($selectAttSub as $stuSub)
                                                                                    <div class="alert alert-info mt-2">
                                                                                        <p><strong>Student ID:</strong> {{$stuSub->stu_id}}</p>
                                                                                        <p><strong>Status:</strong> <span
                                                                                                class="badge bg-success">{{$stuSub->att_sub_status}}</span></p>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        @endif
                                                                    @else
                                                                        <div class="alert alert-warning text-center">
                                                                            <p><strong>Attendance Code:</strong> {{$getatt->att_code}}</p>
                                                                            <p><strong>Status:</strong> <span
                                                                                    class="badge bg-warning">{{$getatt->att_status}}</span>
                                                                            </p>
                                                                        </div>
                                                                        @if($selectAttSub->contains('sch_id', $att->sch_id))
                                                                            <div class="text-center">
                                                                                @foreach($selectAttSub as $stuSub)
                                                                                    <div class="alert alert-info mt-2">
                                                                                        <p><strong>Student ID:</strong> {{$stuSub->stu_id}}</p>
                                                                                        <p><strong>Status:</strong> <span
                                                                                                class="badge bg-success">{{$stuSub->att_sub_status}}</span></p>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    <div class="alert alert-secondary text-center">
                                                                        <i class="fas fa-clock me-2"></i>
                                                                        Attendance can only be opened on <strong>{{$att->sch_day}}</strong> between
                                                                        <strong>{{$att->sch_start_time}}</strong> and <strong>{{$att->sch_end_time}}</strong>.
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                        @endforeach
                        @else
                            <div class="alert alert-danger text-center">
                                <i class="fas fa-exclamation-circle me-2"></i>No schedules available for this course.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .alert {
            margin-top: 10px;
            border-left: 5px solid;
        }

        .alert-info {
            border-left-color: #0dcaf0;
        }

        .alert-warning {
            border-left-color: #ffc107;
        }

        .alert-danger {
            border-left-color: #dc3545;
        }

        .btn-lg {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
        }
    </style>
@endsection