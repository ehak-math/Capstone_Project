@extends('layout.navbar_teacher')
@section('title', 'Schedule')
@section('mainContent')
    <!-- Main Content -->
    <div class="content">
        <div class="row">
            <!-- Main content area -->
            <div class="col-lg-8 col-md-12">
                <div class="row g-2 mt-5">
                    <h1 class="mt-5 mx-2">Uplods document</h1>
                   
                    <form action="{{ route('teacher.document') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">Upload File</label>
                            <input type="file" class="form-control" id="file" name="file" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="tittle" class="form-label">Tittle</label>
                            <input class="form-control"  name="tittle" rows="3"></input>
                        </div>
                        <label for="course">Course</label>
                        <select name="course" >
                            @foreach($select as $course)
                                        <option value="{{ $course->cou_id }}">
                                            {{ $course->sub_name }} ({{ $course->cou_name ?? $course->cou_id }})
                                        </option>
                                    @endforeach
                        </select>
                        <label for="typeOfdoc">type Of document </label>
                        <select name="typeOfdoc" >
                            <option value=""></option>
                        </select>


                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection