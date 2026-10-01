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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->string('title');
            $table->string('type')->comment('ebook, kelas');
            $table->string('is_premium')->default(false);
            $table->unsignedInteger('price')->default(0);
            $table->unsignedInteger('discount')->default(0)->comment('in percentage');
            $table->string('description')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
