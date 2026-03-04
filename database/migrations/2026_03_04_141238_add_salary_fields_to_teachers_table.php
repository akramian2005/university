<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->decimal('rate', 3, 1)->default(1); // 0.5, 1, 1.5
            $table->string('position')->nullable();    // должность
            $table->integer('salary')->nullable();     // рассчитанная зарплата
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            //
        });
    }
};
