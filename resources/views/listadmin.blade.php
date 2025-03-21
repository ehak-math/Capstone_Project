 {{-- @extends('layouts.app') --}}


<div class="container">
    <div class="row">
        @foreach($admin as $ad)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $ad->adm_profile) }}" 
                         class="card-img-top" 
                         alt="Profile Image"
                         style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{$ad->adm_username}}</h5>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="uploadfile mt-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{route('uploadfile')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="mb-3">
                <label for="profile" class="form-label">Profile Image</label>
                <input type="file" name="profile" class="form-control" id="profile" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</div>

<style>
    .card {
        width: 150px;
        height: 100px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .card-img-top {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
</style>

