<?php

namespace App\Exports;

use App\Models\Teachers;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TeachersExport implements FromCollection, WithHeadings
{
    /**
     * Return the collection of teachers.
     */
    public function collection()
    {
        return Teachers::with('subject')->get()->map(function ($teacher) {
            return [
                'ID' => $teacher->tea_id,
                'Full Name' => $teacher->tea_fname,
                'Username' => $teacher->tea_username,
                'Gender' => $teacher->tea_gender,
                'Subject' => $teacher->subject ? $teacher->subject->sub_name : 'N/A',
                'Phone Number' => $teacher->tea_ph_number,
                'Date of Birth' => $teacher->tea_dob,
                'Password' => $teacher->tea_password, 
            ];
        });
    }

    /**
     * Define the headings for the Excel file.
     */
    public function headings(): array
    {
        return [
            'ID',
            'Full Name',
            'Username',
            'Gender',
            'Subject',
            'Phone Number',
            'Date of Birth',
            'Password',
        ];
    }
}