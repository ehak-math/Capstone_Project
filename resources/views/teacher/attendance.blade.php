@extends('layout.navbar_teacher')
@section('title', 'Attendance')
@section('mainContent')
    <div class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="info-teacher rounded">
                    <div class="date_name">
                        <h3>Greatings, {{ $teacher->tea_fname }}!</h3>
                        <p id="currentDate"></p>
                    </div>
                    <!-- Attendance Table -->
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Time</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendances as $attSub)
                                    <tr>
                                        <td>{{$attSub->stu_id}}</td>
                                        <td>{{$attSub->stu_fname}}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $attSub->att_sub_status == 'Present' ? 'success' : 'danger' }}">
                                                {{$attSub->att_sub_status}}
                                            </span>
                                        </td>
                                        <td>{{$attSub->att_sub_time ?? 'N/A'}}</td>
                                        <td>{{$attSub->att_sub_date ?? 'N/A'}}</td>
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
        .table {
            margin-bottom: 0;
        }

        .badge {
            font-weight: 500;
        }

        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, .05);
        }

        .table> :not(caption)>*>* {
            padding: 1rem;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, .02);
        }
    </style>
@endsection