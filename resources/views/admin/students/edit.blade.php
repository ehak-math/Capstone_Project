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