<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('order_item_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // License key
            $table->string('license_key')->unique();

            // License type and status
            $table->enum('type', ['standard', 'extended', 'unlimited'])->default('standard');
            $table->enum('status', ['active', 'expired', 'suspended', 'revoked'])->default('active');

            // Activation limits
            $table->integer('max_activations')->default(1);
            $table->integer('current_activations')->default(0);

            // Domain/device activations
            $table->json('activations')->nullable(); // Store domain/device info

            // Validity
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('expires_at')->nullable();

            // Download info
            $table->integer('download_count')->default(0);
            $table->timestamp('last_downloaded_at')->nullable();

            $table->timestamps();

            $table->index('license_key');
            $table->index(['product_id', 'status']);
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('licenses');
    }
};
