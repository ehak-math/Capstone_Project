<?php

namespace App\Exports;

use App\Models\Students;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithHeadings
{
    /**
     * Return the collection of students.
     */
    public function collection()
    {
        return Students::get()->map(function ($student) {
            return [
                'ID' => $student->stu_id,
                'Full Name' => $student->stu_fname,
                'Grade ID' => $student->stu_gra_id,
                'Username' => $student->stu_username, 
                'Gender' => $student->stu_gender,
                'Date of Birth' => $student->stu_dob,
                'Phone Number' => $student->stu_ph_number,
                'Phone Number Parent' => $student->stu_parent_number,
                'Password' => $student->stu_password,
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
            'Grade ID',
            'Username',
            'Gender',
            'Date of Birth',
            'Phone Number',
            'Phone Number Parent',
            'Password',
        ];
    }
}
