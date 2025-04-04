@extends('layout.navbar_admin')
@section('title', 'users')
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
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Teacher</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- form -->
                                            <form action="" method="POST" class="form-horizontal" role="form">
                                                <div class="form-group mb-3">
                                                    <label for="" class="form-label">First Name</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="" class="form-label">Last Name</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group mb-3 d-flex justify-content-between">
                                                    <div class="col-sm-5">
                                                        <label for="" class="form-label">Gender</label>
                                                        <select name="" id="" class="form-select">
                                                            <option value="male">Male</option>
                                                            <option value="female">Femal</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <label for="" class="form-label">Subject</label>
                                                        <select name="" id="" class="form-select">
                                                            <option value="math">Math</option>
                                                            <option value="khmer">Khmer</option>
                                                            <option value="english">English</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="" class="form-label">Phone Number</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="" class="form-label">Email Address</label>
                                                    <input type="email" class="form-control">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="" class="form-label">Password</label>
                                                    <input type="password" class="form-control">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="" class="form-label">Address</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                
                                            </form>
                                            
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">ADD</button>
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
                                    <th>FIRST NAME</th>
                                    <th>LAST NAME</th>
                                    <th>GENDER</th>  
                                    <th>DEPARTMENT</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>STU1234</td>
                                    <td>Long</td>
                                    <td>Pisent</td>
                                    <td>Male</td>
                                    <td>Science</td>
                                </tr>
                                <tr>
                                    <td>STU1234</td>
                                    <td>Hong</td>
                                    <td>Pich</td>
                                    <td>Male</td>
                                    <td>Science</td>
                                </tr>
                                <tr>
                                    <td>STU1234</td>
                                    <td>Kong</td>
                                    <td>Vichet</td>
                                    <td>Male</td>
                                    <td>Science</td>
                                </tr>
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
                        <h4>User Details</h4>
                        <div>
                            <button class="prvBtn"><i class="fa-solid fa-chevron-left"></i></button>
                            <button class="nxtBtn"><i class="fa-solid fa-chevron-right"></i></button>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex justify-content-between">
                            <span>REF ID:</span>
                            <p>STU123</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>FIRST NAME:</span>
                            <p>Long</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>LAST NAME:</span>
                            <p>Pisen</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>GENDER:</span>
                            <p>MALE</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>PHONE:</span>
                            <p>+123456789</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>EMAIL:</span>
                            <p>student@gmail.com</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>ADDRESS:</span>
                            <p>143b 163 st. Phnom Penh</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>DEPARTMENT:</span>
                            <p>Science</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>STUDENT STATUS:</span>
                            <p>Current</p>
                        </div>
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