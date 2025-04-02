<div class="container">
<h2>students List</h2>
<a href="{{ route('admin.students.create') }}" class="btn btn-primary mb-3">Create students</a>
<table class="table">
    <thead>
        <tr><th>stu_fname</th><th>stu_gra_id</th><th>stu_username</th><th>stu_password</th><th>stu_gender</th><th>stu_dob</th><th>stu_ph_number</th><th>stu_parent_number</th><th>stu_profile</th></tr>
    </thead>
    <tbody>
        @foreach ($students as $item)
                <tr>
                    <td>{{$item->stu_fname}}</td>
                    <td>{{$item->stu_gra_id}}</td>
                    <td>{{$item->stu_username}}</td>
                    <td>{{$item->stu_password}}</td>
                    <td>{{$item->stu_gender}}</td>
                    <td>{{$item->stu_dob}}</td>
                    <td>{{$item->stu_ph_number}}</td>
                    <td>{{$item->stu_parent_number}}</td>
                    <td>{{$item->stu_profile}}</td>
                    <td>
                        <a href="{{ route('admin.students.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.students.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>