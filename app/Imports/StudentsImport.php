<?php

namespace App\Imports;

use App\Models\Students;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class StudentsImport implements ToModel
{
    /**
    * Map each row of the Excel file to a Student model.
    * 
    * @param array $row
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Skip the header row
        if ($row[0] === 'ID') {
            return null;
        }

        // Validate and format the date of birth
        $dob = null;
        if (!empty($row[5])) {
            if (is_numeric($row[5])) {
                // Convert Excel's numeric date format
                $dob = Carbon::instance(Date::excelToDateTimeObject($row[5]))->format('Y-m-d');
            } else {
                try {
                    // Convert normal date string format
                    $dob = Carbon::parse($row[5])->format('Y-m-d');
                } catch (\Exception $e) {
                    $dob = null; // If date conversion fails, set to null
                }
            }
        }

        return new Students([
            'stu_fname' => $row[1],
            'stu_gra_id' => $row[2],
            'stu_username' => $row[3], 
            'stu_dob' => $dob,
            'stu_gender' => $row[4],
            'stu_ph_number' => $row[6],
            'stu_parent_number'=> $row[7],
            'stu_password' => Hash::make('default_password'), // Set a default hashed password
        ]);
    }
}
