<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    // Разрешаем массовое заполнение полей
    protected $fillable = ['name', 'building_id'];

    /**
     * Связь: аудитория принадлежит корпусу
     */
    public function building()
    {
        return $this->belongsTo(Building::class);
    }
}
