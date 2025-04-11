@extends('layout.navbar_student')
@section('title', 'Submit Attendance')
@section('mainContent')
    <div class="content">
        <div class="row">
            <!-- Main content area -->
            <div class="col-lg-12 col-md-12">
                <div class="row g-2 mt-2">
                    <div class="date_name">
                        <h3>Greatings, {{ $student->stu_fname }}!</h3>
                        <p id="currentDate"></p>
                    </div>
                    <div class="info-coures rounded mt-2">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center gap-4">
                                <a href="{{ route('student.courses') }}" class="btn btn-primary"><i
                                        class="fa-solid fa-arrow-left"></i></a>
                                <h3>Documents</h3>
                            </div>
                        </div>
                        <hr>
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
    </div>
@endsection