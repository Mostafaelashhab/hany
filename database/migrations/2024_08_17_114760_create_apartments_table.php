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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('address_en');
            $table->string('address_ar');
            $table->string('image');
            $table->string('description_en');
            $table->string('description_ar');
            $table->string('price');
            $table->string('area');
            $table->string('delivery_in')->nullable();
            $table->string('bedrooms')->nullable();
            $table->string('living_rooms')->nullable();
            $table->string('kitchen')->nullable();
            $table->string('balcony')->nullable();
            $table->string('pool')->nullable();
            $table->string('garden')->nullable();
            $table->string('security')->nullable();
            $table->string('parking')->nullable();
            $table->string('rooms')->nullable();
            $table->string('bathrooms')->nullable();
            $table->string('garage')->nullable();
            $table->string('floor')->nullable();
            $table->string('zone');
            $table->string('latitude');
            $table->string('longitude');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('compound_id')->unsigned();
            $table->foreign('compound_id')->references('id')->on('compounds')->onDelete('cascade');
            $table->bigInteger('parentcat_id')->unsigned();
            $table->foreign('parentcat_id')->references('id')->on('parent_cats')->onDelete('cascade');
            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('apartment_types')->onDelete('cascade');
            $table->bigInteger('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('apartment_statuses')->onDelete('cascade');
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
