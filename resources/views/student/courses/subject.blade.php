@extends('layout.navbar_student')
@section('title', 'Subject')
@section('mainContent')
    <!-- Main Content -->
    <div class="content">
        <div class="row">
            <!-- Main content area -->
            <div class="col-lg-8 col-md-12">
                <div class="row g-2 mt-5">
                    <h1 class="mt-5 mx-2">Subjects : {{  $student->stu_id}}</h1>
                    <!-- subject -->
                    @foreach($course as $cou)


                    <div class="col-6 col-md-6">
                        <div class="subject">
                            <div class="card" style="z-index: 1;">
                                @if($cou->sub_image)
                                <img src="{{ asset('images/math.jpg') }}" class="card-img-top"  alt="Mathematics">
                                @else
                                    <div class="imageNull" style="width: 100%; height: 175px; border: solid 0.5px black; background: aqua " >
                                    <p>{{$cou->sub_name}}</p>
                                      </div>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title"> Subject {{$cou->sub_name}} </h5>
                                    <p class="card-text">Teacher: {{$cou->tea_fname}} </p>
                                    <p class="card-text">Course: {{$cou->cou_id}} </p>
                                    <p class="card-text">Grade: {{$cou->gra_class}}{{$cou->gra_group}} </p>
                                    <a href="{{ route('student.course.submit.show', ['id' => $cou->cou_id]) }}" class="btn btn-primary">Submit Attendance</a>
                                    <a href="{{ route('student.course.document', ['id' => $cou->cou_id]) }}" class="btn btn-primary">
                                        View Documents
                                    </a>                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!-- subject -->
                    {{-- <div class="col-6 col-md-6">
                        <div class="subject">
                            <div class="card" style="z-index: 1;">
                                <img src="{{ asset('images/math.jpg') }}" class="card-img-top"  alt="Mathematics">
                                <div class="card-body">
                                    <h5 class="card-title">Math</h5>
                                    <p class="card-text">Teacher: kong visa</p>
                                    <a href="#" class="btn btn-primary">See all</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- subject -->
                    {{-- <div class="col-6 col-md-6">
                        <div class="subject">
                            <div class="card" style="z-index: 1;">
                                <img src="{{ asset('images/math.jpg') }}" class="card-img-top"  alt="Mathematics">
                                <div class="card-body">
                                    <h5 class="card-title">Math</h5>
                                    <p class="card-text">Teacher: kong visa</p>
                                    <a href="#" class="btn btn-primary">See all</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <!-- subject -->
                    

                </div>
            </div>
        </div>
    </div>
@endsection
