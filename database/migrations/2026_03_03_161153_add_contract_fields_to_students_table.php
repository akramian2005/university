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
        Schema::table('students', function ($table) {
            $table->integer('contract_price')->default(0); // Стоимость контракта
            $table->integer('contract_paid')->default(0);  // Сколько оплатил
        });
    }

    public function down(): void
    {
        Schema::table('students', function ($table) {
            $table->dropColumn(['contract_price', 'contract_paid']);
        });
    }
};
