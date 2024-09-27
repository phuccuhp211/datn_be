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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('img'); // URL ảnh hoặc chuỗi JSON chứa nhiều ảnh
            $table->string('name', 30); // Tên sản phẩm
            $table->foreignId('type')->constrained('product_catalogs')->onDelete('cascade'); // Liên kết với bảng 'product_catalogs'
            $table->text('purpose'); // Mục đích của sản phẩm/dịch vụ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};