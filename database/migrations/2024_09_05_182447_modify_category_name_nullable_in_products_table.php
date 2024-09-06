<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCategoryNameNullableInProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('category_name')->nullable()->change(); // Make category_name nullable
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('category_name')->nullable(false)->change(); // Revert to non-nullable if needed
        });
    }

};
