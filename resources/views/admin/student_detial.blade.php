@extends('layout.navbar')
@section('title', 'Student')
@section('mainContent')
<!-- info section -->

<span id="stu_id">{{ $stubyId}}</span>
<div class="col-lg-4 col-md-12 mt-4 mt-lg-5 p-3 scheldule-section">
    <!-- student details info -->
    <div class="teacher-details rounded mt-4 p-3">
        <div class="d-flex align-items-center justify-content-between">
            <h4>Student Details</h4>
            <div>
                <button class="prvBtn"><i class="fa-solid fa-chevron-left">back</i></button>
                <button class="nxtBtn"><i class="fa-solid fa-chevron-right">go to</i></button>
            </div>
        </div>
        <hr>
        <div class="d-flex flex-column gap-2">
            <div class="d-flex justify-content-between">
                <span>REF ID:</span>
                <p>{{$stubyId->stu_id}}</p>
            </div>
            <div class="d-flex justify-content-between">
                <span>Full Name</span>
                <p>{{$stubyId->stu_fname}}</p>
            </div>
            <div class="d-flex justify-content-between">
                <span>Username</span>
                <p>{{$stubyId->stu_username}}</p>
            </div>
            <div class="d-flex justify-content-between">
                <span>GENDER:</span>
                <p>{{$stubyId->stu_gender}}</p>
            </div>
            <div class="d-flex justify-content-between">
                <span>PHONE:</span>
                <p>{{$stubyId->stu_ph_number}}</p>
            </div>
            <div class="d-flex justify-content-between">
                <span>PHONE PARENT:</span>
                <p>{{$stubyId->stu_parent_number}}</p>
            </div>

            <div class="d-flex justify-content-between">
                <span>CLASS:</span>
                <p>{{$stubyId->stu_grade}}{{$stubyId->stu_group}}</p>
            </div>
            <div class="d-flex justify-content-between">
                <span>STUDENT DOB:</span>
                <p>{{$stubyId->stu_dob}}</p>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger">DELETE</button>

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal">
                    EDIT
                </button>
                <!-- Modal -->
                <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Student</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
{{--                            <div class="modal-body">--}}
{{--                                <!-- form -->--}}
{{--                                @if($stubyId)--}}
{{--                                <form action="{{ route('student.update', $stubyId->stu_id) }}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">--}}
{{--                                    @csrf--}}
{{--                                    @method('PUT')--}}
{{--                                    <div class="form-group mb-3">--}}
{{--                                        <label for="stu_fname" class="form-label">Full Name</label>--}}
{{--                                        <input type="text" name="stu_fname" class="form-control" value="{{ $stubyId->stu_fname }}">--}}
{{--                                    </div>--}}

{{--                                    <div class="form-group mb-3">--}}
{{--                                        <label for="stu_username" class="form-label">Username</label>--}}
{{--                                        <input type="text" name="stu_username" class="form-control" value="{{ $stubyId->stu_username }}">--}}
{{--                                    </div>--}}

{{--                                    <div class="form-group mb-3 d-flex justify-content-between">--}}
{{--                                        <div class="col-sm-5">--}}
{{--                                            <label for="stu_gender" class="form-label">Gender</label>--}}
{{--                                            <select name="stu_gender" id="stu_gender" class="form-select">--}}
{{--                                                <option value="male" {{ $stubyId->stu_gender == 'male' ? 'selected' : '' }}>Male</option>--}}
{{--                                                <option value="female" {{ $stubyId->stu_gender == 'female' ? 'selected' : '' }}>Female</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-sm-5">--}}
{{--                                            <label for="stu_grade" class="form-label">Grade</label>--}}
{{--                                            <select name="stu_grade" id="stu_grade" class="form-select">--}}
{{--                                                <option value="12" {{ $stubyId->stu_grade == '12' ? 'selected' : '' }}>12</option>--}}
{{--                                                <option value="11" {{ $stubyId->stu_grade == '11' ? 'selected' : '' }}>11</option>--}}
{{--                                                <option value="10" {{ $stubyId->stu_grade == '10' ? 'selected' : '' }}>10</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="col-sm-5">--}}
{{--                                        <label for="stu_group" class="form-label">Group</label>--}}
{{--                                        <select name="stu_group" id="stu_group" class="form-select">--}}
{{--                                            <option value="A" {{ $stubyId->stu_group == 'A' ? 'selected' : '' }}>A</option>--}}
{{--                                            <option value="B" {{ $stubyId->stu_group == 'B' ? 'selected' : '' }}>B</option>--}}
{{--                                            <option value="C" {{ $stubyId->stu_group == 'C' ? 'selected' : '' }}>C</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}

{{--                                    <div class="form-group mb-3">--}}
{{--                                        <label for="stu_ph_number" class="form-label">Phone Number</label>--}}
{{--                                        <input type="text" name="stu_ph_number" class="form-control" value="{{ $stubyId->stu_ph_number }}">--}}
{{--                                    </div>--}}

{{--                                    <div class="form-group mb-3">--}}
{{--                                        <label for="stu_parent_number" class="form-label">Parent Phone Number</label>--}}
{{--                                        <input type="text" name="stu_parent_number" class="form-control" value="{{ $stubyId->stu_parent_number }}">--}}
{{--                                    </div>--}}

{{--                                    <div class="form-group mb-3">--}}
{{--                                        <label for="stu_dob" class="form-label">Date of Birth</label>--}}
{{--                                        <input type="date" name="stu_dob" class="form-control" value="{{ $stubyId->stu_dob }}">--}}
{{--                                    </div>--}}

{{--                                    <div class="form-group mb-3">--}}
{{--                                        <label for="stu_profile" class="form-label">Profile</label>--}}
{{--                                        <input type="file" name="stu_profile" class="form-control">--}}
{{--                                    </div>--}}

{{--                                    <div class="modal-footer">--}}
{{--                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>--}}
{{--                                        <button type="submit" class="btn btn-primary">Update</button>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                                @else--}}
{{--                                <p>No student selected for editing</p>--}}
{{--                                @endif--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
