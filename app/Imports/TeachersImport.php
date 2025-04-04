<?php

namespace App\Imports;

use App\Models\Teachers;
use App\Models\Subjects;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

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

        // Validate and format the date of birth
        $dob = null;
        if (!empty($row[6])) {
            if (is_numeric($row[6])) {
                // Handle Excel serial date format
                $dob = Carbon::instance(Date::excelToDateTimeObject($row[6]))->format('Y-m-d');
            } else {
                // Handle string dates
                try {
                    $dob = Carbon::parse($row[6])->format('Y-m-d');
                } catch (\Exception $e) {
                    $dob = null; // If parsing fails, set to null
                }
            }
        }

        return new Teachers([
            'tea_fname' => $row[1],
            'tea_username' => $row[2],
            'tea_gender' => $row[3],
            'tea_subject' => $subject ? $subject->sub_id : null,
            'tea_ph_number' => $row[5],
            'tea_dob' => $dob,
            'tea_password' => Hash::make('default_password'), // Set a default hashed password
        ]);
    }
}