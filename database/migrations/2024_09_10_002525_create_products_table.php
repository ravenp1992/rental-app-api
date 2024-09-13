<?php

use App\Enums\ProductStatus;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->unsignedInteger('rent_price');
            $table->unsignedInteger('buy_price')->nullable();
            $table->unsignedInteger('deposit')->default(0);
            $table->integer('stock_quantity')->default(1);
            $table->string('status')->default(ProductStatus::DRAFT->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
