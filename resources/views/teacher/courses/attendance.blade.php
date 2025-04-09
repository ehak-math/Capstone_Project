@extends('layout.navbar_teacher')
@section('title', 'Attendance')
@section('mainContent')
@php
use App\Models\Attendances;
use App\Models\Attendancesubmit;

$carbon = app('Carbon\Carbon');
$currentDay = strtolower(now('Asia/Phnom_Penh')->format('l'));
// $currentDay = '2025-09-16';
$currentTime = now('Asia/Phnom_Penh');
$currentdmy = $carbon::today('Asia/Phnom_Penh')->format('Y-m-d');


@endphp

<<<<<<< HEAD
<div class="content">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-12">
                <!-- Course Header -->
                <div class="course-header mb-4">
                    <h2 class="text-primary">
                        <i class="fas fa-graduation-cap me-2"></i>
                        Course: {{$course->cou_id}}
                    </h2>
                </div>

                @if($att_dis->count() > 0)
                    @foreach($att_dis as $att)
                    <div class="card attendance-card mb-4">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-calendar-alt text-primary me-2"></i>
                                <h5 class="mb-0">Schedule Time:{{$att->sch_id}}</h5>
                                <span>{{$att->sch_start_time}} - {{$att->sch_end_time}}</span>

                            </div>
                        </div>

                        <div class="card-body">
                            <div class="schedule-info mb-3">
                                <div class="info-item">
                                    <i class="fas fa-clock text-muted me-2"></i>
                                    <span>{{$att->sch_start_time}} - {{$att->sch_end_time}}</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-calendar-day text-muted me-2"></i>
                                    <span>{{ucfirst($att->sch_day)}}</span>
                                </div>
                            </div>
                            @php
                            $scheduleStart = \Carbon\Carbon::parse($att->sch_start_time);
                            $scheduleEnd = \Carbon\Carbon::parse($att->sch_end_time);
                            $isTimeValid = $currentTime->between($scheduleStart, $scheduleEnd);
                            
                            $getatt = Attendances::join('schedules', 'schedules.sch_id', '=', 'attendances.att_sch_id')
                            ->where('schedules.sch_cou_id', $att->sch_cou_id)
                            ->where('schedules.sch_id', $att->sch_id)
                            ->where('att_date', $currentdmy)
                            ->first();
                            
                            @endphp
                            @if($att->sch_day == $currentDay && $isTimeValid )
                                @if($getatt) 
                                <p>{{$getatt->sch_id}}</p>
                                <p>{{$getatt->att_code}}</p>
                                <p>{{$getatt->att_status}}</p>
                                @if($getatt->att_status == 'Open')
                                    <div class="action-buttons mb-4">
                                        <form action="{{ route('teacher.attendance.close') }}" method="POST" id="closeAttendanceForm">
                                            @csrf
                                            <input type="hidden" name="att_sch_id" value="{{$att->sch_id}}">
                                            <input type="hidden" name="attendance_id" value="{{$getatt->att_id}}">
                                            <button type="button" class="btn btn-danger btn-lg w-100 hover-lift" onclick="confirmClose()">
                                                <i class="fas fa-door-closed me-2"></i>Close Attendance
                                            </button>
                                        </form>
                                    </div>
                                @else
                                
                                <div class="student-list">
                                    @php
                                    $selectAttSub = Attendancesubmit::join('students', 'attendance_submit.att_sub_stu_id', '=', 'students.stu_id')
                                        ->join('schedules', 'attendance_submit.att_sub_sch_id', '=', 'schedules.sch_id')
                                        ->where('attendance_submit.att_sub_sch_id', $getatt->sch_id)
                                        ->where('attendance_submit.att_sub_date', $currentdmy)
                                        // ->orderBy('attendance_submit.att_sub_id', 'desc')
                                        // ->select('attendance_submit.*', 'students.*')
                                        ->get();
                                    @endphp
                                    @foreach($selectAttSub as $stuSub)
                                        <div class="student-card">
                                            
                                                @if($stuSub->stu_profile && file_exists(public_path('storage/' . $stuSub->stu_profile)))
                                                    <img class="profile_stu" src="{{ asset('storage/' . $stuSub->stu_profile) }}"
                                                        alt="student Profile">
                                                @else
                                                    <img class="profile_stu" src="{{ asset('images/placeholder_student.jpg') }}"
                                                        alt="Placeholder Image">
                                                @endif
                    
                                            <div class="student-info">
                                                <span class="student-id">{{$stuSub->stu_fname}}</span>
                                                <span class="status-badge {{$stuSub->att_sub_status == 'Present' ? 'bg-success' : 'bg-danger'}}">
                                                    {{$stuSub->att_sub_status}}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @endif
                                @else
                                <div class="action-buttons">
                                    <form action="{{ route('teacher.attendance.open') }}" method="POST" id="openAttendanceForm_{{$att->sch_id}}">
                                        @csrf
                                        <input type="hidden" name="sch_id" value="{{ $att->sch_id }}">
                                        <input type="hidden" name="course_id" value="{{ $course->cou_id }}">
                                        <button type="button" class="btn btn-success btn-lg w-100 hover-lift" onclick="confirmOpen('{{$att->sch_id}}')">
                                            <i class="fas fa-door-open me-2"></i>Open Attendance
                                        </button>
                                    </form>
                                </div>
                                <p>No attendance record found for today.</p>
                                @endif
                                @else
                                <div class="schedule-notice">
                                    <i class="fas fa-info-circle text-muted me-2"></i>
                                    Available on {{ucfirst($att->sch_day)}} ({{$att->sch_start_time}} - {{$att->sch_end_time}})
                                </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="fas fa-calendar-times"></i>
                        <p>No schedules available for this course.</p>
=======
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
>>>>>>> 01fc0b3493fb4a6c3c7a5c5daa5826d336ab8d8b
                    </div>
                </div>
            </div>
        </div>
    </div>

<<<<<<< HEAD
<style>
.attendance-card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    transition: transform 0.2s ease;
}

.attendance-card:hover {
    transform: translateY(-2px);
}

.card-header {
    background: white;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    padding: 1.25rem;
}

.schedule-info {
    display: flex;
    gap: 1.5rem;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
}

.info-item {
    display: flex;
    align-items: center;
}

.code-display {
    background: #e9ecef;
    padding: 1rem;
    border-radius: 8px;
    text-align: center;
}

.code {
    font-size: 1.25rem;
    font-weight: 600;
    color: #0d6efd;
}

.student-list {
    display: grid;
    gap: 0.75rem;
    margin-top: 1rem;
}

.student-card {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 8px;
}

.student-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.hover-lift {
    transition: transform 0.2s ease;
}

.hover-lift:hover {
    transform: translateY(-2px);
}

.empty-state {
    text-align: center;
    padding: 3rem;
    background: #f8f9fa;
    border-radius: 12px;
}

.empty-state i {
    font-size: 3rem;
    color: #dee2e6;
    margin-bottom: 1rem;
}

.schedule-notice {
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
    text-align: center;
    color: #6c757d;
}

.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-weight: 500;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmClose() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to close this attendance session!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, close it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('closeAttendanceForm').submit();
            }
        });
    }

    function confirmOpen(scheduleId) {
        Swal.fire({
            title: 'Open Attendance?',
            text: "You are about to start this attendance session!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, open it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('openAttendanceForm_' + scheduleId).submit();
                Swal.fire({
                    title: 'Opening...',
                    text: 'Starting attendance session',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
    }
</script>
@endsection
=======
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
>>>>>>> 01fc0b3493fb4a6c3c7a5c5daa5826d336ab8d8b
