@extends('layout.navbar_teacher')
@section('title', 'Dashboard')
@section('mainContent')
    <!-- Main Content -->
    <div class="content">
        <div class="row">
            <!-- Main content area -->
            <div class="col-lg-8 col-md-12">
                <div class="date_name">
                    <h3>Greatings, {{$teacher->tea_fname}}!</h3>
                    <p>Subject, {{ $teacher->subject->sub_name }}
                    </p>
                </div>

                <div class="row g-4 mt-2">
                    <div class="col-md-6">
                        <div class="overview-box1 d-flex gap-2">
                            <h2 class="title_over">{{ $totalStudents }}</h2>

                            <div class="total-teach-stu">
                                <h4>Students</h4>
                                <div class="lh-1">
                                    <p style="font-size: 15px"><span class="color-female"><i
                                                class="fa-solid fa-user"></i></span>Female({{ $femaleCount }})</p>
                                    <p style="font-size: 15px"><span class="color-male"><i
                                                class="fa-solid fa-user"></i></span>Male({{ $maleCount }})</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="overview-box1 d-flex gap-2">
                            <h2 class="title_over">{{ $totalStudents }}</h2>

                            <div class="total-teach-stu">
                                <h4>Attandance</h4>
                                <div class="lh-1">
                                    <p style="font-size: 15px"><span class="color-female"><i
                                                class="fa-solid fa-user"></i></span>Absent({{ $femaleCount }})</p>
                                    <p style="font-size: 15px"><span class="color-male"><i
                                                class="fa-solid fa-user"></i></span>Present({{ $maleCount }})</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row g-4 mt-2">
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

            <!-- Schedule section -->
            <div class="col-lg-4 col-md-12 mt-4 mt-lg-5 p-3 scheldule-section">
                <!-- FullCalendar -->
                <div class="calender mt-4 bg-white rounded">
                    <div>
                        <div class="header">
                            <button id="prevBtn">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>
                            <div class="monthYear" id="monthYear"></div>
                            <button id="nextBtn">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                        <div class="days">
                            <div class="day">Sun</div>
                            <div class="day">Mon</div>
                            <div class="day">Tue</div>
                            <div class="day">Wed</div>
                            <div class="day">Thu</div>
                            <div class="day">Fri</div>
                            <div class="day">Sat</div>
                        </div>
                        <div class="dates" id="dates"></div>
                    </div>
                </div>
            </div>
        </div>
@endsection