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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('book_title');
            $table->text('thumbnail');
            $table->bigInteger('book_catagory');
            $table->bigInteger('book_sub_catagory');
            $table->bigInteger('book_child_catagory');
            $table->text('description');
            $table->bigInteger('author_id');
            $table->date('published_year');
            $table->bigInteger('status')->nullable();
            $table->bigInteger('is_deleted')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
