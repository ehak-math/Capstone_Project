<div>
    <div class="card-body">
        <form action="{{ route('updatesub', $subject->sub_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="sub_name" class="form-label">Subject Name</label>
                <input type="text" name="sub_name" class="form-control" id="sub_name" 
                       value="{{ old('sub_name', $subject->sub_name) }}" required>
            </div>

            <div class="mb-3">
                <label for="sub_image" class="form-label">Subject Image</label>
                @if($subject->sub_image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $subject->sub_image) }}" 
                             alt="Current Image" style="max-width: 200px;">
                    </div>
                @else 
                    <p>Your profile is empty</p>
                @endif
                <input type="file" name="sub_image" class="form-control" id="sub_image" accept="image/*">
            </div>

            <div class="d-flex justify-content-between">
                <a href="" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Subject</button>
            </div>
        </form>
        </div>
