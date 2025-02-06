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
        Schema::create('review_consultations', function (Blueprint $table) {
            $table->id('reviewConsultationID');
            $table->unsignedBigInteger('consultationID');
            $table->float('rating');
            $table->string('comment');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_consultations');
    }
};
