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
        Schema::create('area_information', function (Blueprint $table) {
            $table->id("area_id");
            $table->string("areaInformation");
            $table->string("municipality");
            $table->unsignedBigInteger('created_by');
            $table->boolean('is_active')->default(true);
            $table->date('date_created');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area_models');
    }
};
