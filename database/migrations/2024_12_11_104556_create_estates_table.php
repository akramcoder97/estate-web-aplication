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
        Schema::create('estates', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->integer('floor');
            $table->integer('pieces')->nullable();
            $table->integer('surface')->nullable();
            $table->string('specification');
            $table->string('price');
            $table->string('price_unit');
            $table->string('state');
            $table->string('town');
            $table->string('city')->nullable();
            $table->string('images');
            $table->string('phone');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estates');
    }
};
