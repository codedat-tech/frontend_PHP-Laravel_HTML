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
        Schema::create('designers', function (Blueprint $table) {
            $table->id('designerID');
            $table->string('fullname');
            $table->string('email');
            $table->string('password');
            $table->integer('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('portfolio')->nullable();
            $table->integer('experienceYear')->nullable();
            $table->string('specialization')->nullable();
            $table->string('image')->nullable();
            $table->float('rating')->nullable();
            $table->boolean('status')->default(1);
            $table->rememberToken()->nullable;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designers');
    }
};
