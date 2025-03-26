@extends('layout.navbar_admin')
@section('title', 'Student')
@section('mainContent')
<!-- Main Content -->
<div class="content">
        <div class="row">
            <!-- Main content area -->
            <div class="col-lg-8 col-md-12">
                <div class="date_name">
                    <h3>Greatings, Bro!</h3>
                    <p id="currentDate"></p>
                </div>
                <!-- teacher list -->
                 <div class="info-teacher rounded">
                    <div class="d-flex justify-content-between">
                        <h3>Student List</h3>
                        <div class="d-flex gap-2">
                            <button class="btn border">Print</button>
                            <select class="form-select" aria-label="Default select example">
                                <option selected value="export">Export</option>
                                <option value="import">Import</option>
                              </select>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    ADD
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Student</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- form for add user-->
{{--                                            @if(session('success'))--}}
{{--                                                <script>--}}
{{--                                                    alert("{{ session('success') }}");--}}
{{--                                                </script>--}}
{{--                                            @endif--}}

                                            <form action="{{ route('addStudent') }}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group mb-3">
                                                    <label for="stu_fname" class="form-label">Full Name</label>
                                                    <input type="text" name="stu_fname" class="form-control">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="stu_username" class="form-label">Username</label>
                                                    <input type="text" name="stu_username" class="form-control">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="stu_password" class="form-label">Password</label>
                                                    <input type="password" name="stu_password" class="form-control">
                                                </div>

                                                <div class="form-group mb-3 d-flex justify-content-between">
                                                    <div class="col-sm-5">
                                                        <label for="stu_gender" class="form-label">Gender</label>
                                                        <select name="stu_gender" id="" class="form-select">
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Femal</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-5">
                                                        <label for="stu_grade" class="form-label">Grade</label>
                                                        <select name="stu_grade" id="" class="form-select">
                                                            @foreach($grades as $gra)
                                                            <option value="{{$gra->gra_id}}">{{$gra->gra_class}} {{$gra->gra_group}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="stu_ph_number" class="form-label">Phone Number</label>
                                                    <input type="text" name="stu_ph_number" class="form-control">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="stu_parent_number" class="form-label">Parant Phone Number</label>
                                                    <input type="text" name="stu_parent_number" class="form-control">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="stu_dob" class="form-label">Date of Birth</label>
                                                    <input type="date" name="stu_dob" class="form-control">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="stu_profile" class="form-label">Profile</label>
                                                    <input type="file" name="stu_profile" class="form-control">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">ADD</button>
                                                </div>
                                            </form>


                                        </div>

                                    </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <hr>
                    <!-- filter -->
                    <div class="d-flex gap-2">
                        <input type="text" class="form-control" placeholder="Search by name">
                        <div class="d-flex col-auto gap-2">
                            <select class="form-select" aria-label="Gender select">
                                <option selected value="">Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <select class="form-select" aria-label="Department select">
                                <option selected value="">Department</option>
                                <option value="science">Science</option>
                                <option value="english">English</option>
                            </select>
                            <button class="btn btn-primary">Filter</button>
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
                                    <th>Grade</th>
                                    <th>View</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if($students->count() > 0)
                                @foreach($students as $stu)

                               <tr>
                                    <td>{{$stu->stu_id}}</td>
                                   @if($stu->stu_profile)

                                    <td><img style="height: 50px ; width: 50px;" src="{{ asset('storage/' . $stu->stu_profile) }}" ></td>
                                   @else
                                       <th>Your Image is empty</th>
                                   @endif
                                    <td>{{$stu->stu_fname}}</td>
                                    <td>{{$stu->stu_username}}</td>
                                    <td>{{$stu->stu_gender}}</td>
                                    <td>{{$stu->gra_class}} {{$stu->team_group}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" >
                                            <a href="{{ route("showDetails",['id' => $stu->stu_id]) }}">View</a>
                                        </button>
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







            <!-- info section -->
{{--            <div class="col-lg-4 col-md-12 mt-4 mt-lg-5 p-3 scheldule-section">--}}
{{--                <!-- student details info -->--}}
{{--                <form action="{{ route('studentinfo') }}" method="POST" class="form-horizontal" role="form">--}}
{{--                <div class="teacher-details rounded mt-4 p-3">--}}
{{--                    <div class="d-flex align-items-center justify-content-between">--}}
{{--                        <h4>Student Details</h4>--}}
{{--                        <div>--}}
{{--                            <button class="prvBtn"><i class="fa-solid fa-chevron-left"></i></button>--}}
{{--                            <button class="nxtBtn"><i class="fa-solid fa-chevron-right"></i></button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <hr>--}}
{{--                    <div class="d-flex flex-column gap-2">--}}
{{--                        <div class="d-flex justify-content-between">--}}
{{--                            <span>REF ID:</span>--}}
{{--                            <p>{{$student->stu_id}}</p>--}}
{{--                        </div>--}}
{{--                        <div class="d-flex justify-content-between">--}}
{{--                            <span>Full Name</span>--}}
{{--                            <p>{{$student->stu_fname}}</p>--}}
{{--                        </div>--}}
{{--                        <div class="d-flex justify-content-between">--}}
{{--                            <span>Username</span>--}}
{{--                            <p>{{$student->stu_username}}</p>--}}
{{--                        </div>--}}
{{--                        <div class="d-flex justify-content-between">--}}
{{--                            <span>GENDER:</span>--}}
{{--                            <p>{{$student->stu_gender}}</p>--}}
{{--                        </div>--}}
{{--                        <div class="d-flex justify-content-between">--}}
{{--                            <span>PHONE:</span>--}}
{{--                            <p>{{$student->stu_ph_number}}</p>--}}
{{--                        </div>--}}
{{--                        <div class="d-flex justify-content-between">--}}
{{--                            <span>PHONE PARENT:</span>--}}
{{--                            <p>{{$student->stu_parent_number}}</p>--}}
{{--                        </div>--}}

{{--                        <div class="d-flex justify-content-between">--}}
{{--                            <span>CLASS:</span>--}}
{{--                            <p>{{$student->stu_grade}}{{$student->stu_group}}</p>--}}
{{--                        </div>--}}
{{--                        <div class="d-flex justify-content-between">--}}
{{--                            <span>STUDENT DOB:</span>--}}
{{--                            <p>{{$student->stu_dob}}</p>--}}
{{--                        </div>--}}
{{--                        <div class="d-flex justify-content-between mt-4">--}}
{{--                            <!-- Button trigger modal -->--}}
{{--                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal">--}}
{{--                                EDIT--}}
{{--                            </button>--}}
{{--                            <!-- Modal -->--}}
{{--                            <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--                                <div class="modal-dialog">--}}
{{--                                <div class="modal-content">--}}
{{--                                    <div class="modal-header">--}}
{{--                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Teacher</h1>--}}
{{--                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                                    </div>--}}
{{--                                    <div class="modal-body">--}}
{{--                                        <!-- form -->--}}
{{--                                        @if($student)--}}
{{--                                            {{ route('student.update', $student->stu_id) }}--}}
{{--                                        <form action="" method="POST" class="form-horizontal" role="form">--}}
{{--                                             @csrf--}}
{{--                                             @method('PUT')--}}
{{--                                            <div class="form-group mb-3">--}}
{{--                                                <label for="stu_fname" class="form-label">Full Name</label>--}}
{{--                                                <input type="text" name="stu_fname" class="form-control" value="{{ $student->stu_fname }}">--}}
{{--                                            </div>--}}

{{--                                            <div class="form-group mb-3">--}}
{{--                                                <label for="stu_username" class="form-label">Username</label>--}}
{{--                                                <input type="text" name="stu_username" class="form-control" value="{{ $student->stu_username }}">--}}
{{--                                            </div>--}}

{{--                                            <div class="form-group mb-3 d-flex justify-content-between">--}}
{{--                                                <div class="col-sm-5">--}}
{{--                                                    <label for="stu_gender" class="form-label">Gender</label>--}}
{{--                                                    <select name="stu_gender" id="stu_gender" class="form-select">--}}
{{--                                                        <option value="male" {{ $student->stu_gender == 'male' ? 'selected' : '' }}>Male</option>--}}
{{--                                                        <option value="female" {{ $student->stu_gender == 'female' ? 'selected' : '' }}>Female</option>--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}

{{--                                                <div class="col-sm-5">--}}
{{--                                                    <label for="stu_grade" class="form-label">Grade</label>--}}
{{--                                                    <select name="stu_grade" id="stu_grade" class="form-select">--}}
{{--                                                        <option value="12" {{ $student->stu_grade == '12' ? 'selected' : '' }}>12</option>--}}
{{--                                                        <option value="11" {{ $student->stu_grade == '11' ? 'selected' : '' }}>11</option>--}}
{{--                                                        <option value="10" {{ $student->stu_grade == '10' ? 'selected' : '' }}>10</option>--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                            <div class="col-sm-5">--}}
{{--                                                <label for="stu_group" class="form-label">Group</label>--}}
{{--                                                <select name="stu_group" id="stu_group" class="form-select">--}}
{{--                                                    <option value="A" {{ $student->stu_group == 'A' ? 'selected' : '' }}>A</option>--}}
{{--                                                    <option value="B" {{ $student->stu_group == 'B' ? 'selected' : '' }}>B</option>--}}
{{--                                                    <option value="C" {{ $student->stu_group == 'C' ? 'selected' : '' }}>C</option>--}}
{{--                                                </select>--}}
{{--                                            </div>--}}

{{--                                            <div class="form-group mb-3">--}}
{{--                                                <label for="stu_ph_number" class="form-label">Phone Number</label>--}}
{{--                                                <input type="text" name="stu_ph_number" class="form-control" value="{{ $student->stu_ph_number }}">--}}
{{--                                            </div>--}}

{{--                                            <div class="form-group mb-3">--}}
{{--                                                <label for="stu_parent_number" class="form-label">Parent Phone Number</label>--}}
{{--                                                <input type="text" name="stu_parent_number" class="form-control" value="{{ $student->stu_parent_number }}">--}}
{{--                                            </div>--}}

{{--                                            <div class="form-group mb-3">--}}
{{--                                                <label for="stu_dob" class="form-label">Date of Birth</label>--}}
{{--                                                <input type="date" name="stu_dob" class="form-control" value="{{ $student->stu_dob }}">--}}
{{--                                            </div>--}}

{{--                                            <div class="form-group mb-3">--}}
{{--                                                <label for="stu_profile" class="form-label">Profile</label>--}}
{{--                                                <input type="file" name="stu_profile" class="form-control">--}}
{{--                                            </div>--}}

{{--                                            <div class="modal-footer">--}}
{{--                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>--}}
{{--                                                <button type="submit" class="btn btn-primary">Update</button>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                        @else--}}
{{--                                        <p>No student selected for editing</p>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <button type="button" class="btn btn-danger">DELETE</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                </form>--}}
{{--            </div>--}}
        </div>
    </div>
@endsection
