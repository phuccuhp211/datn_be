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
        Schema::create('story_catalogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 40);
            $table->integer('index');
            $table->enum('language', ['vi', 'en'])->default('vi');
            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('story_catalogs');
    }
};