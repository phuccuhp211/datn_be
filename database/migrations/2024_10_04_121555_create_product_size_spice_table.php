<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('product_size_spice', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Liên kết với bảng products
            $table->foreignId('product_size_id')->constrained('product_sizes')->onDelete('cascade'); // Liên kết với bảng product_sizes
            $table->foreignId('product_spice_id')->constrained('product_spices')->onDelete('cascade'); // Liên kết với bảng product_spices
            $table->integer('price'); // Giá của sản phẩm cho kích thước và gia vị cụ thể
            $table->integer('quantity'); // Số lượng cho kích thước và gia vị cụ thể
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('product_size_spice');
    }
};