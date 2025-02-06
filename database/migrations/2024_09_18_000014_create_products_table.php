<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('productID');
            $table->unsignedBigInteger('categoryID');
            $table->unsignedBigInteger('brandID');
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->integer('quantityInStock')->nullable();
            $table->integer('inStocked')->nullable();
            $table->boolean('status')->default(1);
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->foreign('categoryID')->references('categoryID')->on('categories')->onDelete('cascade');
            $table->foreign('brandID')->references('brandID')->on('brands')->onDelete('cascade');
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
