<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grade extends Model
{
    protected $fillable = [
        'registration_id',
        'grade_date',
        'grade',
        'comment',
    ];

    protected $casts = [
        'grade_date' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    // 🔥 Удобная связь к студенту (через registration)
    public function student()
    {
        return $this->hasOneThrough(
            Student::class,
            Registration::class,
            'id', // foreign key on registrations
            'id', // foreign key on students
            'registration_id', // local key on grades
            'student_id' // local key on registrations
        );
    }
}