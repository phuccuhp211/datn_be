<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('thumbnail');
            $table->foreignId('catalog_id')->constrained('story_catalogs')->onDelete('cascade');
            $table->string('title', 100);
            $table->text('content');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->dateTime('date');
            $table->enum('language', ['vi', 'eng'])->default('vi');
            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stories');
    }
};