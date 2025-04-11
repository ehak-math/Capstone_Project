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
                                <div class="attendance-status-card p-4 bg-white rounded-3 shadow-sm">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 text-center border-end">
                                            <div class="mb-2">
                                                <i class="fas fa-calendar-check text-primary fs-3"></i>
                                            </div>
                                            <h6 class="text-muted mb-1">Schedule ID</h6>
                                            <p class="h5 mb-0">{{$getatt->sch_id}}</p>
                                        </div>
                                        <div class="col-md-4 text-center border-end">
                                            <div class="mb-2">
                                                <i class="fas fa-key text-warning fs-3"></i>
                                            </div>
                                            <h6 class="text-muted mb-1">Attendance Code</h6>
                                            <p class="h5 mb-0">{{$getatt->att_code}}</p>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <div class="mb-2">
                                                <i class="fas fa-door-{{$getatt->att_status == 'Open' ? 'open text-success' : 'closed text-danger'}} fs-3"></i>
                                            </div>
                                            <h6 class="text-muted mb-1">Status</h6>
                                            <span class="badge {{$getatt->att_status == 'Open' ? 'bg-success' : 'bg-danger'}} px-3 py-2">
                                                {{$getatt->att_status}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
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
                                    <p>List of all Students </p>

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
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
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

.attendance-status-card {
    transition: all 0.3s ease;
    border: 1px solid rgba(0,0,0,0.05);
}

.attendance-status-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
}

.attendance-status-card .border-end {
    border-color: rgba(0,0,0,0.05) !important;
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
