<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Authenticatable
{
    use HasFactory;
    
    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'password',
    ];
    
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_teacher', 'teacher_id', 'subject_id');
    }

    // Регистрации по учителю
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}

