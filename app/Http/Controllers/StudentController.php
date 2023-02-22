<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Department;
use App\Models\Subject;
use \Cache;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportStudents;
use App\Jobs\ProcessJob;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $students = Cache::remember('students_list', 60, function () {
        //     return Student::with('department', 'subjects')->latest()->paginate(20);
        // });
        // $students = Student::with('department', 'subjects')->take(10)->get();
        // dd($students[0]->subjects);
        $students = Student::with('department', 'subjects')->latest()->paginate(20);
        // dd($students->department);
        return view('students.index', compact('students'))
            ->with('i', (request()->input('page', 1) - 1) * 20);
    }
    public function exportCSVFile() 
    {
        return (new ExportStudents)->download('students.csv', \Maatwebsite\Excel\Excel::CSV);
        // ProcessJob::dispatch();
        // return redirect()->route('students.index')
            // ->with('success', 'Your file is downloading...');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::latest()->get();
        $subjects = Subject::latest()->get();
        return view('students.create', compact('departments', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'student_id' => [
                'required',
                Rule::unique('students')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                })
            ],
            'age' => 'required|integer|min:1|max:200'
        ]);


        $subject =  $request->input('subjects_id');
        // dd($subject);
        $student = Student::create($request->all());
        $student->subjects()->attach($subject);

        return redirect()->route('students.index')
            ->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        // $student->load('department', 'subjects');
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        // dd($student->subjects);
        $departments = Department::latest()->get();
        $subjects = Subject::latest()->get();
        $student->load('subjects');
        // dd($student);
        return view('students.edit', compact('student','departments','subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'student_id' => [
                'required',
                Rule::unique('students')->where(function ($query) use ($student) {
                    return $query->where('id', '<>', $student->id)
                        ->whereNull('deleted_at');
                }),
            ],
            'age' => 'required|integer|min:1|max:200'
        ]);
        $subject =  $request->input('subjects_id');
        // $student->load('subjects')->with;
        $student->update($request->all());
        $student->subjects()->sync($subject);

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully');
    }
}
