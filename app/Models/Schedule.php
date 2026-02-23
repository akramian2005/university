<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'subject_id',
        'teacher_id',
        'classroom_id',
        'building_id',
        'period_id',
        'day_of_week',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }
}
