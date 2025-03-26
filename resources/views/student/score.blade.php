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
                    @if($score)
                    @foreach($score as $sco)
                     <div class="attendance d-flex justify-content-between">
                        <div class="image-text d-flex">
                            <img src="{{ asset('images/math.jpg') }}" class="rounded-3" alt="" width="80px" height="80px">
                            <div class="sub-text align-items-center justify-content-center">
                                <h4>{{$sco->sub_name}}</h4>
                                <h6>{{$sco->gra_class}}</h6>
                                <p>Month : {{$sco->sco_month}}</p>
                            </div>
                        </div>
                         @if($sco->sco_point > 50)
                             <div class="sub-attendance">
                                 <p class="box-att" style="background: green;">{{$sco->sco_point}}</p>
                             </div>
                         @else
                             <div class="sub-attendance">
                                 <p class="box-att" style="background: red;">{{$sco->sco_point}}</p>
                             </div>
                         @endif
                     </div>
                    @endforeach
                    @else
                        <h1>The Score is empty</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
