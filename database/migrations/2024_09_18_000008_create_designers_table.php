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
            $table->integer('phone');
            $table->string('address');
            $table->string('portfolio');
            $table->integer('experienceYear');
            $table->string('specialization');
            $table->string('image');
            $table->float('rating');
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
