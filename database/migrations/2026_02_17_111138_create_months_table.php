<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('months', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Январь, February и т.д.
            $table->integer('number'); // 1-12 для удобной сортировки
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('months');
    }
};
