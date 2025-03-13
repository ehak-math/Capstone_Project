@extends('layout.navbar')
@section('title', 'Teacher')
@section('mainContent')
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
                        <h3>Teacher List</h3>
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
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Teacher</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- form -->
                                        <form action="{{ route('teacher.store') }}" method="POST" class="form-horizontal" role="form">
                                            @csrf
                                            <div class="form-group mb-3">
                                                <label for="tea_fname" class="form-label">FullName</label>
                                                <input type="text" name="tea_fname" class="form-control">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="tea_username" class="form-label">Username</label>
                                                <input type="text" name="tea_username" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="tea_password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="tea_password" name="tea_password" required>
                                            </div>
                                            <div class="form-group mb-3 d-flex justify-content-between">
                                                <div class="col-sm-5">
                                                    <label for="tea_gender" class="form-label">Gender</label>
                                                    <select name="tea_gender" id="tea_gender" class="form-select">
                                                        <option value="male">Male</option>
                                                        <option value="female">Femal</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-5">
                                                    <label for="tea_subject" class="form-label">Subject</label>
                                                    <select name="tea_subject" id="tea_subject" class="form-select">
                                                        @foreach($sub as $subject)
                                                        <option value="{{$subject->sub_id}}">{{$subject->sub_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="tea_ph_number" class="form-label">Phone Number</label>
                                                <input type="text"name="tea_ph_number" class="form-control">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="tea_dob" class="form-label">Date of Birth</label>
                                                <input type="date" name="tea_dob" class="form-control">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="tea_profile" class="form-label">Profile</label>
                                                <input type="text" name="tea_profile" class="form-control">
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
                                <option selected value="">Subject</option>
                                <option value="math">Math</option>
                                <option value="khmer">Science</option>
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
                                    <th>USERNAME</th>
                                    <th>FULLNAME</th>
                                    <th>GENDER</th>  
                                    <th>SUBJECT</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teach as $teacher)
                                <tr>
                                    <td>{{$teacher->tea_id}}</td>
                                    <td>{{$teacher->tea_fname}}</td>
                                    <td>{{$teacher->tea_username}}</td>
                                    <td>{{$teacher->tea_gender}}</td>
                                    <td>{{$teacher->tea_subject}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    

                 </div>
            </div>
    
            <!-- info section -->
            <div class="col-lg-4 col-md-12 mt-4 mt-lg-5 p-3 scheldule-section">
                <!-- teacher details info -->
                <div class="teacher-details rounded mt-4 p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4>Teacher Details</h4>
                        <div>
                            <button class="prvBtn"><i class="fa-solid fa-chevron-left"></i></button>
                            <button class="nxtBtn"><i class="fa-solid fa-chevron-right"></i></button>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex justify-content-between">
                            <span>REF ID:</span>
                            <p>{{$teacherId->tea_id}}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>FULL NAME:</span>
                            <p>{{ $teacherId->tea_fname }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>USERNAME:</span>
                            <p>{{ $teacherId->tea_username}}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>GENDER:</span>
                            <p>{{ $teacherId->tea_gender }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>SUBJEC:</span>
                            <p>{{ $teacherId->tea_subject }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>PHONE:</span>
                            <p> +885 {{ $teacherId->tea_ph_number }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Date of Birth:</span>
                            <p>{{$teacherId->tea_dob}}</p>
                        </div>
                        {{-- <div class="d-flex justify-content-between">
                            <span>ADDRESS:</span>
                            <p>{{ $teacherId->tea_fname }}</p>
                        </div>
                       
                        <div class="d-flex justify-content-between">
                            <span>TEACHER STATUS:</span>
                            <p>{{ $teacherId->tea_fname }}</p>
                        </div> --}}
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-primary">EDIT</button>
                            <button type="button" class="btn btn-danger">DELETE</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection