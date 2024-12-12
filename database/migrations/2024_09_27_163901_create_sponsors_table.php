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
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id'); // ID chính của dự án
            $table->string('name', 100); // Tên dự án
            $table->text('description')->nullable(); // Mô tả chi tiết về dự án
            $table->decimal('total_amount', 15, 2); // Số tiền mục tiêu cần huy động
            $table->decimal('raised_amount', 15, 2)->default(0); // Số tiền đã huy động được
            $table->string('project_image_url')->nullable(); // URL ảnh đại diện của dự án
            $table->enum('status', ['active', 'completed', 'cancelled'])->default('active'); // Trạng thái dự án
            $table->timestamps(); // Thời gian tạo và cập nhật dự án
        });

        // Bảng danh sách ủng hộ
        Schema::create('sponsors', function (Blueprint $table) {
            $table->bigIncrements('id'); // ID chính của lần ủng hộ
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade'); // Liên kết với bảng projects
            $table->string('email', 50); // Email người ủng hộ
            $table->string('name', 30); // Tên người ủng hộ
            $table->decimal('amount', 15, 2); // Số tiền ủng hộ
            $table->dateTime('date'); // Ngày giờ ủng hộ
            $table->text('message')->nullable(); // Tin nhắn hoặc ghi chú từ người ủng hộ (nếu có)
            $table->timestamps(); // Thời gian tạo và cập nhật bản ghi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
        Schema::dropIfExists('sponsors');
    }
};