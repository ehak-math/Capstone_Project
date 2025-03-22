 {{-- @extends('layouts.app') --}}


<div class="container">
    {{-- <div class="row">
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
    </div> --}}

    <div class="uploadfile mt-4">
        {{-- @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif --}}

        {{-- <form action="{{route('uploadfile')}}" method="post" enctype="multipart/form-data">
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
        </form> --}}
<div class="all" style="display: flex">
        <div class="dissub" style="margin-right: 50px; border-right: 1px solid black; padding-right: 50px;">
            @foreach($subjects as $sub)
            <h4>{{$sub->sub_id}}</h4>
            <span>{{$sub->sub_name}}</span>
            <img src="{{ asset('storage/' . $sub->sub_image) }}" >
            <span><a href="{{ route("subject.edit",['id' => $sub->sub_id]) }}">Edit</a></span>
            @endforeach

            <form action="{{ route('addsub') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="sub_image" accept="image/*">
                <input type="text" name="sub_name">
                <button type="submit">Upload</button>
            </form>
        </div>

        <div class="distea" style="margin-right: 50px; border-right: 1px solid black; padding-right: 50px;">
            @foreach($teachers as $tea)
            <h4>{{$tea->tea_id}}</h4>
            <span>{{$tea->tea_fname}}</span>
            <span>{{$tea->sub_name}}</span>

            @endforeach
        </div>
    </div>
        
    </div>
</div>

