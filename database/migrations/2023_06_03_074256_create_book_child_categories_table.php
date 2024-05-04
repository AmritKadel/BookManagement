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
        Schema::create('book_child_categories', function (Blueprint $table) {
            $table->id();
            $table->string('child_title');
            $table->bigInteger('book_cat_id');
            $table->bigInteger('book_sub_cat_id');
            $table->bigInteger('display_order')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_child_categories');
    }
};
