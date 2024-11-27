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
        Schema::create('bills', function (Blueprint $table) {
            $table->id('bill_id')->primary();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('reservation_id')->nullable()->references('reservation_id')->on('reservations');
            $table->foreignId('table_id')->references('table_id')->on('restaurant_tables');
            $table->string('payment_method')->nullable();
            $table->dateTime('bill_time')->nullable();
            $table->dateTime('payment_time')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
