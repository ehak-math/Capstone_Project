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
                        <img src="{{ asset('images/placeholder_student.jpg') }}" alt="Placeholder Image" style="max-width: 200px; border-radius: 5px;">
                        @endif
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>REF ID:</span>
                        <p>STU{{$stu->stu_id}}</p>
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
                    <div class="d-flex justify-content-between">
                        <span>Age:</span>
                        <p>{{ \Carbon\Carbon::parse($stu->stu_dob)->age }}</p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Status:</span>
                        <p>
                            @if($stu->stu_status == 1)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </p>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>