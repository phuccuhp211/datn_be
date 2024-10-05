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
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->string('name', 40);
            $table->string('phone', 12);
            $table->string('email', 25);
            $table->text('address');
            $table->text('list');
            $table->bigInteger('amount');
            $table->string('discount', 10)->nullable();
            $table->bigInteger('total');
            $table->enum('language', ['vi', 'eng'])->default('vi');
            $table->string('slug')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};