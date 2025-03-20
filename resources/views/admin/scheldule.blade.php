@extends('layout.navbar')
@section('title', 'Schedule')
@section('mainContent')
<!-- Main Content -->

@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CreateScheldule">
                        CREATE Schedule
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CreateGrade">
                        CREATE Grade
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CreateCourse">
                        CREATE Course
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="CreateScheldule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">





                                    <form action="{{ route('createschedule') }}" method="POST">
                                        @csrf
                                        <label for="schedule_course_id">Course:</label>
                                        <select id="schedule_course_id" name="schedule_course_id" required>
                                            @foreach($listcourse as $cou)
                                                <option value="{{$cou->cou_id}}">Teacher:{{$cou->tea_fname}} |=| {{$cou->sub_name}}  |=| {{$cou->gra_class}} {{$cou->gra_group}} </option>
                                            @endforeach
                                        </select>
                                        <label for="schedule_day">Day:</label>
                                        <select id="schedule_day" name="schedule_day" required>
                                            <option value="monday">Monday</option>
                                            <option value="tuesday">Tuesday</option>
                                            <option value="wednesday">Wednesday</option>
                                            <option value="thursday">Thursday</option>
                                            <option value="friday">Friday</option>
                                            <option value="saturday">Saturday</option>

                                        </select>
                                        <label for="sch_start_time">Stat-Time:</label>
                                        <select id="team_time" name="sch_start_time" required>
                                            <option value="7:15:00">7:15-8:00 AM</option>
                                            <option value="8:15:00">8:15-9:00 AM</option>
                                            <option value="9:15:00">9:15-10:00 AM</option>
                                        </select>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>

                            </div>

                        </div>
                        </div>
                    </div>
{{--                  Done--}}
                    <div class="modal fade" id="CreateCourse" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form action="{{ route('createcourse') }}" method="POST">
                                    @csrf
                                    <label for="time">Choose a Teacher:</label>
                                    <select id="time" name="teacher" required>
                                        @foreach($listteacher as $tea)
                                        <option value="{{$tea->tea_id}}">{{$tea->tea_username}} with {{$tea->sub_name}}</option>
                                        @endforeach
                                    </select>
                                    <br><br>
                                    <label for="subject">Choose a Grade</label>
                                    <select id="time" name="grade" required>
                                        @foreach($gradelist as $grade)
                                        <option value="{{$grade->gra_id}}">{{$grade->gra_class}} {{$grade->gra_group}}</option>
                                        @endforeach
                                    </select>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>


                            </div>

                        </div>
                        </div>
                    </div>
{{--                  Done--}}
                    <div class="modal fade" id="CreateGrade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form action="{{ route('crategrade') }}" method="POST">
                                        @csrf
                                        <label for="grade_class">Grade:</label>
                                        <select id="team_name" name="grade" required>
                                            <option value="12">12</option>
                                            <option value="11">11</option>
                                            <option value="10">10</option>
                                        </select>
                                        <label for="name">Team Name:</label>
                                        <select id="team_name" name="group" required>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="E">E</option>
                                            <option value="F">F</option>
                                            <option value="G">G</option>
                                            <option value="H">H</option>
                                        </select>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
{{--TODO--}}
            <div
                style="border: 1px solid black;
                padding: 10px;
                margin-top: 10px; ">
                <h4>The list of Grade</h4>
                @foreach($gradelist as $grade)
                <li>Id : {{$grade->sub_name}}    || {{$grade->gra_class}} {{$grade->gra_group}}</li>
                @endforeach
            </div>
            <div
                style="border: 1px solid black;
                padding: 10px;
                margin-top: 10px; ">
                <h4>The list of Coure</h4>
                @foreach($listcourse as $cou)
                    <li>Course Name {{$cou->sub_name}}  teach by {{$cou->tea_fname}}  || class {{$cou->gra_class}} {{$cou->gra_group}}</li>
                @endforeach
                </div>
            <div
                style="border: 1px solid black;
                padding: 10px;
                margin-top: 10px; ">
                <h4>Create Schedule</h4>
                @foreach($schedule as $s)
                    <li> {{ $s->sch_start_time }} |=| {{$s->sch_end_time}} {{$s->sch_day}} {{$s->sub_name}} |WITH| {{$s->tea_fname}} </li>
                @endforeach
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
