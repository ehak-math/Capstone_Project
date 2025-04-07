<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSubModal{{$subject->sub_id}}">
    Edit
</button>

<!-- Edit Modal -->
<div class="modal fade" id="editSubModal{{$subject->sub_id}}" tabindex="-1" aria-labelledby="editSubModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSubModalLabel">Edit Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('updateSubject', ['id' => $subject->sub_id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="sub_name" class="form-label">Subject</label>
                        <input type="text" name="sub_name" value="{{ $subject->sub_name }}" class="form-control" placeholder="eg. Khmer, Math, ...">
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