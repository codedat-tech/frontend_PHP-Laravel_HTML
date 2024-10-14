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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id('consultationID');
            $table->unsignedBigInteger('designerID');
            $table->unsignedBigInteger('customerID');
            $table->dateTime('scheduledAT');
            $table->string('status');
            $table->string('note');
            $table->timestamps();
            $table->foreign('designerID')->references('designerID')->on('designers')->onDelete('cascade');
            $table->foreign('customerID')->references('customerID')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
