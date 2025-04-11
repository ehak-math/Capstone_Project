@extends('layout.navbar_admin')
@section('title', 'Student')
@section('mainContent')
    <!-- Main Content -->
    <div class="content">
        <div class="row">

            <!-- Main content area -->
            <div class="col-lg-12 col-md-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" style="z-index: 100000;" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="date_name">
                    <h3>Greatings, {{Auth::user()->name}}!</h3>
                    <p id="currentDate"></p>
                </div>
                <!-- teacher list -->
                <div class="info-teacher rounded">
                    <div class="d-flex justify-content-between">
                        <h3>Student List</h3>
                        <div class="d-flex gap-2">
                            <a href="{{ route('students.export') }}" class="btn border d-flex align-items-center">Export</a>
                            <!-- Import Button -->
                            <button type="button" class="btn border" data-bs-toggle="modal" data-bs-target="#importModal">
                                Import
                            </button>

                            <!-- Import Modal -->
                            <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="importModalLabel">Import Students</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('students.import') }}" method="POST"
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
                                    <th>GRADE</th>
                                    <th>STATUS</th>
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
                                                    <img class="profile_stu" src="{{ asset('images/placeholder_student.jpg') }}"
                                                        alt="Placeholder Image">
                                                @endif
                                            </td>
                                            <td>{{$stu->stu_username}}</td>
                                            <td>{{$stu->stu_fname}}</td>
                                            <td>{{$stu->stu_gender}}</td>
                                            <td>0{{$stu->stu_ph_number}}</td>
                                            <td>{{$stu->gra_class}} {{$stu->gra_group}}</td>
                                            <td>
                                                @if($stu->stu_status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
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