<!-- View Details Button -->
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#viewModal{{$teacher->tea_id}}">
    View
</button>
<!-- View Details Modal -->
<div class="modal fade" id="viewModal{{$teacher->tea_id}}" tabindex="-1" aria-labelledby="viewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Teacher Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column gap-2">
                    <div class="text-center mt-3">
                        @if($teacher->tea_profile && file_exists(public_path('storage/' . $teacher->tea_profile)))
                            <img src="{{ asset('storage/' . $teacher->tea_profile) }}" alt="Teacher Profile"
                                style="max-width: 200px; border-radius: 5px;">
                        @else
                            <img src="{{ asset('images/placeholder_teacher.jpg') }}" alt="Placeholder Image"
                                style="max-width: 200px; border-radius: 5px;">
                        @endif
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>REF ID:</span>
                        <p>TEA{{$teacher->tea_id}}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Full Name:</span>
                        <p>{{$teacher->tea_fname}}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Username:</span>
                        <p>{{$teacher->tea_username}}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Gender:</span>
                        <p>{{$teacher->tea_gender}}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Phone:</span>
                        <p>0{{$teacher->tea_ph_number}}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Subject:</span>
                        <p>{{$teacher->subject ? $teacher->subject->sub_name : 'N/A' }}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Date of Birth:</span>
                        <p>{{$teacher->tea_dob}}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>