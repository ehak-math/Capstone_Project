<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    ADD
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Course</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- form for add user-->

                <form action="{{ route('admin.courses.add') }}" method="POST" class="form-horizontal" role="form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="cou_sub_id" class="form-label">Subject</label>
                        <select name="cou_sub_id" class="form-select" required>
                            <option value="" disabled selected>Select Subject</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->sub_id }}">{{ $subject->sub_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="cou_tea_id" class="form-label">Teacher</label>
                        <select name="cou_tea_id" class="form-select" required>
                            <option value="" disabled selected>Select Teacher</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->tea_id }}">{{ $teacher->tea_fname }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="cou_gra_id" class="form-label">Grade/Class</label>
                        <select name="cou_gra_id" class="form-select" required>
                            <option value="" disabled selected>Select Grade/Class</option>
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->gra_id }}">{{ $grade->gra_class }}
                                    {{ $grade->gra_group }}
                                </option>
                            @endforeach
                        </select>
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