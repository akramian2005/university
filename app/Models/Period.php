<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Period extends Model
{
    protected $fillable = [
        'name',
        'start_time',
        'end_time',
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time'   => 'datetime:H:i',
    ];

    // Связь с расписанием
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
}
