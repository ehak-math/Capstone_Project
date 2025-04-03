<?php

namespace App\Imports;

use App\Models\Teachers;
use App\Models\Subjects;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class TeachersImport implements ToModel
{
    /**
     * Map each row of the Excel file to a Teacher model.
     */
    public function model(array $row)
    {
        // Skip the header row
        if ($row[0] === 'ID') {
            return null;
        }

        // Find the subject by name
        $subject = Subjects::where('sub_name', $row[4])->first();

        return new Teachers([
            'tea_fname' => $row[1],
            'tea_username' => $row[2],
            'tea_gender' => $row[3],
            'tea_subject' => $subject ? $subject->sub_id : null,
            'tea_ph_number' => $row[5],
            'tea_dob' => $row[6],
            'tea_password' => Hash::make('default_password'), // Set a default hashed password
        ]);
    }
}