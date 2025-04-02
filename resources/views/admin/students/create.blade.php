<div class="container">
    <h2>Create students</h2>
    <form action="{{ route('admin.students.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="stu_fname" class="form-label">stu_fname</label>
            <input type="text" class="form-control" name="stu_fname" value="{{old('stu_fname')}}">
            @error("stu_fname")
                <p>{{$message}}</p>
            @enderror
        </div>
<div class="mb-3">
            <label for="stu_gra_id" class="form-label">stu_gra_id</label>
            <input type="text" class="form-control" name="stu_gra_id" value="{{old('stu_gra_id')}}">
            @error("stu_gra_id")
                <p>{{$message}}</p>
            @enderror
        </div>
<div class="mb-3">
            <label for="stu_username" class="form-label">stu_username</label>
            <input type="text" class="form-control" name="stu_username" value="{{old('stu_username')}}">
            @error("stu_username")
                <p>{{$message}}</p>
            @enderror
        </div>
<div class="mb-3">
            <label for="stu_password" class="form-label">stu_password</label>
            <input type="text" class="form-control" name="stu_password" value="{{old('stu_password')}}">
            @error("stu_password")
                <p>{{$message}}</p>
            @enderror
        </div>
<div class="mb-3">
            <label for="stu_gender" class="form-label">stu_gender</label>
            <input type="text" class="form-control" name="stu_gender" value="{{old('stu_gender')}}">
            @error("stu_gender")
                <p>{{$message}}</p>
            @enderror
        </div>
<div class="mb-3">
            <label for="stu_dob" class="form-label">stu_dob</label>
            <input type="date" class="form-control" name="stu_dob" value="{{old('stu_dob') }}">
            @error("stu_dob")
                <p>{{$message}}</p>
            @enderror
        </div>
<div class="mb-3">
            <label for="stu_ph_number" class="form-label">stu_ph_number</label>
            <input type="text" class="form-control" name="stu_ph_number" value="{{old('stu_ph_number')}}">
            @error("stu_ph_number")
                <p>{{$message}}</p>
            @enderror
        </div>
<div class="mb-3">
            <label for="stu_parent_number" class="form-label">stu_parent_number</label>
            <input type="text" class="form-control" name="stu_parent_number" value="{{old('stu_parent_number')}}">
            @error("stu_parent_number")
                <p>{{$message}}</p>
            @enderror
        </div>
<div class="mb-3">
            <label for="stu_profile" class="form-label">stu_profile</label>
            <input type="text" class="form-control" name="stu_profile" value="{{old('stu_profile')}}">
            @error("stu_profile")
                <p>{{$message}}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>