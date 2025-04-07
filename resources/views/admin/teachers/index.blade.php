@extends('layout.navbar_admin')
@section('title', 'Teacher')
@section('mainContent')
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
                    <h3>Greatings, Bro!</h3>
                    <p id="currentDate"></p>
                </div>
                <!-- teacher list -->
                <div class="info-teacher rounded">
                    <div class="d-flex justify-content-between">
                        <h3>Teacher List</h3>
                        <div class="d-flex gap-2">
                            <a href="{{ route('teachers.export') }}" class="btn border d-flex align-items-center">Export</a>
                            <!-- Import Button -->
                            <button type="button" class="btn border" data-bs-toggle="modal"
                                data-bs-target="#importModal">
                                Import
                            </button>

                            <!-- Import Modal -->
                            <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="importModalLabel">Import Teachers</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('teachers.import') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="importFile" class="form-label">Select Excel File</label>
                                                    <input type="file" name="file" id="importFile" class="form-control"
                                                        required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Import</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- add teacher -->
                            @include('admin.teachers.create')
                        </div>
                    </div>
                    <hr>
                    <!-- filter -->
                    <div class="d-flex gap-2">
                        <input type="text" id="searchInput" class="form-control" placeholder="Please enter to search">
                        <div class="d-flex col-auto gap-2">
                            <select class="form-select" id="genderFilter" aria-label="Gender select">
                                <option selected value=" ">Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <select class="form-select" id="subjectFilter" aria-label="Department select">
                                <option selected value=" ">Subject</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->sub_name }}">{{ $subject->sub_name }}</option>
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
                                    <th>SUBJECT</th>
                                    <th>PHONE NUMBER</th>
                                    <th>ACTION</th>

                                </tr>
                            </thead>
                            <tbody id="teacherTableBody">
                                @foreach($teachers as $teacher)
                                    <tr>
                                        <td>TEA{{$teacher->tea_id}}</td>
                                        <td>
                                            @if($teacher->tea_profile && file_exists(public_path('storage/' . $teacher->tea_profile)))
                                                <img class="profile_teacher" src="{{ asset('storage/' . $teacher->tea_profile) }}"
                                                    alt="Teacher Profile">
                                            @else
                                                <img class="profile_teacher" src="{{ asset('images/placeholder_teacher.jpg') }}"
                                                    alt="Placeholder Image">
                                            @endif
                                        </td>
                                        <td>{{$teacher->tea_username}}</td>
                                        <td>{{$teacher->tea_fname}}</td>
                                        <td>{{$teacher->tea_gender}}</td>
                                        <td>{{$teacher->subject->sub_name}}</td>
                                        <td>0{{$teacher->tea_ph_number}}</td>
                                        <td>
                                            @include('admin.teachers.view_details')
                                            @include('admin.teachers.edit')
                                            @include('admin.teachers.delete')
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
    @include('admin.teachers.search_filter')
@endsection