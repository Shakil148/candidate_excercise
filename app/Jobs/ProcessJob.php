<?php

namespace App\Jobs;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportStudents;
use DB;
class ProcessJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $students;

    public function __construct($students)
    {
        $this->students = $students;
    }

    public function handle()
    {
        // $export = new ExportStudents;
        //   $export->download('students.csv', \Maatwebsite\Excel\Excel::CSV);
        $chunks = array_chunk($this->students, 1000);
        foreach ($chunks as $chunk) {
            Student::insert($chunk);
        }
    }
}
