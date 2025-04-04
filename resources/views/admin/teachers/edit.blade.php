<!-- Edit Button -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{$teacher->tea_id}}">
    Edit
</button>

<!-- Edit Modal -->
<div class="modal fade" id="editModal{{$teacher->tea_id}}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Teacher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="{{ route('updateTeacher', ['id' => $teacher->tea_id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="tea_fname" class="form-label">Full Name</label>
                    <input type="text" name="tea_fname" class="form-control" value="{{ $teacher->tea_fname }}">
                </div>

                <div class="form-group mb-3">
                    <label for="tea_username" class="form-label">Username</label>
                    <input type="text" name="tea_username" class="form-control" value="{{ $teacher->tea_username }}">
                </div>

                <div class="form-group mb-3 d-flex justify-content-between">
                    <div class="col-sm-5">
                        <label for="tea_gender" class="form-label">Gender</label>
                        <select name="tea_gender" class="form-select">
                            <option value="Male" {{ $teacher->tea_gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $teacher->tea_gender == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <div class="col-sm-5">
                        <label for="tea_subject" class="form-label">Subject</label>
                        <select name="tea_subject" class="form-select">
                            @foreach($subjects as $subject)
                            <option value="{{ $subject->sub_id }}" {{ $teacher->tea_subject == $subject->sub_id ? 'selected' : '' }}>
                                {{ $subject->sub_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="tea_ph_number" class="form-label">Phone Number</label>
                    <input type="text" name="tea_ph_number" class="form-control" value="{{ $teacher->tea_ph_number }}">
                </div>

                <div class="form-group mb-3">
                    <label for="tea_dob" class="form-label">Date of Birth</label>
                    <input type="date" name="tea_dob" class="form-control" value="{{ $teacher->tea_dob }}">
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