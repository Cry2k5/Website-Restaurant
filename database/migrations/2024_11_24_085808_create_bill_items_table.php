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
        Schema::create('bill_items', function (Blueprint $table) {
            $table->id('bill_item_id')->primary();
            $table->foreignId('bill_id')->references('bill_id')->on('bills');
            $table->foreignId('dish_id')->references('dish_id')->on('dishes');
            $table->integer('quantity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_items');
    }
};
