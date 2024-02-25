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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->nullable()->constrained()->nullOnDelete();
            $table->string('status')->comment('pending, expired, failed, success');
            $table->string('number');
            $table->unsignedInteger('total')->default(0);
            $table->json('course');
            $table->string('snap_token', 45)->nullable();
            $table->string('payment_method', 45)->nullable();
            $table->string('payment_status', 45)->nullable();
            $table->dateTime('pending_at')->nullable();
            $table->dateTime('expired_at')->nullable();
            $table->dateTime('failed_at')->nullable();
            $table->dateTime('success_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
