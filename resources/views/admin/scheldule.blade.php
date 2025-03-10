@extends('layout.navbar')
@section('title', 'Schedule')
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
            </div>
        </div>
        <!-- badge bg-primary rounded-pill -->

        <!-- Schedule section -->
        <div class="schedule-sectio p-2">
            <div class="d-flex rounded justify-content-between _scheldule">
                <h4>Schedule</h4>
                <div class="d-flex gap-2">
                    <select class="form-select" aria-label="Default select example">
                        <option selected value="Student">Student</option>
                        <option value="Teacher">Teacher</option>
                    </select>
                    <select class="form-select" aria-label="Default select example">
                        <option selected value="class">Class</option>
                        <option value="12A">12A</option>
                        <option value="12B">12B</option>
                        <option value="12C">12C</option>
                    </select>
                    <button class="btn btn-success">Edit</button>
                    <!-- Create  -->
                     <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        CREATE
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            ...
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="table-responsive p-3 rounded">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
                            <th>Sat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>7h - 8h</td>
                            <td>Math</td>
                            <td>Math</td>
                            <td>Math</td>
                            <td>Math</td>
                            <td>Math</td>
                            <td>Math</td>
                        </tr>
                        <tr>
                            <td>8h - 9h</td>
                            <td>Math</td>
                            <td>Math</td>
                            <td>Math</td>
                            <td>Math</td>
                            <td>Math</td>
                            <td>Math</td>
                        </tr>
                        <tr>
                            <td>9h - 10h</td>
                            <td>Math</td>
                            <td>Math</td>
                            <td>Math</td>
                            <td>Math</td>
                            <td>Math</td>
                            <td>Math</td>
                        </tr>
                        <tr>
                            <td>10h - 11h</td>
                            <td>Math</td>
                            <td>Math</td>
                            <td>Math</td>
                            <td>Math</td>
                            <td>Math</td>
                            <td>Math</td>
                        </tr>

                        <!-- evening -->
                        <tr>
                            <td colspan="7" class="text-center bg-light"><strong>Evening</strong></td>
                        </tr>
                        <tr>
                            <td>2h - 3h</td>
                            <td>English</td>
                            <td>English</td>
                            <td>English</td>
                            <td>English</td>
                            <td>English</td>
                            <td>English</td>
                        </tr>
                        <tr>
                            <td>3h - 4h</td>
                            <td>Science</td>
                            <td>Science</td>
                            <td>Science</td>
                            <td>Science</td>
                            <td>Science</td>
                            <td>Science</td>
                        </tr>
                    </tbody>
                    
                </table>
            </div>
            
        </div>
    </div>
@endsection