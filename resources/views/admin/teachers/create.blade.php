<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    ADD
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Teacher</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- form add teacher -->
                <form action="{{ route('admin.teachers.add') }}" method="POST" class="form-horizontal" role="form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="tea_fname" class="form-label">FullName</label>
                        <input type="text" name="tea_fname" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tea_username" class="form-label">Username</label>
                        <input type="text" name="tea_username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tea_password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="tea_password" name="tea_password" required>
                    </div>
                    <div class="form-group mb-3 d-flex justify-content-between">
                        <div class="col-sm-5">
                            <label for="tea_gender" class="form-label">Gender</label>
                            <select name="tea_gender" id="tea_gender" class="form-select">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-sm-5">
                            <label for="tea_subject" class="form-label">Subject</label>
                            <select name="tea_subject" id="tea_subject" class="form-select">
                                @foreach($subjects as $subject)
                                    <option value="{{$subject->sub_id}}">{{$subject->sub_name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tea_ph_number" class="form-label">Phone Number</label>
                        <input type="text" name="tea_ph_number" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tea_dob" class="form-label">Date of Birth</label>
                        <input type="date" name="tea_dob" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="tea_profile" class="form-label">Profile</label>
                        <input type="file" name="tea_profile" class="form-control" required>
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