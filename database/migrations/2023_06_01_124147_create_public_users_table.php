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
        Schema::create('public_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('email');
            $table->bigInteger('email_verified')->nullable();
            $table->bigInteger('mobile_number');
            $table->bigInteger('otp_code')->nullable();
            $table->string('gender')->nullable();
            $table->string('blog')->nullable();
            $table->string('address')->nullable();
            $table->text('password');
            $table->text('user_thumbnail')->nullable();
            $table->string('user_distric')->nullable();
            $table->string('user_catagory')->nullable();
            $table->bigInteger('is_deleted')->nullable();
            $table->bigInteger('status')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_users');
    }
};