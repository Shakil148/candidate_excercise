<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use DB;

class ExportStudents implements FromCollection, WithHeadings
{
    use Exportable;
    public function collection()
    {
        return Student::select('first_name', 'last_name', 'students.student_id', 'age', 'departments.name', DB::raw('group_concat(subjects.name separator ", ") as subject_name'))
        ->leftJoin('departments', 'departments.id', '=', 'department_id')
        ->leftJoin('student_subject', 'student_subject.student_id', '=', 'students.id')
        ->leftJoin('subjects', 'subjects.id', '=', 'student_subject.subject_id')
        ->groupBy('students.id')
        ->orderBy('students.id', 'Desc')
        ->take(100000)->get();
    }
    public function headings(): array
    {
        return [
            'First Name', 'Last Name', 'Student Id', 'Age', 'Department', 'Subjects'
        ];
    }
}
