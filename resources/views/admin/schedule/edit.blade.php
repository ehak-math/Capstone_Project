<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{$schedule->sch_id}}">
    EDIT
</button>

<!-- Edit Modal -->
<div class="modal fade" id="editModal{{$schedule->sch_id}}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('updateSchedule', ['id' => $schedule->sch_id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Select Course -->
                    <div class="form-group mb-3">
                        <label for="sch_cou_id" class="form-label">Course</label>
                        <select name="sch_cou_id" class="form-select" required>
                            <option value="" disabled>Select Course</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->cou_id }}"
                                    {{ $schedule->sch_cou_id == $course->cou_id ? 'selected' : '' }}>
                                    {{ optional(optional($course->teacher)->subject)->sub_name ?? 'No Subject Assigned' }}
                                    ({{ $course->grade->gra_class ?? 'No Class' }}{{ $course->grade->gra_group ?? '' }})
                                    - {{ optional($course->teacher)->tea_fname ?? 'No Teacher Assigned' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Schedule Day -->
                    <div class="form-group mb-3">
                        <label for="sch_day" class="form-label">Day</label>
                        <select name="sch_day" class="form-select" required>
                            <option value="" disabled>Select Day</option>
                            @foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                                <option value="{{ $day }}" {{ $schedule->sch_day == $day ? 'selected' : '' }}>
                                    {{ $day }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Start Time -->
                    <div class="form-group mb-3">
                        <label for="sch_start_time" class="form-label">Start Time</label>
                        <input type="time" name="sch_start_time" class="form-control" value="{{ \Carbon\Carbon::parse($schedule->sch_start_time)->format('H:i') }}" required>
                    </div>

                    <!-- End Time -->
                    <div class="form-group mb-3">
                        <label for="sch_end_time" class="form-label">End Time</label>
                        <input type="time" name="sch_end_time" class="form-control" value="{{ \Carbon\Carbon::parse($schedule->sch_end_time)->format('H:i') }}" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
