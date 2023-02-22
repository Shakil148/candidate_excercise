<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'first_name', 'last_name', 'student_id', 'age', 'department_id', 'deleted_at'
    ];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'student_subject', 'student_id', 'subject_id')->withPivot('subject_id')->withTimestamps();
    }
}
