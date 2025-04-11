@extends('layout.navbar_admin')
@section('title', 'Grade/Subject')
@section('mainContent')
    <!-- Main Content -->
    <div class="content">
        <div class="row">
            <!-- Main content area -->
            <div class="col-lg-12 col-md-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" style="z-index: 100000;" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="date_name">
                    <h3>Greatings, {{Auth::user()->name}}!</h3>
                    <p id="currentDate"></p>
                </div>
                <div class="info-coures rounded mt-2">
                    <div class="d-flex justify-content-between">
                        <h3>Grade/Subject</h3>
                        <div>
                            @include('admin.grade_subject.grade.create_grade')
                            @include('admin.grade_subject.subject.create_subject')
                        </div>
                    </div>
                    <hr>
                    <!-- filter -->
                    <div class="d-flex gap-2">
                        <input type="text" class="form-control" placeholder="Search...">
                        <div class="col-auto d-flex gap-2">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Sort by</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Filter by</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <!-- grade Table -->
                        <div class="col-lg-6 col-md-12 mt-2">
                            <div class="gap-2">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">No.1</th>
                                                <th scope="col">Grade</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($grades as $index => $grade)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $grade->gra_class }} {{ $grade->gra_group }}</td>
                                                    <td>
                                                        @include('admin.grade_subject.grade.edit_grade')

                                                        @include('admin.grade_subject.grade.delete_grade')

                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- subject Table -->
                        <div class="col-lg-6 col-md-12 mt-2">
                            <div class="gap-2">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">No.1</th>
                                                <th scope="col">Subject</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subjects as $index => $subject)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $subject->sub_name }}</td>
                                                    <td>
                                                        @include('admin.grade_subject.subject.edit_subject')
                                                        @include('admin.grade_subject.subject.delete_subject')
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection