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
        Schema::create('category_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent')->constrained('categories');
            $table->foreignId('child')->constrained('categories');
            $table->integer('no_of_questions')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_categories');
    }
};
