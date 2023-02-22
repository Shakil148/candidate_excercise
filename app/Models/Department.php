<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    public function student()
    {
        return $this->hasOne(Student::class);
    }
    public static function newFactory()
    {
        return \Database\Factories\DepartmentFactory::new();
    }
}
