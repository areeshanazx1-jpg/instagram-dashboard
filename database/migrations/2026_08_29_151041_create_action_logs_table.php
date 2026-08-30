<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('action_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instagram_account_id')
                  ->constrained('instagram_accounts')
                  ->onDelete('cascade');
            $table->string('target_username');
            $table->string('action_type');
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->json('response_payload')->nullable();
            $table->timestamps();
            
            $table->index('status');
            $table->index('instagram_account_id');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('action_logs');
    }
};