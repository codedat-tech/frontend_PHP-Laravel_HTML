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
        Schema::create('review_orders', function (Blueprint $table) {
            $table->id('reviewOrderID');
            $table->unsignedBigInteger('orderID');
            $table->float('rating');
            $table->string('comment');
            $table->dateTime('createAT');
            $table->timestamps();
            $table->foreign('orderID')->references('orderID')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_orders');
    }
};
