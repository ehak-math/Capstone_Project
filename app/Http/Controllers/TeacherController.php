<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teachers;
use App\Models\Subject;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    public function editsubject($id)
    {
        $subject = Subject::findOrFail($id);
        return view('editteacher', compact('subject'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate request
            $validated = $request->validate([
                'sub_name' => 'required|unique:subjects,sub_name,' . $id . ',sub_id',
                'sub_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
            ]);

            // Find the subject first
            $subject = Subject::findOrFail($id);

            // Prepare update data
            $data = [
                'sub_name' => $request->sub_name
            ];

            // Handle image upload if new image provided
            if ($request->hasFile('sub_image')) {
                // Delete old image if exists
                if ($subject->sub_image && Storage::disk('public')->exists($subject->sub_image)) {
                    Storage::disk('public')->delete($subject->sub_image);
                }

                // Upload new image
                $path = $this->uploads($request->file('sub_image'));
                if (!$path) {
                    throw new \Exception('Failed to upload new image');
                }
                $data['sub_image'] = $path;
            }

            // Update using the model's static method
            Subject::updateSubject($id, $data);

            // Changed redirect to go back to listadmin view
            return redirect()->action([TeacherController::class, 'showsubject'])
                ->with('success', 'Subject updated successfully');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating subject: ' . $e->getMessage())
                ->withInput();
        }
    }
}
