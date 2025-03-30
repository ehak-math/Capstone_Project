@extends('layout.navbar_teacher')
@section('title', 'Course')
@section('mainContent')

<div class="content">
        <div class="row">
            <!-- Main content area -->
            <div class="col-lg-8 col-md-12">
                <div class="row g-2 mt-5">
                    <h1 class="mt-5 mx-2">Courses</h1>
                    @foreach($Teacher as $tea)
                    <!-- subject -->
                    <div class="col-6 col-md-6">
                        <div class="subject">
                            <div class="card" style="z-index: 1;">
                                <img src="" class="card-img-top"  alt="{{$tea->sub_name}}">
                                <div class="card-body">
                                    <h5 class="card-title">Grade: {{$tea->gra_class}}{{$tea->gra_group}} </h5>
                                    <p class="card-text">Teacher: {{$tea->tea_fname}}</p>
                                    <p>{{$tea->sub_name}}</p>
                                    <a href="{{ route('teacher.attendance.show', ['id' => $tea->cou_id]) }}" class="btn btn-primary">See all</a>                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                   <!-- subject -->
                   <div class="col-6 col-md-6">
                        <div class="subject">
                            <div class="card" style="z-index: 1;">
                                <img src="{{ asset('images/math.jpg') }}" class="card-img-top"  alt="Mathematics">
                                <div class="card-body">
                                    <h5 class="card-title">Grade: 12A </h5>
                                    <p class="card-text">Teacher: Joker</p>
                                    <a href="/student/course_detail" class="btn btn-primary">See all</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection