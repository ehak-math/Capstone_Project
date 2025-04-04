@extends('layout.navbar_teacher')
@section('title', 'Attendance')
@section('mainContent')






    @php
        $carbon = app('Carbon\Carbon');
        $currentDay = strtolower(now('Asia/Phnom_Penh')->format('l'));
        // $currentDay = "friday";
        $currentTime = now('Asia/Phnom_Penh');
        $currentdmy = Carbon::today('Asia/Phnom_Penh')->format('Y-m-d');

        
        // Parse schedule times
        // $scheduleStart = $carbon::parse($att_dis_item->sch_start_time)->timezone('Asia/Phnom_Penh');
        // $scheduleEnd = $carbon::parse($att_dis_item->sch_end_time)->timezone('Asia/Phnom_Penh');
        // // Check if current time is within schedule window
        // $isTimeValid = $currentTime->greaterThanOrEqualTo($scheduleStart) && 
        //               $currentTime->lessThanOrEqualTo($scheduleEnd);
    @endphp

<div class="content">
    <div class="row">
        <!-- Main content area -->
        <div class="col-lg-8 col-md-12">
            <div class="row g-2 mt-5">
                <h1 class="mt-5 mx-2">Courses: {{$course->cou_id}}</h1>
                @if($att_dis->count() > 0)
                    @foreach($att_dis as $att)
                    <div class="card">
                       @php
                        $scheduleStart = \Carbon\Carbon::parse($att->sch_start_time);
                        $scheduleEnd = \Carbon\Carbon::parse($att->sch_end_time);
                        $isTimeValid = $currentTime->between($scheduleStart, $scheduleEnd);
                       @endphp
                        <h1>{{$att->sch_id}}</h1>
                        
                    </div>
                    @if($att->sch_day == $currentDay && $isTimeValid  )
                            {{-- @if($att->sch_id == $getatt->att_sch_id) --}}
                                <div class="text-center">
                                <form action="{{ route('teacher.attendance.open') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="sch_id" value="{{ $att->sch_id}}">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-door-open me-2"></i>Open Attendance
                                    </button>
                                </form>
                            </div>
                            <div class="text-center">
                                <form id="closeAttendanceForm" action="{{ route('teacher.attendance.close') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="att_sch_id" value="{{$att->sch_id}}">
                                    <input type="hidden" name="att_day" value="{{$currentdmy}}">
                                    <input type="hidden" name="att_time" value="{{$att->scheduleEnd}}">
                                    <input type="hidden" name="auto_close" value="false">
                                    <button type="submit" class="btn btn-danger btn-lg" >
                                        <i class="fas fa-door-closed me-2"></i>Close Attendance
                                    </button>
                                </form>
                            </div>
                    @else
                    <div>
                        <p>{{$att->sch_day}} at time {{$att->sch_start_time}}to{{$att->sch_end_time}}</p>
                        <p>{{$currentDay}}</p>
                    </div>
                    @endif

                    @endforeach
                @endif
        </div>
    </div>

                                {{-- <h5>{{$getatt->att_code}}</h5>
                                <p>{{$getatt->att_id}}||{{$getatt->att_startime}}||{{$getatt->att_endtime}}||{{$getatt->att_date}}||{{$getatt->att_status}}</p> --}}
                                
</div>
</div>

@endsection










