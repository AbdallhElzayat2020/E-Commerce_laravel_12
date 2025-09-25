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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->string('email');
            $table->string('email_support');
            $table->string('phone');
            $table->string('address');
            $table->string('logo');
            $table->string('favicon');
            $table->string('facebook');
            $table->string('x');
            $table->string('instagram');
            $table->string('linkedin');
            $table->string('youtube');
            $table->string('tiktok');
            $table->string('pinterest');
            $table->string('reddit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
