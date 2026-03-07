<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();

            $table->foreignId('registration_id')->constrained()->cascadeOnDelete();
            $table->date('grade_date');
            $table->enum('type', ['module1','module2','final']); // 🔹 тип оценки
            $table->integer('grade'); // балл (ограничения проверяются в контроллере)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
