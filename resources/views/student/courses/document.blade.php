@extends('layout.navbar_student')
@section('title', 'Submit Attendance')
@section('mainContent')
<div class="content">
    <div class="row justify-content-center">
        <!-- Main content area -->
        <div class="col-lg-8 col-md-12">
            <div class="card shadow mt-5">
                <div class="card-header bg-primary text-white">
                    <h1>Course{{$select->cou_id}}</h1>   
                </div>

                <div class="card-body">
                    @if($documents && $documents->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th>Upload Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($documents as $document)
                                        <tr>
                                            <td>{{ $document->doc_name }}</td>
                                            {{-- <td>{{ $document->course->sub_name ?? 'N/A' }}</td> --}}
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
</div>
@endsection