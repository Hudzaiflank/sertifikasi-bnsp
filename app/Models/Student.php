<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function studentClass()
    {
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }

    public function studentYear()
    {
        return $this->belongsTo(StudentYear::class, 'year_id', 'id');
    }
}


