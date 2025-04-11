@extends('layout.navbar_admin')
@section('title', 'Course')
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
                        <h3>Course List</h3>
                        <div>
                            @include('admin.courses.create')
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
                    <div class="row g-2">
                        @foreach ($courses as $course)
                            <!-- subject -->
                            <div class="col-6 col-md-3">
                                <div class="subject">
                                    <div class="card" style="z-index: 1;">
                                        <a href="{{ route('admin.courses.view_detail', ['id' => $course->cou_id] )  }}" class="course-link">
                                            <img src="{{ asset('images/subject.jpg') }}" class="card-img-top" alt="Mathematics">
                                            <div class="card-body">
                                                <h5 class="card-title" style="color: #11117E">{{ $course->sub_name }}</h5>
                                                <div class="course-text">
                                                    <p class="card-text"><strong>Teacher:</strong> {{ $course->tea_fname }} <br>
                                                        <strong>Grade:</strong> {{ $course->gra_class }}
                                                        {{ $course->gra_group }}</p>
                                                    <!-- <p class="card-text"></p> -->
                                                </div>
                                                <div class="mt-2">
                                                    <!-- view details -->
                                                    <a href="{{ route('admin.courses.view_detail', ['id' => $course->cou_id] )  }}"
                                                        class="btn btn-success">VIEW
                                                    </a>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{$course->cou_id}}">
                                                        EDIT
                                                    </button>
                                                    <!-- Delete Button -->
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal"
                                                        onclick="setDeleteAction('{{ route('admin.courses.delete', ['id' => $course->cou_id]) }}')">
                                                        DELETE
                                                    </button>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @include('admin.courses.edit')
                        @endforeach
                        @include('admin.courses.delete')
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection