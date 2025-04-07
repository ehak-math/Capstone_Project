<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#scheduleModal">
    ADD
</button>

<!-- Modal -->
<div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="scheduleModalLabel">Add Schedule</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for adding a schedule -->
                <form action="{{ route('addSchedule') }}" method="POST" class="form-horizontal" role="form"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Select Course -->
                    <div class="form-group mb-3">
                        <label for="sch_cou_id" class="form-label">Course</label>
                        <select name="sch_cou_id" class="form-select" required>
                            <option value="" disabled selected>Select Course</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->cou_id }}">
                                    {{ optional(optional($course->teacher)->subject)->sub_name ?? 'No Subject Assigned' }} -
                                    {{ optional($course->teacher)->tea_fname ?? 'No Teacher Assigned' }} 
                                </option>

                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Schedule Date -->
                    <div class="form-group mb-3">
                        <label for="sch_date" class="form-label">Date</label>
                        <input type="date" name="sch_date" class="form-control" required>
                    </div>

                    <!-- Start Time -->
                    <div class="form-group mb-3">
                        <label for="sch_start_time" class="form-label">Start Time</label>
                        <input type="time" name="sch_start_time" class="form-control" required>
                    </div>

                    <!-- End Time -->
                    <div class="form-group mb-3">
                        <label for="sch_end_time" class="form-label">End Time</label>
                        <input type="time" name="sch_end_time" class="form-control" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>