{{-- 
    <div class="content">
        <div class="row">

            <div class="col-lg-8 col-md-12">
                <div id="countdown" class="countdown"></div>
                @foreach($att_dis as $att_dis_item)
                @php
                    $carbon = app('Carbon\Carbon');
                    $currentDay = strtolower(now('Asia/Phnom_Penh')->format('l'));
                    // $currentDay = "friday";
                
                    $currentTime = now('Asia/Phnom_Penh');
                    // Parse schedule times
                    $scheduleStart = $carbon::parse($att_dis_item->sch_start_time)->timezone('Asia/Phnom_Penh');
                    $scheduleEnd = $carbon::parse($att_dis_item->sch_end_time)->timezone('Asia/Phnom_Penh');
                    
                    // Check if current time is within schedule window
                    $isTimeValid = $currentTime->greaterThanOrEqualTo($scheduleStart) && 
                                  $currentTime->lessThanOrEqualTo($scheduleEnd);
                @endphp
                <div class="card">
                    <div class="card-header">
                        <h3>Course: {{ $att_dis_item->sub_name ?? 'N/A' }} ({{$att_dis_item->cou_id}})</h3>
                        <p>Current Day: {{$currentDay}}</p>
                    </div>
                    <div class="card-body">
                        @if($att_dis_item)
                            <div class="schedule-info mb-4">
                                <p><strong>Schedule:</strong> {{ $scheduleStart->format('H:i') }} - {{ $scheduleEnd->format('H:i') }}</p>
                                <p><strong>Day:</strong> {{ $att_dis_item->sch_day }}</p>
                                <p><strong>Teacher:</strong> {{ $att_dis_item->tea_fname }}</p>
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
                            @if(trim($att_dis_item->sch_day) === trim($currentDay) && $isTimeValid)
                            @if(isset($attendance))
                                @if($attendance->sch_start_time < $currentTime)
                                <div class="alert {{ $attendance->att_status === 'Open' ? 'alert-info' : 'alert-secondary' }}">
                                    <h4>Attendance Session</h4>
                                    <p><strong>Id:</strong> {{ $attendance->att_id }}</p>
                                    <p><strong>Code:</strong> {{ $attendance->att_code }}</p>
                                    <p><strong>Start Time:</strong> {{ $carbon::parse($attendance->att_startime)->format('H:i') }}</p>
                                    <p><strong>End Time:</strong> {{ $carbon::parse($attendance->att_endtime)->format('H:i') }}</p>
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
                                @endif
                                
                            @else
                            <div class="text-center">
                                <form action="{{ route('teacher.attendance.open') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $att_dis_item->cou_id }}">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-door-open me-2"></i>Open Attendance
                                    </button>
                                </form>
                            </div>

                            @endif
                            @if(trim($att_dis_item->sch_day) === trim($currentDay) && $isTimeValid)
                            <div class="text-center">
                                <form action="{{ route('teacher.attendance.open') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="random" value="{{ $code }}">
                                    <input type="hidden" name="course_id" value="{{ $att_dis_item->cou_id }}">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-door-open me-2"></i>Open Attendance
                                    </button>
                                </form>
                            </div>

                            @else
                                <div class="alert alert-warning">
                                    <i class="fas fa-clock me-2"></i>
                                    @if($att_dis_item->sch_day !== $currentDay)
                                        Attendance can only be opened on {{ $att_dis_item->sch_day }}.
                                    @else
                                        Class time is from{{$att_dis_item->sch_day}} {{ $scheduleStart->format('H:i') }} to {{ $scheduleEnd->format('H:i') }}.
                                        <br>Current time is: {{ $currentTime->format('H:i') }}
                                    @endif
                                </div>
                                @endif 

                            
                            @elseif(trim($att_dis_item->sch_day) === trim($currentDay) && $isTimeValid)
                                 <div class="text-center">
                                <form action="{{ route('teacher.attendance.open') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $att_dis_item->cou_id }}">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-door-open me-2"></i>Open Attendance
                                    </button>
                                </form>
                            </div>
                            @else
                                <div class="alert alert-warning">
                                    <i class="fas fa-clock me-2"></i>
                                    @if($att_dis_item->sch_day !== $currentDay)
                                        Attendance can only be opened on {{ $att_dis_item->sch_day }}.
                                    @else
                                        Class time is from {{ $scheduleStart->format('H:i') }} to {{ $scheduleEnd->format('H:i') }}.
                                        <br>Current time is: {{ $currentTime->format('H:i') }}
                                    @endif
                                </div>
                        @endif
                       
                    </div>     
                </div>
                @endforeach
            @if(isset($attendance->att_status))
                @if($attendance->att_endtime > $currentTime)
                <div class="alert {{ $attendance->att_status === 'Open' ? 'alert-info' : 'alert-secondary' }}">
                    <h4>Attendance Session</h4>
                    <p><strong>Id:</strong> {{ $attendance->att_id }}</p>
                    <p><strong>Id:</strong> {{ $attendance->sch_start_time }}-{{$attendance->sch_end_time}}||{{$attendance->sch_day}}</p>
                    <p><strong>Code:</strong> {{ $attendance->att_code }}</p>
                    <p><strong>Start Time:</strong> {{ $carbon::parse($attendance->att_startime)->format('H:i') }}</p>
                    <p><strong>End Time:</strong> {{ $carbon::parse($attendance->att_endtime)->format('H:i') }}</p>
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
            @endif
            @else
            <p>no att</p>
            @endif
        </div>
    </div>

@if($selectStudentSubmit->count() > 0)
 
        @foreach($selectStudentSubmit as $history)
            <div class="alert alert-info mb-3">


                <strong>Course:</strong> {{$history->att_sub_id}}<br>
                <strong>Status:</strong> {{$history->att_sub_status }}<br>
                
            </div>
        @endforeach
   
@else
<p>You need to create </p>
@endif --}}
{{-- <style>
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
@endpush --}}

