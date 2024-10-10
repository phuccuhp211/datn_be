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
        Schema::create('product_size_spice_quantity', function (Blueprint $table) {
            $table->id(); // ID tự động tăng
            $table->foreignId('product_size_id')->constrained('product_sizes')->onDelete('cascade'); // Khóa ngoại đến bảng product_sizes
            $table->foreignId('product_spice_id')->constrained('product_spices')->onDelete('cascade'); // Khóa ngoại đến bảng product_spices
            $table->integer('quantity'); // Số lượng sản phẩm cho size và vị tương ứng
            $table->timestamps(); // Thời gian tạo và cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_size_spice_quantity');
    }
};