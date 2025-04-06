<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add Grade
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add
                    Grade</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- form for add grade-->

                <form action="{{ route('addGrade') }}" method="POST" class="form-horizontal" role="form">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="gra_class" class="form-label">Grade</label>
                        <input type="text" name="gra_class" class="form-control" placeholder="eg. 12 11">
                    </div>
                    <div class="form-group mb-3">
                        <label for="gra_group" class="form-label">Class</label>
                        <input type="text" name="gra_group" class="form-control" placeholder="eg. A B">
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