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
        Schema::create('animals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('type')->unsigned();
            $table->text('img');
            $table->string('name', 20);
            $table->integer('age');
            $table->string('gender', 10);
            $table->string('colors', 20);
            $table->string('genitive', 20);
            $table->text('health_info');
            $table->bigInteger('form_requests_id')->unsigned()->nullable();
            $table->foreign('type')->references('id')->on('animal_catalogs');
            $table->foreign('form_requests_id')->references('id')->on('form_requests');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};