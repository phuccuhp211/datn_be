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
        Schema::create('catalogs_animals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 20);
            $table->timestamps();
        });
        Schema::create('catalogs_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 20);
            $table->timestamps();
        });
        Schema::create('catalogs_news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 20);
            $table->integer('index');
            $table->timestamps();
        });
        Schema::create('sponsors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 30);
            $table->bigInteger('amount');
            $table->dateTime('date');
            $table->timestamps();
        });
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('img');
            $table->string('name', 30);
            $table->bigInteger('type')->unsigned();
            $table->text('purpose');
            $table->bigInteger('price');
            $table->foreign('type')->references('id')->on('catalogs_products');
            $table->timestamps();
        });
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('name', 40);
            $table->string('phone', 12);
            $table->string('email', 25);
            $table->text('address');
            $table->text('list');
            $table->bigInteger('amount');
            $table->string('discount', 10)->nullable();
            $table->bigInteger('total');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('thumbnail');
            $table->bigInteger('catalog_id')->unsigned();
            $table->string('title', 40);
            $table->text('content');
            $table->bigInteger('author_id')->unsigned();
            $table->dateTime('date');
            $table->foreign('catalog_id')->references('id')->on('catalogs_news');
            $table->foreign('author_id')->references('id')->on('users');
            $table->timestamps();
        });
        Schema::create('form_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 40);
            $table->string('phone', 12);
            $table->string('email', 25);
            $table->text('address');
            $table->text('message');
            $table->bigInteger('user_id')->unsigned();
            $table->string('type', 10);
            $table->string('status', 10);
            $table->string('addition_infomation', 100)->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
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
            $table->foreign('type')->references('id')->on('catalogs_animals');
            $table->foreign('form_requests_id')->references('id')->on('form_requests');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogs_animals');
        Schema::dropIfExists('catalogs_products');
        Schema::dropIfExists('catalogs_news');
        Schema::dropIfExists('sponsors');
        Schema::dropIfExists('products');
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('news');
        Schema::dropIfExists('form_requests');
        Schema::dropIfExists('animals');
    }
};
