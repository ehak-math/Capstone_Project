@extends('layout.navbar_admin')
@section('title', 'Course Details')
@section('mainContent')

    <!-- Main Content -->
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
                <div class="info-coures rounded mt-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center gap-4">
                            <a href="{{ route('admin.courses.index') }}" class="btn btn-primary"><i
                                    class="fa-solid fa-arrow-left"></i></a>
                            <h3>Course Details</h3>
                        </div>
                        <div>
                            <h3 style="color: #11117E">{{ $grade->gra_class }} {{ $grade->gra_group }}</h3>
                        </div>
                    </div>
                    <hr>
                    <!-- filter -->
                    <div class="d-flex gap-2">
                        <input type="text" class="form-control" placeholder="Search...">
                        <div class="col-auto d-flex gap-2">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Sort by</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Filter by</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <!-- title subject and teacher name -->
                    <div class="d-flex align-items-center gap-2">
                        <h3><strong>Subject: {{ $teacher->subject->sub_name }}</strong></h3>
                        <h3><strong>({{ $teacher->tea_fname }})</strong></h3>
                    </div>
                    <hr>
                    <!-- table -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">S.N.</th>
                                    <th scope="col">Profile</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Parants' Phone Number </th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Age</th>
                                    <th scope="col">Score Point</th>
                                    <th scope="col">Month</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($students->isEmpty())
                                    <tr>
                                        <td colspan="10" class="text-center">No students found for this class and group.</td>
                                    </tr>
                                @else
                                @foreach ($students as $index => $student)
                                    @php
                                        // Find the score for the current student
                                        $studentScore = $scores->firstWhere('sco_stu_id', $student->stu_id);
                                    @endphp
                                        <tr>
                                        <td>{{$index + 1}}</td>
                                        <td>
                                            @if($student->stu_profile && file_exists(public_path('storage/' . $student->stu_profile)))
                                                <img class="profile_stu" src="{{ asset('storage/' . $student->stu_profile) }}"
                                                    alt="Student Profile">
                                            @else
                                                <img class="profile_stu" src="{{ asset('images/placeholder_student.jpg') }}"
                                                    alt="Placeholder Image">
                                            @endif
                                        </td>
                                        <td>{{ $student->stu_fname }}</td>
                                        <td>{{ $student->stu_username }}</td>
                                        <td>0{{ $student->stu_ph_number }}</td>
                                        <td>0{{ $student->stu_parent_number }}</td>
                                        <td>{{ $student->stu_gender }}</td>
                                        <td>{{ \Carbon\Carbon::parse($student->stu_dob)->age }}</td>
                                        <td style="color: green">{{ $studentScore ? $studentScore->sco_point : 'N/A' }}</td>
                                        <td>{{ $studentScore ? \Carbon\Carbon::create()->month((int) $studentScore->sco_month)->format('F') : 'N/A' }}</td>
                                        <td>
                                            @if ($student->stu_status == 1)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-primary">EDIT</a>
                                            <a href="#" class="btn btn-danger">DELETE</a>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection