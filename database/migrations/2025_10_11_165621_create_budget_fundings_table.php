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
        Schema::create('budget_fundings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fundings_id')
                ->constrained('fundings')
                ->onDelete('cascade');
            $table->bigInteger('amount');
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
        Schema::dropIfExists('budget_fundings');
    }
};
