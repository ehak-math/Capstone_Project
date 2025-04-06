@extends('layout.navbar_teacher')
@section('title', 'Manage Scores')
@section('mainContent')
<div class="content">
    <div class="row justify-content-center">
        <!-- Main content area -->
        <div class="col-lg-8 col-md-12">
            <div class="row g-2 mt-5">
                <div class="card shadow-sm p-3">
                    <h1 class="text-primary">Hello, {{$teacher->tea_id}}</h1>
                    <p><strong>Course:</strong> {{$course->cou_id}}</p>
                    <hr>

                    <!-- Add Score Form -->
                    <form action="{{route('teacher.score.create')}}" method="post" class="mb-3">
                        @csrf
                        <div class="mb-2">
                            <label for="cou_id" class="form-label">Add Score to Students in Course {{$course->cou_id}}</label>
                            <input type="hidden" class="form-control" value="{{$course->cou_id}}" name="cou_id" required>
                        </div>
                        <div class="mb-2">
                            <label for="month" class="form-label">Select Month:</label>
                            <select id="month" name="sco_month" class="form-select">
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-plus-circle me-2"></i>Submit
                        </button>
                    </form>
                </div>

                <hr>

                <!-- Display Scores -->
                @if(!isset($selectallpoint))
                    @foreach($selectallStudent as $stu)
                        <div class="card shadow-sm p-2 mb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-dark mb-1">Student ID: {{$stu->stu_id}}</h6>
                                    <p class="mb-0"><strong>Name:</strong> {{$stu->stu_fname}}</p>
                                    <p class="mb-0"><strong>Class:</strong> {{$stu->gra_class}}{{$stu->gra_group}}</p>
                                </div>
                                <span class="badge bg-secondary">0</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    @foreach($selectallpoint as $stupoint)
                        <div class="card shadow-sm p-2 mb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-dark mb-1">Student ID: {{$stupoint->stu_id}}</h6>
                                    <p class="mb-0"><strong>Name:</strong> {{$stupoint->stu_fname}}</p>
                                    <p class="mb-0"><strong>Class:</strong> {{$stupoint->gra_class}}{{$stupoint->gra_group}}</p>
                                </div>
                                <span class="badge bg-success">{{$stupoint->sco_point}}</span>
                            </div>
                            <form action="{{route('teacher.score.addscore')}}" method="post" class="mt-2">
                                @csrf
                                <input type="hidden" name="sco_id" value="{{$stupoint->sco_id}}">
                                <input type="hidden" name="stu_id" value="{{$stupoint->stu_id}}">
                                <input type="hidden" name="cou_id" value="{{$stupoint->cou_id}}">
                                <div class="mb-2">
                                    <label for="score" class="form-label">Update Score</label>
                                    <input type="number" class="form-control form-control-sm" value="{{$stupoint->sco_point}}" name="sco_point" required>
                                </div>
                                <button type="submit" class="btn btn-warning btn-sm w-100">
                                    <i class="fas fa-edit me-2"></i>Update
                                </button>
                            </form>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: 1px solid #ddd;
        border-radius: 6px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 10px;
        margin-bottom: 10px;
        background-color: #fff;
    }

    .card h6, .card p {
        margin: 0;
        font-size: 0.9rem;
    }

    .card .badge {
        font-size: 0.85rem;
        padding: 5px 10px;
        border-radius: 12px;
    }

    .badge.bg-secondary {
        background-color: #6c757d !important;
    }

    .badge.bg-success {
        background-color: #28a745 !important;
    }

    .btn-sm {
        font-size: 0.85rem;
        padding: 5px 10px;
    }
</style>
@endsection

