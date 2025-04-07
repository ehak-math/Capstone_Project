<!-- Edit Modal -->
<div class="modal fade" id="editModal{{$course->cou_id}}" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('updateCourse', ['id' => $course->cou_id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="cou_sub_id" class="form-label">Subject</label>
                        <select name="cou_sub_id" class="form-select" required>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->sub_id }}" {{ $course->cou_sub_id == $subject->sub_id ? 'selected' : '' }}>
                                    {{ $subject->sub_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="cou_tea_id" class="form-label">Teacher</label>
                        <select name="cou_tea_id" class="form-select">
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->tea_id }}" {{ $course->cou_tea_id == $teacher->tea_id ? 'selected' : '' }}>
                                    {{ $teacher->tea_fname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="cou_gra_id" class="form-label">Grade/Class</label>
                        <select name="cou_gra_id" class="form-select">
                            @foreach($grades as $grade)
                                <option value="{{ $grade->gra_id }}" {{ $course->cou_gra_id == $grade->gra_id ? 'selected' : '' }}>
                                    {{ $grade->gra_class }} {{ $grade->gra_group }}
                                </option>
                            @endforeach
                        </select>
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