@extends('layout.navbar_teacher')
@section('title', 'Attendance')
@section('mainContent')

@php
    use Carbon\Carbon;
    $currentDay = now()->format('l');
    $currentTime = now();
@endphp

<div class="content">
    <div class="row">
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Course:{{$att_dis->cou_id}} {{ $att_dis->sub_name ?? 'N/A' }}</h3>
                </div>
                <div class="card-body">
                    @if($att_dis)
                        <div class="schedule-info mb-4">
                            <p><strong>Schedule:</strong> {{ Carbon::parse($att_dis->sch_start_time)->format('H:i') }} - 
                               {{ Carbon::parse($att_dis->sch_end_time)->format('H:i') }}</p>
                            <p><strong>Day:</strong> {{ $att_dis->sch_day }}</p>
                            <p><strong>Teacher:</strong> {{ $att_dis->tea_fname }}</p>
                        </div>

                        @if($attendance)
                            <div class="alert alert-info">
                                <h4>Active Attendance Session</h4>
                                <p><strong>Code:</strong> {{ $attendance->att_code }}</p>
                                <p><strong>Start Time:</strong> {{ Carbon::parse($attendance->att_startime)->format('H:i') }}</p>
                                <p><strong>End Time:</strong> {{ Carbon::parse($attendance->att_endtime)->format('H:i') }}</p>
                                <p><strong>Status:</strong> {{ $attendance->att_status }}</p>
                            </div>
                        @else
                            @if($att_dis->sch_day === $currentDay)
                                <div class="text-center">
                                    <form action="{{ route('teacher.attendance.open') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="course_id" value="{{ $course->cou_id }}">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fas fa-door-open me-2"></i>Open Attendance
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    <i class="fas fa-clock me-2"></i>
                                    Attendance can only be opened on {{ $att_dis->sch_day }}.
                                </div>
                            @endif
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin-top: 20px;
}
.btn-lg {
    padding: 15px 30px;
    font-size: 1.2rem;
}
.schedule-info p {
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}
</style>
@endsection