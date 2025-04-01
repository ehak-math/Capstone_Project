@extends('layout.navbar_student')
@section('title', 'Submit Attendance')
@section('mainContent')

<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($attendanceSub && $attendanceSub->count() > 0)
        @foreach($attendanceSub as $attsub)
            @if($attsub->att_id && $attsub->att_status === 'Open')
                <div class="card mb-4 attendance-card">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-book me-2"></i>Course: {{$attsub->cou_name ?? $attsub->cou_id}}
                        </h5>
                        <span class="badge bg-light text-primary">
                            <i class="fas fa-clock me-1"></i>Open
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Time Window:</strong> 
                            @if($attsub->att_startime && $attsub->att_endtime)
                            {{ Carbon\Carbon::parse($attsub->att_startime)->format('H:i') }} - 
                            {{ Carbon\Carbon::parse($attsub->att_endtime)->format('H:i') }}
                        @else
                            <span class="text-warning">Time not set</span>
                        @endif
                    </div>
                        
                        @if(!$attsub->already_submitted)
                            <form action="{{ route('student.course.submit') }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                <div class="mb-4">
                                    <label for="code_sub" class="form-label">
                                        <i class="fas fa-key me-2"></i>Attendance Code
                                    </label>
                                    <div class="input-group">
                                        <input type="text" 
                                            class="form-control form-control-lg @error('code_sub') is-invalid @enderror" 
                                            name="code_sub" 
                                            id="code_sub" 
                                            required 
                                            autocomplete="off"
                                            pattern="[A-Za-z0-9]+"
                                            maxlength="6"
                                            placeholder="Enter 6-digit code">
                                        @error('code_sub')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="text-muted">Enter the code provided by your instructor</small>
                                </div>

                                <input type="hidden" name="cou_id" value="{{$attsub->cou_id}}" required>
                                <input type="hidden" name="att_id" value="{{$attsub->att_id}}" required>
                                <input type="hidden" name="att_start" value="{{$attsub->att_startime}}" required>
                                <input type="hidden" name="att_end" value="{{$attsub->att_endtime}}" required>

                                <button type="submit" class="btn btn-primary btn-lg w-100" 
                                        onclick="return confirm('Are you sure you want to submit attendance?')">
                                    <i class="fas fa-check-circle me-2"></i>Submit Attendance
                                </button>
                            </form>
                        @else
                            <div class="alert alert-success mb-0">
                                <i class="fas fa-check-circle me-2"></i>
                                <strong>Attendance Already Submitted</strong>
                                <p class="mb-0 mt-2">You have already submitted attendance for this session.</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    @else
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                <h4>No Active Attendance Sessions</h4>
                <p class="text-muted mb-0">There are no open attendance sessions at this time.</p>
            </div>
        </div>
    @endif
</div>

<style>
.attendance-card {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border: none;
    transition: transform 0.2s;
}
.attendance-card:hover {
    transform: translateY(-2px);
}
.form-control-lg {
    font-size: 1.1rem;
    letter-spacing: 2px;
}
.btn-lg {
    padding: 1rem 2rem;
}
.alert {
    border-left: 4px solid;
}
.alert-info {
    border-left-color: #0dcaf0;
}
.alert-success {
    border-left-color: #198754;
}
.alert-danger {
    border-left-color: #dc3545;
}
.card-header {
    border-bottom: none;
}
.badge {
    font-size: 0.9rem;
    padding: 0.5em 1em;
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-dismiss alerts after 5 seconds
    setTimeout(function() {
        document.querySelectorAll('.alert-dismissible').forEach(function(alert) {
            new bootstrap.Alert(alert).close();
        });
    }, 5000);

    // Format code input
    const codeInput = document.getElementById('code_sub');
    if (codeInput) {
        codeInput.addEventListener('input', function(e) {
            this.value = this.value.toUpperCase();
            this.value = this.value.replace(/[^A-Z0-9]/g, '');
        });
    }
});
</script>
@endpush

@endsection