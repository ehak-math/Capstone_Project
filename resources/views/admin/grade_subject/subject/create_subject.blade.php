<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subjectModal">
    Add Subject
</button>

<!-- Modal -->
<div class="modal fade" id="subjectModal" tabindex="-1" aria-labelledby="subjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="subjectModalLabel">Add
                    Subject</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- form for add grade-->

                <form action="{{ route('addSubject') }}" method="POST" class="form-horizontal" role="form">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="sub_name" class="form-label">Subject</label>
                        <input type="text" name="sub_name" class="form-control" placeholder="eg. Khmer, Math">
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