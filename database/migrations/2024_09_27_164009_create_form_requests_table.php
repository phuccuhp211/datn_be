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
        Schema::create('form_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 40);
            $table->string('phone', 12);
            $table->string('email', 25);
            $table->text('address');
            $table->text('message');
            $table->string('type', 10);
            $table->string('status', 10);
            $table->string('addition_infomation', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_requests');
    }
};
