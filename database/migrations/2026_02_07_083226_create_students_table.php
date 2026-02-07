<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id()->startingValue(100000);             // Primary key
            $table->string('first_name');    // Имя студента
            $table->string('last_name');     // Фамилия студента
            $table->date('date_born')->nullable(); // Дата рождения (необязательная)

            // Внешние ключи
            $table->foreignId('gender_id')->nullable();
            $table->foreignId('region_id')->nullable();
            $table->foreignId('nationality_id')->nullable();
            $table->foreignId('group_id')->nullable();
            $table->foreignId('form_of_study_id')->nullable();

            $table->timestamps(); // created_at и updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
