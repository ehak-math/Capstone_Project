<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal"
    data-bs-target="#exampleModal">
    ADD
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Student</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- form for add user-->

                <form action="{{ route('addStudent') }}" method="POST" class="form-horizontal"
                    role="form" enctype="multipart/form-data">
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
                                    <option value="{{$gra->gra_id}}">{{$gra->gra_class}}
                                        {{$gra->gra_group}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="stu_ph_number" class="form-label">Phone Number</label>
                        <input type="text" name="stu_ph_number" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="stu_parent_number" class="form-label">Parant Phone
                            Number</label>
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
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>