<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{$grade->gra_id}}">
    Edit
</button>

<!-- Edit Modal -->
<div class="modal fade" id="editModal{{$grade->gra_id}}" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Grade</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('updateGrade', ['id' => $grade->gra_id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="gra_class" class="form-label">Grade</label>
                        <input type="text" name="gra_class" value="{{ $grade->gra_class }}" class="form-control" placeholder="eg. 12 11">
                    </div>
                    <div class="form-group mb-3">
                        <label for="gra_group" class="form-label">Class</label>
                        <input type="text" name="gra_group" value="{{ $grade->gra_group }}" class="form-control" placeholder="eg. A B">
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