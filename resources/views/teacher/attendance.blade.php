@extends('layout.navbar_teacher')
@section('title', 'Attendance')
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
                        <h3>Attendance List</h3>
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
                                    <th>ATTENDANCE</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>STU1234</td>
                                    <td>Long</td>
                                    <td>Pisent</td>
                                    <td>Male</td>
                                    <td>Science</td>
                                    <td id="att-present">Present</td>
                                </tr>
                                <tr>
                                    <td>STU1234</td>
                                    <td>Hong</td>
                                    <td>Pich</td>
                                    <td>Male</td>
                                    <td>Science</td>
                                    <td id="att-absent">Absent</td>
                                </tr>
                                <tr>
                                    <td>STU1234</td>
                                    <td>Kong</td>
                                    <td>Vichet</td>
                                    <td>Male</td>
                                    <td>Science</td>
                                    <td id="att-present">Present</td>
                            </tbody>
                        </table>
                    </div>
                    

                 </div>
            </div>
    
            <!-- generate code attendance section -->
            <div class="col-lg-4 col-md-12 mt-4 mt-lg-5 p-3 scheldule-section">
                
                <!-- generate code details -->
                <div class="teacher-details rounded mt-4 p-3">
                    <h4>Generate code</h4>
                    <hr>
                    <div class="d-flex flex-column gap-2">
                        <form action="" method="get">
                            <div class="mb-3">
                                <label for="attendanceCode" class="form-label">Attendance Code</label>
                                <input type="text" class="form-control" id="attendanceCode" name="attendanceCode" value="" readonly>
                            </div>
                            <button type="submit" class="btn btn-primary">Generate Code</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection