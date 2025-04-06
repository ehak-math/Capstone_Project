@extends('layout.navbar_student')
@section('title', 'Scores')
@section('mainContent')
    <!-- Main Content -->
    <div class="content">
        <div class="row justify-content-center">
            <!-- Main content area -->
            <div class="col-lg-8 col-md-12 mt-5">
                <div class="list-of-student m-2">
                    <h1 class="mt-5 text-center text-primary">List of Scores</h1>
                    <!-- List of scores -->
                    @if(!isset($score))
                        @foreach($score as $sco)
                            <div class="attendance d-flex justify-content-between align-items-center shadow-sm">
                                <div class="image-text d-flex align-items-center">
                                    <img src="{{ asset('images/math.jpg') }}" class="rounded-3" alt="Subject Image" width="80px" height="80px">
                                    <div class="sub-text ms-3">
                                        <h4 class="mb-1 text-dark">{{$sco->sub_name}}</h4>
                                        <h6 class="mb-1 text-muted">{{$sco->gra_class}}</h6>
                                        <p class="mb-0 text-secondary">Month: {{$sco->sco_month}}</p>
                                    </div>
                                </div>
                                @if($sco->sco_point > 50)
                                    <div class="sub-attendance">
                                        <p class="box-att bg-success">{{$sco->sco_point}}</p>
                                    </div>
                                @else
                                    <div class="sub-attendance">
                                        <p class="box-att bg-danger">{{$sco->sco_point}}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <h1 class="text-center text-danger mt-5">The Score is Empty</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .attendance {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .attendance:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .image-text img {
            border: 2px solid #ddd;
        }
        .sub-text h4 {
            font-weight: bold;
        }
        .sub-text h6 {
            font-size: 0.9rem;
        }
        .sub-text p {
            font-size: 0.85rem;
        }
        .box-att {
            padding: 10px 20px;
            border-radius: 50px;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
            text-align: center;
            min-width: 60px;
        }
        .bg-success {
            background-color: #28a745 !important;
        }
        .bg-danger {
            background-color: #dc3545 !important;
        }
    </style>
@endsection
