@extends('layout.navbar_teacher')
@section('title', 'Top Students')
@section('mainContent')
<div class="content">
    <div class="container">
        <div class="row ">
            <div class="col-lg-12 col-md-12 mt-5">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4 mt-5">
                    <h2 class="text-primary mb-0">
                        <i class="fas fa-trophy me-2"></i>Top Students
                    </h2>
                </div>

                <!-- Students Table -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Top</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Subject</th>
                                        <th>Point</th>
                                        <th>Month</th>
                                        <th>Attendance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topStudent as $index => $student)
                                    <tr>
                                        <td>
                                            <span class="text-muted">{{ $index + 1 }}</span>
                                        </td>
                                        <td>{{$student->stu_fname}}</td>
                                        <td>
                                            <span class="badge bg-light text-dark">
                                                {{$student->gra_class}}{{$student->gra_group}}
                                            </span>
                                        </td>
                                        <td>{{$student->sub_name}}</td>
                                        <td>
                                            @if($student->sco_point >= 50)
                                                <span class="badge bg-success score-badge">
                                                    {{ $student->sco_point }}
                                                    <i class="fas fa-check-circle ms-1"></i>
                                                </span>
                                            @elseif($student->sco_point < 50 && $student->sco_point > 0)
                                                <span class="badge bg-warning text-dark score-badge">
                                                    {{ $student->sco_point }}
                                                    <i class="fas fa-exclamation-circle ms-1"></i>
                                                </span>
                                            @else
                                                <span class="badge bg-danger score-badge">
                                                    0
                                                    <i class="fas fa-times-circle ms-1"></i>
                                                </span>
                                            @endif
                                        </td>
                                            
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                {{$student->sco_month}}
                                            </small>
                                        </td>
                                        <td>
                                            @php
                                                $presentCount = App\Models\AttendanceSubmit::where('att_sub_stu_id', $student->stu_id)
                                                    ->where('att_sub_status', 'Absent')
                                                    ->count();
                                                
                                            @endphp
                                            <span class="badge bg-warning attendance-badge">
                                                {{ $presentCount }}
                                                <i class="fas fa-user-clock ms-1"></i>
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.table {
    margin-bottom: 0;
}

.table th {
    background-color: #f8f9fa;
    font-weight: 600;
    border-top: none;
}

.table td {
    vertical-align: middle;
}

.badge {
    font-weight: 500;
    padding: 0.5em 0.75em;
}

.card {
    border: none;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.fw-medium {
    font-weight: 500;
}

.table td:first-child {
    width: 40px;
    text-align: center;
}

@media (max-width: 768px) {
    .table-responsive {
        border: 0;
    }
    
    .table thead {
        display: none;
    }
    
    .table tr {
        margin-bottom: 1rem;
        display: block;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
    }
    
    .table td {
        display: block;
        text-align: right;
        border: none;
        position: relative;
        padding-left: 50%;
    }
    
    .table td::before {
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 50%;
        padding-left: 15px;
        font-weight: 600;
        text-align: left;
    }

    .table td:first-child {
        text-align: right;
        width: auto;
    }
    
    .table td:first-child::before {
        content: "#";
    }
}

.attendance-badge {
    font-size: 1.1rem;
    padding: 0.5rem 1rem;
    font-weight: 500;
    border-radius: 8px;
}

.attendance-badge i {
    font-size: 1rem;
}

@media (max-width: 768px) {
    .attendance-badge {
        font-size: 1rem;
        padding: 0.4rem 0.8rem;
    }
}

.score-badge {
    font-size: 1.1rem;
    padding: 0.5rem 1rem;
    font-weight: 500;
    border-radius: 8px;
}

.score-badge i {
    font-size: 1rem;
}

@media (max-width: 768px) {
    .score-badge {
        font-size: 1rem;
        padding: 0.4rem 0.8rem;
    }
}
</style>
@endsection