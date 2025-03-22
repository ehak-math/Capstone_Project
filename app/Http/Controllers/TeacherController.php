<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teachers;
use App\Models\Subject;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{

    public function showsubject(){
        $subjects = Subject::displaySubject();
        $teachers = Teachers::displayTeacher();
        return view('listadmin', ['subjects' => $subjects, 'teachers' => $teachers]);

    }
    function uploads($data){
        if ($data) {
            $file =$data;
            
            // Create unique filename
            $imageName = 'sub_name' . '_' . time() . '.' . $file->getClientOriginalExtension();
            
            // Store file in public/images directory
            $path = $file->storeAs('images', $imageName, 'public');
        }
        return $path;

    }
    public function store(Request $request)
    {
        $request->validate([
            'sub_name' => 'required',
            'sub_image' => 'required|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $path = $this->uploads($request->file('sub_image'));
        
        if (!$path) {
            return redirect()->back()
                ->with('error', 'Failed to upload image')
                ->withInput();
        }

        $data = [
            'sub_name' => $request->sub_name,
            'sub_image' => $path
        ];

        Subject::insertSubject($data);
        return redirect()->back()->with('success', 'Subject created successfully!');
    }
}
