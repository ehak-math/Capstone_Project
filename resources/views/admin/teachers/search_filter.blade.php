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

                                    @include('admin.teachers.edit')
                                    @include('admin.teachers.delete')
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