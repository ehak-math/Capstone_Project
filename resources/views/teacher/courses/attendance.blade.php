@extends('layout.navbar_teacher')
@section('title', 'Attendance')
@section('mainContent')

@php
    use Carbon\Carbon;
    $currentDay = now('Asia/Phnom_Penh')->format('l');
    $currentTime = now('Asia/Phnom_Penh');
    
    // Parse schedule times
    $scheduleStart = Carbon::parse($att_dis->sch_start_time)->timezone('Asia/Phnom_Penh');
    $scheduleEnd = Carbon::parse($att_dis->sch_end_time)->timezone('Asia/Phnom_Penh');
    
    // Check if current time is within schedule window
    $isTimeValid = $currentTime->greaterThanOrEqualTo($scheduleStart) && 
                  $currentTime->lessThanOrEqualTo($scheduleEnd);
@endphp

<div class="content">
    <div class="row">
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Course: {{ $att_dis->sub_name ?? 'N/A' }} ({{$att_dis->cou_id}})</h3>
                    <p>Current Day: {{$currentDay}}</p>
                </div>
                <div class="card-body">
                    @if($att_dis)
                        <div class="schedule-info mb-4">
                            <p><strong>Schedule:</strong> {{ $scheduleStart->format('H:i') }} - {{ $scheduleEnd->format('H:i') }}</p>
                            <p><strong>Day:</strong> {{ $att_dis->sch_day }}</p>
                            <p><strong>Teacher:</strong> {{ $att_dis->tea_fname }}</p>
                            <div id="countdown" class="countdown"></div>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if($attendance)
                            <div class="alert {{ $attendance->att_status === 'Open' ? 'alert-info' : 'alert-secondary' }}">
                                <h4>Attendance Session</h4>
                                <p><strong>Code:</strong> {{ $attendance->att_code }}</p>
                                <p><strong>Start Time:</strong> {{ Carbon::parse($attendance->att_startime)->format('H:i') }}</p>
                                <p><strong>End Time:</strong> {{ Carbon::parse($attendance->att_endtime)->format('H:i') }}</p>
                                <p><strong>Status:</strong> 
                                    <span class="badge {{ $attendance->att_status === 'Open' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $attendance->att_status }}
                                    </span>
                                </p>
                                
                                @if($attendance->att_status === 'Open')
                                    <div class="mt-3">
                                        <form id="closeAttendanceForm" action="{{ route('teacher.attendance.close') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="attendance_id" value="{{ $attendance->att_id }}">
                                            <input type="hidden" name="auto_close" value="false">
                                            <button type="submit" class="btn btn-danger btn-lg" 
                                                onclick="return confirm('Are you sure you want to close this attendance?')">
                                                <i class="fas fa-door-closed me-2"></i>Close Attendance
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @elseif(trim($att_dis->sch_day) === trim($currentDay) && $isTimeValid)
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
                                @if($att_dis->sch_day !== $currentDay)
                                    Attendance can only be opened on {{ $att_dis->sch_day }}.
                                @else
                                    Class time is from {{ $scheduleStart->format('H:i') }} to {{ $scheduleEnd->format('H:i') }}.
                                    <br>Current time is: {{ $currentTime->format('H:i') }}
                                @endif
                            </div>
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
.badge {
    font-size: 0.9rem;
    padding: 0.5em 0.8em;
}
.countdown {
    font-size: 1.2rem;
    font-weight: bold;
    color: #dc3545;
    margin-top: 10px;
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    @if($attendance && $attendance->att_status === 'Open')
        const endTime = new Date('{{ $attendance->att_endtime }}').getTime();
        
        function updateCountdown() {
            const now = new Date().getTime();
            const distance = endTime - now;
            
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            document.getElementById('countdown').innerHTML = 
                `Time remaining: ${minutes}m ${seconds}s`;
            
            if (distance < 0) {
                clearInterval(x);
                document.getElementById('countdown').innerHTML = "EXPIRED";
                
                // Auto close attendance
                const form = document.getElementById('closeAttendanceForm');
                if (form) {
                    document.querySelector('input[name="auto_close"]').value = 'true';
                    form.submit();
                }
            }
        }
        
        // Update countdown every second
        const x = setInterval(updateCountdown, 1000);
        updateCountdown();
    @endif
});
</script>
@endpush

@endsection