<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;
    // Разрешаем массовое заполнение поля name
    protected $fillable = ['name'];

    /**
     * Связь: корпус может иметь много аудиторий
     */
    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
}
