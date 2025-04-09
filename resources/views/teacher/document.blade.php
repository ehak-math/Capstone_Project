@extends('layout.navbar_teacher')
@section('title', 'Schedule')
@section('mainContent')
    <!-- Main Content -->
    <div class="content">
        <div class="row">
            <!-- Main content area -->
            <div class="col-lg-8 col-md-12">
                <div class="row g-2 mt-5">
                    
                    <h1 class="mt-5 mx-2">Upload document</h1>
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
                   
                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-file-upload me-2"></i>Upload Document
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('teacher.document') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="tittle" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="tittle" name="tittle" required>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" 
                                                  placeholder="Enter document description..."></textarea>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="file" class="form-label">Upload File</label>
                                        <input type="file" class="form-control" id="file" name="file" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="course" class="form-label">Select Course</label>
                                        <select name="course" id="course" class="form-select">
                                            @foreach($select as $course)
                                                <option value="{{ $course->cou_id }}">
                                                    {{ $course->sub_name }} ({{ $course->cou_name ?? $course->cou_id }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="typeOfdoc" class="form-label">Document Type</label>
                                        <select name="typeOfdoc" id="typeOfdoc" class="form-select">
                                            <option value="lecture">Lecture</option>
                                            <option value="homework">Homework</option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <span>Upload Document</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <style>
                    .card {
                        border: none;
                        border-radius: 10px;
                    }

                    .form-label {
                        font-weight: 500;
                        color: #495057;
                    }

                    .form-control:focus, .form-select:focus {
                        border-color: #80bdff;
                        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
                    }

                    .btn-primary {
                        padding: 0.5rem 1.5rem;
                        font-weight: 500;
                    }

                    .card-header {
                        border-bottom: 1px solid rgba(0,0,0,.125);
                    }

                    textarea {
                        resize: vertical;
                        min-height: 100px;
                    }
                    </style>
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