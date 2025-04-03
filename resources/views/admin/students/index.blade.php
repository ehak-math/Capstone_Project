@extends('layout.navbar_admin')
@section('title', 'Student')
@section('mainContent')
    <!-- Main Content -->
    <div class="content">
        <div class="row">
            <!-- Main content area -->
            <div class="col-lg-12 col-md-12">
                <div class="date_name">
                    <h3>Greatings, Bro!</h3>
                    <p id="currentDate"></p>
                </div>
                <!-- teacher list -->
                <div class="info-teacher rounded">
                    <div class="d-flex justify-content-between">
                        <h3>Student List</h3>
                        <div class="d-flex gap-2">
                            <button class="btn border">Export</button>
                            <button class="btn border">Import</button>
                            <!-- add student -->
                            @include('admin.students.create')
                        </div>
                    </div>
                    <hr>
                    <!-- filter -->
                    <div class="d-flex gap-2">
                        <input type="text" id="searchInput" class="form-control" placeholder="Please enter to search"
                            aria-label="Search">
                        <div class="d-flex col-auto gap-2">
                            <select class="form-select" id="genderFilter" aria-label="Gender select">
                                <option selected value="">Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <select class="form-select" id="gradeFilter" aria-label="Grade select">
                                <option selected value="">Grade</option>
                                @foreach($grades as $gra)
                                    <option value="{{ $gra->gra_id }}">{{ $gra->gra_class }} {{ $gra->gra_group }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- list teacher -->
                    <hr>
                    <div class="table-responsive">

                        <table class="table  table-hover">
                            <thead>
                                <tr>
                                    <th>REF ID</th>
                                    <th>PROFILE</th>
                                    <th>USERNAME</th>
                                    <th>FULLNAME</th>
                                    <th>GENDER</th>
                                    <th>PHONE NUMBER</th>
                                    <th>Grade</th>
                                    <th>Action</th>

                                </tr>
                            </thead>

                            <tbody id="studentTableBody">
                                @if($students->count() > 0)
                                    @foreach($students as $stu)

                                        <tr>
                                            <td>STU{{$stu->stu_id}}</td>
                                            <td>
                                                @if($stu->stu_profile && file_exists(public_path('storage/' . $stu->stu_profile)))
                                                    <img class="profile_stu" src="{{ asset('storage/' . $stu->stu_profile) }}"
                                                        alt="Student Profile">
                                                @else
                                                    <img class="profile_stu" src="{{ asset('images/placeholder_student.png') }}"
                                                        alt="Placeholder Image">
                                                @endif
                                            </td>
                                            <td>{{$stu->stu_username}}</td>
                                            <td>{{$stu->stu_fname}}</td>
                                            <td>{{$stu->stu_gender}}</td>
                                            <td>0{{$stu->stu_ph_number}}</td>
                                            <td>{{$stu->gra_class}} {{$stu->gra_group}}</td>
                                            <td>
                                                <!-- view details -->
                                                @include('admin.students.view_details')

                                                <!-- edite -->
                                                @include('admin.students.edit')

                                                <!-- delete -->
                                                @include('admin.students.delete')
                                            </td>
                                        </tr>

                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">No students found</td>
                                    </tr>
                                @endif
                            </tbody>

                        </table>
                    </div>
                    

                </div>
            </div>
        </div>
    </div>
    @include('admin.students.search_filter')
@endsection