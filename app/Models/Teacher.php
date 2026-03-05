<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Teacher extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'password',
        'rate',
        'position',
        'salary',
        'avatar',
    ];

    public function getAvatarUrlAttribute()
    {
        return $this->avatar 
            ? asset('storage/' . $this->avatar) 
            : asset('images/default-teacher-avatar.png');
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function subjects()
    {
        return $this->belongsToMany(
            Subject::class,
            'subject_teacher',
            'teacher_id',
            'subject_id'
        );
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Salary Logic
    |--------------------------------------------------------------------------
    */

    public function calculateSalary()
    {
        $baseRateSalary = 300000;
        $salary = $baseRateSalary * ($this->rate ?? 1);

        $positionBonus = match ($this->position) {
            'Старший преподаватель' => 1000,
            'Доцент' => 2000,
            'Профессор' => 3000,
            default => 0,
        };

        return $salary + $positionBonus;
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($teacher) {
            $teacher->salary = $teacher->calculateSalary();
        });
    }
}