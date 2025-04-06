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
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                   
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
                            <option value="lecture">lecture</option>
                            <option value="homework">homework</option>
                        </select>


                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>

            <!-- Display Documents -->
            <div class="col-lg-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Uploaded Documents</h3>
                    </div>
                    <div class="card-body">
                        @if($documents && $documents->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Course</th>
                                            <th>Type</th>
                                            <th>Description</th>
                                            <th>Upload Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($documents as $document)
                                            <tr>
                                                <td>{{ $document->doc_name }}</td>
                                                <td>{{ $document->course->sub_name ?? 'N/A' }}</td>
                                                <td>{{ $document->doc_type }}</td>
                                                <td>{{ Str::limit($document->doc_deatial, 50) }}</td>
                                                {{-- <td>{{ $document->created_at->format('Y-m-d H:i') }}</td> --}}
                                                <td>
                                                    <a href="{{ route('teacher.document.download', $document->doc_id) }}" 
                                                       class="btn btn-sm btn-primary">
                                                        <i class="fas fa-download"></i> Download
                                                    </a>
                                                    <form action="{{ route('teacher.document.delete', $document->doc_id) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                                onclick="return confirm('Are you sure you want to delete this document?')">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                No documents uploaded yet.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection