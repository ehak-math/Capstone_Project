@extends('layout.navbar_admin')
@section('title', 'Schedule')
@section('mainContent')
    <!-- Main Content -->
    <div class="content">
        <div class="row">
            <!-- Main content area -->
            <div class="col-lg-12 col-md-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="date_name">
                    <h3>Greatings, {{Auth::user()->name}}!</h3>
                    <p id="currentDate"></p>
                </div>
                <div class="info-coures rounded mt-2">
                    <div class="d-flex justify-content-between">
                        <h3>Schedules</h3>
                        <div>
                            @include('admin.schedule.create')
                        </div>
                    </div>
                    <hr>
                    <!-- filter -->
                    <div class="d-flex gap-2">
                        <input type="text" class="form-control" placeholder="Search...">
                        <div class="col-auto d-flex gap-2">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Sort by</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Filter by</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        @foreach ($schedules as $schedule)
                        
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                            <div class="card h-100" style="">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title">{{ $schedule->sch_day }}</h3>
                                        <h5 class="card-title">{{ $schedule->gra_class }}{{ $schedule->gra_group }}</h5>
                                    </div>
                                    <h5 class="card-subtitle mb-2 mt-1 text-body-secondary">{{ $schedule->sub_name }}
                                        ({{ $schedule->tea_fname }})
                                    
                                    </h4>
                                    <p class="card-text">
                                        {{ \Carbon\Carbon::parse($schedule->sch_start_time)->format('H:i') }}h -
                                        {{ \Carbon\Carbon::parse($schedule->sch_end_time)->format('H:i') }}h
                                    </p>
                                    @include('admin.schedule.edit')
                                    @include('admin.schedule.delete')
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection