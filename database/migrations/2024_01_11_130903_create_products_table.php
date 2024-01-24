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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id');
            $table->foreignId('category_id');
            $table->string('name')->nullable();
            $table->integer('code')->nullable();
            $table->string('unit')->nullable();
            $table->integer('buy_price')->nullable();
            $table->integer('sale_price')->nullable();
            $table->integer('discount')->nullable()->default(0);
            $table->integer('stock')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->string('descript')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
