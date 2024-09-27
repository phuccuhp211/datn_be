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
        Schema::create('stories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('thumbnail'); // URL ảnh hoặc chuỗi JSON chứa nhiều ảnh
            $table->foreignId('catalog_id')->constrained('story_catalogs')->onDelete('cascade'); // Liên kết với bảng 'story_catalogs'
            $table->string('title', 40)->notNull(); // Tiêu đề bài viết
            $table->text('content'); // Nội dung bài viết
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); // Liên kết với bảng 'users' cho tác giả
            $table->dateTime('date'); // Ngày đăng bài
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stories');
    }
};