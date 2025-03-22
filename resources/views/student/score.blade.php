@extends('layout.navbar_student')
@section('title', 'attendances')
@section('mainContent')
    <!-- Main Content -->
    <div class="content">
        <div class="row">
            <!-- Main content area -->
            <div class="col-lg-8 col-md-12 mt-5">
                <div class="list-of-student m-2">
                    <h1 class="mt-5">List of Score</h1>
                    <!-- list of attendance -->
                     <div class="attendance d-flex justify-content-between">
                        <div class="image-text d-flex">
                            <img src="{{ asset('images/math.jpg') }}" class="rounded-3" alt="" width="80px" height="80px">
                            <div class="sub-text align-items-center justify-content-center">
                                <h4>Math</h4>
                                <p>Date: 22/03/2025</p>
                            </div>
                        </div>
                        <div class="sub-attendance">
                            <p class="box-att" style="background: green;">Present</p>
                        </div>
                     </div>

                     <div class="attendance d-flex justify-content-between mt-3">
                        <div class="image-text d-flex">
                            <img src="{{ asset('images/math.jpg') }}" class="rounded-3" alt="" width="80px" height="80px">
                            <div class="sub-text align-items-center justify-content-center">
                                <h4>Math</h4>
                                <p>Date: 22/03/2025</p>
                            </div>
                        </div>
                        <div class="sub-attendance">
                            <p class="box-att" style="background: green;">Present</p>
                        </div>
                     </div>

                     <div class="attendance d-flex justify-content-between mt-3">
                        <div class="image-text d-flex">
                            <img src="{{ asset('images/math.jpg') }}" class="rounded-3" alt="" width="80px" height="80px">
                            <div class="sub-text align-items-center justify-content-center">
                                <h4>Math</h4>
                                <p>Date: 22/03/2025</p>
                            </div>
                        </div>
                        <div class="sub-attendance">
                            <p class="box-att" style="background: red;">Absent</p>
                        </div>
                     </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection