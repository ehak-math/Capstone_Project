@extends('layout.navbar_teacher')
@section('title', 'Attendance')
@section('mainContent')
<div class="content">
    <div class="row">
        <!-- Main content area -->
        <div class="col-lg-8 col-md-12">
            <div class="row g-2 mt-5"> 
                
                
            <h1>hello: {{$teacher->tea_id}}</h1>
            <p>course: {{$course->cou_id}}</p>
            <hr>
            
            <form action="{{route('teacher.score.create')}}" method="post">
                @csrf
                {{-- <div class="mb-3">
                    <label for="score" class="form-label">Score</label>
                </div> --}}
                <div class="mb-3">
                    <label for="cou_id" class="form-label">Add score To student : course {{$course->cou_id}}</label>
                    <input type="hidden" class="form-control" value="{{$course->cou_id}}" name="cou_id" required>
                </div>
                <div class="mb-3">
                <label for="month">Select Month:</label>
                <select id="month" name="sco_month">
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
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        <hr>
        @if(!isset($selectallpoint))
            @foreach($selectallStudent as $stu)
            <p>StudentId:{{$stu->stu_id}}</p>
            <p>StudentName:{{$stu->stu_fname}}</p>
            <p>StudentClass:{{$stu->gra_class}}{{$stu->gra_group}}</p>
            <p>Course:{{$stu->cou_id}}</p>
            <p>Score:0</p>
            <hr>
            @endforeach
        @else
        @foreach($selectallpoint as $stupoint)
            <p>StudentId:{{$stupoint->stu_id}}</p>
            <p>ScoreID:{{$stupoint->sco_id}}</p>
            <p>StudentName:{{$stupoint->stu_fname}}</p>
            <p>StudentClass:{{$stupoint->gra_class}}{{$stupoint->gra_group}}</p>
            <p>Course:{{$stupoint->cou_id}}</p>
            <p>Score:{{$stupoint->sco_point}}</p>
            <form action="{{route('teacher.score.addscore')}}" method="post">
                @csrf
                <input type="hidden" name="sco_id" value="{{$stupoint->sco_id}}">
                <input type="hidden" name="stu_id" value="{{$stupoint->stu_id}}">
                <input type="hidden" name="cou_id" value="{{$stupoint->cou_id}}">
                <div class="mb-3">
                    <label for="score" class="form-label">Score</label>
                    <input type="number" class="form-control" value="{{$stupoint->sco_point}}" name="sco_point" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
            <hr>
            @endforeach
        @endif
        </div>
        
        </div>
    </div>
</div>
@endsection
