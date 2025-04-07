@extends('layout.navbar_teacher')
@section('title', 'Schedule')
@section('mainContent')
<div class="content">
    <div class="row justify-content-center">
        <div class="col-lg-11 col-md-12 mt-4">
            <div class="schedule-wrapper">
                <h1 class="schedule-title">My Class Schedule</h1>
                <p>Teacher: {{$teacher->tea_fname}}</p>
                <div class="table-responsive">
                    <table class="schedule-table">
                        <thead>
                            <tr>
                                <th>Day</th>
                                <th>Time</th>
                                <th>Subject</th>
                                <th>Teacher</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedules as $sch)
                                <tr class="schedule-row">
                                    <td data-label="Day">
                                        <div class="day-badge">{{ $sch->sch_day }}</div>
                                    </td>
                                    <td data-label="Time">
                                        <div class="time-slot">
                                            <span class="time start">{{ \Carbon\Carbon::parse($sch->sch_start_time)->format('h:i A') }}</span>
                                            <span class="separator">-</span>
                                            <span class="time end">{{ \Carbon\Carbon::parse($sch->sch_end_time)->format('h:i A') }}</span>
                                        </div>
                                    </td>
                                    <td data-label="Subject">
                                        <div class="subject-info">
                                            <span class="subject-name">{{ $sch->sub_name }}</span>
                                        </div>
                                    </td>
                                    <td data-label="Teacher">
                                        <div class="teacher-info">
                                            <span class="teacher-name">{{ $sch->tea_fname }}</span>
                                        </div>
                                    </td>

                                    <td data-label="Grade">
                                        <div class="grade-info">
                                            {{ $sch->gra_class }} | {{ $sch->gra_group }}
                                        </div>
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

<style>
.schedule-wrapper {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 25px;
    margin: 20px;
}

.schedule-title {
    font-size: 1.8rem;
    color: #2c3e50;
    text-align: center;
    margin-bottom: 30px;
    font-weight: 600;
}

.schedule-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 12px;
    margin-bottom: 20px;
}

.schedule-table thead th {
    background-color: #f8f9fa;
    color: #2c3e50;
    font-weight: 600;
    padding: 15px;
    text-align: left;
    border-bottom: 2px solid #e9ecef;
}

.schedule-row {
    transition: transform 0.2s ease;
    background: white;
}

.schedule-row:hover {
    transform: translateY(-2px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.schedule-table td {
    padding: 15px;
    border-top: 1px solid #e9ecef;
    vertical-align: middle;
}

.day-badge {
    background-color: #4CAF50;
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 500;
    display: inline-block;
}

.time-slot {
    color: #2c3e50;
}

.time {
    font-weight: 500;
}

.separator {
    margin: 0 5px;
    color: #6c757d;
}

.subject-info {
    display: flex;
    align-items: center;
}

.subject-name {
    font-weight: 500;
    color: #2c3e50;
}

.teacher-info {
    color: #6c757d;
}

.grade-info {
    /* background-color: #e9ecef; */
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.9em;
    /* font-weight: 500; */
    /* align-items: center; */
    height: 50px;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    /* color: #495057; */
}

@media screen and (max-width: 768px) {
    .schedule-wrapper {
        padding: 15px;
        margin: 10px;
    }

    .schedule-table thead {
        display: none;
    }

    .schedule-row {
        display: block;
        margin-bottom: 20px;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 10px;
    }

    .schedule-table td {
        display: block;
        text-align: right;
        padding: 8px;
        border: none;
        position: relative;
    }

    .schedule-table td::before {
        content: attr(data-label);
        position: absolute;
        left: 8px;
        font-weight: 600;
        color: #2c3e50;
    }

    .day-badge {
        float: right;
    }

    .time-slot, .subject-info, .teacher-info, .grade-info {
        margin-left: 120px;
    }

    .schedule-title {
        font-size: 1.5rem;
        margin-bottom: 20px;
    }
}

@media screen and (max-width: 576px) {
    .schedule-wrapper {
        padding: 10px;
    }

    .schedule-title {
        font-size: 1.3rem;
    }

    .time-slot, .subject-info, .teacher-info, .grade-info {
        margin-left: 100px;
    }
}
</style>
@endsection
