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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id('orderDetailID');
            $table->unsignedBigInteger('productID');
            $table->unsignedBigInteger('orderID');
            $table->integer('quantity');
            $table->timestamps();
            $table->foreign('productID')->references('productID')->on('products')->onDelete('cascade');
            $table->foreign('orderID')->references('orderID')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
