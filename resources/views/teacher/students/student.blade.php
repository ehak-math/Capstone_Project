@extends('layout.navbar_teacher')
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
                                    <th>SCORE</th>
                                    <th>ACTION</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>STU1234</td>
                                    <td>Long</td>
                                    <td>Pisent</td>
                                    <td>Male</td>
                                    <td>Science</td>
                                    <td>125</td>
                                    <td>
                                        <a href="#" class="btn btn-primary">VIEW</a>
                                        <a href="#" class="btn btn-success">EDIT</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>STU1234</td>
                                    <td>Hong</td>
                                    <td>Pich</td>
                                    <td>Male</td>
                                    <td>Science</td>
                                    <td>125</td>
                                    <td>
                                        <a href="#" class="btn btn-primary">VIEW</a>
                                        <a href="#" class="btn btn-success">EDIT</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>STU1234</td>
                                    <td>Kong</td>
                                    <td>Vichet</td>
                                    <td>Male</td>
                                    <td>Science</td>
                                    <td>125</td>
                                    <td>
                                        <a href="#" class="btn btn-primary">VIEW</a>
                                        <a href="#" class="btn btn-success">EDIT</a>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection