@extends('layout.navbar_student')
@section('title', 'attendances')
@section('mainContent')
    <!-- Main Content -->
    <div class="content">
        <div class="row">
            <!-- Main content area -->
            <div class="col-lg-12 col-md-12 mt-5">
                <div class="list-of-student m-2">
                    <h1 class="mt-5">List of attendance</h1>`
                    <!-- list of attendance -->
                    @foreach($attendances as $att_stu)
                     <div class="attendance d-flex justify-content-between">
                        <div class="image-text d-flex">
                            <img src="{{ asset('images/subject.jpg') }}" class="rounded-3" alt="" width="auto" height="80px">
                            <div class="sub-text align-items-center justify-content-center">
                                <h4>Teacher:{{$att_stu->tea_fname}}</h4>
                                <p>Date: {{$att_stu->att_sub_date}}</p>
                                <p>Subject: {{$att_stu->sub_name}}</p>
                            </div>
                        </div>

                        <div class="sub-attendance">
                            @if($att_stu->att_sub_status == 'Absent')
                            <p class="box-att" style="background: red;">{{$att_stu->att_sub_status}}</p>
                            @elseif($att_stu->att_sub_status == 'Present')  
                            <p class="box-att" style="background: green;">{{$att_stu->att_sub_status}}</p>
                            @endif
                        </div>
                     </div>
                     @endforeach
                     
                </div>
            </div>
        </div>
    </div>
@endsection