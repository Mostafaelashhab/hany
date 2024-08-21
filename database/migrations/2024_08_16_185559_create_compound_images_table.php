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
        Schema::create('compound_images', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->bigInteger('compound_id')->unsigned();
            $table->foreign('compound_id')->references('id')->on('compounds')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compound_images');
    }
};
