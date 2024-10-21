<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('type')->unsigned();
            $table->string('name', 20);
            $table->integer('age');
            $table->string('gender', 10);
            $table->string('colors', 20);
            $table->string('genitive', 20);
            $table->json('health_info');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->enum('language', ['vi', 'eng'])->default('vi');
            $table->string('slug')->nullable();
            $table->foreign('type')->references('id')->on('animal_catalogs');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
