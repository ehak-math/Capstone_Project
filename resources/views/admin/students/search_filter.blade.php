<!-- search -->
<script>
    document.getElementById('searchInput').addEventListener('input', filterStudents);
    document.getElementById('genderFilter').addEventListener('change', filterStudents);
    document.getElementById('gradeFilter').addEventListener('change', filterStudents);

    function filterStudents() {

        const searchQuery = document.getElementById('searchInput').value;
        const genderQuery = document.getElementById('genderFilter').value;
        const gradeQuery = document.getElementById('gradeFilter').value;

        // Build the query string
        const queryString = `search=${encodeURIComponent(searchQuery)}&gender=${encodeURIComponent(genderQuery)}&grade=${encodeURIComponent(gradeQuery)}`;

        // Send AJAX request
        fetch(`{{ route('searchStudents') }}?${queryString}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
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
    }
</script>
