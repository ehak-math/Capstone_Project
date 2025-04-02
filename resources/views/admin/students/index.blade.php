@extends('layout.navbar_admin')
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
                        <input type="text" id="searchInput" class="form-control" placeholder="Search by name">
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
                    <button class="btn btn-primary" id="filterButton">Filter</button>
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
                                    <th>Grade</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            
                            <tbody id="studentTableBody">
                                @if($students->count() > 0)
                                @foreach($students as $stu)

                               <tr>
                                    <td>{{$stu->stu_id}}</td>
                                    <td>
                                        @if($stu->stu_profile && file_exists(public_path('storage/' . $stu->stu_profile)))
                                            <img class="profile_stu" src="{{ asset('storage/' . $stu->stu_profile) }}" alt="Student Profile">
                                        @else
                                            <img class="profile_stu" src="{{ asset('images/placeholder.png') }}" alt="Placeholder Image">
                                        @endif
                                    </td>
                                    <td>{{$stu->stu_fname}}</td>
                                    <td>{{$stu->stu_username}}</td>
                                    <td>{{$stu->stu_gender}}</td>
                                    <td>0{{$stu->stu_ph_number}}</td>
                                    <td>{{$stu->gra_class}} {{$stu->gra_group}}</td>
                                    <td>
                                        <!-- View Details Button -->
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#viewModal{{$stu->stu_id}}">
                                            View
                                        </button>

                                        <!-- View Details Modal -->
                                        <div class="modal fade" id="viewModal{{$stu->stu_id}}" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="viewModalLabel">Student Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="d-flex flex-column gap-2">
                                                            <div class="text-center mt-3">
                                                                @if($stu->stu_profile && file_exists(public_path('storage/' . $stu->stu_profile)))
                                                                    <img src="{{ asset('storage/' . $stu->stu_profile) }}" alt="Student Profile" style="max-width: 200px; border-radius: 5px;">
                                                                @else
                                                                    <img src="{{ asset('images/placeholder.png') }}" alt="Placeholder Image" style="max-width: 200px; border-radius: 5px;">
                                                                @endif
                                                            </div>
                                                            <div class="d-flex justify-content-between">
                                                                <span>REF ID:</span>
                                                                <p>{{$stu->stu_id}}</p>
                                                            </div>
                                                            <div class="d-flex justify-content-between">
                                                                <span>Full Name:</span>
                                                                <p>{{$stu->stu_fname}}</p>
                                                            </div>
                                                            <div class="d-flex justify-content-between">
                                                                <span>Username:</span>
                                                                <p>{{$stu->stu_username}}</p>
                                                            </div>
                                                            <div class="d-flex justify-content-between">
                                                                <span>Gender:</span>
                                                                <p>{{$stu->stu_gender}}</p>
                                                            </div>
                                                            <div class="d-flex justify-content-between">
                                                                <span>Phone:</span>
                                                                <p>0{{$stu->stu_ph_number}}</p>
                                                            </div>
                                                            <div class="d-flex justify-content-between">
                                                                <span>Parent Phone:</span>
                                                                <p>0{{$stu->stu_parent_number}}</p>
                                                            </div>
                                                            <div class="d-flex justify-content-between">
                                                                <span>Grade:</span>
                                                                <p>{{$stu->gra_class}} {{$stu->gra_group}}</p>
                                                            </div>
                                                            <div class="d-flex justify-content-between">
                                                                <span>Date of Birth:</span>
                                                                <p>{{$stu->stu_dob}}</p>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 

                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{$stu->stu_id}}">
                                            Edit
                                        </button>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal{{$stu->stu_id}}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Student</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form action="{{ route('updateStudent', ['id' => $stu->stu_id]) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="form-group mb-3">
                                                            <label for="stu_fname" class="form-label">Full Name</label>
                                                            <input type="text" name="stu_fname" class="form-control" value="{{ $stu->stu_fname }}">
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="stu_username" class="form-label">Username</label>
                                                            <input type="text" name="stu_username" class="form-control" value="{{ $stu->stu_username }}">
                                                        </div>

                                                        <div class="form-group mb-3 d-flex justify-content-between">
                                                            <div class="col-sm-5">
                                                                <label for="stu_gender" class="form-label">Gender</label>
                                                                <select name="stu_gender" class="form-select">
                                                                    <option value="Male" {{ $stu->stu_gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                                    <option value="Female" {{ $stu->stu_gender == 'Female' ? 'selected' : '' }}>Female</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-sm-5">
                                                                <label for="stu_grade" class="form-label">Grade</label>
                                                                <select name="stu_grade" class="form-select">
                                                                    @foreach($grades as $gra)
                                                                    <option value="{{ $gra->gra_id }}" {{ $stu->stu_gra_id == $gra->gra_id ? 'selected' : '' }}>
                                                                        {{ $gra->gra_class }} {{$stu->gra_group}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="stu_ph_number" class="form-label">Phone Number</label>
                                                            <input type="text" name="stu_ph_number" class="form-control" value="{{ $stu->stu_ph_number }}">
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="stu_parent_number" class="form-label">Parent Phone Number</label>
                                                            <input type="text" name="stu_parent_number" class="form-control" value="{{ $stu->stu_parent_number }}">
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="stu_dob" class="form-label">Date of Birth</label>
                                                            <input type="date" name="stu_dob" class="form-control" value="{{ $stu->stu_dob }}">
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="stu_profile" class="form-label">Profile</label>
                                                            <input type="file" name="stu_profile" class="form-control">
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Edit</button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                        
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteAction('{{ route('deleteStudent', ['id' => $stu->stu_id]) }}')">Delete</button>

                                        <!-- Delete Confirmation Modal -->
                                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this student?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <form id="deleteForm" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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

<!-- search -->
<script>
    document.getElementById('searchInput').addEventListener('input', function () {
        const query = this.value;

        // Send AJAX request
        fetch(`{{ route('searchStudents') }}?name=${query}`)
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('studentTableBody');
                tableBody.innerHTML = ''; // Clear the table body

                if (data.length > 0) {
                    data.forEach(student => {
                        tableBody.innerHTML += `
                            <tr>
                                <td>${student.stu_id}</td>
                                <td>
                                    ${student.stu_profile && student.stu_profile !== '' ? 
                                        `<img class="profile_stu" src="/storage/${student.stu_profile}" alt="Student Profile">` : 
                                        `<img class="profile_stu" src="/images/placeholder.png" alt="Placeholder Image">`}
                                </td>
                                <td>${student.stu_fname}</td>
                                <td>${student.stu_username}</td>
                                <td>${student.stu_gender}</td>
                                <td>0${student.stu_ph_number}</td>
                                <td>${student.grade ? student.grade.gra_class + ' ' + student.grade.gra_group : 'N/A'}</td>
                                <td>
                                                                         <!-- View Details Button -->
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#viewModal${student.stu_id}">
                                        View
                                    </button>

                                    <!-- View Details Modal -->
                                    <div class="modal fade" id="viewModal${student.stu_id}" tabindex="-1" aria-labelledby="viewModalLabel${student.stu_id}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="viewModalLabel${student.stu_id}">Student Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="d-flex flex-column gap-2">
                                                        <div class="text-center mt-3">
                                                            ${student.stu_profile && student.stu_profile !== '' ? 
                                                                `<img src="/storage/${student.stu_profile}" alt="Student Profile" style="max-width: 200px; border-radius: 5px;">` : 
                                                                `<img src="/images/placeholder.png" alt="Placeholder Image" style="max-width: 200px; border-radius: 5px;">`}
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span>REF ID:</span>
                                                            <p>${student.stu_id}</p>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span>Full Name:</span>
                                                            <p>${student.stu_fname}</p>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span>Username:</span>
                                                            <p>${student.stu_username}</p>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span>Gender:</span>
                                                            <p>${student.stu_gender}</p>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span>Phone:</span>
                                                            <p>0${student.stu_ph_number}</p>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span>Parent Phone:</span>
                                                            <p>0${student.stu_parent_number}</p>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span>Grade:</span>
                                                            <p>${student.grade ? student.grade.gra_class + ' ' + student.grade.gra_group : 'N/A'}</p>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span>Date of Birth:</span>
                                                            <p>${student.stu_dob}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{$stu->stu_id}}">
                                            Edit
                                        </button>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal{{$stu->stu_id}}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Student</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form action="{{ route('updateStudent', ['id' => $stu->stu_id]) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="form-group mb-3">
                                                            <label for="stu_fname" class="form-label">Full Name</label>
                                                            <input type="text" name="stu_fname" class="form-control" value="{{ $stu->stu_fname }}">
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="stu_username" class="form-label">Username</label>
                                                            <input type="text" name="stu_username" class="form-control" value="{{ $stu->stu_username }}">
                                                        </div>

                                                        <div class="form-group mb-3 d-flex justify-content-between">
                                                            <div class="col-sm-5">
                                                                <label for="stu_gender" class="form-label">Gender</label>
                                                                <select name="stu_gender" class="form-select">
                                                                    <option value="Male" {{ $stu->stu_gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                                    <option value="Female" {{ $stu->stu_gender == 'Female' ? 'selected' : '' }}>Female</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-sm-5">
                                                                <label for="stu_grade" class="form-label">Grade</label>
                                                                <select name="stu_grade" class="form-select">
                                                                    @foreach($grades as $gra)
                                                                    <option value="{{ $gra->gra_id }}" {{ $stu->stu_gra_id == $gra->gra_id ? 'selected' : '' }}>
                                                                        {{ $gra->gra_class }} {{$stu->gra_group}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="stu_ph_number" class="form-label">Phone Number</label>
                                                            <input type="text" name="stu_ph_number" class="form-control" value="{{ $stu->stu_ph_number }}">
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="stu_parent_number" class="form-label">Parent Phone Number</label>
                                                            <input type="text" name="stu_parent_number" class="form-control" value="{{ $stu->stu_parent_number }}">
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="stu_dob" class="form-label">Date of Birth</label>
                                                            <input type="date" name="stu_dob" class="form-control" value="{{ $stu->stu_dob }}">
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="stu_profile" class="form-label">Profile</label>
                                                            <input type="file" name="stu_profile" class="form-control">
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Edit</button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                        
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteAction('{{ route('deleteStudent', ['id' => $stu->stu_id]) }}')">Delete</button>

                                        <!-- Delete Confirmation Modal -->
                                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this student?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <form id="deleteForm" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                            </tr>
                        `;
                    });
                } else {
                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="8" class="text-center">No students found</td>
                        </tr>
                    `;
                }
            })
            .catch(error => console.error('Error:', error));
    });
</script>

@endsection
