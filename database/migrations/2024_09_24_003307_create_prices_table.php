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
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->foreignId('product_id')->constrained();
            $table->integer('daily_rate')->default(0);
            $table->integer('weekly_rate')->default(0);
            $table->integer('monthly_rate')->defaultt(0);
            $table->integer('buy_price')->nullable();
            $table->string('currency', length: 3);
            $table->date('valid_from');
            $table->date('valid_to');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
