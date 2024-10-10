<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_spices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Khóa ngoại tới bảng products
            $table->string('name', 50); // Tên của vị (Ví dụ: Vị gà, Vị bò, Vị cá)
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('product_spices');
    }
};