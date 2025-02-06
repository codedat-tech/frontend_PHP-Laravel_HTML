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
        Schema::create('blueprints', function (Blueprint $table) {
            $table->id('blueprintID');
            $table->unsignedBigInteger('categoryDesignID');
            $table->unsignedBigInteger('designerID')->nullable();
            $table->string('name');
            $table->string('image');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('categoryDesignID')->references('categoryDesignID')->on('category_designs')->onDelete('cascade');
            $table->foreign('designerID')->references('designerID')->on('designers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blueprints');
    }
};
