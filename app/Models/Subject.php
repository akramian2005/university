<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];

    // Потоки по предмету
    public function streams()
    {
        return $this->hasMany(Stream::class);
    }

    // Учителя по предмету
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'subject_teacher', 'subject_id', 'teacher_id');
    }


    // Регистрации студентов по предмету
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
