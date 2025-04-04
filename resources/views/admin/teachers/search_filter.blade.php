<!-- Search -->
<script>
    document.getElementById('searchInput').addEventListener('input', filterTeachers);
    document.getElementById('genderFilter').addEventListener('change', filterTeachers);
    document.getElementById('subjectFilter').addEventListener('change', filterTeachers);

    function filterTeachers() {
        const searchQuery = document.getElementById('searchInput').value;
        const genderQuery = document.getElementById('genderFilter').value;
        const subjectQuery = document.getElementById('subjectFilter').value;

        // Build the query string
        const queryString = `search=${encodeURIComponent(searchQuery)}&gender=${encodeURIComponent(genderQuery)}&subject=${encodeURIComponent(subjectQuery)}`;

        // Send AJAX request
        fetch(`{{ route('searchTeachers') }}?${queryString}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Response Data:', data); // Debugging response
                const tableBody = document.getElementById('teacherTableBody');
                tableBody.innerHTML = ''; // Clear the table body

                if (data.length > 0) {
                    data.forEach(teacher => {
                        tableBody.innerHTML += `
                            <tr>
                                <td>TEA${teacher.tea_id}</td>
                                <td>
                                    ${teacher.tea_profile && teacher.tea_profile !== '' ?
                                `<img class="profile_teacher" src="/storage/${teacher.tea_profile}" alt="Teacher Profile">` :
                                `<img class="profile_teacher" src="/images/placeholder_teacher.jpg" alt="Placeholder Image">`}
                                </td>
                                <td>${teacher.tea_username}</td>
                                <td>${teacher.tea_fname}</td>
                                <td>${teacher.tea_gender}</td>
                                <td>${teacher.subject ? teacher.subject.sub_name : 'N/A'}</td>
                                <td>0${teacher.tea_ph_number}</td>
                                <td>
                                    <!-- View Details Button -->
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#viewModal${teacher.tea_id}">
                                        View
                                    </button>

                                    <!-- View Details Modal -->
                                    <div class="modal fade" id="viewModal${teacher.tea_id}" tabindex="-1" aria-labelledby="viewModalLabel${teacher.tea_id}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="viewModalLabel${teacher.tea_id}">Teacher Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="d-flex flex-column gap-2">
                                                        <div class="text-center mt-3">
                                                            ${teacher.tea_profile && teacher.tea_profile !== '' ?
                                `<img src="/storage/${teacher.tea_profile}" alt="Teacher Profile" style="max-width: 200px; border-radius: 5px;">` :
                                `<img src="/images/placeholder_teacher.jpg" alt="Placeholder Image" style="max-width: 200px; border-radius: 5px;">`}
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span>REF ID:</span>
                                                            <p>TEA${teacher.tea_id}</p>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span>Full Name:</span>
                                                            <p>${teacher.tea_fname}</p>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span>Username:</span>
                                                            <p>${teacher.tea_username}</p>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span>Gender:</span>
                                                            <p>${teacher.tea_gender}</p>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span>Phone:</span>
                                                            <p>0${teacher.tea_ph_number}</p>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span>Subject:</span>
                                                            <p>${teacher.subject ? teacher.subject.sub_name : 'N/A'}</p>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span>Date of Birth:</span>
                                                            <p>${teacher.tea_dob}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Edit Button -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal${teacher.tea_id}">
                                        Edit
                                    </button>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal${teacher.tea_id}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Edit Teacher</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                <form action="/admin/teachers/${teacher.tea_id}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="form-group mb-3">
                                                        <label for="tea_fname" class="form-label">Full Name</label>
                                                        <input type="text" name="tea_fname" class="form-control" value="${teacher.tea_fname }">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="tea_username" class="form-label">Username</label>
                                                        <input type="text" name="tea_username" class="form-control" value="${teacher.tea_username }">
                                                    </div>

                                                    <div class="form-group mb-3 d-flex justify-content-between">
                                                        <div class="col-sm-5">
                                                            <label for="tea_gender" class="form-label">Gender</label>
                                                            <select name="tea_gender" class="form-select">
                                                                <option value="Male" ${teacher.tea_gender == 'Male' ? 'selected' : '' }>Male</option>
                                                                <option value="Female" ${teacher.tea_gender == 'Female' ? 'selected' : '' }>Female</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-sm-5">
                                                            <label for="tea_subject" class="form-label">Subject</label>
                                                            <select name="tea_subject" class="form-select">
                                                                ${subjects.map(subject => `
                                                                    <option value="${subject.sub_id}" ${teacher.tea_subject == subject.sub_id ? 'selected' : ''}>
                                                                        ${subject.sub_name}
                                                                    </option>
                                                                `).join('')}
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="tea_ph_number" class="form-label">Phone Number</label>
                                                        <input type="text" name="tea_ph_number" class="form-control" value="${teacher.tea_ph_number }">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="tea_dob" class="form-label">Date of Birth</label>
                                                        <input type="date" name="tea_dob" class="form-control" value="${teacher.tea_dob }">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="tea_profile" class="form-label">Profile</label>
                                                        <input type="file" name="tea_profile" class="form-control">
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

                                    <!-- Delete Button -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal${teacher.tea_id}">
                                        Delete
                                    </button>

                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade" id="deleteModal${teacher.tea_id}" tabindex="-1" aria-labelledby="deleteModalLabel${teacher.tea_id}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel${teacher.tea_id}">Confirm Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this teacher with ID <strong>TEA${teacher.tea_id}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="/admin/teachers/${teacher.tea_id}" method="POST">
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
                            <td colspan="8" class="text-center">No teachers found</td>
                        </tr>
                    `;
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>
<script>
    const subjects = @json($subjects); // Convert Laravel data to a JavaScript array
</script>
